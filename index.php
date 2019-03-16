<?php
session_start();
define('ROOT', dirname(__FILE__) . '/app/');
require_once(ROOT.'components/Router.php');
require_once(ROOT.'components/Db.php');
$router = new Router();
$router->start();