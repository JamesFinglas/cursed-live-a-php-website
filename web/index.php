<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

//run web application
$app = new Itb\WebApplication();
$app->run();

/*$db = new Database();
$connection = $db->getConnection();

if(null!= $connection){
    print 'Success - we connected to the Database';
}else{
    die('There was an error connecting to the Database');
}*/

