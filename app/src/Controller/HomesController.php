<?php

namespace App\Controller;
use Cake\ORM\TableRegistry;

use App\Controller\AppController;

class HomesController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        dd(2);

        $this->Stores = TableRegistry::getTableLocator()->get('Stores');
        $this->Blogs = TableRegistry::getTableLocator()->get('Blogs');
    }

    public function index()
    {
        $stores = $this->Stores->find('StoreDatas')->where()->toArray();

        $this->set(compact('stores'));
    }
}
