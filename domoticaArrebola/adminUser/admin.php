
      <?php
   
   require_once("../conexion.php");
 
    
   $admin=new usuario($objPDO);
   
   echo $admin->admin();
    
 
   
      ?>
   

   