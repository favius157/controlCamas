<?php ?>

<!DOCTYPE html>
<html lang="en">
    <style>
        .salas{
            border: 1px solid gray;
            margin-top: 0px;
            height: 50px;
        }
    </style>
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
                <a class="navbar-brand" href="#"><span>SOPORTE</span></a>
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
        <div class="container-fluid" id="pcont">
            <div class="cl-mcont">
                <div class="row bloques">
                    <div class="col-md-2">
                        <div class="card block-flat">
                            <div class="card-body">
                                <div class="row salas">
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                </div>
                                <div class="row salas">
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                </div>
                                <div class="row salas">
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                </div>
                                <div class="row salas">
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                </div>
                                <div class="row salas">
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                    <div class="col-md-4">
                                        cama
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-right: 0px">
                        <div class="card block-flat">
                            <div class="card-body">
                                <h1 style="text-align: center;">Bloque</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0 0 0 0;">
                        <div class="card block-flat">
                            <div class="card-body">
                                <h1 style="text-align: center;">Ascensor</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-left: 0px">
                        <div class="card block-flat">
                            <div class="card-body">
                                <h1 style="text-align: center;">Bloque</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card block-flat">
                            <div class="card-body">
                                <h1 style="text-align: center;">Bloque</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="height: 150px;">
                    <div class="col-md-2" style="background-color: #c02ad2; height: 100%;">
                        <h1 style="text-align: center; color: white; font-weight: 700;">
                            Enfermeria
                        </h1>
                    </div>
                    <div class="col-md-8">

                    </div>
                    <div class="col-md-2" style="background-color: #c02ad2; height: 100%;">
                        <h1 style="text-align: center; color: white; font-weight: 700;">
                            Enfermeria
                        </h1>
                    </div>
                </div>
                <div class="row bloques">
                    <div class="col-md-2">
                        <div class="card block-flat">
                            <div class="card-body">
                                <h1 style="text-align: center;">Bloque</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-right: 0px">
                        <div class="card block-flat">
                            <div class="card-body">
                                <h1 style="text-align: center;">Bloque</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0 0 0 0;">
                        <div class="card block-flat">
                            <div class="card-body">
                                <h1 style="text-align: center;">Ascensor</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-left: 0px">
                        <div class="card block-flat">
                            <div class="card-body">
                                <h1 style="text-align: center;">Bloque</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card block-flat">
                            <div class="card-body">
                                <h1 style="text-align: center;">Bloque</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 


    </div>

    <?php
    include_once (APPPATH . "views/template/scripts.php");
    ?> 	
    <script type="text/javascript" src="<?= base_url("assets/js/negocio/rol.js") ?>"></script>
</body>
</html>


<div id="modalNuevoRol" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span id="task"></span> Rol</h4>
            </div>
            <div class="modal-body">

                <div class="row" id="formRol">
                    <div class="col-md-6">
                        <label>Nombre de rol:</label>
                        <input type="text" name="nRol" class="form-control" placeholder="Nombre del rol">
                    </div>

                </div>


            </div>
            <div class="modal-footer">

                <span id="msgRol" class="msgAlertas" style="float: left; color: red; display: none;">Los campos marcados con rojo son obligatorios</span>
                <button class="btn btn-facebook" onclick="editarRol(0, true)" id="btnEditarRol" style="display: none;">Guardar</button>
                <button class="btn btn-primary" onclick="nuevoRol(true)" id="btnGuardarRol">Guardar</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            </div>
        </div>

    </div>
</div>

<div id="modalConfirmacion" class="modal fade bd-example-modal-sm" role="dialog">
    <div class="modal-dialog" style="width: 30%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center;">Seguro que quieres borrar este registro?</h4>
            </div>

            <div class="modal-footer" style="text-align: center;">

                <button class="btn btn-primary" onclick="borrar(0, true)" style="width: 76.6px;">SI</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            </div>
        </div>

    </div>
</div>
