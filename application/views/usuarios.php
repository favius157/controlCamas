<?php
 ?>
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
                                    <table class="table no-border hover" id="tablaUsuario">
                                        <thead class="no-border">
                                            <tr>
                                                <th>Nombre completo</th>
                                                <th>Establecimiento</th>
                                                <th>Rol</th>
                                                <th>Usuario</th>
                                                <th>Estado</th>
                                                <th><a onclick="nuevoUsuario(false)" data-toggle ="modal" data-target ="#myModal" style="color: #AE212A; cursor: pointer;"><i class="fa fa-plus-square"> Nuevo</i></a></th>
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
    <script type="text/javascript" src="<?= base_url("assets/js/negocio/usuario.js") ?>"></script>
</body>
</html>


<div id="modalNuevoUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevo Usuario</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="formUsuario">
                    <div class="col-md-6">
                            <label>Persona:</label>
                            <select class="select2" id="cmbPersonas"></select>
                    </div>
                    <div class="col-md-6">
                        <label>Usuario:</label>
                        <input type="text" name="usuario" class="form-control" placeholder="Usuario de la persona">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Contraseña:</label>
                        <input type="password" name="contraseña" class="form-control" placeholder="">
                    </div>

                    <div class="col-md-6">
                        <label>Repetir Contraseña:</label>
                        <input type="password" name="rContraseña" class="form-control" placeholder="">
                    </div><br>

                    <div class="col-md-6">
                        <label>Rol:</label>
                        <select class="select2" id="cmbRoles"></select>
                    </div>

                </div>


            </div>
            <div class="modal-footer">

                <span id="msgUsuarios" class="msgAlertas" style="float: left; color: red; display: none">Los campos marcados con rojo son obligatorios</span>
                <button class="btn btn-warning" onclick="editarUsuario(0, true)" id="btnEditarUsuario" >Guardar</button>
                <button class="btn btn-primary" onclick="nuevoUsuario(true)" id="btnGuardarUsuario">Guardar</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            </div>
        </div>

    </div>
</div>


<div id="modalEditarRol" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Rol</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="formUsuario">
                    <div class="col-md-6">
                        <label>Usuario:</label>
                        <input type="text" name="editarusuario" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label>Rol:</label>
                        <select class="select2" id="cmbEditarRoles"></select>
                    </div>

                </div>


            </div>
            <div class="modal-footer">

                <span id="msgUsuarios" class="msgAlertas" style="float: left; color: red; display: none">Los campos marcados con rojo son obligatorios</span>
                <button class="btn btn-warning" onclick="editarRol(0, true)" id="btnEditarRol" >Guardar</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            </div>
        </div>

    </div>
</div>

<div id="modalEditarContrasena" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cambiar Contraseña</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="formUsuario">
                    <div class="col-md-6">
                        <label>Usuario:</label>
                        <input type="text" name="editarusuario" class="form-control" disabled>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Contraseña:</label>
                        <input type="password" name="editarcontraseña" class="form-control" placeholder="">
                    </div>

                    <div class="col-md-6">
                        <label>Repetir Contraseña:</label>
                        <input type="password" name="erContraseña" class="form-control" placeholder="">
                    </div><br>
                </div>


            </div>
            <div class="modal-footer">

                <span id="msgUsuariosc" class="msgAlertas" style="float: left; color: red; display: none">Los campos marcados con rojo son obligatorios</span>
                <button class="btn btn-warning" onclick="editarContrasena(0, true)" id="btnEditarContrasena" >Guardar</button>
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
                <button id="btnGuardar" onclick="eliminarUsuario(0, true)" type="button" class="btn btn-primary btn-flat md-close">Confimar</button>
            </div>

        </div>

    </div>
</div>