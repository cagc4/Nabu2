<?php


require_once 'include/google-api-php-client/apiClient.php';
require_once 'include/google-api-php-client/contrib/apiOauth2Service.php';
require_once 'include/idiorm.php';
require_once 'include/relativeTime.php';


$this->objUtilities = new Utilities($configDB["hostname"],$configDB["username"],$configDB["password"],$configDB["database"]);

$host = $configDB["hostname"];
$user = $configDB["username"];
$pass = $configDB["password"];
$database = $configDB["database"];

ORM::configure("mysql:host=$host;dbname=$database");
ORM::configure('username', $user);
ORM::configure('password', $pass);

ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

