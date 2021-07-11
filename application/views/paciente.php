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
                                <h3>Buscar Paciente</h3>
                                <input type="text" name="MatriculaoCi" id="MatriculaoCi">
                                <button onclick="buscarPaciente();">Buscar</button>
                               
                                <input type="text" name="nombres">
                                <input type="text" name="matricula">
                            </div>
                        </div>              
                    </div>
                </div>
             </div> 
        </div>
    </div>    
        <div class="" id="piso-1">
             <div class="row mb-3">
              <div class="col-md-1">.col</div>
              <div class="col">.col</div>
              <div class="col">.col</div>
              <div class="col">.col</div>
              <div class="col">.col</div>
              <div class="col">.col</div>
              <div class="col">.col</div>
              <div class="col">.col</div>
              <div class="col">.col</div>
              <div class="col">.col</div>
            </div>
            <div class="row mb-3">
              <div class="col">.col</div>
              <div class="col">.col</div>
              <div class="col">.col</div>
            </div>
            <div class="row mb-3">
              <div class="col-4">.col-4</div>
              <div class="col-4">.col-4</div>
              <div class="col-4">.col-4</div>
            </div>
        </div>

    <?php
    include_once (APPPATH . "views/template/scripts.php");
    ?>  
    <script type="text/javascript" src="<?= base_url("assets/js/negocio/paciente.js") ?>"></script>
</body>
</html>
