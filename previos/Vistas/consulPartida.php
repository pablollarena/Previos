<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 12/01/2017
 * Time: 11:29
 */
ini_set("session.cookie_lifetime","7200");
ini_set("session.gc_maxlifetime","7200");
include_once ("../Modelos/Menu.php");
include_once ("../Modelos/Persona.php");
include_once("../Modelos/Sir52Facturas.php");
include_once ("../Modelos/ReportePrevio.php");
include_once ("../");
session_start();
$oMenu = new Menu();
$oPers = new Persona();
$oReporte = new ReportePrevio();
$arrItem = null;
$sErr ="";
$sNom = "";
$nGrp = 0;
$arrMenu = null;
$nick = "";
$nRef = "";
$nBand = false;

if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    $oPers = $_SESSION['sUser'];
    $sNom = $oPers->getNomCompleto();
    $nick = $oPers->getUsuario();
    $nRef = $_POST['txtValRef'];
    $nFactura = $_POST['txtFac'];
    $nRef = $_POST['txtRef'];
    $oReporte->setSir52(new Facturas());
    $oReporte->setSir60(new Sir60Referencias());
    $oReporte->getSir52()->setNumero($_POST['txtFac']);
    $oReporte->getSir60()->setReferencia($_POST['txtRef']);
    $arrItem = $oReporte->consultarInfoItem();
    $nCont = 0;
    $nBand = $oReporte->estadoReferencia();
    if($oPers->getReferen() == 1){
        $arrMenu = $oMenu->generarMenu($oPers->getGrp()->getIdGrp());
    }else if($oPers->getReferen() == 2 or $oPers->getReferen() == 3){
        $arrMenu = $oMenu->generarMenu(($oPers->getGrupo()));
    }else{
        $sErr = "Error en el menú";
    }

}else{
    $sErr = "Faltan datos de Sesión";
}

if($sErr != ""){
    header("Location: ../error.php?sError=".$sErr);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Previos</title>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- iCheck -->
    <!--<script src="../../vendors/iCheck/icheck.min.js"></script>
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <img src="../images/trimex.png" class="img-responsive" />
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_info">
                        <span>Bienvenido</span>
                        <h2><?php echo $sNom;?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br /><br /><br /><br /><br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> Página Principal <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="menuPrincipal.php">Inicio</a></li>
                                </ul>
                            </li>
                        </ul>
                        <?php
                        for($i=0;$i<count($arrMenu);$i++){
                            ?>
                            <ul class="nav side-menu">
                                <li>
                                    <a><i class="<?php echo $arrMenu[$i]['icon'];?>"></i> <?php echo $arrMenu[$i]['titulo']; ?><span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <?php
                                        if(count($arrMenu[$i]['subcategoria'])>0){
                                            for($j=0;$j<count($arrMenu[$i]['subcategoria']);$j++){
                                                ?>
                                                <li><a href="<?php echo $arrMenu[$i]['subcategoria'][$j]['enlace'];?>"><?php echo $arrMenu[$i]['subcategoria'][$j]['titulo'];?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>

                </div>
                <!-- /sidebar menu -->


            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <?php echo $nick;?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="../Controladores/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>ITEMS </h2>

                            <div class="clearfix"></div>

                        </div>
                        <div class="x_content">

                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <div class="x_panel">
                                    <input type="hidden" name="txtRefe" value="">
                                    <div class="x_title">
                                        <h2><i class="fa fa-align-left"></i>Items por Factura </h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <!-- start accordion -->
                                        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                            <?php
                                            if($arrItem)
                                                foreach ($arrItem as $vRow){
                                                    ?>
                                                    <div class="x_content">
                                                        <form id="frmPrevio<?php echo $nCont;?>" action="Galeria.php" method="post">
                                                            <input type="hidden" name="txtRef1" value="<?php echo $nRef;?>">
                                                            <input type="hidden" name="txtFac1" value="<?php echo $nFactura;?>">
                                                            <input type="hidden" name="txtItem" value="<?php echo $vRow->getSir52()->getItem();?>">
                                                            <div class="panel">
                                                                <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $vRow->getSir52()->getItem();?>" aria-expanded="true" aria-controls="collapseOne">
                                                                    <h4 class="panel-title">Número de Item <?php echo $vRow->getSir52()->getItem();?></h4>
                                                                </a>
                                                                <div id="<?php echo $vRow->getSir52()->getItem();?>"  class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                                    <div class="panel-body">
                                                                        <table class="table table-bordered">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Factura</label>
                                                                                        <div class="col-md-6 col-sm-9 col-xs-12">
                                                                                            <input type="text" class="form-control" name ="txtFactura" id="txtFactura" value="<?php echo $vRow->getSir52()->getNumero(); ?>" disabled >
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad : <?php echo $vRow->getCant();?> </label>
                                                                                        <div class="col-md-6 col-sm-9 col-xs-12">
                                                                                            <input type="text" class="form-control" name="txtCantidad" id="txtCantidad" value="<?php echo $vRow->getCant(); ?>" >
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>


                                                                                    <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                        <?php
                                                                                        if ($vRow->getCompleta() == 1){
                                                                                            ?>
                                                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Mercancía: Completa </label>
                                                                                            <?php
                                                                                        }else if($vRow->getFaltante() == 1){
                                                                                            ?>
                                                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Mercancía: Faltante </label>
                                                                                            <?php
                                                                                        }else if($vRow->getSobrante() == 1){
                                                                                            ?>
                                                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Mercancía: Sobrante  </label>
                                                                                            <?php
                                                                                        }
                                                                                        ?>

                                                                                    </div>
                                                                                    <div class="col-md-7 col-sm-9 col-xs-12">
                                                                                        <select class="form-control" name="mercancia" id="mercancia">
                                                                                            <option value="">Seleccione</option>
                                                                                            <option value="1">Completa</option>
                                                                                            <option value="2">Faltante</option>
                                                                                            <option value="3">Sobrante</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <div class="col-md-5 col-sm-9 col-xs-12">
                                                                                            <?php
                                                                                            if($vRow->getPieza() == 1 ){
                                                                                                ?>
                                                                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">Presentación: Pieza</label>
                                                                                                <?php

                                                                                            }else if ($vRow->getJuego() == 1){
                                                                                                ?>
                                                                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">Presentación: Juego</label>
                                                                                                <?php
                                                                                            } else if ($vRow->getOtro() == 1){
                                                                                                ?>
                                                                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">Presentación: Otro</label>
                                                                                                <?php
                                                                                            }
                                                                                            ?>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-9 col-xs-12">
                                                                                            <select class="form-control" name="presentacion" id="presentacion">
                                                                                                <option value="">Seleccione</option>
                                                                                                <option value="1">Pieza</option>
                                                                                                <option value="2">Juego</option>
                                                                                                <option value="3">Otro</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Origen </label>
                                                                                        <div class="col-md-6 col-sm-9 col-xs-12">
                                                                                            <input type="text" class="form-control" name="txtOrigen" id="txtOrigen" value="<?php echo $vRow->getOrigen(); ?>" >
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Peso Aprox.Kg</label>
                                                                                        <div class="col-md-6 col-sm-9 col-xs-12">
                                                                                            <input type="text" class="form-control" name="txtPesoAprox" id="txtPesoAprox" value="<?php echo $vRow->getPesoAprox();?>" >
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="3" rowspan="1">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">Observaciones: <b>Nota: No borrar Observaciones, solo agregar debajo de lo ya escrito. </b></label>
                                                                                        <div class="col-md-10 col-sm-9 col-xs-12">
                                                                                            <textarea class="form-control" rows="8"  name="observaciones">
                                                                                                <?php  echo $vRow->getObservaciones(); ?>
                                                                                            </textarea>

                                                                                        </div>
                                                                                    </div>
                                                                                </td>


                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
                                                                        <script>
                                                                            $(function(){
                                                                                $("#btn_enviar<?php echo $nCont;?>").click(function () {
                                                                                    var url = "../Controladores/actualizarPartidas.php";
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url : url,
                                                                                        data : $("#frmPrevio<?php echo $nCont;?>").serialize(),
                                                                                        success: function(data)
                                                                                        {
                                                                                            $("#respuesta").html(data);
                                                                                        }
                                                                                    });
                                                                                    return true;
                                                                                });
                                                                            });
                                                                        </script>
                                                                        <?php
                                                                        if($nBand == false){
                                                                            ?>
                                                                            <div class="form-group">
                                                                                <div class="col-md-10 col-sm-9 col-xs-12" align="center">
                                                                                    <input type="button" value="Actualizar Partida" class="btn btn-round btn-primary" id="btn_enviar<?php echo $nCont;?>">
                                                                                </div>
                                                                            </div>
                                                                        <?php
                                                                        }

                                                                        ?>
                                                                        <div id="respuesta"></div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <?php
                                                    $nCont = $nCont + 1;
                                                }

                                            ?>

                                        </div>
                                        <!-- end of accordion -->


                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="../../vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- morris.js -->
    <script src="../../vendors/raphael/raphael.min.js"></script>
    <script src="../../vendors/morris.js/morris.min.js"></script>
    <!-- gauge.js -->
    <script src="../../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- Skycons -->
    <script src="../../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../../vendors/Flot/jquery.flot.js"></script>
    <script src="../../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../../vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>

    <!-- Flot -->

    <!-- /Flot -->

    <!-- jQuery Sparklines -->

    <!-- /jQuery Sparklines -->

    <!-- Doughnut Chart -->

    <!-- /Doughnut Chart -->

    <!-- bootstrap-daterangepicker -->

    <!-- /bootstrap-daterangepicker -->

    <!-- morris.js -->

    <!-- /morris.js -->

    <!-- Skycons -->

    <!-- /Skycons -->

    <!-- gauge.js -->

    <!-- /gauge.js -->
</body>
</html>