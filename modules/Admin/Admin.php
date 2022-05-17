<?php

namespace app\modules\admin;

use Yii;

/**
 * admin module definition class
 */
class Admin extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\Admin\controllers';
    // Set Default Layout to seperate page
    public $layout = 'main';
    public $defaultRoute = 'default/index';
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::$app->user->loginUrl = ['admin/default/login'];
        Yii::$app->errorHandler->errorAction = 'admin/default/error';

        // custom initialization code goes here
        Yii::$app->set('session', [
            'class' => 'yii\web\Session',
            'name' => '_zayAdminSessionId',
        ]);
    }
}
