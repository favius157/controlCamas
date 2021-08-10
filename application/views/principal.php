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
        <div class="row">

            <div class="stats_bar">
                <div data-step="2" data-intro="<strong>Beautiful Elements</strong> <br/> If you are looking for a different UI, this is for you!." class="butpro butstyle">
                    <div class="sub">
                        <h2>CAMAS OCUPADAS</h2>
                        <span id="total_ocupadas">170</span>
                    </div>
                    <div class="stat">
                        <span class="spk1"><canvas width="74" height="15" style="display: inline-block; width: 74px; height: 15px; vertical-align: top;"></canvas>
                        </span>
                    </div>
                </div>
                <div class="butpro butstyle">
                    <div class="sub">
                        <h2>CAMAS LIBRES</h2>
                        <span id="total_libres">$951,611</span>
                    </div>
                    <div class="stat"><span class="up"> 13,5%</span></div>
                </div>
                <div class="butpro butstyle" onclick="cargarInformeElegido('hoy')">
                    <div class="sub">
                        <h2>INTERNACIONES HOY</h2>
                        <span id="internados_hoy">125</span>
                    </div>
                    <div class="stat">
                        <span class="down"> 20,7%</span>
                    </div>
                </div>
                <div class="butpro butstyle" onclick="cargarInformeElegido('criticos')">
                    <div class="sub">
                        <h2>INTERNACIONES > 14 DIAS</h2>
                        <span id="pacientes_criticos">18</span>
                    </div>
                    <div class="stat">
                        <span class="equal"> 0%</span>
                    </div>
                </div>
                <div class="butpro butstyle" onclick="cargarInformeElegido('aislados')">
                    <div class="sub">
                        <h2>CANTIDAD AISLADOS</h2>
                        <span id="total_aislados">3%</span>
                    </div>
                    <div class="stat">
                        <span class="spk2"><canvas width="80" height="15" style="display: inline-block; width: 80px; height: 15px; vertical-align: top;"></canvas></span>
                    </div>
                </div>
                <div class="butpro butstyle" onclick="cargarInformeElegido('riesgosos')">
                    <div class="sub">
                        <h2>INTERNADOS EN UTI</h2>
                        <span id="total_riesgosos">184</span>
                    </div>
                    <div class="stat">
                        <span class="spk3">
                            <canvas width="80" height="15" style="display: inline-block; width: 80px; height: 15px; vertical-align: top;"></canvas>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <DIV class="row" style="padding: 15px 25px 0 25px;">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="block-flat">
                    <div class="header">
                        <h2>Últimos movimientos</h2>
                    </div>
                    <div class="content" id="ultimasNoticias">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="block-flat">
                    <div class="header">
                        <h2 id="txtReporte">Internaciones hoy</h2>
                    </div>
                    <div class="content">
                        <table class="tbl" id="tblInternadosHoy">
                            <thead>

                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <table class="tbl" id="tblPacientesCriticos" style="display: none;">
                            <thead>

                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <table class="tbl" id="tblPacientesAislados" style="display: none;">
                            <thead>

                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <table class="tbl" id="tblPacientesRiesgosos" style="display: none;">
                            <thead>

                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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