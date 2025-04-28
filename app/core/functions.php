<?php

function show($staff)
{
    echo "<pre>";
    print_r($staff);
    echo "</pre>";
}

function esc($str)
{
    return htmlspecialchars($str);
}

function redirect($path, $params = '')
{
    $queryString = '';

    // If there are parameters, build the query string
    if (!empty($params)) {
        $queryString = '?' .'id='.$params;
    }

    // Redirect to the path with query string
    if (!headers_sent()) {
        header('Location: ' . URLROOT . '/' . $path . $queryString);
        exit;
    } else {
        echo "<script>window.location.href='" . URLROOT . '/' . $path . $queryString . "';</script>";
        exit;
    }
}
