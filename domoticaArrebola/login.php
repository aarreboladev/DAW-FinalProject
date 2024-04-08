
      <?php
   
   require_once("conexion.php");
 
    
   $login=new usuario($objPDO);
   
   echo $login->login();
   


  
   
      ?>
   