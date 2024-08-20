<?php
if (!function_exists('redirectBack')) {
    function redirectBack($url = null) {
        if ($url === null) {
            if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
                $url = $_SERVER['HTTP_REFERER'];
            } else {
                $url = 'index.php';
            }
        }

        header("Location: $url");
        exit();
    }
}