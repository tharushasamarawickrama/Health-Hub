<?php

if($_SERVER['SERVER_NAME'] == 'localhost') {
    define('DBNAME','blah');
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','');
    define('ROOT', 'http://localhost/Health-Hub/public/');
}else{
    define('DBNAME','blah');
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','');
    define('ROOT', 'http://www.yourwebsite.com/');
}

define('APPROOT', dirname(dirname(__FILE__)));
define('URLROOT', 'http://localhost/Health-Hub/public/');

define('DEBUG',true);