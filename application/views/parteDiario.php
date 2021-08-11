<?php ?>

<!DOCTYPE html>
<html lang="en">
    <?php
    include_once (APPPATH . "views/template/header.php");
    ?> 
    <!-- Fixed navbar -->
    <div id="head-nav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="fa fa-gear"></span>
                </button>
                <a class="navbar-brand" href="#"><span><?= NOMBRE_EMPRESA ?></span></a>
            </div>
            <div class="navbar-collapse collapse">

                <ul class="nav navbar-nav navbar-right user-nav">
                    <li class="dropdown profile_menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img alt="Avatar" src="" /><span></span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="Perfil" class="dropdown-toggle" data-toggle="dropdown">Ver Perfil</a></li>
                            <li><a href="Login/logOut">Cerrar Session</a></li>
                        </ul>
                    </li>
                </ul>


            </div>
            <!--/.nav-collapse animate-collapse -->
        </div>
    </div>
    <!-- End Fixed navbar -->
    <!-- Menu -->
    <div id="cl-wrapper" class="fixed-menu">
        <div class="cl-sidebar" data-position="right" data-step="1" data-intro="<strong>Fixed Sidebar</strong> <br/> It adjust to your needs." >
            <div class="cl-toggle"><i class="fa fa-bars"></i></div>
            <div class="cl-navblock">
                <div class="menu-space">
                    <div class="content">
                        <ul class="cl-vnavigation" id="menuPrincipal">
                            <?php
//include_once (APPPATH . "views/template/menuprincipal.php"); 
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="text-right collapse-button" style="padding:7px 9px;">
                    <input type="text" class="form-control search" placeholder="Search..." />
                    <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
                </div>
            </div>
        </div>   
        <!-- END Menu -->

        <!-- Small boxes (Stat box) -->

        <DIV class="row" style="padding: 15px 25px 0 25px;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="block-flat">
                    <div class="header">
                        <h2>PARTE DIARIO DE MOVIMIENTO DE PACIENTES</h2>
                    </div>
                    <div class="content" id="">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="col-md-6">
                                    <label>Piso: </label>
                                    <select class="select2" id="cmbPisos">

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Fecha: </label>
                                    <div class="input-group date datetime" data-min-view="2" data-date-format="yyyy-mm-dd">
                                        <input class="form-control" size="16" type="text" value="2021-07-20" readonly="" id="calendar">
                                        <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" onclick="generarInforme()">Generar</button>
                                    <a class="btn" onclick="generarPdf()">Imprimir</a>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-0">
                                <table class="table-bordered" id="tblParteDiarioIngresos">
                                    <thead>
                                        <tr>
                                            <th>Matrícula</th>
                                            <th>Nombre completo</th>
                                            <th>Edad</th>
                                            <th>Sexo</th>
                                            <th>Transferido de</th>
                                            <th>Sala</th>
                                            <th>Cama</th>
                                            <th>Dianóstico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                                
                                <table class="table-bordered" id="tblParteDiarioEgresos">
                                    <thead>
                                        <tr>
                                            <th>Matrícula</th>
                                            <th>Nombre completo</th>
                                            <th>Edad</th>
                                            <th>Sexo</th>
                                            <th>Tipo de alta</th>
                                            <th>Sala</th>
                                            <th>Cama</th>
                                            <th>Fecha de ingreso</th>
                                            <th>Diagnó  stico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </DIV>

    </div>

    <?php
    include_once (APPPATH . "views/template/scripts.php");
    ?> 	
    <script type="text/javascript" src="<?= base_url("assets/js/negocio/reportes.js") ?>"></script>
</body>
</html>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Title</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idConfirmacion" id="idConfirmacion">
                <div class="text-center">
                    <div class="col-sm-6">
                        <table>

                        </table>
                    </div>
                </div>


            </div>
            <div class="modal-footer">


            </div>
        </div>

    </div>
</div>