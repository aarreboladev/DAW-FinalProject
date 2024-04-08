
      <?php
   
   require_once("conexion.php");
 
 

   $estado=new usuario($objPDO);
   $tipo=$_POST['tipo'];
   $valor=$_POST['valor'];
   $columna=$_POST['columna'];

   if($tipo=="luz"){
      echo $estado->cambiarEstado($valor,$columna);
   }
   if ($tipo=="per"){
      echo $estado->cambiarEstadoPersiana($valor,$columna);

   }
    
 
   
      ?>
   

   