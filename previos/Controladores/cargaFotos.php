<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 17/02/2017
 * Time: 03:41 PM
 */

include_once ("../Modelos/CargaMultiple.php");
include_once ("../Modelos/ReportePrevio.php");
$oReporte = new ReportePrevio();
$oCargarFotos = new CargaMultiple();
$vImagenes = $_FILES['FileImg']['name'];

$nItem = $_POST['txtItem'];
if(isset($_SESSION['sReporte'])){
    $oReporte = $_SESSION['sReporte'];
    $sReferencia = $oReporte->getSir60()->getReferencia();
    $nFactura = $oReporte->getSir52()->getNumero();
}else{
    $sReferencia = $_POST['txtnRef'];
    $nFactura = $_POST['txtFactura'];
}

try{
    if ($oCargarFotos->cargarArchivos($vImagenes,$sReferencia,$nFactura,$nItem) == 1){
        header("Location: ../Vistas/itemsPorPartida.php");
    }
}catch (Exception $e){
    error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(),0);
    $sErr2 = "Error en base de datos, comunicarse con el administrador";
}
?>