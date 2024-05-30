<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use DateTime;
use Cake\ORM\TableRegistry;
use Cake\Http\Session;
use Cake\I18n\Date;
use Cake\Utility\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Cake\Utility\Text;

class MediaController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Files = TableRegistry::getTableLocator()->get('Files');
    }

    public function index()
    {

        if ($this->request->is('post')) {
            $images = $this->request->getUploadedFiles();
            if (!empty($images)) {
                // Upload ảnh
                $this->upload($images);

                // Redirect sau khi upload thành công để tránh lặp lại yêu cầu POST
                return $this->redirect(['action' => 'index']);
            }
        }

        // Lấy danh sách ảnh từ cơ sở dữ liệu
        $files = $this->Files->getAllFiles();
        $this->set(compact('files'));
    }

    public function select()
    {
        $this->viewBuilder()->setLayout('ajax');
        $files = $this->Files->find('all');
        $this->set(compact('files'));
    }
}
