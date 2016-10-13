<?php
define("APP_PATH",realpath(dirname(__FILE__)."/../"));
define("APP_MODEL",APP_PATH.'/application/models/');
$app  = new Yaf_Application(APP_PATH . "/conf/application.ini",ini_get("yaf.environ"));
$app->bootstrap()->run();
?>
