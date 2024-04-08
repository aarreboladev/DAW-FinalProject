
      <?php
   
   require_once("conexion.php");
 
    
   $luces=new usuario($objPDO);
   
   echo $luces->estadoLuces();
   


  
   
      ?>
   