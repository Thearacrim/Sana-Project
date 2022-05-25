<?php

namespace app\components;

use yii\i18n\I18N;
use Yii;

class NewI18N extends I18N
{
    public function translate($category, $message, $params, $language)
    {
        if (Yii::$app->getRequest()->getCookies()->has('lang')) {
            if (Yii::$app->getRequest()->getCookies()->getValue('lang') == 'kh-KM') {
                return parent::translate($category, strtolower($message), $params, $language);
            } else {
                return parent::translate($category, $message, $params, $language);
            }
        }
        return parent::translate($category, $message, $params, $language);
    }
}
