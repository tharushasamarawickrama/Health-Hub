<?php

if($_SERVER['SERVER_NAME'] == 'localhost') {
    define('ROOT', 'http://localhost/Health-Hub/public/');
}else{
    define('ROOT', 'http://www.yourwebsite.com/');
}

define('APPROOT', dirname(dirname(__FILE__)));
define('URLROOT', 'http://localhost/Health-Hub/public/');