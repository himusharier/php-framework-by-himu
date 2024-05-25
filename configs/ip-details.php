<?php
$GetIP = getenv('HTTP_CLIENT_IP') ?: getenv('HTTP_X_FORWARDED_FOR') ?: getenv('HTTP_X_FORWARDED') ?: getenv('HTTP_FORWARDED_FOR') ?: getenv('HTTP_FORWARDED') ?: getenv('REMOTE_ADDR');
// won't work on local machine. but, on online server it works fine!
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json/$GetIP");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result=curl_exec($ch);
$result=json_decode($result);
if($result->status=='success'){
    $locationCity = $result->city; //city
    $locationCountry = $result->country; //country
    $locationLatitude = $result->lat; //latitude
    $locationLongitude = $result->lon; //longitude
    $locationIp = $result->query; //ip
}