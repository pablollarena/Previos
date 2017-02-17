<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 17/02/2017
 * Time: 03:41 PM
 */

include_once ("../Modelos/CargaMultiple.php");
$oCargarFotos = new CargaMultiple();
$vImagenes = $_FILES['FileImg']['name'];
$sReferencia = $_POST['txtnRef'];
$nFactura = $_POST['txtFactura'];

if ($oCargarFotos->cargarArchivos($vImagenes,$sReferencia) == 1){
      header("Location: ../Vistas/itemsPorPartida.php?sReferencia=".$sReferencia."&nFactura=".$nFactura);
}else{

}




?>