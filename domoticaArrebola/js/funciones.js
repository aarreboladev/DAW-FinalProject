$(function() {
  $("#bOnSalon").hide();
  $("#bOffSalon").hide();
  $("#bOnHab1").hide();
  $("#bOffHab1").hide();
  $("#bOnHab2").hide();
  $("#bOffHab2").hide();
  $("#bOnHab3").hide();
  $("#bOffHab3").hide();
  $("#bOnHabM").hide();
  $("#bOffHabM").hide();
  $("#luzPlano").show();
  $("#movs").show();
$("#myChart").hide();
$("#bombillas").hide();
  $("#pOnSalon").hide();
  $("#pOffSalon").hide();
  $("#pOnHab1").hide();
  $("#pOffHab1").hide();
  $("#pOnHab2").hide();
  $("#pOffHab2").hide();
  $("#pOnHab3").hide();
  $("#pOffHab3").hide();
  $("#pOnHabM").hide();
  $("#pOffHabM").hide();
  $("#persianaPlano").hide();
  $("#persiana").hide();

  $("#principalMovimientos").hide();
  $("#principalTemperatura").hide();
 
  
});

cont2=0;

function login(){

    nombre=$("#nombre").val();
    pass=$("#pass").val();
   
    $.ajax({
        type: "POST",
        url: "login.php",
        data:
		{
            nombre:nombre,
            pass:pass
		},
        success: function(respuesta) {
          prueba=respuesta.trim()
         
          if (prueba=="bien"){
          window.location.href = "index.php?usuario="+nombre;
         
          }
          else{
            
            $("#mensaje").html("Error al inciar sesion");
          }
        }
      });
}
function nombre(){

  
  $.ajax({
      type: "POST",
      url: "php/nombre.php",
      data:
  {
  
  },
      success: function(respuesta) {

      $("#bienvenido").html("<a>" + " Bienvenido , "  + respuesta + "</a>");
        
      }
    });

   
} 
nombre();

function registrar(){
 
  nombre=$("#nombre").val();
  pass=$("#pass").val();
  pass2=$("#pass2").val();
  apellido=$("#apellido").val();
  email=$("#email").val();
 if (pass==pass2){
  $.ajax({
      type: "POST",
      url: "register.php",
      data:
  {
          nombre:nombre,
          pass:pass,
          apellido:apellido,
          email:email,
          
  },
      success: function(respuesta) {
        //$("#respuesta").html(respuesta)
        prueba=respuesta.trim()
       
       // console.log(prueba);
        if (prueba==""){
          window.location.href = "login.html";
        }
        else{
          $("#mensaje").html(respuesta);
        }
     //  $("#respuesta").html(respuesta);
      
      }
    });
  }
}



function user(){
  $.ajax({
    type: "POST",
    url: "users.php",
    data:
{
     
        
},
    success: function(respuesta) {
      //$("#respuesta").html(respuesta)
      
      $("#tabla").append(respuesta );
      
      
     
   //  $("#respuesta").html(respuesta);
    
    }
  });

}
user();
function historial(){
  $.ajax({
    type: "POST",
    url: "adminUser/registros.php",
    data:
{
             
},
    success: function(respuesta) {
      //$("#respuesta").html(respuesta)
      
      $("#tablaMovimientos").append(respuesta );
      
      
     
   //  $("#respuesta").html(respuesta);
    
    }
  });

}

historial();

$( "#editar1" ).click(function() {
  alert( "Handler for .click() called." );
});


function editarID(cont){
  id=$("#id"+cont).html();
  $.ajax({
    type: "POST",
    url: "adminUser/editarID.php",
    data:
{
     id:id
        
},
    success: function(respuesta) {
      prueba=respuesta.trim()
      $("#id").val(prueba);
    }
  });
 
 
}
function editarNombre(cont){
  id=$("#id"+cont).html();
  
  $.ajax({
    type: "POST",
    url: "adminUser/editarNombre.php",
    data:
{
     id:id
        
},
    success: function(respuesta) {
      prueba=respuesta.trim()
      $("#nombre").val(prueba);
    }
  });
}
function editarApellido(cont){
  id=$("#id"+cont).html();
   
  $.ajax({
    type: "POST",
    url: "adminUser/editarApellido.php",
    data:
{
     id:id
        
},
    success: function(respuesta) {  
      prueba=respuesta.trim() 
      $("#apellido").val(prueba);
    }
  });
}

function editarGmail(cont){
  id=$("#id"+cont).html();
   
  $.ajax({
    type: "POST",
    url: "adminUser/editarGmail.php",
    data:
{
     id:id
        
},
    success: function(respuesta) {   
      prueba=respuesta.trim()
      $("#gmail").val(prueba);
    }
  });
}



function eliminar(cont){

id=$("#id"+cont).html();
mensaje="Seguro que quieres eliminar este usuario?";
      result = window.confirm(mensaje);
      if (result==true){
  $.ajax({
    type: "POST",
    url: "adminUser/eliminar.php",
    data:
{
     id:id
        
},
    success: function(respuesta) {
      //$("#respuesta").html(respuesta)
      
        alert("Se ha eliminado correctamente");
        window.location.href = "adminUser.php";
      
      
     
   //  $("#respuesta").html(respuesta);
    
    }
  });
      }

  


}

function registros(cont){
  id=$("#id"+cont).html();
  $.ajax({
    type: "POST",
    url: "adminUser/registros.php",
    data:
{
     id:id
        
},
    success: function(respuesta) {
      
   //  $("#respuesta").html(respuesta);
    
    }
  });
}

function admin(cont){
  id=$("#id"+cont).html();
  $.ajax({
    type: "POST",
    url: "adminUser/admin.php",
    data:
{
     id:id
        
},
    success: function(respuesta) {
      //$("#respuesta").html(respuesta)
      
      prueba=respuesta.trim()
      //console.log(prueba);
      if(prueba==1){
        alert("Se han concedido permisos de administrador");
        window.location.href = "adminUser.php";
      }
      else {
        alert("Este usuario ya tiene permisos");
      }
      
      
     
   //  $("#respuesta").html(respuesta);
    
    }
  });
}


function editar(){
  id=$("#id").val();
  nom=$("#nombre").val();
  ape=$("#apellido").val();
  gma=$("#gmail").val();
  $.ajax({
    type: "POST",
    url: "adminUser/editar.php",
    data:
{
     id:id,
     nom:nom,
     ape:ape,
     gma:gma
        
},
    success: function(respuesta) {
      alert("El registro se ha actualizado correctamente");
      window.location.href = "adminUser.php";
    }
  });

}

function noAdmin(cont){

  id=$("#id"+cont).html();
  $.ajax({
    type: "POST",
    url: "adminUser/noAdmin.php",
    data:
{
     id:id
        
},
    success: function(respuesta) {
      //$("#respuesta").html(respuesta)
      
      prueba=respuesta.trim()
     // console.log(prueba);
      if(prueba==1){
        alert("Se han quitado los permisos de administrador");
        window.location.href = "adminUser.php";
      }
      else {
        alert("Este usuario no tiene permisos");
      }
      
      
     
   //  $("#respuesta").html(respuesta);
    
    }
  });


}


function registroAdmin(cont){
  id=$("#id"+cont).html();
  $.ajax({
    type: "POST",
    url: "adminUser/registrosAdmin.php",
    data:
{
     id:id
        
},
    success: function(respuesta) {
      $("#registros").html(respuesta );
    }
  });

}



function luces(){
  $("#bombillas").show();
  $("#persianas").hide();
  $("#myChart").hide();
  $("#principalTemperatura").hide();
    $("#luzPlano").show();
  $("#movs").show();
  $("#persianaPlano").hide();
  $("#persiana").hide();
  $("#pOnSalon").hide();
  $("#pOffSalon").hide();
  $("#pOnHab1").hide();
  $("#pOffHab1").hide();
  $("#pOnHab2").hide();
  $("#pOffHab2").hide();
  $("#pOnHab3").hide();
  $("#pOffHab3").hide();
  $("#pOnHabM").hide();
  $("#pOffHabM").hide();

  $("#principalMovimientos").hide();
  
  setInterval(function(){ 
    $.ajax({
      type: "POST",
      url: "luces.php",
      dataType:"json",
      data:
  {
               
  },
      success: function(respuesta) {
   
     //console.log(respuesta);
     for(let ref=0;ref<respuesta.length;ref++){
  
       salon=respuesta[ref].salon;
       hab1=respuesta[ref].hab1;
       hab2=respuesta[ref].hab2;
       hab3=respuesta[ref].hab3;
       habM=respuesta[ref].habM;
       per2=respuesta[ref].per1;
       per3=respuesta[ref].per3;
       perS=respuesta[ref].per4;
       perM=respuesta[ref].per5;

  }
  
  if(salon==1){
    $("#bOnSalon").show();
    $("#bOffSalon").hide();
  }
  else{
    $("#bOffSalon").show();
    $("#bOnSalon").hide();
  }
  if(hab1==1){
    $("#bOffHab1").hide();
    $("#bOnHab1").show();
  }
  else{
    $("#bOffHab1").show();
    $("#bOnHab1").hide();
  }
  
  if(hab2==1){
    $("#bOffHab2").hide();
    $("#bOnHab2").show();
  }
  else{
    $("#bOffHab2").show();
    $("#bOnHab2").hide();
  }
  if(hab3==1){
    $("#bOffHab3").hide();
    $("#bOnHab3").show();
  }
  else{
    $("#bOffHab3").show();
    $("#bOnHab3").hide();
  }
  if(habM==1){
    $("#bOffHabM").hide();
    $("#bOnHabM").show();
  }
  else{
    $("#bOffHabM").show();
    $("#bOnHabM").hide();
  }
  if(per2==1){
    $("#pOnHab2").show();
    $("#pOffHab2").hide();
  }
  if(per2==2){
    $("#pOnHab2").hide();
    $("#pOffHab2").show();
  }
  if(per3==1){
    $("#pOnHab3").show();
    $("#pOffHab3").hide();
  }
  if(per3==2){
    $("#pOnHab3").hide();
    $("#pOffHab3").show();
  }
  
  if(perS==1){
    $("#pOnSalon").show();
    $("#pOffSalon").hide();
  }
  if(perS==2){
    $("#pOnSalon").hide();
    $("#pOffSalon").show();
  }
  if(perM==1){
    $("#pOnHabM").show();
    $("#pOffHabM").hide();
  }
  if(perM==2){
    $("#pOnHabM").hide();
    $("#pOffHabM").show();
  }
  
  
  
      }
    });

  }, 1000);

 
};

function persianas(){
  $("#bombillas").hide();
  $("#persianas").show();
  $("#principalTemperatura").hide();
  $("#myChart").hide();
  $("#persianaPlano").show();
  $("#persiana").show();
  $("#luzPlano").hide();
  $("#movs").hide();
  $("#bOnSalon").hide();
  $("#bOffSalon").hide();
  $("#bOnHab1").hide();
  $("#bOffHab1").hide();
  $("#bOnHab2").hide();
  $("#bOffHab2").hide();
  $("#bOnHab3").hide();
  $("#bOffHab3").hide();
  $("#bOnHabM").hide();
  $("#bOffHabM").hide();

  $("#principalMovimientos").hide();
  setInterval(function(){ 

    $.ajax({
      type: "POST",
      url: "persianas.php",
      dataType:"json",
      data:
  {
               
  },
      success: function(respuesta) {
   
     console.log(respuesta);
     for(let ref=0;ref<respuesta.length;ref++){
       perS=respuesta[ref].per1;
       per2=respuesta[ref].per3;
       per3=respuesta[ref].per4;
       perM=respuesta[ref].per5;
     
      }
  
  if(per2==1){
    $("#pOnHab2").show();
    $("#pOffHab2").hide();
  }
  else{
    $("#pOnHab2").hide();
    $("#pOffHab2").show();
  }
  if(per3==1){
    $("#pOnHab3").show();
    $("#pOffHab3").hide();
  }
  else{
    $("#pOnHab3").hide();
    $("#pOffHab3").show();
  }
  
  if(perS==1){
    $("#pOnSalon").show();
    $("#pOffSalon").hide();
  }
  else{
    $("#pOnSalon").hide();
    $("#pOffSalon").show();
  }
  if(perM==1){
    $("#pOnHabM").show();
    $("#pOffHabM").hide();
  }
  else{
    $("#pOnHabM").hide();
    $("#pOffHabM").show();
  }
  
  
      }
    });
   }, 1000);


}

function temperatura(){
  $("#bombillas").hide();
  $("#persianas").hide();
  //persianas
  $("#persianaPlano").hide();
  $("#persiana").hide();
  $("#pOnSalon").hide();
  $("#pOffSalon").hide();
  $("#pOnHab1").hide();
  $("#pOffHab1").hide();
  $("#pOnHab2").hide();
  $("#pOffHab2").hide();
  $("#pOnHab3").hide();
  $("#pOffHab3").hide();
  $("#pOnHabM").hide();
  $("#pOffHabM").hide();
  $("#luzPlano").hide();
  // luz
  $("#movs").hide();
  $("#bOnSalon").hide();
  $("#bOffSalon").hide();
  $("#bOnHab1").hide();
  $("#bOffHab1").hide();
  $("#bOnHab2").hide();
  $("#bOffHab2").hide();
  $("#bOnHab3").hide();
  $("#bOffHab3").hide();
  $("#bOnHabM").hide();
  $("#bOffHabM").hide();

  //movimientos

  $("#principalMovimientos").hide();

  $("#principalTemperatura").show();
  $("#myChart").show();
 
  setInterval(function(){
    $.ajax({
      type: "POST",
      url: "temperatura.php",
      data:
  {
               
  },
      success: function(respuesta) {
   
        $("#tablaTemperatura").html(respuesta );
        graficaTemperatura();
      
      }
    });

  }, 1000);



 
}




$( "#salonOn" ).click(function() {
  crearLog("Encender luz salon");
  cambiarEstado("luz","salon",1);
});

$( "#salonOff" ).click(function() {
  
  crearLog("Apagar luz salon");
  cambiarEstado("luz","salon",0);
});



$( "#H1On" ).click(function() {
 
  crearLog("Encender luz Hab1");
  cambiarEstado("luz","hab1",1);
});

$( "#H1Off" ).click(function() {

  crearLog("Apagar luz Hab1");
  cambiarEstado("luz","hab1",0);
});

$( "#H2On" ).click(function() {

  crearLog("Encender luz Hab2");
  cambiarEstado("luz","hab2",1);
});

$( "#H2Off" ).click(function() {
 
  crearLog("Apagar luz Hab2");
  cambiarEstado("luz","hab2",0);
});

$( "#H3On" ).click(function() {
 
  crearLog("Encender luz Hab3");
  cambiarEstado("luz","hab3",1);
});

$( "#H3Off" ).click(function() {
 
  crearLog("Apagar luz Hab3");
  cambiarEstado("luz","hab3",0);
});

$( "#HMOn" ).click(function() {
 
  crearLog("Encender luz Hab Matrimonio");
  cambiarEstado("luz","habM",1);
});

$( "#HMOff" ).click(function() {
  crearLog("Apagar luz Hab Matrimonio");
  cambiarEstado("luz","habM",0);
});

// PERSIANAS 



$( "#PsalonOn" ).click(function() {
 
  crearLog("Subir persiana salon");
  
  cambiarEstado("per","per4",1);
});

$( "#PsalonOff" ).click(function() {
  
  crearLog("Bajar persiana salon");
  cambiarEstado("per","per4",2);
});



$( "#P2On" ).click(function() {
  
  crearLog("Subir persiana Hab 2");
  cambiarEstado("luz","per2",0);
  cambiarEstado("luz","per1",1);
   
  ;
});

$( "#P2Off" ).click(function() {
  
  crearLog("Bajar persiana Hab 2");
  cambiarEstado("luz","per1",0); 
  cambiarEstado("luz","per2",1);
 

  
});


$( "#P3On" ).click(function() {
 
  crearLog("Subir persiana Hab 3");
  cambiarEstado("per","per3",1);
});

$( "#P3Off" ).click(function() {
 
  crearLog("Bajar persiana Hab 3");
  cambiarEstado("per","per3",2);
});

$( "#PMOff" ).click(function() {

  crearLog("Bajar persiana Hab Matrimonio");
  cambiarEstado("per","per5",2);
});


$( "#PMOn" ).click(function() {
 
  crearLog("Subir persiana Hab Matrimonio");
  cambiarEstado("per","per5",1);
});


function movimientos(){
  $("#bombillas").hide();
  $("#persianas").hide();
  $("#principalMovimientos").show();
  //persiana

  $("#persianaPlano").hide();
  $("#persiana").hide();
  $("#pOnSalon").hide();
  $("#pOffSalon").hide();
  $("#pOnHab1").hide();
  $("#pOffHab1").hide();
  $("#pOnHab2").hide();
  $("#pOffHab2").hide();
  $("#pOnHab3").hide();
  $("#pOffHab3").hide();
  $("#pOnHabM").hide();
  $("#pOffHabM").hide();
  $("#luzPlano").hide();
  // luz
  $("#movs").hide();
  $("#bOnSalon").hide();
  $("#bOffSalon").hide();
  $("#bOnHab1").hide();
  $("#bOffHab1").hide();
  $("#bOnHab2").hide();
  $("#bOffHab2").hide();
  $("#bOnHab3").hide();
  $("#bOffHab3").hide();
  $("#bOnHabM").hide();
  $("#bOffHabM").hide();

  // temperatura 

  $("#principalTemperatura").hide();
  $("#myChart").hide();
}






function graficaTemperatura(){
  $.ajax({
    type: "POST",
    url: "graficaTemperatura.php",
    dataType:"json",
    data:
{
             
},
    success: function(respuesta) {
      var mietiqueta = new Array();
      var midato = new Array();
    

     
      //recorremos los datos del json capturando el dato de cada campo para cada iteracion

      for(let ref=0;ref<respuesta.length;ref++){

          let fecha=respuesta[ref].fecha;
          let temperatura=respuesta[ref].temperatura;
        // console.log(fecha);
        // console.log(temperatura);

          //llenamos cada array que usaremos en el chart
          mietiqueta[ref]= fecha;
          midato[ref] = temperatura;
       
    
      }
      //$("#respuesta").html(respuesta)
     // console.log(respuesta);
      var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: mietiqueta ,
                datasets: [{
                    label: 'mi gráfica de temperatura',
                    data: midato ,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
      
     
   //  $("#respuesta").html(respuesta);
    
    }
  });


}

function crearLog(comentario){


  $.ajax({
    type: "POST",
    url: "crearLog.php",
    data:
{
    comentario: comentario
},
    success: function(respuesta) {
    // console.log("log creado");
    
    }
  });
}

function cambiarEstado(tipo,columna,valor){
  $.ajax({
    type: "POST",
    url: "cambiarEstado.php",
    data:
{
    columna:columna,
    tipo:tipo,
    valor:valor
  
},
    success: function(respuesta) {
    // console.log("valor cambiado ");
    
    }
  });
} 




/// sb-admin-2 ni caso


/*!
 * Start Bootstrap - SB Admin 2 v4.0.7 (https://startbootstrap.com/template-overviews/sb-admin-2)
 * Copyright 2013-2019 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin-2/blob/master/LICENSE)
 */

!function(t){"use strict";t("#sidebarToggle, #sidebarToggleTop").on("click",function(o){t("body").toggleClass("sidebar-toggled"),t(".sidebar").toggleClass("toggled"),t(".sidebar").hasClass("toggled")&&t(".sidebar .collapse").collapse("hide")}),t(window).resize(function(){t(window).width()<768&&t(".sidebar .collapse").collapse("hide")}),t("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel",function(o){if(768<t(window).width()){var e=o.originalEvent,l=e.wheelDelta||-e.detail;this.scrollTop+=30*(l<0?1:-1),o.preventDefault()}}),t(document).on("scroll",function(){100<t(this).scrollTop()?t(".scroll-to-top").fadeIn():t(".scroll-to-top").fadeOut()}),t(document).on("click","a.scroll-to-top",function(o){var e=t(this);t("html, body").stop().animate({scrollTop:t(e.attr("href")).offset().top},1e3,"easeInOutExpo"),o.preventDefault()})}(jQuery);
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Earnings",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '$' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Direct", "Referral", "Social"],
    datasets: [{
      data: [55, 30, 15],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
