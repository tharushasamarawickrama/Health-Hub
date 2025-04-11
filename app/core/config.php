<?php

if($_SERVER['SERVER_NAME'] == 'localhost') {
    define('DBNAME','health_hub');
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','');
    define('ROOT', 'http://localhost:8081/Health-Hub/public/');
}else{
    define('DBNAME','health_hub');
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','');
    define('ROOT', 'http://www.yourwebsite.com/');
}

define('APPROOT', dirname(dirname(__FILE__)));
define('URLROOT', 'http://localhost:8081/Health-Hub/public/');

define('DEBUG',true);