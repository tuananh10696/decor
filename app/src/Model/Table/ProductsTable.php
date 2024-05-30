<?php
// src/Model/Table/ProductsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class ProductsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        // Thêm các quan hệ, validation rules, behaviors nếu cần
    }
}
