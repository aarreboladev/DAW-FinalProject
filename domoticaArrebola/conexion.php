<?php
  
  require_once("class.pdofactory.php");
    require_once("abstract.databoundobject.php");
    require_once('usuarioMap.php');
   // require("paraulaMapping.php");
 
    
    $strDSN = "mysql:host=PMYSQL129.dns-servicio.com:3306;dbname=7570106_domoticaArrebola";
       $objPDO = PDOFactory::GetPDO($strDSN, "arrebola", "password", 
           array());
       $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
  

?>
