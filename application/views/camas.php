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
                        <ul class="cl-vnavigation">
                            <?php
                            include_once (APPPATH . "views/template/menuprincipal.php");
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
                                <h3>Gestion de camas</h3>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: green; color: white; font-weight: 600;">
                                                Lista de pisos
                                                <!--<span class="badge badge-primary badge-pill" style="cursor: pointer; background-color: white !important; color: green;"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Agregar un nuevo piso"></i></span>-->
                                            </li>
                                            <div id="listaPisos">
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
                                        <table class="table table-bordered" id="tablaCamas">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Bloque</th>
                                                    <th scope="col">Piso</th>
                                                    <th scope="col">Número de cama</th>
                                                    <th scope="col">Sector</th>
                                                    <th scope="col">Estado de la cama</th>
                                                    <th scope="col">
                                                        <a onclick="nuevaCama(false)" style="color: #AE212A; cursor: pointer; border-right: 1px solid; padding-right: 5px;"><i class="fa fa-plus-square"> Nueva cama</i></a> <a onclick="nuevoBloque(false)" style="color: #AE212A; cursor: pointer;"><i class="fa fa-plus-square"> Nuevo bloque</i></a> 
                                                    </th>
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
                </div>
            </div>
        </div> 


    </div>

    <?php
    include_once (APPPATH . "views/template/scripts.php");
    ?> 	
    <script type="text/javascript" src="<?= base_url("assets/js/negocio/camas.js") ?>"></script>
</body>
</html>


<div id="modalCamas" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="task"></span> Cama</h4>
            </div>
            <div class="modal-body">

                <div class="row" id="formCama">
                    <div class="col-md-6">
                        <label>Nombre de rol:</label>
                        <input type="number" name="nCama" class="form-control" placeholder="Número de cama">
                    </div>
                    <div class="col-md-6">
                        <label>Piso:</label>
                        <select class="select2" id="cmbPisos">

                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Bloque:</label>
                        <select class="select2" id="cmbBloques">

                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Sector:</label>
                        <select class="form-control" id="cmbSector">
                            <option value="0" selected>Seleccione el sector</option>
                            <option value="1">Varones</option>
                            <option value="2">Mujeres</option>
                        </select>
                    </div>

                </div>


            </div>
            <div class="modal-footer">

                <span id="msgCama" class="msgAlertas" style="float: left; color: red; display: none;">Los campos marcados con rojo son obligatorios</span>
                <button class="btn btn-facebook" onclick="editarCama(0, true)" id="btnEditarCama" style="display: none;">Guardar</button>
                <button class="btn btn-primary" onclick="nuevaCama(true)" id="btnGuardarCama">Guardar</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            </div>
        </div>

    </div>
</div>

<div id="modalBloque" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 30%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="task"></span> bloque</h4>
            </div>
            <div class="modal-body">

                <div class="row" id="formCama">
                    <div class="col-md-6">
                        <label>Nombre de rol:</label>
                        <input type="text" name="nBloque" class="form-control" placeholder="Nombre del bloque">
                    </div>

                </div>


            </div>
            <div class="modal-footer">

                <span id="msgBloque" class="msgAlertas" style="float: left; color: red; display: none;">Los campos marcados con rojo son obligatorios</span>
                <button class="btn btn-facebook" onclick="editarBloque(0, true)" id="btnEditarBloque" style="display: none;">Guardar</button>
                <button class="btn btn-primary" onclick="nuevoBloque(true)" id="btnGuardarBloque">Guardar</button>
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
