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

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>0</h3>

                <p>Equipos Recibidos</p>
              </div>
              <div class="icon">
                 <i class="fas fa-laptop"></i>
              </div>
              <a href="<?=base_url()?>" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php 
                if(isset($count_fichas_day)){
                  echo $count_fichas_day;
                }else{
                  echo "0";
                }

                ?></h3>

                <p>Equipos Devueltos</p>
              </div>
              <div class="icon">
               <i class="fas fa-truck-loading"></i>
              </div>
              <a href="<?=base_url()?>" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php 
                if(isset($count_medicos)){
                  echo $count_medicos;
                }else{
                  echo "0";
                }

                ?></h3>

                <p>Equipo en Reparación</p>
              </div>
              <div class="icon">
                <i class="fas fa-laptop-medical"></i>
              </div>
              <a href="<?=base_url('')?>" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php 
                if(isset($count_users)){
                  echo $count_users;
                }else{
                  echo "0";
                }

                ?></h3>

                <p>Equipos Falla</p>
              </div>
              <div class="icon">
                <i class="fas fa-backspace"></i>
              </div>
              <a href="<?=base_url('')?>" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

    </div>

   <?php 
    	include_once (APPPATH . "views/template/scripts.php");
   ?> 	
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