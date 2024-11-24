<?php

function show($staff){
    echo "<pre>";
    print_r($staff);
    echo "</pre>";
}

function esc($str){
    return htmlspecialchars($str);
}

function redirect($path){
    header('location: ' . URLROOT . $path);
    die();
}