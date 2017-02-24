<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 12/01/2017
 * Time: 11:29
 */

include_once ("../Modelos/Menu.php");
include_once ("../Modelos/Persona.php");
include_once("../Modelos/Sir52Facturas.php");
include_once ("../Modelos/ReportePrevio.php");

session_start();

$oFactura = new Facturas();
$arrFacturas = null;
$oReporte = null;
$arrItem = null;
$sErr ="";
if(isset($_POST['txtValRef']) && !empty($_POST['txtValRef'])){
    $nRef = $_POST['txtValRef'];
    $oFactura->setSir60(new Sir60Referencias());
    $oFactura->getSir60()->setReferencia($nRef);
    $arrFacturas = $oFactura->buscarItemFactura();
}else{
    $sErr = "No se ingresó referencia";
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
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
</head>
<form id="frmGal" action="Galeria.php" method="post">
    <input type="hidden" name="txtRefe" value="<?php echo $nRef; ?>">
    <div class="x_title">
        <ul class="nav navbar-right panel_toolbox">
            <li>

            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</form>
<div class="x_content">

                    <form method="post" action="verItems.php">
                        <input type="hidden" name="txtRef" value="<?php echo $nRef;?>">
                        <input type="hidden" name="txtFac">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Número de Factura</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 0;
                            foreach($arrFacturas as $vFact){
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i + 1; ?></th>
                                    <td><?php echo $vFact->getNumero(); ?></td>
                                    <td><input type="submit" value="Ver Items" class="btn btn-round btn-primary" onclick="txtFac.value='<?php echo $vFact->getNumero(); ?>';"></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>


                            </tbody>
                        </table>
                    </form>

                </div>

    <!-- /page content -->
