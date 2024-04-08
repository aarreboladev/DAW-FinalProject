$(function() {
    $("#login-button").attr('disabled', true);
  });
cont=0;
function VerificaNombre(){ // funcion
    
    nombre=$("#nombre").val(); // variable con el contenido del input 
    
    if($("#nombre").val().length > 0) {  // si el contenido del nombre es mayor que 0 
		
		var mostrar1 = $("#nombre").val(); // variable con el contenido del input 
        var patron = /^[A-Za-z]{1,15}/; // expresion regular 
        var resultado1 = patron.test(mostrar1); // ejecutamos la expresion en el input 
        console.log(resultado1);
        if (resultado1==false){ // si da false 
           // alert("entro");
            $("#nombre").css("border-color", "red"); // fondo rojo // fondo rojo
            alert("El nombre tiene que tener la primera mayuscula y no debe contener numeros ni caracteres especiales");
			return false; //devolvemos falso
		}
		else {
             $("#nombre").css("border-color", "green"); //fondo verde          
             cont++;
              if (cont==5){
               // alert("va");
                $('#login-button').removeAttr("disabled");
            
            
            }
             console.log(cont);
        }
    
    
    
    }
    if (nombre==""){ // if si el nombre esta vacio
        $("#nombre").css("border-color", "red");
    }
}
function VerificaApellido(){ // funcion
    
    apellido=$("#apellido").val(); // variable con el contenido del input 
    
    if($("#apellido").val().length > 0) {  // si el contenido del nombre es mayor que 0 
		
		var mostrar1 = $("#apellido").val(); // variable con el contenido del input 
        var patron = /^[A-Za-z]{1,15}/; // expresion regular 
        var resultado1 = patron.test(mostrar1); // ejecutamos la expresion en el input 
        console.log(resultado1);
        if (resultado1==false){ // si da false 
           //// alert("entro");
            $("#apellido").css("border-color", "red"); // fondo rojo // fondo rojo
            alert("El apellido tiene que tener la primera mayuscula y no debe contener numeros ni caracteres especiales");
			return false; //devolvemos falso
		}
		else {
             $("#apellido").css("border-color", "green"); //fondo verde   
             cont++;
              if (cont==5){
               // alert("va");
                $('#login-button').removeAttr("disabled");
            
            
            }
             console.log(cont);        
        }
    
    
    
    }
    if (nombre==""){ // if si el nombre esta vacio
        $("#nombre").css("border-color", "red");
    }
}





function verificarEmail(){
email=$("#email").val();
    if($("#email").val().length > 0) {  // si el contenido del nombre es mayor que 0 
            
        var mostrar1 = $("#email").val(); // variable con el contenido del input 
        var patron = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/ // expresion regular 
        var resultado1 = patron.test(mostrar1); // ejecutamos la expresion en el input 
        if (resultado1==false){ // si da false 
            $("#email").css("border-color", "red"); // fondo rojo // fondo rojo
            return false; //devolvemos falso
        }
        else{
            $("#email").css("border-color", "green"); //fondo verde
            cont++;
             if (cont==5){
              // // alert("va");
                $('#login-button').removeAttr("disabled");
            
            
            }
            console.log(cont);
        }

        if (email==""){ // if si el nombre esta vacio
            $("#email").css("border-color", "red");
        }


    }
 
}

function verificarPass(){
    email=$("#pass").val();
    if($("#pass").val().length > 0) {  // si el contenido del nombre es mayor que 0 
            
        var mostrar1 = $("#pass").val(); // variable con el contenido del input 
        var patron = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/ // expresion regular 
        var resultado1 = patron.test(mostrar1); // ejecutamos la expresion en el input 
        if (resultado1==false){ // si da false 
            $("#pass").css("border-color", "red"); // fondo rojo // fondo rojo
            alert("La contraseña debe contener al menos 1 mayuscula, 1 numero y un caracter especial");
            return false; //devolvemos falso

        }
        else{
            $("#pass").css("border-color", "green"); //fondo verde
            cont++;
            console.log(cont);
            if (cont==5){
              // // alert("va");
                $('#login-button').removeAttr("disabled");
            
            
            }
        }

        if (email==""){ // if si el nombre esta vacio
            $("#pass").css("border-color", "red");
        }


    }
}

function verificarPass2(){
    email=$("#pass2").val();
    if($("#pass2").val().length > 0) {  // si el contenido del nombre es mayor que 0 
            
        var mostrar1 = $("#pass2").val(); // variable con el contenido del input 
        var patron = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/ // expresion regular 
        var resultado1 = patron.test(mostrar1); // ejecutamos la expresion en el input 
        if (resultado1==false){ // si da false 
            $("#pass2").css("border-color", "red"); // fondo rojo // fondo rojo
            alert("La contraseña debe contener al menos 1 mayuscula, 1 numero y un caracter especial");
            return false; //devolvemos falso
        }
        else{
            $("#pass2").css("border-color", "green"); //fondo verde
            cont++;
            console.log(cont);
            if (cont==5){
               //// alert("va");
                $('#login-button').removeAttr("disabled");
            
            
            }
        }

        if (email==""){ // if si el nombre esta vacio
            $("#pass2").css("border-color", "red");
        }


    }
}

