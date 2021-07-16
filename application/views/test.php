<?php ?>

<!DOCTYPE html>
<html lang="en">
    <style>
        .salas .card{
            height: 150px;
            text-align: center;
            border: 1px solid;
            border-radius: 5px;
            /*margin: 20px 20px;*/
        }

        .salas{
            margin-bottom: 10px;
        }

        .card-body{
            cursor: pointer;

        }
        
        .detalleCama{
            border: 1px solid black;
            width: 10px;
            height: 10px;
        }
        .list-inline span{
            margin-right: 5px;
            margin-left: 5px;
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
            <div class="cl-mcont" style="height: 900px;">
                <div class="row bloques" style="height: 33%;">
                    <div class="col-md-2">
                        <div class="card block-flat">
                            <div class="card-body" id="bloquea">
                                <h1>Bloque A</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-right: 0px">
                        <div class="card block-flat">
                            <div class="card-body" id="bloquec">
                                <h1>Bloque C</h1>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0 0 0 0;">
                        <div class="card block-flat">
                            <div class="">
                                <h1 style="text-align: center;">Ascensor</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-left: 0px">
                        <div class="card block-flat">
                            <div class="card-body" id="bloqueh">
                                <h1>Bloque H</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card block-flat">
                            <div class="card-body" id="bloquef">
                                <h1>Bloque F</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="height: 33%;">
                    <div class="col-md-2" style="">
                        <div class="card block-flat">
                            <div class="">
                                <h1 style="">
                                    Enfermeria
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">

                    </div>
                    <div class="col-md-2" style="">
                        <div class="card block-flat">
                            <div class="">
                                <h1 style="">
                                    Enfermeria
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bloques" style="height: 33%;">
                    <div class="col-md-2">
                        <div class="card block-flat">
                            <div class="card-body" id="bloqueb">
                                <h1>Bloque B</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-right: 0px">
                        <div class="card block-flat">
                            <div class="card-body" id="bloqued">
                                <h1>Bloque D</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 0 0 0 0;">
                        <div class="card block-flat">
                            <div class="">
                                <h1 style="text-align: center;">Ascensor</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-left: 0px">
                        <div class="card block-flat">
                            <div class="card-body" id="bloqueg">
                                <h1>Bloque G</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card block-flat">
                            <div class="card-body" id="bloquee">
                                <h1>Bloque E</h1>
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
