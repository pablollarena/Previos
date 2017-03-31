<?php
/**
 * Created by PhpStorm.
 * User: SISTEMAS-PABLO
 * Date: 30/03/2017
 * Time: 12:04 PM
 */
include_once ("../Modelos/SobrantesPartida.php");
include_once ("../Modelos/CargaMultiple.php");

$sRef = $_POST['txtRefe'];
$sObs = $_POST['Sobrante'];
$sErr = "";
$nNumero = 0;
for($i = 0;$i<=count($sObs);$i++){

    if($i == count($sObs)){
        break;
    }else{
        $oSobrante = new  SobrantesPartida();
        $oCarga = new CargaMultiple();
        $oSobrante->setReferencia60(new Sir60Referencias());
        $oSobrante->getReferencia60()->setReferencia($sRef);
        $oSobrante->setObservaciones($sObs[$i]);
        $nTotalReg = $oSobrante->buscarUltimoItem();

        if($nTotalReg == 0){
            $oSobrante->setNumItem(1);
            $nNumero = 1;
        }else if($nTotalReg >= 1){
            $nNumero = $nTotalReg + 1;
            $oSobrante->setNumItem($nNumero);
        }

        $nCont = $i + 1;
        $sNombre = "fotoSobrante".$nCont;
        $arrImagenes = $_FILES[$sNombre]['name'];

        try{
            if($oSobrante->insertarSobrantesPartidas() == 1){
                if($oCarga->cargarArchivosSobrantes($arrImagenes, $sRef, $nNumero,$sNombre) == 1){
                    $nReg = 1;
                }else{
                    $sErr = "Error al intentar cargar la imágenes";
                }
            }else{
                $sErr = "Error en la base de datos";
            }
        }catch (Exception $e){
            error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(),0);
            $sErr2 = "Error en base de datos, comunicarse con el administrador";
        }
    }

}

if($nReg == 1){
    header("Location: ../Vistas/SobrantesPartidas.php");
}else{
    echo  $sErr;
}
?>