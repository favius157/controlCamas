<?php ?>

<!DOCTYPE html>
<html lang="en">
    <style>

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
                <a class="navbar-brand" href="#"><span><?= NOMBRE_EMPRESA ?></span></a>
            </div>
            <div class="navbar-collapse collapse">

                <ul class="nav navbar-nav navbar-right user-nav">
                    <li class="dropdown profile_menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img alt="Avatar" src="" /><span></span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="Perfil" class="dropdown-toggle" data-toggle="dropdown">Ver Perfil</a></li>
                            <li><a href="<?= base_url("Login/logOut")?>">Cerrar Session</a></li>
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
            <?php
            include_once (APPPATH . "views/template/pisos/$idPiso.php");
            ?>
        </div> 


    </div>

    <?php
    include_once (APPPATH . "views/template/scripts.php");
    ?> 	
    <script type="text/javascript" src="<?= base_url("assets/js/negocio/pisos.js") ?>"></script>
</body>
</html>




<div id="modalCamas" class="modal fade bd-example-modal-sm" role="dialog">
    <div class="modal-dialog" style="width: 60%; height: 500px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h1 class="modal-title" style="text-align: center;">Estado de camas en el bloque <span id="nombreBloque" style="font-weight: 700"></span><span id="nombrePiso"></span></h1>
            </div>
            <div class="modal-body">
                <div id="theBloque"></div>
            </div>

        </div>

    </div>
</div>

<div id="modalAsignarPaciente" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="formAsignar">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Buscar Paciente</h3>
                <H5>La busqueda se realiza por la matricula o el numero de carné del asegurado...</H5>
                <input type="text" name="MatriculaoCi" id="MatriculaoCi" placeholder="Ej: 820505ABC ó 123456789 " style="text-transform:uppercase" required>
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <button onclick="buscarPaciente();">Buscar</button><br>

                    <div class="row" id="formAsignar">
                        <div class="col-md-12">
                            <ul id="listAsegurados">    
                                <left  ><a>Asegurados:</a></left><a style="padding: 0px 250px;">Tipo Asegurado</a>
                            </ul>
                        </div>

                    </div>
                    <div class="modal-body">


                        <div class="col-md-6">
                            <label>Nombre Completo:</label>
                            <input type="text" name="nombres" class="form-control" placeholder="Nombre de la persona" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Matricula:</label>
                            <input type="text" name="matricula" class="form-control" placeholder="" disabled>
                        </div>
                        <div class="col-md-3">
                            <label>Fecha Nacimiento:</label>
                            <input style="text-align: center;font-size: 16px;" type="date" name="fec_nacimiento" class="form-control" placeholder="" disabled>
                        </div>

                        <div class="col-md-6">
                            <br>
                            <label>Empresa:</label>
                            <input type="text" name="empresa" class="form-control" placeholder="" disabled>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <label>Patronal:</label>
                            <input type="text" name="patronal" class="form-control" placeholder="" disabled>
                        </div>

                        <div class="col-md-6">
                            <br>
                            <label>Medico:</label>
                            <input type="text" name="medico" class="form-control" placeholder="" disabled>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <label>Especialidad:</label>
                            <input type="text" name="especialidad" class="form-control" placeholder="" disabled>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <label>CIE 10:</label>
                            <input type="text" name="cie10" class="form-control" placeholder="" disabled>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <label>Diagnóstico ultima atención:</label>
                            <input type="text" name="diagnostico" class="form-control" placeholder="" disabled>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <label>Diagnóstico de Internación:</label>
                            <input type="text" name="diagnosticoEnfermeria" class="form-control" placeholder="" >
                        </div>
                        <div class="col-md-5">
                            <br>
                            <label>Ingreso a: </label>
                            <br>
                            <input class="form-check-input" type="radio" value="1" name="tipoingreso" id="normal" checked>
                            <label class="form-check-label" for="flexRadioDefault1" style="margin-right:  20px;font-size:20px;">
                                Sala Común
                            </label>
                            <input class="form-check-input" type="radio" value="2" name="tipoingreso" id="aislado" >
                            <label class="form-check-label" for="flexRadioDefault2" style="font-size:20px;">
                                Sala Aislado
                            </label> 
                        </div> 
                        <div class="col-md-3">
                            <br>
                            <label>Paciente de: </label>
                            <br>
                            <input  type="checkbox" value="4" name="riesgo" id="riesgo" onchange="javascript:mostrarEquipamiento()">
                            <label  style="font-size:20px;">  Riesgo</label>
                        </div> 
                        <div class="row" id="formRiesgo">
                            <div class="col-md-12" id="listEquipamiento" style="display: none;">
                                <br>
                                    <!--<left  ><a>Asegurados:</a></left><a style="padding: 0px 250px;">Tipo Asegurado</a>-->
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div>
                                          <input class="form-check-input" type="checkbox" value="tuboOxigeno" name="check">
                                        <label class="form-check-label" for="inlineCheckbox1"style="margin-right:  20px;">Tubo de Oxigeno</label> 
                                        <label style="display:inline; ">Libras:</label>
                                        <input style="width :100px; height : 30px;display:inline;" type="number" id="tuboOxigeno"name="librasTubo" class="form-control" placeholder="" >  
                                        </div>
                                        
                                    </li>
                                    <li class="list-group-item">
                                        <div>
                                          <input class="form-check-input" type="checkbox" value="ventilador" name="check">
                                        <label class="form-check-label" for="inlineCheckbox1"style="margin-right:  20px;">Ventilador</label>  
                                        </div>
                                        
                                    </li>
                                        
                                    <li class="list-group-item">
                                        <div>
                                         <input class="form-check-input" type="checkbox" value="monitor" name="check">
                                        <label class="form-check-label" for="inlineCheckbox1"style="margin-right:  20px;">Monitor</label>
                                        </div>
                                        
                                    </li>   
                                </ul>
                                </div> 
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div>
                                         <input class="form-check-input" type="checkbox" value="flujometro" name="check">
                                        <label class="form-check-label" for="inlineCheckbox1"style="margin-right:  30px;">Flujometro</label>
                                        <label style="display:inline; ">Libras:</label>
                                        <input style="width :100px; height : 30px;display:inline;" type="number" id="flujometro" name="librasFlujometro" class="form-control" placeholder="" > 
                                        </div>
                                        
                                    </li>
                                    <li class="list-group-item">
                                        <div>
                                        <input class="form-check-input" type="checkbox" value="aspirador" name="check">
                                        <label class="form-check-label" for="inlineCheckbox1"style="margin-right:  20px;">Aspirador</label>  
                                        </div>
                                        
                                    </li>
                                        
                                    <li class="list-group-item">
                                        <div>
                                         <input class="form-check-input" type="checkbox" value="ambu" name="check">
                                        <label class="form-check-label" for="inlineCheckbox1"style="margin-right:  20px;">Ambu</label>
                                        </div>
                                        
                                    </li>   
                                </ul>
                                </div>    
                                
                            </div>

                        </div>
                        <input type="hidden" name="id_historial" class="form-control">
                        <input type="hidden" name="sexo" class="form-control">
                        <input type="hidden" name="codcns" class="form-control">
                        <input type="hidden" name="edad" class="form-control">
                        <input type="hidden" name="cie10Literal" class="form-control">

                    </div>


            </div>
            <div class="modal-footer">

                <span id="msgAsignar" class="msgAlertas" style="float: left; color: red; display: none;font-weight: bold;">Por favor ingrese una matrícula o carné para realizar la búsqueda, gracias!....</span>
                <button class="btn btn-success" onclick="asignarPaciente(0, true)" id="btnGuardarPersona">Asignar</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            </div>
        </div>

    </div>
</div>

<!-- r -->
<div id="modalPacienteByCama" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header modal-notify modal-info" id="formVerPaciente">

                <h3 style="font-size: 20px; font-weight: bold; color: white;">INFORMACION DEL PACIENTE</h3>
            </div>
            <div class="modal-body">

                <div class="row" id="formVerPaciente">
                    <div class="col-md-6">
                        <label>Nombre Completo:</label>
                        <input type="text" name="nombres" class="form-control" placeholder="Nombre de la persona" disabled>
                    </div>
                    <div class="col-md-6">
                        <label>Matricula:</label>
                        <input type="text" name="matricula" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <label>CIE 10:</label>
                        <input type="text" name="cie10" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <label>Diagnóstico:</label>
                        <input type="text" name="diagnostico" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <label>Medico:</label>

                        <input type="text" name="medico" class="form-control" placeholder="" disabled>

                    </div>
                    <div class="col-md-6">
                        <br>
                        <label>Especialidad:</label>
                        <input type="text" name="especialidad" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="col-md-5">
                        <br>
                        <label>Fecha Internación:</label>
                        <input type="text" id="fecha" class="form-control" value="" style="float: left; color: red;font-size: 20px; font-weight: bold;" disabled>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <label>Sexo:</label>
                        <input type="text" id="sexo" class="form-control" value=""  disabled>
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>Edad:</label>
                        <input type="number" id="edad" class="form-control" value=""  disabled>
                    </div><br>
                    <div class="col-md-6">
                        <br>
                        <label>Registrado Por:</label>
                        <div class="input-group margin-bottom-sm">
                            <span class="input-group-addon" style="background-color:lightblue;"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
                            <input class="form-control" id="usuario" type="text" disabled>
                        </div>
                    </div>



                </div>
            </div>

            <div class="modal-footer">

                <span id="msgAsignar" class="msgAlertas" style="float: left; color: red; display: none;font-weight: bold;">Por favor ingrese una matrícula o carné para realizar la búsqueda, gracias!....</span>
                <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>

            </div>
        </div>

    </div>
</div>


<div id="modalAltaPaciente" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 30%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header modal-notify modal-info">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title fa fa-medkit" aria-hidden="true" style="font-size: 20px; font-weight: bold; color: white;">  ATENCION!</h4>
            </div>   
            <div class="modal-body">
                <div class="text-center">
                    <h4>Seguro de dar de alta?</h4>
                    <p style="font-size:15pt;">Selecciona el motivo del alta</p><br>
                    <select class="select2" id="cmbAlta">

                    </select>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-flat md-close" data-dismiss="modal">No</button>
                <button id="btnGuardar" onclick="liberarCama(0, true)" type="button" class="btn btn-success btn-flat md-close">Confimar</button>
            </div>

        </div>

    </div>
</div>

<div id="modalTransferirPaciente" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header modal-notify modal-info" id="formVerPaciente">

                <h3 style="font-size: 30px; font-weight: bold; color: white;">TRANSFERENCIA DE PACIENTE</h3>
            </div>
            <div class="modal-body">

                    <div class="col-md-6">
                        <label>Nombre Completo:</label>
                        <input type="text" name="nombres" class="form-control" placeholder="Nombre de la persona" disabled>
                    </div>
                    <div class="col-md-6">
                        <label>Diagnóstico:</label>
                        <input type="text" name="diagnostico" class="form-control" placeholder="" disabled>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <label>Medico:</label>
                        <input type="text" name="medico" class="form-control" placeholder="">
                    </div>
                    <div class="col-md-6">
                        <br>
                        <label>Especialidad:</label>
                        <input type="text" name="especialidad" class="form-control" placeholder="">
                    </div>

                    <div class="col-md-6">
                        <br>
                        <label>Diagnóstico de Transferencia:</label>
                        <input type="text" name="diagnosticoEnfermeria" class="form-control" placeholder="">
                    </div>
                                       
                    <div class="col-md-2">
                        <br>
                        <label>PISO: </label>
                        <select class="select2" id="pisos">
                            <option value="0">Seleccione.....</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <br>
                        <label>CAMA: </label>
                        <select class="select2" id="camas">
                            <option value="0">Seleccione.....</option>
                        </select>
                    </div>
                     <div class="col-md-4">
                        <br>
                        <label>Ingreso a Sala: </label>
                        <br>
                        <input class="form-check-input" type="radio" value="1" name="tipoingreso" id="normal" >
                        <label class="form-check-label" for="flexRadioDefault1" style="margin-right:  30px;font-size:20px;">
                            Común
                        </label>
                        <input class="form-check-input" type="radio" value="2" name="tipoingreso" id="aislado" >
                        <label class="form-check-label" for="flexRadioDefault2" style="font-size:20px;">
                            Aislada
                        </label> 
                    </div>
                    <div class="col-md-3">
                            <br>
                            <label>Paciente de: </label>
                            <br>
                            <input  type="checkbox" value="4" name="riesgo" id="riesgo" onchange="javascript:mostrarEquipamiento()">
                            <label  style="font-size:20px;">  Riesgo</label>
                        </div> 
                        <div class="row" id="formRiesgo">
                            <div class="col-md-12" id="listEquipamiento" style="display: none;">dsfsdsdf
                                <br>
                                    <!--<left  ><a>Asegurados:</a></left><a style="padding: 0px 250px;">Tipo Asegurado</a>-->
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div>
                                          <input class="form-check-input" type="checkbox" value="tuboOxigeno" name="check">
                                        <label class="form-check-label" for="inlineCheckbox1"style="margin-right:  20px;">Tubo de Oxigeno</label> 
                                        <label style="display:inline; ">Libras:</label>
                                        <input style="width :100px; height : 30px;display:inline;" type="number" id="tuboOxigeno"name="librasTubo" class="form-control" placeholder="" >  
                                        </div>
                                        
                                    </li>
                                    <li class="list-group-item">
                                        <div>
                                          <input class="form-check-input" type="checkbox" value="ventilador" name="check">
                                        <label class="form-check-label" for="inlineCheckbox1"style="margin-right:  20px;">Ventilador</label>  
                                        </div>
                                        
                                    </li>
                                        
                                    <li class="list-group-item">
                                        <div>
                                         <input class="form-check-input" type="checkbox" value="monitor" name="check">
                                        <label class="form-check-label" for="inlineCheckbox1"style="margin-right:  20px;">Monitor</label>
                                        </div>
                                        
                                    </li>   
                                </ul>
                                </div> 
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div>
                                         <input class="form-check-input" type="checkbox" value="flujometro" name="check">
                                        <label class="form-check-label" for="inlineCheckbox1"style="margin-right:  30px;">Flujometro</label>
                                        <label style="display:inline; ">Libras:</label>
                                        <input style="width :100px; height : 30px;display:inline;" type="number" id="flujometro" name="librasFlujometro" class="form-control" placeholder="" > 
                                        </div>
                                        
                                    </li>
                                    <li class="list-group-item">
                                        <div>
                                        <input class="form-check-input" type="checkbox" value="aspirador" name="check">
                                        <label class="form-check-label" for="inlineCheckbox1"style="margin-right:  20px;">Aspirador</label>  
                                        </div>
                                        
                                    </li>
                                        
                                    <li class="list-group-item">
                                        <div>
                                         <input class="form-check-input" type="checkbox" value="ambu" name="check">
                                        <label class="form-check-label" for="inlineCheckbox1"style="margin-right:  20px;">Ambu</label>
                                        </div>
                                        
                                    </li>   
                                </ul>
                                </div>    
                                
                            </div>

                        </div>
                    <input type="hidden" name="matricula" class="form-control">
                    <input type="hidden" name="codcns" class="form-control">
                    <input type="hidden" name="fecnacimiento" class="form-control">
                    <input type="hidden" name="cie10" class="form-control">
                    <input type="hidden" name="cie10Literal" class="form-control">
                    <input type="hidden" name="empresa" class="form-control">
                    <input type="hidden" name="patronal" class="form-control">
                    <input type="hidden" name="idhistorial" class="form-control">
                    <input type="hidden" name="sexo" class="form-control">
                    <input type="hidden" name="edad" class="form-control">
            </div>

            <div class="modal-footer">

                <span id="msgAsignar" class="msgAlertas" style="float: left; color: red; display: none;font-weight: bold;">Por favor ingrese una matrícula o carné para realizar la búsqueda, gracias!....</span>
                <button class="btn btn-warning" onclick="transferirPaciente(0, true)" id="btnGuardarPersona">Transferir</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            </div>
        </div>

    </div>
</div>



