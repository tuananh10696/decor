<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\ORM\TableRegistry;
use Cake\Http\Session;
use Cake\I18n\Date;
use Cake\Utility\Hash;

class ProductsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('ImageUpload');
        $this->Products = TableRegistry::getTableLocator()->get('Products');

    }

    public function index()
    {

        // Your code here
    }

    public function edit()
    {
        $product = $this->Products->newEmptyEntity();

        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            dd($product);
            if ($this->Products->save($product)) {
                if (!empty($this->request->getData('images'))) {
                    $images = $this->request->getData('images');
                    $this->ImageUpload->uploadImages($images, 'Files');
                }

                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }

        $this->set(compact('product'));
    }
}
