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
                <div class="row">
                    <div class="col-md-12">
                        <div id="loaderTable"></div>
                        <div class="block-flat">
                            <div class="header">							
                                <h3>Roles y permisos</h3>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: green; color: white; font-weight: 600;">
                                                Lista de roles
                                                <span class="badge badge-primary badge-pill crear" style="cursor: pointer; background-color: white !important; color: green;" onclick="nuevoRol(false)"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Agregar un nuevo rol"></i></span>
                                            </li>
                                            <div id="listaRoles">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    Dapibus ac facilisis in
                                                    <span class="badge badge-primary badge-pill">2</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    Morbi leo risus
                                                    <span class="badge badge-primary badge-pill">1</span>
                                                </li>
                                            </div>
                                        </ul>
                                    </div>
                                    <div class="col-md-8">
                                        <table class="table no-border hover" id="tablaPermisos">
                                            
                                            <thead class="no-border">
                                                <tr>
                                                    <th>Nombre del menu</th>
                                                    <th>Estado</th>
                                                    <th>
                                                        <a class="crear" onclick="nuevoPermiso(false)" data-toggle ="modal" style="color: #AE212A; cursor: pointer;"><i class="fa fa-plus-square"> Nuevo Permiso</i></a>

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="no-border-y">

                                            </tbody>
                                        </table>	
                                    </div>
                                </div>
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
    <script type="text/javascript" src="<?= base_url("assets/js/negocio/privilegios.js") ?>"></script>
</body>
</html>


<div id="modalNuevoRol" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevo Rol</h4>
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
                <button class="btn btn-primary" onclick="nuevoRol(true)" id="btnGuardarRol">Guardar</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            </div>
        </div>

    </div>
</div>

<div id="modalNuevoPermiso" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevo Permiso</h4>
            </div>
            <div class="modal-body">

                <div class="row" id="formPermiso">
                    <div class="col-md-4" style="padding-bottom: 35px;">
                        <select class="select2" id="cmbRoles">

                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Lista de accesos:</label>
                        <ul id="listMenus">

                        </ul>

                    </div>
                    <div class="col-md-4">
                        <label>Lista seleccionada</label>
                        <ul id="listSeleccionados">

                        </ul>
                    </div>

                </div>


            </div>
            <div class="modal-footer">

                <span id="msgPermiso" class="msgAlertas" style="float: left; color: red; display: none;">Los campos marcados con rojo son obligatorios</span>
                <button class="btn btn-facebook" onclick="editarPermiso(0, 0, true)" id="btnEditarPermiso" style="display: none;">Guardar</button>
                <button class="btn btn-primary" onclick="nuevoPermiso(true)" id="btnGuardarPermiso">Guardar</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            </div>
        </div>

    </div>
</div>