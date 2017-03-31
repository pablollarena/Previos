<?php
/**
 * Created by PhpStorm.
 * User: SISTEMAS-PABLO
 * Date: 24/03/2017
 * Time: 11:58 AM
 */
include_once ("../Modelos/CargaMultiple.php");
include_once ("../Modelos/Sir76Contenedores.php");
$oCon = new Sir76Contenedores();
$oCargaFotos = new CargaMultiple();
$vImagenes = $_FILES['FileImg']['name'];


//$sRef = $_POST['txtValRef'];
if(isset($_SESSION['sConten']) && !empty($_SESSION['sConten'])){
    $oCon = $_SESSION['sConten'];
    $sReferencia = $oCon->getReferencia60()->getReferencia();
    $nNumCon = $_POST['txtCont'];
}else{
    $sReferencia = $_POST['txtnRef'];
    $nNumCon = $_POST['txtCont'];
}
try{
    if($oCargaFotos->cargarArchivosContenedor($vImagenes,$sReferencia,$nNumCon) == 1){
        header("Location: ../Vistas/infoReferencia.php");
    }
}catch(Exception $e){
    error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(),0);
    $sErr2 = "Error en base de datos, comunicarse con el administrador";
}
?>