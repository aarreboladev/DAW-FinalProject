<?php
require('../conexion.php');
 
   
        
   $sql="SELECT username  FROM usuario WHERE user_id='". $_SESSION['id']."'"; 
   $resultado=$objPDO->query($sql);
   
    
   while ( $row = $resultado -> fetch( PDO :: FETCH_ASSOC )) {
     echo $row['username'];
     
     
   
   }

 
?>