<?php
// src/Model/Entity/Product.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Product extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
