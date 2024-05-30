<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;
use Cake\Event\EventInterface;
use ArrayObject;

class AppTable extends Table
{
    public $attaches = [];

    public function initialize(array $config): void
    {
        // 作成日時と更新日時の自動化
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'updated' => 'always'
                ]
            ]
        ]);
    }
}
