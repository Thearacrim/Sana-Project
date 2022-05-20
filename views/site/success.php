<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$base_url = Yii::getAlias('@web') ?>
<div class="container">
    <?php
    class User
    {
        public $name = 'Alex';
    }
    class Animal
    {
        public $type = 'Pig';
    }

    $array = [
        'foo' => [
            'bar' => new User(),
        ],
        'animal' => [
            'type' => new Animal(),
        ]
    ];
    $animal = ArrayHelper::getValue($array, 'animal.type.type');

    $value = isset($array['foo']['bar']->name) ? $array['foo']['bar']->name : null;
    echo $value;
    echo $animal;
    ?>
    <h2 class="text-center m-5 thanks text-color">Thanks for sub</h2>
    <div class="row">
        <div class="col-6">
            <img src=".<?php $base_url ?>./frontend/uploads/output-onlinegiftools (1).gif" alt="Success" class="cart-gif">
        </div>
        <div class="col-6">
            <a href="<?= Url::to(['site/']) ?>" class="btn btn-lg rounded-0 btn-outline-primary back_btn">Back To Page <i class="fa-solid fa-angles-right"></i></a>
        </div>
    </div>
</div>