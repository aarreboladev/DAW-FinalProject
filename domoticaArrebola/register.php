
      <?php
   
   require_once("conexion.php");
 
    
   $register=new usuario($objPDO);
   
   echo $register->register();
    
 
   
      ?>
   

   