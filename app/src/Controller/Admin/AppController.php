<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController as BaseAppController;
use Cake\Utility\Hash;
use Cake\ORM\TableRegistry;
use Cake\Http\Session;
use Cake\Utility\Text;
use Intervention\Image\ImageManagerStatic as Image;

class AppController extends BaseAppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('admin');
    }


    protected function upload($images)
    {
        // Đây là nơi định nghĩa hàm upload

        // Đường dẫn tới các thư mục upload
        $uploadPath = WWW_ROOT . 'upload' . DS . 'images' . DS . 'auth_imgs';
        $largePath = WWW_ROOT . 'upload' . DS . 'images' . DS . 'large_imgs';
        $thumbnailPath = WWW_ROOT . 'upload' . DS . 'images' . DS . 'thumb_imgs';

        // Tạo các thư mục nếu chưa tồn tại
        if (!is_dir($uploadPath)) mkdir($uploadPath, 0777, true);
        if (!is_dir($largePath)) mkdir($largePath, 0777, true);
        if (!is_dir($thumbnailPath)) mkdir($thumbnailPath, 0777, true);

        // Biến đếm số lượng ảnh tải lên thành công và không thành công
        $successCount = 0;
        $errorCount = 0;

        foreach ($images['images'] as $image) {
            // Lấy tên tệp và phần mở rộng
            $extension = pathinfo($image->getClientFilename(), PATHINFO_EXTENSION);

            // Tạo tên mới cho tệp
            // Lấy tên gốc của tệp
            $originalFileName = pathinfo($image->getClientFilename(), PATHINFO_FILENAME);

            // Tạo mã hash từ tên gốc và cắt chuỗi để lấy 2 ký tự đầu tiên
            $hash = substr(md5($originalFileName), 0, 2);

            // Tạo tên mới cho tệp
            $newFileName = $originalFileName . '_' . $hash . '.' . $extension;
            $originalFilePath = $uploadPath . DS . $newFileName;
            $largeFilePath = $largePath . DS . 'large_' . $newFileName;
            $thumbnailFilePath = $thumbnailPath . DS . 'thumb_' . $newFileName;

            // Lưu ảnh gốc
            $image->moveTo($originalFilePath);

            // Tạo và lưu thumbnail
            $this->convert_img('300x188', $originalFilePath, $thumbnailFilePath);

            // Tạo và lưu ảnh kích thước lớn
            $this->convert_img('800x500', $originalFilePath, $largeFilePath);

            // Lưu thông tin vào cơ sở dữ liệu
            if ($this->saveToDatabase($newFileName)) {
                $successCount++;
            } else {
                $errorCount++;
            }
        }

        // Hiển thị thông báo
        if ($successCount > 0) {
            $this->Flash->success(__($successCount . ' images uploaded successfully.'));
        }
        if ($errorCount > 0) {
            $this->Flash->error(__($errorCount . ' images failed to upload.'));
        }
    }

    private function saveToDatabase($newFileName)
    {
        $filesTable = $this->getTableLocator()->get('Files');
        $fileEntity = $filesTable->newEmptyEntity();
        $fileEntity->image = $newFileName;
        $fileEntity->created = date('Y-m-d H:i:s');
        return $filesTable->save($fileEntity) !== false;
    }

    /**
     * ファイルアップロード
     * @param $size [width]x[height]
     * @param $source アップロード元ファイル(フルパス)
     * @param $dist 変換後のファイルパス（フルパス）
     * @param $method 処理方法
     *        - fit     $size内に収まるように縮小
     *        - cover   $sizeの短い方に合わせて縮小
     *        - crop    cover 変換後、中心$sizeでトリミング
     * */

    public function convert_img($size, $source, $dist, $method = 'fit')
    {
        if (!file_exists($source)) {
            throw new \Exception('Source file does not exist: ' . $source);
        }

        list($ow, $oh) = getimagesize($source);
        $sz = explode('x', $size);
        $cmdline = '/usr/local/bin/convert';

        if (!file_exists($cmdline)) {
            throw new \Exception('ImageMagick convert command not found');
        }

        // Kiểm tra kích thước và phương thức thay đổi kích thước
        if (0 < $sz[0] && 0 < $sz[1]) {
            if ($ow <= $sz[0] && $oh <= $sz[1]) {
                // Kích thước ảnh gốc nhỏ hơn kích thước mong muốn
                $size = $ow . 'x' . $oh;
                $option = '-thumbnail ' . $size . '>';
            } else {
                // Kích thước ảnh gốc lớn hơn kích thước mong muốn
                if ($method === 'cover' || $method === 'crop') {
                    // Cắt ảnh theo kích thước mong muốn
                    $crop = $size;
                    if (($ow / $oh) <= ($sz[0] / $sz[1])) {
                        $size = $sz[0] . 'x';
                    } else {
                        $size = 'x' . $sz[1];
                    }

                    $option = '-thumbnail ' . $size . '>';

                    if ($method === 'crop') {
                        $option .= ' -gravity center -crop ' . $crop . '+0+0';
                    }
                } else {
                    // Thay đổi kích thước thông thường
                    $option = '-thumbnail ' . $size . '>';
                }
            }
        } else {
            // Kích thước không xác định, giữ nguyên kích thước gốc
            $size = $ow . 'x' . $oh;
            $option = '-thumbnail ' . $size . '>';
        }

        // Chạy lệnh ImageMagick
        $command = escapeshellcmd($cmdline . ' ' . $option . ' ' . escapeshellarg($source) . ' ' . escapeshellarg($dist));
        $output = system($command, $returnVar);

        if ($returnVar !== 0) {
            throw new \Exception('Error executing ImageMagick convert command: ' . $output);
        }

        // Thay đổi quyền tệp
        @chmod($dist, 0666);

        return $output;
    }



    // public function checkLogin()
    // {
    //     $session = new Session();
    //     if (empty($session->read('login'))) {
    //         return $this->redirect(['controller' => 'Top', 'action' => 'login', 'prefix' => 'admin']);
    //     }
    // }

    // public function checkRole()
    // {
    //     $session = new Session();
    //     if ($session->read('login')['role'] != 1) {
    //         $this->Flash->warning('権限がない！');
    //         return $this->redirect(['controller' => 'Top', 'action' => 'admin', 'prefix' => 'admin']);
    //     }
    // }

    // public function _edit($id = 0, $options = [])
    // {
    //     $options = array_merge([
    //         'contain' => [],
    //         'redirect' => ['action' => 'index'],
    //         'update_post_data' => null,
    //         'afterSave' => null,
    //         'beforeSave' => null
    //     ], $options);

    //     $entity = $this->Model->find('all')->where([$this->modelName . '.id' => $id]);
    //     if ($options['contain']) {
    //         $entity->contain($options['contain']);
    //     }
    //     $entity = $entity->first();
    //     if (!$entity) {
    //         $entity = $this->Model->newEntity([]);
    //     }

    //     if ($this->request->is(['post', 'put'])) {
    //         $opt = [];
    //         if ($options['contain']) {
    //             $opt['associated'] = $options['contain'];
    //         }
    //         $post_data = $this->request->getData();
    //         if ($options['update_post_data']) {
    //             $post_data = $options['update_post_data']($post_data);
    //         }
    //         $entity = $this->Model->patchEntity($entity, $post_data, $opt);

    //         if ($options['beforeSave']) {
    //             $entity = $options['beforeSave']($entity);
    //         }

    //         if (!$entity->hasErrors()) {
    //             if ($this->Model->save($entity)) {
    //                 $this->Flash->success(__('保存しました。'));

    //                 if ($options['afterSave']) {
    //                     $options['afterSave']($entity);
    //                 }
    //                 return $this->redirect($options['redirect']);
    //             } else {
    //                 $this->Flash->error(__('エラー、保存できませんでした。'));
    //             }
    //         }
    //     }

    //     $this->set(compact('entity'));
    // }

    // public function _status($id = 0)
    // {
    //     $entity = $this->Model->find('all')->where([$this->modelName . '.id' => $id])->first();

    //     if ($entity->id == '') {
    //         $this->Flash->error('更出来ませんでした！');
    //         return $this->redirect(['action' => 'index']);
    //     }

    //     if ($entity->status == 1) {
    //         $newStatus = 0;
    //     } else {
    //         $newStatus = 1;
    //     }

    //     $entity->status = $newStatus;

    //     // Update status to database
    //     if ($this->Model->save($entity)) {
    //         $this->Flash->success('変更しました。');
    //         return $this->redirect(['action' => 'index']);
    //     } else {
    //         $this->Flash->error('変更出来ませんでした！');
    //     }
    // }
    // /**
    //  * ファイル/記事削除
    //  *
    //  * */
    // protected function _delete($id, $type, $columns = null, $option = array())
    // {
    //     $option = array_merge(
    //         array('redirect' => null),
    //         $option
    //     );
    //     extract($option);

    //     $primary_key = $this->{$this->modelName}->getPrimaryKey();
    //     $query = $this->{$this->modelName}->find()->where([$this->modelName . '.' . $primary_key => $id]);

    //     if (!$query->isEmpty() && in_array($type, array('image', 'file', 'content'))) {
    //         $entity = $query->first();
    //         $data = $entity->toArray();
    //         $partyId = $entity->id;

    //         if ($type === 'image' && isset($this->{$this->modelName}->attaches['images'][$columns])) {
    //             if (!empty($data['attaches'][$columns])) {
    //                 foreach ($data['attaches'][$columns] as $_) {
    //                     $_file = WWW_ROOT . $_;
    //                     if (is_file($_file)) {
    //                         @unlink($_file);
    //                     }
    //                 }
    //             }
    //             $this->{$this->modelName}->updateAll(
    //                 array($columns => ''),
    //                 array($this->modelName . '.' . $this->{$this->modelName}->getPrimaryKey() => $id)
    //             );
    //         } elseif ($type === 'file' && isset($this->{$this->modelName}->attaches['files'][$columns])) {
    //             if (!empty($data['attaches'][$columns][0])) {
    //                 $_file = WWW_ROOT . $data['attaches'][$columns][0];
    //                 if (is_file($_file)) {
    //                     @unlink($_file);
    //                 }

    //                 $this->{$this->modelName}->updateAll(
    //                     array(
    //                         $columns => '',
    //                         $columns . '_name' => '',
    //                         $columns . '_size' => 0,
    //                     ),
    //                     array($this->modelName . '.' . $this->{$this->modelName}->getPrimaryKey() => $id)
    //                 );
    //             }
    //         } elseif ($type === 'content') {
    //             if (($this->{$this->modelName}->attaches['images'] ?? '') != null) {
    //                 $image_index = array_keys($this->{$this->modelName}->attaches['images']);
    //             }
    //             if (($this->{$this->modelName}->attaches['files'] ?? '') != null) {
    //                 $file_index = array_keys($this->{$this->modelName}->attaches['files']);
    //             }

    //             if (($image_index ?? '') != null) {
    //                 foreach ($image_index as $idx) {
    //                     foreach ($data['attaches'][$idx] as $_) {
    //                         $_file = WWW_ROOT . $_;
    //                         if (is_file($_file)) {
    //                             @unlink($_file);
    //                         }
    //                     }
    //                 }
    //             }

    //             if (($file_index ?? '') != null) {
    //                 foreach ($file_index as $idx) {
    //                     $_file = WWW_ROOT . $data['attaches'][$idx][0];
    //                     if (is_file($_file)) {
    //                         @unlink($_file);
    //                     }
    //                 }
    //             }

    //             //回転履歴の削除場合orders tableのデータも削除する
    //             if ($this->modelName === 'Parties') {
    //                 $ordersTable = TableRegistry::getTableLocator()->get('Orders');
    //                 $ordersToDelete = $ordersTable->find()->where(['party_id' => $partyId])->all();
    //                 foreach ($ordersToDelete as $order) {
    //                     $ordersTable->delete($order);
    //                 }
    //             }

    //             $this->{$this->modelName}->delete($entity);

    //             $id = 0;
    //         }
    //     }

    //     if ($redirect) {
    //         $this->redirect($redirect);
    //     }

    //     if ($redirect !== false) {
    //         if ($id) {
    //             $this->redirect(array('action' => 'edit', $id));
    //         } else {
    //             $this->redirect(array('action' => 'index'));
    //         }
    //     }

    //     return;
    // }

    // /**
    //  * 順番　入れ替え　ドラッグ用
    //  *
    //  * saved_data => [ ['id' => 2, 'position' => 5], ['id' => 1, 'position' => 3], ['id' => 3, 'position' => 1] ]
    //  * posted_positions =>  リオーダーする順序を指定するidの配列。形式は [3, 2, 1]
    //  *
    //  * save => 指定したidの順番にリオーダーされた配列。形式は [ ['id' => 3, 'position' => 5], ['id' => 2, 'position' => 3], ['id' => 1, 'position' => 1] ]
    //  */
    // protected function _drag_position()
    // {
    //     $this->autoRender = false;
    //     $new_positions = $this->request->getData('positions') ?? [1, 7, 2, 3];
    //     if (!$new_positions) {
    //         return false;
    //     }

    //     $cond = array(
    //         $this->modelName . '.id IN' => $new_positions
    //     );
    //     $datas = $this->{$this->modelName}->find()->where($cond)->toArray();
    //     $datas = array_map(function ($_data) {
    //         return [
    //             'id' => $_data['id'],
    //             'position' => $_data['position']
    //         ];
    //     }, $datas);

    //     // 既存positionを大きい順に並べて
    //     $newOrderDatas = $this->reorderArrayBasedOnId($datas, $new_positions);
    //     foreach ($newOrderDatas as $new_data) {
    //         $this->{$this->modelName}->updateAll(['position' => $new_data['position']], ['id' => $new_data['id']]);
    //     }
    //     return true;
    // }
}
