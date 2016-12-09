<?php

error_reporting(-1); //Добавлять в отчет все PHP ошибки
mb_internal_encoding('utf-8');


/**
 * Автозагрузчик всех классов
 */
spl_autoload_register(
    function ($className) {
        // Получаем путь к файлу из имени класса
        $folders=array('DataBase','Models');
        foreach ($folders as $folder) {
            $path=realpath(__DIR__."/app/$folder/$className.php");
            if ($path) {
                require_once $path;
            }
        }
    }
);

/**
 * Подключение к БД
 */
$config['host']='localhost';
$config['dbname']='company';
$config['user']='root';
$config['password']='';

$connect_str = 'mysql'
.':host='. $config['host']
.';dbname='.$config['dbname'];

$db=new PDO($connect_str,
    $config['user'],
    $config['password']
            ,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8, sql_mode='STRICT_ALL_TABLES'")
            );
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


/**
 * Используемые сущности
 */
$employesTable=new EmployesEntity($db);
$departmentsTable=new DepartmentsEntity($db);




### Тесты ###
require('tests.php');