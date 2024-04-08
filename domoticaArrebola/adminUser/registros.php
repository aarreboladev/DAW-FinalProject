
      <?php
   
   require_once("../conexion.php");
 
    
   $historial=new usuario($objPDO);
   
   echo $historial->filasHistorial();
    
 
   
      ?>
   

   