<?php

session_start();

if(!isset($_SESSION["user"])){
    header("location:login.php");
}



?>


<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/estilos.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" href="public/alertifyjs/css/alertify.min.css">
    <title>Sistema de Hoteleria</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.html"> <i class="fas fa-fw fa-building"></i> Hotel José - Administración</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">

                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $_SESSION["user"] ?></h5>
                                    <span class="status"></span><span class="ml-2">Disponible</span>
                                </div>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Cerrar sesion</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="#" ><i class="fa fa-fw fa-home"></i>Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mostrar-clientes" data-modulo="clientes" data-form="clientes" href="#"><i class="fa fa-fw  fa-users"></i>Clientes</a>
                            </li>




                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-fw fa-address-card"></i>Empleados</a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link mostrar-empleados" data-modulo="empleados" data-form="empleados" href="#">Mantenimiento</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mostrar-tipoempleados" data-modulo="tipoempleados" data-form="tipoempleados"  href="#">Categorias</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>



                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-building"></i>Hotel</a>
                                <div id="submenu-5" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link mostrar-pisos" data-modulo="pisos" data-form="pisos" href="#">Pisos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mostrar-habitaciones" data-modulo="habitaciones" data-form="habitaciones" href="#">Habitaciones</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mostrar-tipohabitaciones" data-modulo="tipohabitaciones" data-form="tipohabitaciones" href="#">Categoria de habitaciones</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mostrar-informaciongeneral" data-modulo="informaciongeneral" data-form="informaciongeneral" href="#">Información general</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-clipboard-list"></i>Reservas</a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link mostrar-reservas" data-modulo="reservas" data-form="reservas" href="#">Mantenimiento</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mirar-calendario" data-modulo="calendario" data-form="calendario" href="#">Vista de calendario</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-glass-martini"></i>Servicios</a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-2" aria-controls="submenu-1-2">Venta de productos</a>
                                            <div id="submenu-1-2" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link mostrar-productos" data-modulo="productos" data-form="productos" href="#">Productos</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link mostrar-tipoproductos" data-modulo="tipoproductos" data-form="tipoproductos" href="#">Categorias</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#">Ventas</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-3" aria-controls="submenu-1-3">Actividades</a>
                                            <div id="submenu-1-3" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#">Lista de actividades</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#">Inscripccion a actividades</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>


                                    </ul>
                                </div>
                            </li>


                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->

        <div class="dashboard-wrapper">

            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <hr style="height:0pt; visibility:hidden;" />


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                          <div class="container">
                            <div id="modulos">
                              <div class="modulos" id="vistas-clientes"></div>
                              <div class="modulos" id="vistas-buscar-clientes"></div>                              
                              <div class="modulos" id="vistas-empleados"></div>
                              <div class="modulos" id="vistas-buscar-empleados"></div>
                              <div class="modulos" id="vistas-pisos"></div>
                              <div class="modulos" id="vistas-buscar-pisos"></div>
                              <div class="modulos" id="vistas-tipohabitaciones"></div>
                              <div class="modulos" id="vistas-buscar-tipohabitaciones"></div>
                              <div class="modulos" id="vistas-habitaciones"></div>
                              <div class="modulos" id="vistas-buscar-habitaciones"></div>
                              <div class="modulos" id="vistas-servicios"></div>
                              <div class="modulos" id="vistas-buscar-servicios"></div>
                              <div class="modulos" id="vistas-reservas"></div>
                              <div class="modulos" id="vistas-buscar-reservas"></div>
                              <div class="modulos" id="vistas-chat"></div>
                              <div class="modulos" id="vistas-informaciongeneral"></div>
                              <div class="modulos" id="vistas-productos"></div>
                              <div class="modulos" id="vistas-buscar-productos"></div>
                              
                              <div class="modulos" id="vistas-tipoproductos"></div>
                              <div class="modulos" id="vistas-buscar-tipoproductos"></div>
                              
                              <div class="modulos" id="vistas-tipoempleados"></div>
                              <div class="modulos" id="vistas-buscar-tipoempleados"></div>

                              <div class="modulos" id="vistas-calendario"></div>






                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                
            </div>

            




                    <!-- ============================================================== -->
                    <!-- pageheader  -->
           
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->



            <hr style="height:328pt; visibility:hidden;" />
            <div class="container">
                <div class="ecommerce-widget">
                    <div class="row ">
                        <div class="col-10">
                        </div>
                        <div class="col-2 " >
                            <h4><a class="nav-link enseñar-chat float-right" data-modulo="chat" data-form="chat" href="#">Chat <i class="fas fa-fw fa-comment"></i> </a></h4>
                       </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                             Copyright © 2020. Derechos reservados 
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href=>Acerca de</a>
                                <a href=>Contacto</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>


    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
    <script src="public/alertifyjs/alertify.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.dev.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="public/js/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="public/js/app.js"></script>
    <script src="public/js/notificaciones.js"></script>
    <script src="public/js/push.js"></script>

    <script src="https://unpkg.com/vue-select@3.0.0"></script>
    
</body>
 
</html>