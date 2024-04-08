<?php

require('conexion.php');
class usuario extends DataBoundObject {
        
        public $user_id;
        public $username;
        public $password;
        public $admin;
        public $apellido;
        public $email;
      


        public function DefineTableName() {
                return("usuario");
        }

        public function DefineRelationMap() {
                return(array(
                        "user_id" => "user_id",
                        "username" => "username",
                        "password" => "password",
                        "admin" => "admin",
                        "apellido" => "apellido",
                        "email" => "email"
                        
                    ));
        }
        
      
}

?>