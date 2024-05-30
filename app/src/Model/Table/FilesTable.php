<?php
// src/Model/Table/ProductsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class FilesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('files');

        // Thêm các quan hệ, validation rules, behaviors nếu cần
    }
    // Phương thức tìm kiếm tất cả các bản ghi trong bảng files
    public function getAllFiles()
    {
        return $this->find('all')->toArray();
    }
}
