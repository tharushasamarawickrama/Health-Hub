<?php

if($_SERVER['SERVER_NAME'] == 'localhost') {
    define('ROOT', 'http://localhost/MVC/public/');
}else{
    define('ROOT', 'http://www.yourwebsite.com/');
}