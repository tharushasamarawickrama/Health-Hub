<?php

if($_SERVER['SERVER_NAME'] == 'localhost') {
    define('ROOT', 'http://localhost:8080/Health-Hub/public/');
}else{
    define('ROOT', 'http://www.yourwebsite.com/');
}

define('APPROOT', dirname(dirname(__FILE__)));
define('URLROOT', 'http://localhost:8080/Health-Hub/public/');