
    
    <?php
    
    require_once("conexion.php");
  
   $u=new usuario($objPDO);
   
   echo $u->filasUsuario();
   

    



      ?>
   