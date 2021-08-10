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
                                <h3>Lista de personas</h3>
                            </div>
                            <div class="content">
                                <div class="table-responsive">
                                    <button class="btn btn-default crear">Nueva persona</button>
                                    <button class="btn btn-default modificar">Actualizar persona</button>
                                    <table class="table no-border hover" id="tablaPersona">
                                        <thead class="no-border">
                                            <tr>
                                                <th>Nombre completo</th>
                                                <th>Carné de identidad</th>
                                                <th>Matrícula</th>
                                                <th>Teléfono</th>
                                                <th>Cargo</th>
                                                <th>Establecimiento</th>
                                                <th>Estado</th>

                                                <th><a class="crear" onclick="nuevaPersona(false)" data-toggle ="modal" data-target ="#myModal" style="color: #AE212A; cursor: pointer;"><i class="fa fa-plus-square"> Nuevo</i></a></th>
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

    <?php
    include_once (APPPATH . "views/template/scripts.php");
    ?> 	
    <script type="text/javascript" src="<?= base_url("assets/js/negocio/persona.js") ?>"></script>
</body>
</html>


<div id="modalNuevaPersona" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nueva persona</h4>
            </div>
            <div class="modal-body">

                <div class="row" id="formPersona">
                    <div class="col-md-6">
                        <label>Nombre:</label>
                        <input type="text" name="nPersona" class="form-control" placeholder="Nombre de la persona">
                    </div>
                    <div class="col-md-6">
                        <label>Apellidos:</label>
                        <input type="text" name="aPersona" class="form-control" placeholder="Apellidos paterno y materno">
                    </div>
                    <div class="col-md-6">
                        <label>Carné de identidad:</label>
                        <input type="text" name="ci" class="form-control" placeholder="Ej: 123465sc">
                    </div>
                    <div class="col-md-6">
                        <label>Matrícula:</label>
                        <input type="text" name="matricula" class="form-control" placeholder="Ej: 911007LBF">
                    </div>
                    <div class="col-md-6">
                        <label>Número telefónico:</label>
                        <input type="number" name="telefono" class="form-control" placeholder="Ej: 78456995">
                    </div>
                    <div class="col-md-6">
                        <label>Cargo:</label>
                        <select class="select2" id="cmbCargos">

                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Establecimiento:</label>
                        <select class="select2" id="cmbEstablecimientos">

                        </select>
                    </div>

                </div>


            </div>
            <div class="modal-footer">

                <span id="msgPersonas" class="msgAlertas" style="float: left; color: red; display: none;">Los campos marcados con rojo son obligatorios</span>
                <button class="btn btn-warning" onclick="editarPersona(0, true)" id="btnEditarPersona">Guardar</button>
                <button class="btn btn-primary" onclick="nuevaPersona(true)" id="btnGuardarPersona">Guardar</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            </div>
        </div>

    </div>
</div>

<!-- Modal Confirmar Eliminacion -->
<div id="myModalConfirmacion" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title fa fa-briefcase"style="font-size:15pt; text-align: center;">  ATENCION!</h4>
            </div>   
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle danger"><i class="fa fa-times"></i></div>
                    <h4>Oh god!</h4>
                    <p>Estas seguro que quieres borrar este registro?</p><br>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-flat md-close" data-dismiss="modal">No</button>
                <button id="btnGuardar" onclick="eliminarPersona(0, true)" type="button" class="btn btn-primary btn-flat md-close">Confimar</button>
            </div>

        </div>

    </div>
</div>