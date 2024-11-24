<?php

function show($staff){
    echo "<pre>";
    print_r($staff);
    echo "</pre>";
}

function esc($str){
    return htmlspecialchars($str);
}

function redirect($path, $params='')
{
    $queryString = '';

    // If there are parameters, build the query string
    if (!empty($params)) {
        $queryString = '?' .'v1='.$params;
    }

    // Redirect to the path with query string
    header('Location: ' . URLROOT . '/' . $path . $queryString);
    die();
}
