
    
    <?php
   
   require('../conexion.php');
    
   $eliminarUser=new usuario($objPDO);
   
   echo $eliminarUser->eliminarUser();
    


    ?>
   