<?php
session_start();
date_default_timezone_set("Europe/Madrid");
abstract class DataBoundObject {

   protected $ID;
   protected $objPDO;
   protected $strTableName;
   protected $arRelationMap;
   protected $blForDeletion;
   protected $blIsLoaded;
   protected $arModifiedRelations;
   protected $campo;
   protected $resultado;

   abstract protected function DefineTableName();
   abstract protected function DefineRelationMap();

   public function __construct(PDO $objPDO, $campo = NULL , $resultado = NULL) {
      $this->strTableName = $this->DefineTableName();
      $this->arRelationMap = $this->DefineRelationMap();
      $this->objPDO = $objPDO;
      $this->blIsLoaded = false;
      if (isset($campo)) {
         $this->campo = $campo;
         $this->resultado = $resultado;
        
      };
      $this->arModifiedRelations = array();
   }

   public function Load() {
     
      if (isset($this->campo)) {
		$strQuery = "SELECT ";
        foreach ($this->arRelationMap as $key => $value) {
			$strQuery .= "\"" . $key . "\",";
        }
        $strQuery = substr($strQuery, 0, strlen($strQuery)-1);
        $strQuery .= " FROM " . $this->strTableName . " WHERE " . $this->campo .  " = :eid";
       
      
        $objStatement = $this->objPDO->prepare($strQuery);
        $objStatement->bindParam(':eid', $this->resultado, PDO::PARAM_STR);
        $objStatement->execute();
        $arRow = $objStatement->fetch(PDO::FETCH_ASSOC);
        foreach($arRow as $key => $value) {
            $strMember = $this->arRelationMap[$key];
            if (property_exists($this, $strMember)) {
                if (is_numeric($value)) {
                   eval('$this->'.$strMember.' = '.$value.';');
                } else {
                   eval('$this->'.$strMember.' = "'.$value.'";');
                };
            };
         };
         $this->blIsLoaded = true;
      };
   }

   public function Save() {
      if (isset($this->campo)) {
         $strQuery = 'UPDATE "' . $this->strTableName . '" SET ';
         foreach ($this->arRelationMap as $key => $value) {
            eval('$actualVal = &$this->' . $value . ';');
            if (array_key_exists($value, $this->arModifiedRelations)) {
               $strQuery .= '"' . $key . "\" = :$value, ";
            };
         }
         $strQuery = substr($strQuery, 0, strlen($strQuery)-2);
         $strQuery .= ' WHERE ' . $this->campo . ' = :eid';
         unset($objStatement);
         $objStatement = $this->objPDO->prepare($strQuery);
         $objStatement->bindValue(':eid', $this->resultado, PDO::PARAM_INT);
         foreach ($this->arRelationMap as $key => $value) {
            eval('$actualVal = &$this->' . $value . ';');
            if (array_key_exists($value, $this->arModifiedRelations)) {
               if ((is_int($actualVal)) || ($actualVal == NULL)) {
                  $objStatement->bindValue(':' . $value, $actualVal,PDO::PARAM_INT);
               } else {
                  $objStatement->bindValue(':' . $value, $actualVal,PDO::PARAM_STR);
               };
            };
         };
         $objStatement->execute();
      } else {
         $strValueList = "";
         $strQuery = 'INSERT INTO "' . $this->strTableName . '"(';
         foreach ($this->arRelationMap as $key => $value) {
            eval('$actualVal = &$this->' . $value . ';');
            if (isset($actualVal)) {
               if (array_key_exists($value, $this->arModifiedRelations)) {
                  $strQuery .= '"' . $key . '", ';
                  $strValueList .= ":$value, ";
               };
            };
         }
         $strQuery = substr($strQuery, 0, strlen($strQuery) - 2);
         $strValueList = substr($strValueList, 0, strlen($strValueList) - 2);
         $strQuery .= ") VALUES (";
         $strQuery .= $strValueList;
         $strQuery .= ")";

         unset($objStatement);
         $objStatement = $this->objPDO->prepare($strQuery);
         foreach ($this->arRelationMap as $key => $value) {
            eval('$actualVal = &$this->' . $value . ';');
            if (isset($actualVal)) {   
               if (array_key_exists($value, $this->arModifiedRelations)) {
                  if ((is_int($actualVal)) || ($actualVal == NULL)) {
                     $objStatement->bindValue(':' . $value, $actualVal, PDO::PARAM_INT);
                  } else {
                     $objStatement->bindValue(':' . $value, $actualVal, PDO::PARAM_STR);
                  };
               };
            };
         }
         $objStatement->execute();
         $this->ID = $this->objPDO->lastInsertId();
      }
   }

   public function MarkForDeletion() {
      $this->blForDeletion = true;
   }
   
   public function __destruct() {
      if (isset($this->ID)) {   
         if ($this->blForDeletion == true) {
            $strQuery = 'DELETE FROM "' . $this->strTableName . '" WHERE "id" = :eid';
            $objStatement = $this->objPDO->prepare($strQuery);
            $objStatement->bindValue(':eid', $this->ID, PDO::PARAM_INT);   
            $objStatement->execute();
         };
      }
   }

   public function __call($strFunction, $arArguments) {

      $strMethodType = substr($strFunction, 0, 3);
      $strMethodMember = substr($strFunction, 3);
      switch ($strMethodType) {
         case "set":
            return($this->SetAccessor($strMethodMember, $arArguments[0]));
            break;
         case "get":
            return($this->GetAccessor($strMethodMember));   
      };
      return(false);   
   }

   private function SetAccessor($strMember, $strNewValue) {
      if (property_exists($this, $strMember)) {
         if (is_numeric($strNewValue)) { 
            eval('$this->' . $strMember . ' = ' . $strNewValue . ';');
         } else {
            eval('$this->' . $strMember . ' = "' . $strNewValue . '";');
         };
         
         $this->arModifiedRelations[$strMember] = "1";
         return $this;
         
      } else {
         return(false);
      };   
   }

   private function GetAccessor($strMember) {
      if ($this->blIsLoaded != true) {
         $this->Load();
      }
      if (property_exists($this, $strMember)) {
         eval('$strRetVal = $this->' . $strMember . ';');
         return($strRetVal);
      } else {
         return(false);
      };   
   }
   
   public function filasUsuario(){
      $sql="SELECT * FROM usuario";
      $cont=0;
      $resultado=$this->objPDO->query($sql); 
     
    
      while ( $row = $resultado -> fetch( PDO :: FETCH_ASSOC )) {
         $cont++;    
         echo" <tr> <th scope='row' id='id$cont' >" . $row['user_id'] . " </th> <td  id='nombre$cont' >" . $row['username'] . " </td><td id='apellido$cont'>".$row['apellido'] ."</td><td id='gmail$cont'>".$row['email'] ."</td> <td id='admin$cont'>" . $row['admin']."</td> <td><button class='btn btn-primary' data-toggle='modal' data-target='#editar' data-whatever='@mdo' id='editar$cont' onclick='editarID($cont),editarNombre($cont),editarApellido($cont),editarGmail($cont)' >Editar</button> <button class='btn btn-primary' id='eliminar$cont' onclick='eliminar($cont)' >Eliminar</button> <button class='btn btn-primary' id='registros$cont' data-toggle='modal' data-target='#exampleModal' data-whatever='@mdo' onclick='registros($cont),registroAdmin($cont)'>Ver Registros</button> <button class='btn btn-primary' id='admin$cont' onclick='admin($cont)'>Admin</button> <button class='btn btn-primary' id='noAdmin$cont' onclick='noAdmin($cont)'>Quitar Admin</button></td> </tr>";  
        

      }
    
   }
   public function filasHistorial(){
      $sql="SELECT * FROM historial order by fecha DESC  limit 20";
      $cont=0;
      $resultado=$this->objPDO->query($sql); 
     
    
      while ( $row = $resultado -> fetch( PDO :: FETCH_ASSOC )) {
         $cont++;    
         echo "<tr> <th scope='row' id='id$cont' >" . $row['id_mov'] . " </th> <td  id='idUser$cont' >" . $row['user_id'] . " </td>  <td  id='nombre$cont' >" . $row['nombre'] . " </td><td id='apellido$cont'>".$row['apellido'] ."</td><td id='accion$cont'>".$row['accion'] ."</td> <td id='fecha$cont'>" . $row['fecha']."</tr>";  
        

      }
    
   }

   public function editarID(){
      $id= $_POST['id'];
      echo $id;

   }
   public function editarNombre(){
      $id= $_POST['id'];
      $idSession=$_SESSION['id'];
      $sql="SELECT username FROM usuario WHERE user_id=$id";
      $resultado=$this->objPDO->query($sql); 
      $row = $resultado->fetch(PDO::FETCH_ASSOC);
      echo $row['username'];
      $sql2="SELECT username, apellido FROM usuario where user_id=$idSession";
      $resultado2=$this->objPDO->query($sql2); 
      $row = $resultado2->fetch(PDO::FETCH_ASSOC);
      $user=$row['username'];
      $apellido=$row['apellido'];
      $fecha=date("Y-m-d H:i:s");  
      //año mes dia hora
      $sql3="INSERT INTO historial (user_id,nombre,apellido,accion,fecha)values ('$idSession','$user','$apellido','Editar usuario','$fecha')";
      $resultado3=$this->objPDO->query($sql3); 
   }
   public function editarApellido(){
      $id= $_POST['id'];

      $sql="SELECT apellido FROM usuario WHERE user_id=$id";
      $resultado=$this->objPDO->query($sql); 
      $row = $resultado->fetch(PDO::FETCH_ASSOC);
      echo $row['apellido'];

   }
   public function editarGmail(){
      $id= $_POST['id'];

      $sql="SELECT email FROM usuario WHERE user_id=$id";
      $resultado=$this->objPDO->query($sql); 
      $row = $resultado->fetch(PDO::FETCH_ASSOC);
      echo $row['email'];
   }
   public function editar(){
      $id=$_POST['id'];
      $nom=$_POST['nom'];
      $ape=$_POST['ape'];
      $gma=$_POST['gma'];

      $sql="UPDATE usuario SET username='$nom', apellido='$ape', email='$gma' where user_id='$id'";
      echo $sql;
      $resultado=$this->objPDO->query($sql);
    

   }
   public function login(){
  
      if(isset($_POST['nombre']) && isset($_POST['pass'])){
         $nombre=$_POST['nombre'];
         $pass=$_POST['pass'];
       
         $sql="SELECT username , password  FROM usuario WHERE username='$nombre' and password='$pass'";
        
         $resultado=$this->objPDO->query($sql);
         $prueba=$resultado->fetch(PDO::FETCH_ASSOC);
         
         $sql2="SELECT user_id from usuario where username='$nombre' and password='$pass'";
         $resultado2=$this->objPDO->query($sql2);
        
        
         while ( $row = $resultado2 -> fetch( PDO :: FETCH_ASSOC )) {
                      
             $_SESSION['id'] = $row['user_id'];  
         }
         $id = $_SESSION['id'];
      
       
       if($prueba!= ""){
         echo"bien";
       }
       
         
     }

   }
  public function registros(){
     
  }
   public function eliminarUser(){
      $id = $_POST['id'];
      $sql="DELETE FROM usuario where user_id = $id ";
      echo $sql;
      $resultado=$this->objPDO->query($sql); 
      $idSession=$_SESSION['id'];
      $sql2="SELECT username, apellido FROM usuario where user_id=$idSession";
      $resultado2=$this->objPDO->query($sql2); 
      $row = $resultado2->fetch(PDO::FETCH_ASSOC);
      $user=$row['username'];
      $apellido=$row['apellido'];
      echo $user;
      $fecha=date("Y-m-d H:i:s");  ;
      //año mes dia hora
      $sql3="INSERT INTO historial (user_id,nombre,apellido,accion,fecha)values ('$idSession','$user','$apellido','Eliminar usuario','$fecha')";
      $resultado3=$this->objPDO->query($sql3); 
   }

   public function admin(){
      $id = $_POST['id'];
      $sq="select admin from usuario where user_id=$id";
      $res=$this->objPDO->query($sq);
     
      if ($res!="1"){
         $sql="UPDATE usuario SET admin=1 where user_id=$id;";
         $resultado=$this->objPDO->query($sql);
         echo "1";
      }
      else{
         echo "0";
      }
      $idSession=$_SESSION['id'];
      $sql2="SELECT username, apellido FROM usuario where user_id=$idSession";
      $resultado2=$this->objPDO->query($sql2); 
      $row = $resultado2->fetch(PDO::FETCH_ASSOC);
      $user=$row['username'];
      $apellido=$row['apellido'];
      //echo $user;
      $fecha=date("Y-m-d H:i:s");  ;
      //año mes dia hora
      $sql3="INSERT INTO historial (user_id,nombre,apellido,accion,fecha)values ('$idSession','$user','$apellido','Dar permisos de administrador','$fecha')";
      $resultado3=$this->objPDO->query($sql3); 
   }
   
   public function noAdmin(){
      $id = $_POST['id'];
      $sq="select admin from usuario where user_id=$id";
     
      $res=$this->objPDO->query($sq);
     
      if ($res!="0"){
         $sql="UPDATE usuario SET admin=0 where user_id=$id;";
         $resultado=$this->objPDO->query($sql);
         echo "1";
      }
      else{
         echo "0";
      }
      $idSession=$_SESSION['id'];
      $sql2="SELECT username, apellido FROM usuario where user_id=$idSession";
      $resultado2=$this->objPDO->query($sql2); 
      $row = $resultado2->fetch(PDO::FETCH_ASSOC);
      $user=$row['username'];
      $apellido=$row['apellido'];
     
      $fecha=date("Y-m-d H:i:s");  ;
      //año mes dia hora
      $sql3="INSERT INTO historial (user_id,nombre,apellido,accion,fecha)values ('$idSession','$user','$apellido','Quitar permisos de administrador','$fecha')";
      $resultado3=$this->objPDO->query($sql3); 
   }
   public function registrosAdmin(){
      $cont=0;
      $id=$_POST['id'];
      echo $id;
      $sql="SELECT * FROM historial where user_id=$id";
      $resultado=$this->objPDO->query($sql); 
      while ( $row = $resultado -> fetch( PDO :: FETCH_ASSOC )) {
         $cont++;    
         echo "<tr> <th scope='row' id='id$cont' >" . $row['id_mov'] . " </th> <td  id='idUser$cont' >" . $row['user_id'] . " </td>  <td  id='nombre$cont' >" . $row['nombre'] . " </td><td id='apellido$cont'>".$row['apellido'] ."</td><td id='accion$cont'>".$row['accion'] ."</td> <td id='fecha$cont'>" . $row['fecha']."</tr>";  
        

      }
   }
   public function register(){
      $aErrores = array();
      $aMensajes = array();
      $patron_texto = "/^[A-Za-z]{1,15}/";
      $patron_mail = "/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/";
      $patron_pass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/";
      if(isset($_POST['nombre']) && isset($_POST['pass'])){
         if(empty($_POST['nombre'])){
            $aErrores[]="Tienes que introducir un nombre";
         }
         else{
            if( preg_match($patron_texto, $_POST['nombre']) ){
               $aMensajes[] = "Nombre: [".$_POST['nombre']."]";
            }
        else{
            $aErrores[] = "El nombre sólo puede contener letras y espacios";
            }
         }

         if( empty($_POST['apellido']) ) {
         $aErrores[] = "Debe especificar un apellido";
         }
         else{
         // Comprobar mediante una expresión regular, que sólo contienen letras y espacios:
               if( preg_match($patron_texto, $_POST['apellido']) ){
                  $aMensajes[] = "Apellido: [".$_POST['apellido']."]";
               }
               else{
                  $aErrores[] = "El apellido sólo puede contener letras y espacios";
               }
            }
            if( empty($_POST['pass']) ) {
               $aErrores[] = "Debe especificar una contraseña";
               }
               else{
               // Comprobar mediante una expresión regular, que sólo contienen letras y espacios:
                     if( preg_match($patron_pass, $_POST['pass']) ){
                        $aMensajes[] = "Contraseña: [".$_POST['pass']."]";
                     }
                     else{
                        $aErrores[] = "La contraseña debe contener mínimo una mayuscula minusculas un dígito y un caracter especial, EJEMPLO: P@ssw0rd";
                     }
                  }
              if( empty($_POST['email']) ) {
               $aErrores[] = "Debe especificar un email";
               }
               else{
               // Comprobar mediante una expresión regular, que sólo contienen letras y espacios:
                     if( preg_match($patron_mail, $_POST['email']) ){
                        $aMensajes[] = "Email: [".$_POST['email']."]";
                     }
                     else{
                        $aErrores[] = "El email sólo puede contener letras y espacios";
                     }
                  }
                  if( count($aErrores) > 0 )
                  {
                      echo "<p>ERRORES ENCONTRADOS:</p>";
                      // Mostrar los errores:
                      for( $contador=0; $contador < count($aErrores); $contador++ ){
                          echo $aErrores[$contador]."<br/>";
                      }
                  }
                  else
                  {
                     $nombre=$_POST['nombre'];
                     $pass=$_POST['pass'];
                     $apellido=$_POST['apellido'];
                     $email=$_POST['email'];
                     
                     $sql="SELECT username FROM usuario WHERE username='$nombre' and password='$pass'" ;
                    
                     $resultado=$this->objPDO->query($sql);
                     $prueba=$resultado->fetch(PDO::FETCH_ASSOC);
                     //var_dump($prueba);
                     if ($prueba == ""){
                       $sql2="INSERT INTO usuario (username,password ,admin,apellido,email) VALUES ('$nombre','$pass','0','$apellido','$email')";
                       $resultado=$this->objPDO->query($sql2);
                       
                     }
                     else{
                        echo  "El usuario y contraseña ya existe";
                        
                     }
                  }
              }
              
               
       
         
       }

       public function tablaTemperatura(){
         $sql="SELECT fecha , temperatura FROM temperatura ORDER BY fecha DESC limit 15  ";
         $cont=0;
         $resultado=$this->objPDO->query($sql); 
        
       
         while ( $row = $resultado -> fetch( PDO :: FETCH_ASSOC )) {
            $cont++;    
            echo "<tr> <td id='fecha$cont'>".$row['fecha'] ."</td><td id='temperatura$cont'>".$row['temperatura'] . "</tr>";  
           
   
         }
       
         
      }


      public function graficaTemperatura(){
         $sql2="SELECT fecha, temperatura FROM temperatura " ; // AQUI HAY QUE PONER EL WHERE ID= CON EL SESSION DE LA ID QUE LE PASAS DEL ALUMNO
         //echo json_encode($prueba);
         $statement = $this->objPDO->prepare($sql2);
         $statement->execute();
         $result = $statement->fetchAll();

         $json= json_encode($result);

         echo $json;
      }


      public function crearLog($comentario){

         $idSession=$_SESSION['id'];
         $sql="SELECT * FROM usuario WHERE user_id=$idSession" ;
         $resultado=$this->objPDO->query($sql);
         $fecha=date("Y-m-d H:i:s");  
         while ( $row = $resultado -> fetch( PDO :: FETCH_ASSOC )) {
           
           $user=$row['username'];
           $apellido=$row['apellido'];
           
         }

         $sql3="INSERT INTO historial (user_id,nombre,apellido,accion,fecha)values ('$idSession','$user','$apellido','$comentario','$fecha')";
         $resultado3=$this->objPDO->query($sql3); 
      }


      public function cambiarEstado($valor,$columna){

         $sql="UPDATE luces SET $columna=$valor WHERE 1" ;
         echo $sql;
         $resultado=$this->objPDO->query($sql);
         
      }
      public function cambiarEstadoPersiana($valor,$columna){

         $sql="UPDATE persianas SET $columna=$valor WHERE 1" ;
         echo $sql;
         $resultado=$this->objPDO->query($sql);
         
      }
      public function estadoPersiana($valor,$columna){

         $sql="UPDATE persianas SET $columna=$valor WHERE 1" ;
         $resultado=$this->objPDO->query($sql);
         
      }

      public function estadoLuces(){
         $sql2="SELECT * FROM luces,persianas" ; // AQUI HAY QUE PONER EL WHERE ID= CON EL SESSION DE LA ID QUE LE PASAS DEL ALUMNO
         //echo json_encode($prueba);
         $statement = $this->objPDO->prepare($sql2);
         $statement->execute();
         $result = $statement->fetchAll();

         $json= json_encode($result);

         echo $json;
    
      }

      
   }

  


?>
