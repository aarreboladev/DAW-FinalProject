<?php   

require_once("conexion.php");


$sql="SELECT * FROM usuario WHERE user_id=$idSession" ;
$resultado=$this->objPDO->query($sql);

while ( $row = $resultado -> fetch( PDO :: FETCH_ASSOC )) {
  
  $user=$row['username'];
  $apellido=$row['apellido'];
  
}

?>