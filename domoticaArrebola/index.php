<?php
require_once("conexion.php");
 if(isset($_GET['usuario'])){
  $id = $_SESSION['id'];
  $sql="SELECT username, admin FROM usuario WHERE user_id=$id" ;
  //print $sql;
  $resultado=$objPDO->query($sql);
  while ( $row = $resultado -> fetch( PDO :: FETCH_ASSOC )) {
    
    $nombre=$row['username'];
    $admin=$row['admin'];
 }

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ProyectoArrebola </title>

   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/estilo.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href='index.php?usuario=<?php print $nombre?>'>
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ArrebolaProject</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php?usuario=<?php print $nombre?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
     



      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Admin:</h6>
            <a class="collapse-item" href="adminUser.php">Administrador de usuarios</a>
          </div>
        </div>
      </li>

    

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
      

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

         
       

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                <div id="bienvenido">Bienvenido,</div>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
               
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesion
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
           
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" style="height:170px;">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-4 " style="margin-top:-5px;">Administración de luces</div>
                      
                    <button class="btn btn-primary" style="margin-left:50px;width:100px; height:50px; margin-bottom:10px; " onclick="luces()">Luces</button>
                      <br>
                      <!-- AQUI VA EL BOTON-->
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Administración de persianas</div>
                      <br>
                      <button class="btn btn-primary" style="margin-left:50px;width:100px; height:50px; margin-bottom:20px;" onclick="persianas()">Persianas</button>
                      <br>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Administración de temperatura</div>
                      <div class="row no-gutters align-items-center">
                        
                       
                      </div>
                      <button class="btn btn-primary" style="margin-left:50px;width:120px; height:50px; margin-top:20px;"onclick="temperatura(),graficaTemperatura()">Temperatura</button>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

       
 
            <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Administracion de movimientos</div>
                            <div class="row no-gutters align-items-center">
                              
                            
                            </div>
                            <?php 
                            
                            if ($admin==1){

                            ?>
                            <button class="btn btn-primary" style="margin-left:50px;width:120px; height:50px; margin-top:20px;" onclick="movimientos()">Movimientos</button>
                            <?php
                            }
                            else{
                              ?>
                            <button class="btn btn-primary" style="margin-left:50px;width:120px; height:50px; margin-top:20px;" onclick="movimientos()" disabled>Movimientos</button>
                              <?php
                            }

                            ?>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   
        <!-- /.container-fluid -->

      </div>
    
    <div class="containter" >
      <div class="row">
        <div class="col-md-5" >
       
          <img id="luzPlano" src="img/plano.PNG" alt="">
          <img id="persianaPlano" src="img/plano.PNG" alt="">
          <div id="bombillas">
          <img id="bOnSalon" src="img/bOn.png" alt="">
          <img id="bOffSalon" src="img/bOff.png" alt="">
          <img id="bOnHab1" src="img/bOn.png" alt="">
          <img id="bOffHab1" src="img/bOff.png" alt="">
          <img id="bOnHab2" src="img/bOn.png" alt="">
          <img id="bOffHab2" src="img/bOff.png" alt="">
          <img id="bOnHab3" src="img/bOn.png" alt="">
          <img id="bOffHab3" src="img/bOff.png" alt="">
          <img id="bOnHabM" src="img/bOn.png" alt="">
          <img id="bOffHabM" src="img/bOff.png" alt="">
        </div>
  <!-- persianas -->
             <div id=persianas>               
          <img id="pOnSalon" src="img/verde.png" alt="">
          <img id="pOffSalon" src="img/rojo.png" alt="">
          <img id="pOnHab2" src="img/verde.png" alt="">
          <img id="pOffHab2" src="img/rojo.png" alt="">
          <img id="pOnHab3" src="img/verde.png" alt="">
          <img id="pOffHab3" src="img/rojo.png" alt="">
          <img id="pOnHabM" src="img/verde.png" alt="">
          <img id="pOffHabM" src="img/rojo.png" alt="">
          </div>
        </div>
        <div id="movs" class="col-md-6" style="margin-top:16px;">
              <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Luces</th>
                      <th scope="col">Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                     
                      <td>Salón</td>
                      <td><button id="salonOn" style="width:80px; margin-right:10px"class="btn btn-success">ON</button> <button id="salonOff" style="width:80px; margin-left:10px" class="btn btn-danger">OFF</button></td>
                    </tr>
                    <tr>
                      
                      <td>Habitación 1 </td>
                      <td><button id="H1On" style="width:80px; margin-right:10px"class="btn btn-success">ON</button> <button id="H1Off"style="width:80px; margin-left:10px" class="btn btn-danger">OFF</button></td>
                    </tr>
                    <tr>
                     
                      <td>Habitación 2 </td>
                      <td><button id="H2On" style="width:80px; margin-right:10px"class="btn btn-success">ON</button> <button id="H2Off" style="width:80px; margin-left:10px" class="btn btn-danger">OFF</button></td>
                    </tr>
                    <tr>
                     
                     <td>Habitación 3 </td>
                     <td><button id="H3On" style="width:80px; margin-right:10px"class="btn btn-success">ON</button> <button id="H3Off" style="width:80px; margin-left:10px" class="btn btn-danger">OFF</button></td>
                   </tr>
                   <tr>
                     
                     <td>Habitacion Matrimonio</td>
                     <td><button id="HMOn"style="width:80px; margin-right:10px"class="btn btn-success">ON</button> <button id="HMOff" style="width:80px; margin-left:10px" class="btn btn-danger">OFF</button></td>
                   </tr>
                  </tbody>
              </table>

        </div>
        
        <div id="persiana" class="col-md-6" style="margin-top:16px;">
              <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Persianas</th>
                      <th scope="col">Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                     
                      <td>Salón</td>
                      <td><button id="PsalonOn" style="width:80px; margin-right:10px"class="btn btn-success">Subir</button> <button id="PsalonOff" style="width:80px; margin-left:10px" class="btn btn-danger">Bajar</button></td>
                    </tr>
                   
                    <tr>
                     
                      <td>Habitación 2 </td>
                      <td><button id="P2On" style="width:80px; margin-right:10px"class="btn btn-success">Subir</button> <button id="P2Off" style="width:80px; margin-left:10px" class="btn btn-danger">Bajar</button></td>
                    </tr>
                    <tr>
                     
                     <td>Habitación 3 </td>
                     <td><button id="P3On" style="width:80px; margin-right:10px"class="btn btn-success">Subir</button> <button id="P3Off" style="width:80px; margin-left:10px" class="btn btn-danger">Bajar</button></td>
                   </tr>
                   <tr>
                     
                     <td>Habitacion Matrimonio</td>
                     <td><button id="PMOn"style="width:80px; margin-right:10px"class="btn btn-success">Subir</button> <button id="PMOff" style="width:80px; margin-left:10px" class="btn btn-danger">Bajar</button></td>
                   </tr>
                  </tbody>
              </table>

        </div>
        <div style="margin-top:70px;" id="principalMovimientos"> 
          <table class="table" style="width:1000px; margin-left:330px; margin-top:-1px;" >
              <thead class="thead-dark">
                <tr>
                  <th scope="col">ID movimiento</th>
                  <th scope="col">ID Usuario</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Apellido</th>
                  <th scope="col">Accion</th>
                  <th scope="col">Fecha</th>
                </tr>
              </thead>
              <tbody id="tablaMovimientos">
              
              </tbody>
            </table>
        </div>

        <div style="margin-top:70px;" id="principalTemperatura"> 
          <table class="table" style="width:700px; margin-left:900px; margin-top:-1px;" >
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Fecha</th>
                  <th scope="col">Temperatura</th>
                 
                </tr>
              </thead>
              <tbody id="tablaTemperatura">
              
              </tbody>
            </table>
        </div>
      <div style="width:700px; height:300px; margin-left:100px; margin-top:-820px;">
        <canvas id="myChart" width="400" height="400"></canvas>
      </div>
        
      </div>
    </div>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Estas seguro de que quieres cerrar sesión? .</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="login.html">Cerrar Sesión</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  
 
  <script src="js/funciones.js"></script>
 

    </head>

  

</body>

</html>


<?php
 
 }
 else{
  header('Location:login.html');
  
 }
?>