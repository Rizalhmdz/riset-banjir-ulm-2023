<?php

require 'firebase-php-master/src/firebaseLib.php';
$param1 = $_GET["temp"];
$param2 = $_GET["hum"];

$url = 'https://risetulm-8a989-default-rtdb.asia-southeast1.firebasedatabase.app/'; 
$token = 'ykMReG9wU5zAuT7V5JhAu1afdC3FejdkEPaW9yQU'; 

date_default_timezone_set("Asia/Singapore");
$date_log = date("yyyy/mm/dd");
$time_log = date("H:i:s");
$lokasi_1 = "lokasi_1";
$DEFAULT_PATH = '/'.$date_log.'/'.$lokasi_1.'/'.$time_log.'/';

function getPath($date, $location, $time) {
    return '/'.$date.'/'.$location.'/'.$time.'/suhu/';
  }

$_devicestatus= array(
'suhu' => $param1,
'kelembaban' => $param2,
);

$url = 'https://risetulm-8a989-default-rtdb.asia-southeast1.firebasedatabase.app/'; 
  $token = 'ykMReG9wU5zAuT7V5JhAu1afdC3FejdkEPaW9yQU'; 
  $firebase = new \Firebase\FirebaseLib($url, $token);
  $firebase->push(getPath($date_log, $lokasi_1, $time_log), $_devicestatus);

print("Update Berhasil");

 

function sendData(){
  $url = 'https://risetulm-8a989-default-rtdb.asia-southeast1.firebasedatabase.app/'; 
  $token = 'ykMReG9wU5zAuT7V5JhAu1afdC3FejdkEPaW9yQU'; 
  $firebase = new \Firebase\FirebaseLib($url, $token);
  $firebase->push(getPath($date_log, $lokasi_1, $time_log), $_devicestatus);

  print("Update Berhasil");
}


function getPathLog(){
  $type = "Log";
  date_default_timezone_set("Asia/Singapore");
  $date_log = date("yyyy/mm/dd");
  $time_log = date("H:i:s");
  $lokasi_1 = "lokasi_1";
  return '/'.$date.'/'.$location.'/'.$time.'/suhu/';
}
function getPathRealtime(){

}


function addData(){
  
}

?>