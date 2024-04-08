
      <?php
   
   require_once("conexion.php");
 
 

   $estado=new usuario($objPDO);
   $valor=$_POST['valor'];
   $columna=$_POST['columna'];
   echo $estado->estadoPersiana($valor,$columna);
    
 
   
      ?>
   

   