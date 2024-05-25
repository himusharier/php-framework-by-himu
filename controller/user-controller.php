<?php
//add all website page here with the level of $url[0]:
if (empty($url[0])) {
    require_once("pages/public/public-home-page.php");

} elseif ($url[0] == "about") {
    require_once("pages/public/public-about-page.php");

} else {
    require_once("pages/404-page.php");
}
