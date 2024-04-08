
      <?php
   
   require_once("conexion.php");
 
    
   $temperatura=new usuario($objPDO);
   
   echo $temperatura->graficaTemperatura();
    
 
   
      ?>
   

   