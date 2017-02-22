<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 25/01/2017
 * Time: 05:21 PM
 */
include_once ("../Modelos/Menu.php");
include_once ("../Modelos/Persona.php");
include_once ("../Modelos/Sir76Contenedores.php");
require_once ("../Modelos/Observaciones.php");
session_start();
$oMenu = new Menu();
$oPers = new Persona();
$oContededor= new Sir76Contenedores();
$oObservacion = new Observaciones();
$arrObservacion = null;
$sErr ="";
$sNom = "";
$nGrp = 0;
$arrMenu = null;
$arrRef = null;
$arrConte =null;
$nick = "";
$sRef = "";
$sCliente = "";
$dFecha = null;
$sRecinto = "";
$bBandera = false;
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    $oPers = $_SESSION['sUser'];
    $sNom = $oPers->getNomCompleto();
    $nick = $oPers->getUsuario();
    $sRef = $_POST['txtRef'];
    $sCliente = $_POST['txtCliente'];
    $dFecha = $_POST['txtFecha'];
    $sRecinto = $_POST['txtRecinto'];
    $oObservacion->setSir60(new Sir60Referencias());
    $oObservacion->getSir60()->setReferencia($_POST['txtRef']);

    if($oObservacion->validaReferencia() == true){
        $bBandera = true;
        $arrObservacion = $oObservacion->buscarTodosObser();
        $oContededor->setReferencia60(new Sir60Referencias());
        $oContededor->getReferencia60()->setReferencia($sRef);
        $arrConte = $oContededor->buscarContenedoresPorRef();
    }else{
        $arrConte = null;
        $arrObservacion = null;
    }

    $nCon = 0;
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

    <title>PREVIOS - Consultar Previos Asignados</title>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
                <div class="page-title">
                    <div class="title_left">
                        <h3>Información General</h3>
                    </div>
                </div>


            <div class="clearfix"></div>

            <div class="">
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <form id="frmDatos" action="../Vistas/consultarItems.php" method="post">
                            <input type="hidden" value="<?php echo $sRef;?>" name="txtValRef">
                            <div class="row">
                                <div class="x_content">
                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <div class="form-group">
                                            <label class="control-label col-md-1 col-sm-1 col-xs-1" for="txtNombre">Cliente</span>
                                            </label>
                                            <div class="col-md-5 col-sm-6 col-xs-12">
                                                <input type="text" id="txtNombre" name="txtNombre" required="required" class="form-control col-md-7 col-xs-12"
                                                       value="<?php echo $sCliente; ?>" disabled>
                                            </div>
                                            <label class="control-label col-md-1 col-sm-1 col-xs-3" for="txtNombre">Fecha</span>
                                            </label>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <input type="text" id="txtNombre" name="txtNombre" required="required" class="form-control col-md-7 col-xs-12"
                                                       value="<?php echo $dFecha; ?>" disabled>
                                            </div>
                                        </div>
                                        <br/><br/><br/>
                                        <div class="form-group">
                                            <label class="control-label col-md-1 col-sm-1 col-xs-1" for="txtNombre">Referencia</span>
                                            </label>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <input type="text" id="txtNombre" name="txtNombre" required="required" class="form-control col-md-7 col-xs-12"
                                                       value="<?php echo $sRef;?>" disabled>
                                            </div>
                                            <label class="control-label col-md-1 col-sm-1 col-xs-3" for="txtNombre">Recinto</span>
                                            </label>
                                            <div class="col-md-5 col-sm-6 col-xs-12">
                                                <input type="text" id="txtNombre" name="txtNombre" required="required" class="form-control col-md-7 col-xs-12"
                                                       value="<?php echo $sRecinto;?>" disabled>
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <input type="submit" id="txtNombre" name="txtNombre" class="btn btn-success btn-lg"
                                                       value="Ver Items">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Observaciones de la Referencia</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <form id="frmDatos" action="../Vistas/consultarItems.php" method="post">
                            <input type="hidden" value="<?php echo $sRef;?>" name="txtValRef">
                            <div class="row">
                                <div class="x_content">
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Observación</th>
                                            <th>Realizada por:</th>
                                            <th>Fecha de registro</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($arrObservacion != null){
                                            foreach ($arrObservacion as $item) {
                                                ?>
                                                <tr>
                                                    <td width="60%"><?php echo $item->getObservacion();?></td>
                                                    <td width="20%"><?php echo $item->getUsuario();?></td>
                                                    <td width="20%"><?php echo $item->getFecha();?></td>
                                                </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td rowspan="2" colspan="3">No se han registrado observaciones para esta referencia</td>

                                            </tr>
                                            <?php
                                        }
                                        ?>

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Información de la Carga</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            <div class="x_content">
                                <?php
                                    if($bBandera == true){
                                        ?>
                                        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                            <?php
                                            $bHab = false;
                                            if($arrConte != null){
                                                foreach ($arrConte as $vRow){
                                                    $bHab = $oContededor->validaContenedor($sRef, $vRow->getNumero());

                                                    ?>
                                                    <div class="x_content">
                                                        <form name="frmContent<?php echo $nCon;?>" id="frmContent<?php echo $nCon;?>">
                                                            <input type="hidden" name="txtRef" value="<?php echo $sRef;?>"/>
                                                            <input type="hidden" name="operacion" value="content"/>
                                                            <input type="hidden" name="txtNumConten" value="<?php echo $vRow->getNumero();?>"/>
                                                            <div class="panel">
                                                                <a class="panel-heading" role="tab" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $vRow->getNumero();?>" aria-expanded="false" aria-controls="<?php echo $vRow->getNumero();?>">
                                                                    <h5 class="panel-title">CONTENEDOR <?php echo $vRow->getNumero();?></h5>  <h5 class=""> NUM-BL: <?php echo ($vRow->getSir74()->getNumeroBL()== "" ? "NO TIENE BL" : $vRow->getSir74()->getNumeroBL()) ; ?></h5>

                                                                </a>
                                                                <div id="<?php echo $vRow->getNumero();?>" class="panel-collapse collapse in" role="tabpanel">
                                                                    <div class="panel-body">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-1 col-sm-1 col-xs-1" >Peso</span>
                                                                            </label>
                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                <input type="text" id="txtPeso" name="txtPeso" required="required" class="form-control col-md-7 col-xs-12"
                                                                                       value="<?php echo $vRow->getPeso(); ?>" disabled>
                                                                            </div>
                                                                            <label class="control-label col-md-1 col-sm-1 col-xs-3" >Sellos</span>
                                                                            </label>
                                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                                <input type="text" id="txtSellos" name="txtSellos" required="required" class="form-control col-md-7 col-xs-12"
                                                                                       value="<?php echo $vRow->getSir107()->getSellos(); ?>" disabled>
                                                                            </div>
                                                                            <label class="control-label col-md-1 col-sm-4 col-xs-12">IMO</label>
                                                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                                                <select class="form-control required" name="imo">
                                                                                    <option value="">Seleccione</option>
                                                                                    <option value="1">SI</option>
                                                                                    <option value="0">NO</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <br/>
                                                                        <br/>
                                                                        <br/>
                                                                        <table class="table table-striped table-bordered dt-responsive nowrap">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>Tamaño</th>
                                                                                <th>Tipo</th>
                                                                                <th>Sello Colocado</th>
                                                                                <th>Peso de Carga S/Contenerizar</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Seleccione el Tamaño</label>
                                                                                        <div class="col-md-7 col-sm-9 col-xs-12">
                                                                                            <select class="form-control" name="tamaño" >
                                                                                                <option value="">Seleccione</option>
                                                                                                <option value="40">40'</option>
                                                                                                <option value="20">20'</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Seleccione el Tipo</label>
                                                                                        <div class="col-md-7 col-sm-9 col-xs-12">
                                                                                            <select class="form-control" name="tipo">
                                                                                                <option value="">Seleccione</option>
                                                                                                <option value="DC">DC</option>
                                                                                                <option value="HC">HC</option>
                                                                                                <option value="OT">OT</option>
                                                                                                <option value="FR">FR</option>
                                                                                                <option value="RF">RF</option>
                                                                                                <option value="TK">TK</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3 col-sm-2 col-xs-3" for="txtSelloColocado">Sellos</span>
                                                                                        </label>
                                                                                        <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                            <input type="text" id="txtSelloColocado" name="txtSelloColocado" required="required" class="form-control col-md-7 col-xs-12"
                                                                                            >
                                                                                        </div>

                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3 col-sm-2 col-xs-3">Peso</span>
                                                                                        </label>
                                                                                        <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                            <input type="text" id="txtPeso1" name="txtPeso1" required="required" class="form-control col-md-7 col-xs-12"
                                                                                            >
                                                                                        </div>

                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td colspan="4" rowspan="1">
                                                                                    <h5 align="center"> Daños</h5>
                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="4" rowspan="1">
                                                                                    <div class="form-group">

                                                                                        <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="daños[]" id="daños1" value="Origen"> Origen
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="daños[]" id="daños2" value="Recinto"> Recinto
                                                                                                </label>
                                                                                            </div>


                                                                                        </div>
                                                                                        <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="daños[]" id="daños3" value="Frente"> Frente
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="daños[]" id="daños4" value="PanelIzq"> Panel Izq.
                                                                                                </label>
                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="daños[]" id="daños5" value="Piso"> Piso
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="daños[]" id="daños6" value="Techo"> Techo
                                                                                                </label>
                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="daños[]" id="daños7" value="PanelDer"> Panel Der.
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="daños[]" id="daños8" value="Puertas"> Puertas
                                                                                                </label>
                                                                                            </div>


                                                                                        </div>
                                                                                        <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="daños[]" id="daños9" value="BarrasPuerta"> Barras Puerta
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="daños[]" id="daños10" value="Seguros"> Seguros
                                                                                                </label>
                                                                                            </div>


                                                                                        </div>
                                                                                        <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="daños[]" id="daños11" value="Abrazaderas"> Abrazaderas
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="daños[]" id="daños12" value="LonaBarra"> Lona/Barra
                                                                                                </label>
                                                                                            </div>


                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="col-md-12 col-sm-9 col-xs-12">
                                                                                            <textarea class="resizable_textarea form-control" name="txtOtros" id="txtOtros" placeholder="Otros"></textarea>
                                                                                        </div>
                                                                                    </div>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="4" rowspan="1">
                                                                                    <h5 align="center"> Bultos</h5>
                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                            <thead>
                                                                            <tr>
                                                                                <th colspan="1">Cantidad de Bultos</th>
                                                                                <th colspan="3">Bultos Dañados y Cuantos</th>

                                                                            </tr>
                                                                            </thead>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="1" rowspan="1">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3 col-sm-2 col-xs-3" for="txtCantiBultos">Cantidad</span>
                                                                                        </label>
                                                                                        <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                            <input type="text" id="txtCantiBultos" name="txtCantiBultos" required="required" class="form-control col-md-7 col-xs-12"
                                                                                            >
                                                                                        </div>

                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="3" rowspan="1">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-2 col-sm-4 col-xs-12">Bultos dañados</label>
                                                                                        <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                            <select class="form-control" name="bDañados" id="bDañados<?php echo $nCon;?>">
                                                                                                <option value="">Seleccione</option>
                                                                                                <option value="1">SI</option>
                                                                                                <option value="0">NO</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="txtCantiDañados">Cantidad</span>
                                                                                        </label>
                                                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                            <input type="text" id="txtCantiDañados<?php echo $nCon;?>" name="txtCantiDañados" required="required" class="form-control col-md-7 col-xs-12"
                                                                                            >
                                                                                        </div>
                                                                                    </div>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="4" rowspan="1">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3 col-sm-2 col-xs-3" for="txtNombre">Presentación de los Bultos</span>
                                                                                        </label>

                                                                                    </div>
                                                                                    <br/><br/>
                                                                                    <div class="form-group">

                                                                                        <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="bultosPresen[]" id="PalletsMadera" value="PalletsMadera"> Pallets de Madera
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="bultosPresen[]" id="PalletsPlastico" value="PalletsPlastico"> Pallets de Plástico
                                                                                                </label>
                                                                                            </div>


                                                                                        </div>
                                                                                        <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="bultosPresen[]" id="Cartonada" value="Cartonada"> Cartonada
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="bultosPresen[]" id="Cuñetes" value="Cuñetes"> Cuñetes
                                                                                                </label>
                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="bultosPresen[]" id="Sacos" value="Sacos"> Sacos
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="bultosPresen[]" id="SuperBolsas" value="SuperBolsas"> Superbolsas
                                                                                                </label>
                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="bultosPresen[]" id="Bidones" value="Bidones"> Bidones
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="bultosPresen[]" id="Cont1000L" value="Cont1000L"> Cont.1000L
                                                                                                </label>
                                                                                            </div>


                                                                                        </div>
                                                                                        <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="bultosPresen[]" id="HuacalesMadera" value="HuacalesMadera"> Huacales de Madera
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="bultosPresen[]" id="CajasMadera" value="CajasMadera"> Cajas de Madera
                                                                                                </label>
                                                                                            </div>


                                                                                        </div>
                                                                                        <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="bultosPresen[]" id="RacksMetalicos" value="RacksMetalicos"> Racks Metalicos
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="bultosPresen[]" id="Granel" value="Granel"> Granel
                                                                                                </label>
                                                                                            </div>


                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="col-md-12 col-sm-9 col-xs-12">
                                                                                            <textarea class="resizable_textarea form-control" placeholder="Otros (Especifique)" name="txtOtrosPresen" id="txtOtrosPresen"></textarea>
                                                                                        </div>
                                                                                    </div>

                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <thead>
                                                                                <tr>
                                                                                    <th colspan="2">Averias</th>
                                                                                    <th colspan="2">Fumigado</th>

                                                                                </tr>
                                                                                </thead>
                                                                            </tr>
                                                                            <tr>

                                                                                <td colspan="2" rowspan="1">
                                                                                    <div class="form-group">
                                                                                        <div class="col-md-4 col-sm-3 col-xs-12">
                                                                                            <p>
                                                                                                Origen:
                                                                                                <input type="radio" class="flat" name="averias" id="averias" value="1"/> <br/>
                                                                                                Recinto:
                                                                                                <input type="radio" class="flat" name="averias" id="averias" value="0"/>
                                                                                            </p>
                                                                                        </div>

                                                                                    </div>

                                                                                </td>
                                                                                <td colspan="2" rowspan="1">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3 col-sm-4 col-xs-12">Fumigado</label>
                                                                                        <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                            <select class="form-control" name="txtFumigado">
                                                                                                <option value="">Seleccione</option>
                                                                                                <option value="si">SI</option>
                                                                                                <option value="no">NO</option>
                                                                                            </select>
                                                                                        </div>

                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <thead>
                                                                                <tr>
                                                                                    <th colspan="2">Mercancia</th>
                                                                                    <th colspan="2">Previo</th>

                                                                                </tr>
                                                                                </thead>
                                                                            </tr>
                                                                            <tr>

                                                                                <td colspan="2" rowspan="1">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Mercancía</label>
                                                                                        <div class="col-md-7 col-sm-9 col-xs-12">
                                                                                            <select class="form-control" name="mercancia" id="mercancia<?php echo $nCon;?>">
                                                                                                <option value="1">Conforme a Factura</option>
                                                                                                <option value="2">Faltante</option>
                                                                                                <option value="3">Sobrante</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br/><br/>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtCanMer1">Cantidad</span>
                                                                                        </label>
                                                                                        <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                            <input type="text" id="txtCanMer1<?php echo $nCon;?>" name="txtCanMer1"  class="form-control col-md-7 col-xs-12" />
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2" rowspan="1">
                                                                                    <div class="form-group">

                                                                                        <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="Previos[]" id="DesYCon" value="DesYCon"> DesYCon
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="Previos[]" id="Separacion" value="Separacion"> Separación
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="Previos[]" id="Ocular" value="Ocular"> Ocular
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="Previos[]" id="RevisiónC/Autoridad" value="RevisionC/Autoridad"> Revisión C/Autoridad
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input type="checkbox" class="flat" name="Previos[]" id="Etiquetado" value="Etiquetado"> Etiquetado
                                                                                                </label>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <!--Función para enviar los formularios de cada contenedor al controlador-->
                                                                        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
                                                                        <script>
                                                                            $(function(){
                                                                                $("#btn_enviar<?php echo $nCon;?>").click(function () {
                                                                                    var url = "../Controladores/controlPrevios.php";
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url : url,
                                                                                        data : $("#frmContent<?php echo $nCon;?>").serialize(),
                                                                                        success: function(data)
                                                                                        {
                                                                                            $("#respuesta").html(data);
                                                                                        }
                                                                                    });
                                                                                    return true;
                                                                                });
                                                                            });
                                                                        </script>
                                                                        <!-- Validación de formularios -->
                                                                        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>

                                                                        <script type="text/javascript">
                                                                            function validarFormulario(){
                                                                                JQuery.validator.messages.required = 'Campo requerido';
                                                                                $("#btn_enviar<?php echo $nCon;?>").click(function(){
                                                                                    var valida = $("#frmContent<?php echo $nCon;?>").valid();
                                                                                    if(valida){
                                                                                        alert('El formulario es correcto');
                                                                                    }
                                                                                });
                                                                            }
                                                                        </script>
                                                                        <!-- Validación de formularios -->
                                                                        <!-- Validar select's seleccionados -->
                                                                        <script>
                                                                            $(document).ready(function () {
                                                                                $("#txtCanMer1<?php echo $nCon;?>").attr({
                                                                                    disabled : true
                                                                                });
                                                                                $("#mercancia<?php echo $nCon;?>").change(function () {
                                                                                    if($("#mercancia<?php echo $nCon;?>").val() == '2' || $("#mercancia<?php echo $nCon;?>").val() == '3'){
                                                                                        $("#txtCanMer1<?php echo $nCon;?>").attr({
                                                                                            disabled : false
                                                                                        });
                                                                                    }else if($("#mercancia<?php echo $nCon;?>").val() == '1'){
                                                                                        $("#txtCanMer1<?php echo $nCon;?>").attr({
                                                                                            disabled : true
                                                                                        });
                                                                                    }
                                                                                });
                                                                            })
                                                                        </script>
                                                                        <!-- Validar select's de mercancia seleccionados -->
                                                                        <!-- Validar select's de bultos dañados seleccionados -->
                                                                        <script>
                                                                            $(document).ready(function () {
                                                                                $("#txtCantiDañados<?php echo $nCon;?>").attr({
                                                                                    disabled : true
                                                                                });
                                                                                $("#bDañados<?php echo $nCon;?>").change(function () {
                                                                                    if($("#bDañados<?php echo $nCon;?>").val() == '1'){
                                                                                        $("#txtCantiDañados<?php echo $nCon;?>").attr({
                                                                                            disabled : false
                                                                                        });
                                                                                    }else if($("#bDañados<?php echo $nCon;?>").val() == '0'){
                                                                                        $("#txtCantiDañados<?php echo $nCon;?>").attr({
                                                                                            disabled : true
                                                                                        });
                                                                                    }else{
                                                                                        $("#txtCantiDañados<?php echo $nCon;?>").attr({
                                                                                            disabled : true
                                                                                        });
                                                                                    }
                                                                                });
                                                                            })
                                                                        </script>
                                                                        <!-- Validar radios seleccionados -->

                                                                        <div align="center">
                                                                            <?php
                                                                            if($bHab == false){
                                                                                ?>
                                                                                <input type="button" value="Guardar" class="btn btn-round btn-primary" id="btn_enviar<?php echo $nCon;?>" />
                                                                                <?php
                                                                            }
                                                                            ?>

                                                                        </div>
                                                                        <div id="respuesta"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <?php
                                                    $nCon = $nCon + 1;
                                                }
                                            }else{
                                                $cHab = false;
                                                $cHab = $oContededor->validaCarga($sRef);
                                                ?>
                                                <div class="x_content">
                                                    <form id="cargaSuelta">
                                                        <input type="hidden" name="txtRef" value="<?php echo $sRef;?>"/>
                                                        <input type="hidden" name="operacion" value="CargaSuelta" />
                                                        <div class="panel-body">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-1 col-sm-1 col-xs-3" >Sello de Origen</span>
                                                                </label>
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <input type="text" id="txtSellos" name="txtSellos" required="required" class="form-control col-md-7 col-xs-12" />
                                                                </div>
                                                                <label class="control-label col-md-1 col-sm-1 col-xs-3" >No. BL</span>
                                                                </label>
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <input type="text" id="txtBL" name="txtBL" required="required" class="form-control col-md-7 col-xs-12" />
                                                                </div>
                                                                <label class="control-label col-md-1 col-sm-4 col-xs-12">IMO</label>
                                                                <div class="col-md-3 col-sm-9 col-xs-12">
                                                                    <select class="form-control" name="imo">
                                                                        <option value="">Seleccione</option>
                                                                        <option value="1">SI</option>
                                                                        <option value="0">NO</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <br/><br/>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-1 col-sm-2 col-xs-3" for="txtNombre">Sello Colocado</span>
                                                                </label>
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <input type="text" id="txtSelloColocado" name="txtSelloColocado" required="required" class="form-control col-md-7 col-xs-12"
                                                                    >
                                                                </div>
                                                                <label class="control-label col-md-1 col-sm-2 col-xs-3" for="txtNombre">Peso</span>
                                                                </label>
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <input type="text" id="Peso" name="Peso" required="required" class="form-control col-md-7 col-xs-12"
                                                                    >
                                                                </div>
                                                            </div>
                                                            <br/>
                                                            <br/>
                                                            <br/>
                                                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                                                <thead>
                                                                <tr>
                                                                    <td colspan="4" rowspan="1">
                                                                        <h5 align="center"> Bultos</h5>
                                                                    </td>

                                                                </tr>
                                                                </thead>

                                                                <tr>
                                                                    <th colspan="1">Cantidad de Bultos</th>
                                                                    <th colspan="3">Bultos Dañados y Cuantos</th>

                                                                </tr>


                                                                <tr>
                                                                    <td colspan="1" rowspan="1">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-3 col-sm-2 col-xs-3" for="txtCantiBultos">Cantidad</span>
                                                                            </label>
                                                                            <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                <input type="text" id="txtCantiBultos" name="txtCantiBultos" required="required" class="form-control col-md-7 col-xs-12"
                                                                                >
                                                                            </div>

                                                                        </div>
                                                                    </td>
                                                                    <td colspan="3" rowspan="1">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-2 col-sm-4 col-xs-12">Bultos dañados</label>
                                                                            <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                <select class="form-control" name="bDañados" id="bDañados">
                                                                                    <option value="">Seleccione</option>
                                                                                    <option value="1">SI</option>
                                                                                    <option value="0">NO</option>
                                                                                </select>
                                                                            </div>
                                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="txtCantiDañados">Cantidad</span>
                                                                            </label>
                                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                <input type="text" id="txtCantiDañados" name="txtCantiDañados" required="required" class="form-control col-md-7 col-xs-12"
                                                                                >
                                                                            </div>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4" rowspan="1">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-3 col-sm-2 col-xs-3" for="txtNombre">Presentación de los Bultos</span>
                                                                            </label>

                                                                        </div>
                                                                        <br/><br/>
                                                                        <div class="form-group">

                                                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen1" value="PalletsMadera"> Pallets de Madera
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen2" value="PalletsPlastico"> Pallets de Plástico
                                                                                    </label>
                                                                                </div>


                                                                            </div>
                                                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen2" value="Cartonada"> Cartonada
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen3" value="Cuñetes"> Cuñetes
                                                                                    </label>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen4" value="Sacos"> Sacos
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen5" value="SuperBolsas"> Superbolsas
                                                                                    </label>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen6" value="Bidones"> Bidones
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen7" value="Cont1000L"> Cont.1000L
                                                                                    </label>
                                                                                </div>


                                                                            </div>
                                                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen8" value="HuacalesMadera"> Huacales de Madera
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen9" value="CajasMadera"> Cajas de Madera
                                                                                    </label>
                                                                                </div>


                                                                            </div>
                                                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen10" value="RacksMetalicos"> Racks Metalicos
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen11" value="Granel"> Granel
                                                                                    </label>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-md-12 col-sm-9 col-xs-12">
                                                                                <textarea class="resizable_textarea form-control" placeholder="Otros (Especifique)" name="txtOtrosPresen" id="txtOtrosPresen"></textarea>
                                                                            </div>
                                                                        </div>

                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <thead>
                                                                    <tr>
                                                                        <th colspan="2">Averias</th>
                                                                        <th colspan="2">Fumigado</th>

                                                                    </tr>
                                                                    </thead>
                                                                </tr>
                                                                <tr>

                                                                    <td colspan="2" rowspan="1">
                                                                        <div class="form-group">
                                                                            <div class="col-md-4 col-sm-3 col-xs-12">
                                                                                <p>
                                                                                    Origen:
                                                                                    <input type="radio" class="flat" name="averias" id="averias" value="1"/> <br/>
                                                                                    Recinto:
                                                                                    <input type="radio" class="flat" name="averias" id="averias" value="0"/>
                                                                                </p>
                                                                            </div>

                                                                        </div>

                                                                    </td>
                                                                    <td colspan="2" rowspan="1">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-3 col-sm-4 col-xs-12">FUMIGADO</label>
                                                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                                                <select class="form-control" name="fumigado">
                                                                                    <option value="">Seleccione</option>
                                                                                    <option value="si">SI</option>
                                                                                    <option value="no">NO</option>
                                                                                </select>
                                                                            </div>

                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <thead>
                                                                    <tr>
                                                                        <th colspan="2">Mercancia</th>
                                                                        <th colspan="2">Previo</th>

                                                                    </tr>
                                                                    </thead>
                                                                </tr>
                                                                <tr>

                                                                    <td colspan="2" rowspan="1">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Mercancía</label>
                                                                            <div class="col-md-7 col-sm-9 col-xs-12">
                                                                                <select class="form-control" name="mercancia" id="mercancia">
                                                                                    <option value="1">Conforme a Factura</option>
                                                                                    <option value="2">Faltante</option>
                                                                                    <option value="3">Sobrante</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <br/><br/>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtCanMer1">Cantidad</span>
                                                                            </label>
                                                                            <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                <input type="text" id="txtCanMer1" name="txtCanMer1" required="required" class="form-control col-md-7 col-xs-12" />
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2" rowspan="1">
                                                                        <div class="form-group">

                                                                            <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="Previos[]" id="bultosPresen2" value="Separacion"> Separacion
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="Previos[]" id="bultosPresen3" value="Ocular"> Ocular
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="Previos[]" id="bultosPresen4" value="RevisionC/Autoridad"> Revisión C/Autoridad
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" class="flat" name="Previos[]" id="bultosPresen5" value="Etiquetado"> Etiquetado
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
                                                            <script>
                                                                $(function(){
                                                                    $("#btnCarga").click(function () {
                                                                        var url = "../Controladores/controlPrevios.php";
                                                                        $.ajax({
                                                                            type: "POST",
                                                                            url : url,
                                                                            data : $("#cargaSuelta").serialize(),
                                                                            success: function(data)
                                                                            {
                                                                                $("#respuesta").html(data);
                                                                            }
                                                                        });
                                                                        return false;
                                                                    });
                                                                });
                                                            </script>
                                                            <!-- Validar select's seleccionados -->
                                                            <script>
                                                                $(document).ready(function () {
                                                                    $("#txtCanMer1").attr({
                                                                        disabled : true
                                                                    });
                                                                    $("#mercancia").change(function () {
                                                                        if($("#mercancia").val() == '2' || $("#mercancia").val() == '3'){
                                                                            $("#txtCanMer1").attr({
                                                                                disabled : false
                                                                            });
                                                                        }else if($("#mercancia").val() == '1'){
                                                                            $("#txtCanMer1").attr({
                                                                                disabled : true
                                                                            });
                                                                        }
                                                                    });
                                                                })
                                                            </script>
                                                            <!-- Validar select's de mercancia seleccionados -->
                                                            <!-- Validar select's de bultos dañados seleccionados -->
                                                            <script>
                                                                $(document).ready(function () {
                                                                    $("#txtCantiDañados").attr({
                                                                        disabled : true
                                                                    });
                                                                    $("#bDañados").change(function () {
                                                                        if($("#bDañados").val() == '1'){
                                                                            $("#txtCantiDañados").attr({
                                                                                disabled : false
                                                                            });
                                                                        }else if($("#bDañados").val() == '0'){
                                                                            $("#txtCantiDañados").attr({
                                                                                disabled : true
                                                                            });
                                                                        }else{
                                                                            $("#txtCantiDañados").attr({
                                                                                disabled : true
                                                                            });
                                                                        }
                                                                    });
                                                                })
                                                            </script>
                                                            <!-- Validar radios seleccionados -->
                                                            <div align="center">
                                                                <?php
                                                                if($cHab == false){

                                                                    ?>
                                                                    <input type="button" id="btnCarga"  value="Guardar" class="btn btn-round btn-primary"  />
                                                                    <?php
                                                                }

                                                                ?>
                                                            </div>
                                                            <div id="respuesta"></div>
                                                        </div>
                                                    </form>
                                                </div>



                                                <?php
                                            }
                                            ?>

                                        </div>
                                <?php
                                    }else{
                                        ?>
                                        <h1>NO SE HAN REGISTRADO OBSERVACIONES</h1>
                                <?php
                                    }
                                ?>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
            <div class="clearfix"></div>
    </div>

    <!-- jQuery -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>



    <!-- Datatables -->
    <script>
        $(document).ready(function() {
            var handleDataTableButtons = function() {
                if ($("#datatable-buttons").length) {
                    $("#datatable-buttons").DataTable({
                        dom: "Bfrtip",
                        buttons: [
                            {
                                extend: "copy",
                                className: "btn-sm"
                            },
                            {
                                extend: "csv",
                                className: "btn-sm"
                            },
                            {
                                extend: "excel",
                                className: "btn-sm"
                            },
                            {
                                extend: "pdfHtml5",
                                className: "btn-sm"
                            },
                            {
                                extend: "print",
                                className: "btn-sm"
                            },
                        ],
                        responsive: true
                    });
                }
            };

            TableManageButtons = function() {
                "use strict";
                return {
                    init: function() {
                        handleDataTableButtons();
                    }
                };
            }();

            $('#datatable').dataTable();

            $('#datatable-keytable').DataTable({
                keys: true
            });

            $('#datatable-responsive').DataTable();

            $('#datatable-scroller').DataTable({
                ajax: "js/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });

            $('#datatable-fixed-header').DataTable({
                fixedHeader: true
            });

            var $datatable = $('#datatable-checkbox');

            $datatable.dataTable({
                'order': [[ 1, 'asc' ]],
                'columnDefs': [
                    { orderable: false, targets: [0] }
                ]
            });
            $datatable.on('draw.dt', function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_flat-green'
                });
            });

            TableManageButtons.init();
        });
    </script>
    <!-- /Datatables -->
        <!-- Custom Notification -->
        <script>
            $(document).ready(function() {
                var cnt = 10;

                TabbedNotification = function(options) {
                    var message = "<div id='ntf" + cnt + "' class='text alert-" + options.type + "' style='display:none'><h2><i class='fa fa-bell'></i> " + options.title +
                        "</h2><div class='close'><a href='javascript:;' class='notification_close'><i class='fa fa-close'></i></a></div><p>" + options.text + "</p></div>";

                    if (!document.getElementById('custom_notifications')) {
                        alert('doesnt exists');
                    } else {
                        $('#custom_notifications ul.notifications').append("<li><a id='ntlink" + cnt + "' class='alert-" + options.type + "' href='#ntf" + cnt + "'><i class='fa fa-bell animated shake'></i></a></li>");
                        $('#custom_notifications #notif-group').append(message);
                        cnt++;
                        CustomTabs(options);
                    }
                };

                CustomTabs = function(options) {
                    $('.tabbed_notifications > div').hide();
                    $('.tabbed_notifications > div:first-of-type').show();
                    $('#custom_notifications').removeClass('dsp_none');
                    $('.notifications a').click(function(e) {
                        e.preventDefault();
                        var $this = $(this),
                            tabbed_notifications = '#' + $this.parents('.notifications').data('tabbed_notifications'),
                            others = $this.closest('li').siblings().children('a'),
                            target = $this.attr('href');
                        others.removeClass('active');
                        $this.addClass('active');
                        $(tabbed_notifications).children('div').hide();
                        $(target).show();
                    });
                };

                CustomTabs();

                var tabid = idname = '';

                $(document).on('click', '.notification_close', function(e) {
                    idname = $(this).parent().parent().attr("id");
                    tabid = idname.substr(-2);
                    $('#ntf' + tabid).remove();
                    $('#ntlink' + tabid).parent().remove();
                    $('.notifications a').first().addClass('active');
                    $('#notif-group div').first().css('display', 'block');
                });
            });
        </script>
        <!-- /Custom Notification -->
</body>
</html>
