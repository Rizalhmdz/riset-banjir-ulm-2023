<?php

require 'firebase-php-master/src/firebaseLib.php';

if(isset($_GET["loc"])) {
  $loc = $_GET["loc"];
} else {
  $loc = "lokasi_1";
}

if(isset($_GET["temp"])) {
  $temp = $_GET["temp"];
} else {
  $temp = 0;
}

if(isset($_GET["hum"])) {
  $hum = $_GET["hum"];
} else {
  $hum = 0;
}

if(isset($_GET["tas"])) {
  $location = $_GET["tas"];
} else {
  $tas = 0;
}

if(isset($_GET["tip"])) {
  $location = $_GET["tip"];
} else {
  $tip = 0;
}



$url = 'https://risetulm-8a989-default-rtdb.asia-southeast1.firebasedatabase.app/'; 
$token = 'ykMReG9wU5zAuT7V5JhAu1afdC3FejdkEPaW9yQU'; 
$firebase = new \Firebase\FirebaseLib($url, $token);

function getPath($date, $location, $time) {
    return '/'.$date.'/'.$location.'/'.$time.'/suhu/';
  }

function getPathLog($location, $parameter){
  $type = "Log";
  date_default_timezone_set("Asia/Singapore");
  $date_log = date("d-m-y");
  $hour_log = date("H");
  $timestamp = date("H:i:s");
  return '/'.$type.'/'.$location.'/'.$date_log.'/'.$hour_log.'/'.$parameter.'/'.$timestamp;
}

function getPathRealtime($location, $parameter){
  $type = "Realtime";
  date_default_timezone_set("Asia/Singapore");
  return '/'.$type.'/'.$location.'/'.$parameter.'/';
}

function checkDataISNULL($path){
  global $firebase;
  return is_null($firebase->get($path));
}


$firebase->set(getPathLog($loc, "temperature"), $temp);
$firebase->set(getPathLog($loc, "kelembaban"),  $hum);
$firebase->set(getPathLog($loc, "tinggi_air_sungai"),  $tas);
$firebase->set(getPathLog($loc, "total_tip"),  $tip);


$path_temp = getPathRealtime($loc, "temperature");
if(checkDataISNULL($path_temp)){
  $firebase->update($path_temp, $temp);
} else {
  $firebase->set($path_temp, $temp);
}

$path_hum = getPathRealtime($loc, "kelembaban");
if(checkDataISNULL($path_hum)){
  $firebase->update($path_hum,  $hum);
} else {
  $firebase->set($path_hum,  $hum);
}

$path_tas = getPathRealtime($loc, "tinggi_air_sungai");
if(checkDataISNULL($path_tas)){
  $firebase->update($path_tas,  $tas);
} else {
  $firebase->set($path_tas,  $tas);
}

$path_tip = getPathRealtime($loc, "total_tip");
if(checkDataISNULL($path_tip)){
  $firebase->update($path_tip,  $tip);
} else {
  $firebase->set($path_tip,  $tip);
}

print("Update Berhasil");

?>