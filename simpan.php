<?php

require 'firebase-php-master/src/firebaseLib.php';

if(isset($_GET["loc"])) {
  $loc = $_GET["loc"];
} else {
  $loc = "lokasi_1";

}
$label_sensor_temp = "";

if($loc == "lokasi_1"){
  $label_sensor_temp = "am2320";
}
elseif($loc == "lokasi_2"){
  $label_sensor_temp = "dht22";
}
elseif($loc == "lokasi_3"){
  $label_sensor_temp = "sht20";
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
  $tas = $_GET["tas"];
} else {
  $tas = 0;
}

if(isset($_GET["tip"])) {
  $tip = $_GET["tip"];
} else {
  $tip = 0;
}

if(isset($_GET["tegangan_ina"])) {
  $tegangan_ina = $_GET["tegangan_ina"];
} else {
  $tegangan_ina = 0;
}

if(isset($_GET["arus_ina"])) {
  $arus_ina = $_GET["arus_ina"];
} else {
  $arus_ina = 0;
}

if(isset($_GET["tegangan_hlw"])) {
  $tegangan_hlw = $_GET["tegangan_hlw"];
} else {
  $tegangan_hlw = 0;
}

if(isset($_GET["arus_hlw"])) {
  $arus_hlw = $_GET["arus_hlw"];
} else {
  $arus_hlw = 0;
}

if(isset($_GET["tegangan_pzem"])) {
  $tegangan_pzem = $_GET["tegangan_pzem"];
} else {
  $tegangan_pzem = 0;
}

if(isset($_GET["arus_pzem"])) {
  $arus_pzem = $_GET["arus_pzem"];
} else {
  $arus_pzem= 0;
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

function getPathLogTemp($location, $parameter){
  global $label_sensor_temp;
  $type = "Log";
  date_default_timezone_set("Asia/Singapore");
  $date_log = date("d-m-y");
  $hour_log = date("H");
  $timestamp = date("H:i:s");
  return '/'.$type.'/'.$location.'/'.$date_log.'/'.$hour_log.'/'.$label_sensor_temp.'/'.$parameter.'/'.$timestamp;
}

function getPathRealtime($location, $parameter){
  $type = "Realtime";
  date_default_timezone_set("Asia/Singapore");
  return '/'.$type.'/'.$location.'/'.$parameter.'/';
}

function getPathRealtimeTemp($location, $parameter){
  global $label_sensor_temp;
  $type = "Realtime";
  date_default_timezone_set("Asia/Singapore");
  return '/'.$type.'/'.$location.'/'.$label_sensor_temp.'/'.$parameter.'/';
}

function checkDataISNULL($path){
  global $firebase;
  return is_null($firebase->get($path));
}


$firebase->set(getPathLogTemp($loc, "temperature"), $temp);
$firebase->set(getPathLogTemp($loc, "kelembaban"),  $hum);
$firebase->set(getPathLog($loc, "tinggi_air_sungai"),  $tas);

if($loc == "lokasi_1"){
  $firebase->set(getPathLog($loc, "total_tip"),  $tip);
  $firebase->set(getPathLog($loc, "tegangan_ina"),  $tegangan_ina);
  $firebase->set(getPathLog($loc, "arus_ina"),  $arus_ina);
  $firebase->set(getPathLog($loc, "tegangan_hlw"),  $tegangan_hlw);
  $firebase->set(getPathLog($loc, "arus_hlw"),  $arus_hlw);
  $firebase->set(getPathLog($loc, "tegangan_pzem"),  $tegangan_pzem);
  $firebase->set(getPathLog($loc, "arus_pzem"),  $arus_pzem);

  $path_tip = getPathRealtime($loc, "total_tip");
  if(checkDataISNULL($path_tip)){
    $firebase->update($path_tip,  $tip);
  } else {
    $firebase->set($path_tip,  $tip);
  }

  $path_t_ina = getPathRealtime($loc, "tegangan_ina");
  if(checkDataISNULL($path_t_ina)){
    $firebase->update($pathpath_t_ina,  $tegangan_ina);
  } else {
    $firebase->set($path_t_ina,  $tegangan_ina);
  }

  $path_a_ina = getPathRealtime($loc, "arus_ina");
  if(checkDataISNULL($path_a_ina)){
    $firebase->update($path_a_ina,  $arus_ina);
  } else {
    $firebase->set($path_a_ina,  $arus_ina);
  }

  $path_t_hlw = getPathRealtime($loc, "tegangan_hlw");
  if(checkDataISNULL($path_t_hlw)){
    $firebase->update($path_t_hlw,  $tegangan_hlw);
  } else {
    $firebase->set($path_t_hlw,  $tegangan_hlw);
  }

  $path_a_hlw = getPathRealtime($loc, "arus_hlw");
  if(checkDataISNULL($path_a_hlw)){
    $firebase->update($path_a_hlw,  $arus_hlw);
  } else {
    $firebase->set($path_a_hlw,  $arus_hlw);
  }

  $path_t_pzem = getPathRealtime($loc, "tegangan_pzem");
  if(checkDataISNULL($path_t_pzem)){
    $firebase->update($path_t_pzem,  $tegangan_pzem);
  } else {
    $firebase->set($path_t_pzem,  $tegangan_pzem);
  }

  $path_a_pzem = getPathRealtime($loc, "arus_pzem");
  if(checkDataISNULL($path_a_pzem)){
    $firebase->update($path_a_pzem,  $arus_pzem);
  } else {
    $firebase->set($path_a_pzem,  $arus_pzem);
  }
}


$path_temp = getPathRealtimeTemp($loc, "temperature");
if(checkDataISNULL($path_temp)){
  $firebase->update($path_temp, $temp);
} else {
  $firebase->set($path_temp, $temp);
}

$path_hum = getPathRealtimeTemp($loc, "kelembaban");
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

print("Update Berhasil");

?>