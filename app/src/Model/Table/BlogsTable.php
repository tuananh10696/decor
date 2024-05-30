<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class BlogsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('blogs'); // Tên bảng trong cơ sở dữ liệu
        $this->setDisplayField('title'); // Tên cột hiển thị
        $this->setPrimaryKey('id'); // Tên cột khóa chính
    }
}
