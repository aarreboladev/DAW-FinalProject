
      <?php
   
   require_once("conexion.php");
 
 

   $log=new usuario($objPDO);
   $comentario=$_POST['comentario'];
   echo $log->crearLog($comentario);
    
 
   
      ?>
   

   