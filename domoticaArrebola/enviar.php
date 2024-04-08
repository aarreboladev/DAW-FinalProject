<?php
   require_once("conexion.php");

//Get parameter sended by Arduino.

$value = $_GET["temp"];
date_default_timezone_set("Europe/Madrid");

$fecha=date("Y-m-d H:i:s");

$var = date('H:i:s');
print $var;
if ($value != "") {
    if ($var=="23:59:00" || $var=="11:00:00" || $var=="13:00:00" || $var=="16:00:00" || $var=="18:00:00" || $var=="20:00:00" || $var=="22:00:00"|| $var=="14:03:00" ){
         $sql="INSERT INTO temperatura (fecha,temperatura) values('$fecha','$value')";
         $resultado=$objPDO->query($sql);
    }
    
} 
?>