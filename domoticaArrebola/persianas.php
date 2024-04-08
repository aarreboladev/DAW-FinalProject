
      <?php
   
   require_once("conexion.php");
 
    
   $persianas=new usuario($objPDO);
   
   echo $persianas->estadoPersianas();
   


  
   
      ?>
   