<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/yii-1.1.13.e9e4a0/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

date_default_timezone_set('PRC');

require_once($yii);
Yii::createWebApplication($config)->run();
