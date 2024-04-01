<?php
define('BASE_URL_PATH', '/');
define('Views','/views');
require_once __DIR__ . '/App/functions.php';
require_once __DIR__ . '/lib/Psr4AutoloaderClass.php';
$loader = new Psr4AutoloaderClass;
$loader->register();
// Các lớp có không gian tên bắt đầu với CT275\Labs nằm ở src
$loader->addNamespace('App\\', __DIR__ .'/App');
try {
    $PDO = (new App\Model\PDOFactory)->create([
    'dbhost' => 'localhost',
    'dbname' => 'CNWeb',
    'dbuser' => 'root',
    'dbpass' => ''
    ]);
    } catch (Exception $ex) {
        echo 'Không thể kết nối đến MySQL, kiểm tra lại username/password đến MySQL.<br>';
        exit("<pre>${ex}</pre>");
    }