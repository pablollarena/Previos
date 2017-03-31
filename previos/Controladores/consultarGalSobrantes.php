<?php
/**
 * Created by PhpStorm.
 * User: SISTEMAS-PABLO
 * Date: 31/03/2017
 * Time: 10:35 AM
 */
ini_set("session.cookie_lifetime","7200");
ini_set("session.gc_maxlifetime","7200");
include_once ("../Modelos/Menu.php");
include_once ("../Modelos/Persona.php");
include_once ("../Modelos/Sir60Referencias.php");
include_once ("../Modelos/SobrantesPartida.php");
session_start();
$oMenu = new Menu();
$oPers = new Persona();
$oRef = new Sir60Referencias();
$oSobrantes = new SobrantesPartida();
$sErr ="";
$sNom = "";
$nGrp = 0;
$arrMenu = null;
$arrObs = null;

$nick = "";
$dFecha = Date('Y-m-d');
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    $oPers = $_SESSION['sUser'];
    $sNom = $oPers->getNomCompleto();
    $nick = $oPers->getUsuario();
    if($oPers->getReferen() == 1){
        $arrMenu = $oMenu->generarMenu($oPers->getGrp()->getIdGrp());
    }else if($oPers->getReferen() == 2 or $oPers->getReferen() == 3){
        $arrMenu = $oMenu->generarMenu(($oPers->getGrupo()));
    }else{
        $sErr = "Error en el menú";
    }
    $oSobrantes->setReferencia60(new Sir60Referencias());
    $oSobrantes->getReferencia60()->setReferencia($_POST['txtValRef']);
    $arrObs = $oSobrantes->buscarObservaciones();

    $sRef = $_POST['txtValRef'];
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



    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

        <!-- page content -->

            <div class="">

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <form id="frmPrevios" action="../Controladores/GaleriaSobrantes.php" method="post">
                            <input type="hidden" name="txtRef" value="<?php echo $sRef;?>"/>
                            <input type="hidden" name="txtItem" >
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>LISTA DE SOBRANTES<small></small></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>Observación</th>
                                                <th>Número de Item</th>
                                                <th>Acción</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if($arrObs != null){
                                                foreach ($arrObs as $vRow){
                                                    ?>
                                                    <tr>
                                                        <td><textarea><?php echo $vRow->getObservaciones();?></textarea></td>
                                                        <td><?php echo $vRow->getNumItem(); ?></td>
                                                        <td><input type="submit" value="Ver Galeria" class="btn btn-primary"
                                                                   onclick="txtItem.value='<?php echo $vRow->getNumItem();?>';" /> </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /page content -->

    </div>

</body>
</html>
