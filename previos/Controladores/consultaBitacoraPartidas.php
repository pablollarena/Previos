<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 12/01/2017
 * Time: 11:29
 */

include_once ("../Modelos/Menu.php");
include_once ("../Modelos/Persona.php");
include_once ("../Modelos/BitacoraPartidas.php");
session_start();
$oBitacora = new BitacoraPartidas();
$arrBit = null;
$oReporte = null;
$arrItem = null;
$sErr ="";

if(isset($_POST['txtValRef']) && !empty($_POST['txtValRef'])){
    $nRef = $_POST['txtValRef'];
    $oBitacora->setReferencia60(new Sir60Referencias());
    $oBitacora->getReferencia60()->setReferencia($_POST['txtValRef']);
    $arrBit = $oBitacora->buscarBitacoraPartidas();

}else{
    $sErr = "No se ingresó referencia";
}

if($sErr != ""){
    //header("Location: ../error.php?sError=".$sErr);
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
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
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
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th class="column-title">Usuario</th>
                <th class="column-title">Fecha de Modificacion</th>
                <th class="column-title">Factura</th>
                <th class="column-title">Item</th>
                <th class="column-title">Accion</th>
                <th class="bulk-actions" colspan="5">
                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
            </tr>
            </thead>

            <tbody>

            <?php
            if ($arrBit)
            {
                foreach ($arrBit as $vRow){
                    ?>
                    <tr class="even pointer">
                        <td class=" "><?php  echo $vRow->getUsuario();?></td>
                        <td class=" "><?php echo $vRow->getFechaModificacion();?> </td>
                        <td class=" "><?php echo $vRow->getFactura52()->getNumero();?></td>
                        <td class=" "><?php echo $vRow->getFactura52()->getItem();?></td>
                        <td class=" " width="30%"><?php echo $vRow->getAccion();?></td>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>

            </tbody>
        </table>
    </form>

</div>
<!-- iCheck -->
<script src="../../vendors/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../vendors/fastclick/lib/fastclick.js"></script>
<!-- /page content -->
