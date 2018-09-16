<?php


require_once 'include/google-api-php-client/apiClient.php';
require_once 'include/google-api-php-client/contrib/apiOauth2Service.php';
require_once 'include/idiorm.php';
require_once 'include/relativeTime.php';


//session_name('Nabu');
//session_start();


$host = 'localhost';
$user = 'nabu';
$pass = '6492496';
$database = 'nabu2';

ORM::configure("mysql:host=$host;dbname=$database");
ORM::configure('username', $user);
ORM::configure('password', $pass);

ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//configuracion de google console api
//$redirect_url = 'http://localhost/Pruebas/Google/'; 
//$client_id = '225702401481-tslc05tn785dg1m41lh4h9jhvsquiipk.apps.googleusercontent.com';
//$client_secret = 'uIVfML4S33xsukHN-v8WKclS';
//$api_key = '';
