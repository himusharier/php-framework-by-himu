<?php
//add all website pages here with sub-pages as well:
switch ($url[0]) {
    case '':
        require_once 'pages/public/public-home-page.php';
        break;
    case 'about':
        switch ($url[1]) {
            case '':
                require_once 'pages/public/public-about-page.php';
                break;
            default:
                require_once 'pages/404-page.php';
                break;
        }
        break;
    default:
        require_once 'pages/404-page.php';
        break;
}
