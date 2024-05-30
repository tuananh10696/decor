<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use Intervention\Image\ImageManagerStatic as Image;

class ImageUploadComponent extends Component
{
    public function uploadImages($images, $productId)
    {
        $filesTable = TableRegistry::getTableLocator()->get('Files');
        $uploadedFiles = [];

        foreach ($images as $image) {
            $fileName = Text::uuid() . '-' . $image->getClientFilename();
            $hashedFileName = hash('sha256', $fileName) . '.' . $image->getClientExtension();
            $imagePath = WWW_ROOT . 'files' . DS . $hashedFileName;
            $thumbnailPath = WWW_ROOT . 'files' . DS . 'thumbnails' . DS . $hashedFileName;

            // Save original image
            $image->moveTo($imagePath);

            // Create and save thumbnail
            $thumbnail = Image::make($imagePath)->resize(150, 150);
            $thumbnail->save($thumbnailPath);

            $file = $filesTable->newEntity([
                'product_id' => $productId,
                'images' => 'files/' . $hashedFileName,
                'thumbnail' => 'files/thumbnails/' . $hashedFileName
            ]);

            if ($filesTable->save($file)) {
                $uploadedFiles[] = $file;
            }
        }

        return $uploadedFiles;
    }
}
