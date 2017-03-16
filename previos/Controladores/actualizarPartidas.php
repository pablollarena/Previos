<?php
include_once ("../Modelos/ReportePrevio.php");
include_once ("../Modelos/cat_user.php");
include_once ("../Modelos/Persona.php");
session_start();
$oReporte = new ReportePrevio();
$oRep = new ReportePrevio();
$sUser = new cat_user();
$oPers = new Persona();
$sErr = "";
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
if (isset($_POST['txtRef1']) && !empty($_POST['txtRef1']) && isset($_POST['txtFac1']) && !empty($_POST['txtFac1']) && isset($_POST['txtItem']) && !empty($_POST['txtItem'])){
    $oPers = $_SESSION['sUser'];
    $oReporte->setSir60(new Sir60Referencias());
    $oReporte->setSir52(new Facturas());
    $oReporte->getSir60()->setReferencia($_POST['txtRef1']);
    $oReporte->getSir52()->setNumero($_POST['txtFac1']);
    $oReporte->getSir52()->setItem($_POST['txtItem']);
    $oReporte->buscarInfoPartida();
    $oRep->setSir60(new Sir60Referencias());
    $oRep->setSir52(new Facturas());
    $oRep->getSir60()->setReferencia($_POST['txtRef1']);
    $oRep->getSir52()->setNumero($_POST['txtFac1']);
    $oRep->getSir52()->setItem($_POST['txtItem']);
    $sCadena = "";
    if($oReporte->getCant() == $_POST['txtCantidad']){
        $oRep->setCant($_POST['txtCantidad']);
    }else if($oReporte->getCant() != $_POST['txtCantidad']){
        $oRep->setCant($_POST['txtCantidad']);
        $sCadena = $sCadena." ;se modifico el campo de cantidad";
    }
     if($_POST['mercancia'] == 1){
         $oRep->setCompleta(1);
         $oRep->setFaltante(0);
         $oRep->setSobrante(0);
        $sCadena = $sCadena." ;Se cambió la cantidad por Completa";
     }else if($_POST['mercancia'] == 2){
         $oRep->setCompleta(0);
         $oRep->setFaltante(1);
         $oRep->setSobrante(0);
         $sCadena = $sCadena." ;Se cambió la cantidad por Faltante";
     }else if($_POST['mercancia'] == 3){
         $oRep->setCompleta(0);
         $oRep->setFaltante(0);
         $oRep->setSobrante(1);
         $sCadena = $sCadena." ;Se cambió la cantidad por Sobrante";
     }else if($oReporte->getCompleta() == 1 and $_POST['mercancia'] == ""){
         $oRep->setCompleta(1);
         $oRep->setFaltante(0);
         $oRep->setSobrante(0);
     }else if($oReporte->getFaltante() == 1  and $_POST['mercancia'] == ""){
         $oRep->setCompleta(0);
         $oRep->setFaltante(1);
         $oRep->setSobrante(0);
     }else if($oReporte->getSobrante() == 1  and $_POST['mercancia'] == ""){
         $oRep->setCompleta(0);
         $oRep->setFaltante(0);
         $oRep->setSobrante(1);
     }

     if ($_POST['presentacion'] == 1 ){
         $oRep->setPieza(1);
         $oRep->setJuego(0);
         $oRep->getOtro(0);
         $sCadena = $sCadena.";se modifico la presentaacion a pieza";
     }else if($_POST['presentacion'] == 2){
         $oRep->setPieza(0);
         $oRep->setJuego(1);
         $oRep->getOtro(0);
         $sCadena = $sCadena.";se modifico la presentaacion a juego";
     }else if($_POST['presentacion'] == 3)
     {
         $oRep->setPieza(0);
         $oRep->setJuego(0);
         $oRep->getOtro(1);
         $sCadena = $sCadena.";se modifico la presentaacion a Otro";
     }else if($oReporte->getPieza() == 1 and $_POST['presentacion'] == ""){
         $oRep->setPieza(1);
         $oRep->setJuego(0);
         $oRep->getOtro(0);
     }else if($oReporte->getPieza() == 2 and empty($_POST['presentacion']) ){
         $oRep->setPieza(0);
         $oRep->setJuego(1);
         $oRep->getOtro(0);
     }else if ($oReporte->getOtro() == 3 and empty($_POST['presentacion'])){
         $oRep->setPieza(0);
         $oRep->setJuego(0);
         $oRep->getOtro(1);
     }


     if ($oReporte->getOrigen() == $_POST['txtOrigen']){
         $oRep->setOrigen($_POST['txtOrigen']);
     }else if($oReporte->getOrigen() != $_POST['txtOrigen']){
         $oRep->setOrigen($_POST['txtOrigen']);
         $sCadena = $sCadena." ;Se realizo el cambio en el origen";
     }

     if ($oReporte->getPesoAprox() == $_POST['txtPesoAprox']){
         $oRep->setPesoAprox($_POST['txtPesoAprox']);
     }else if($oReporte->getPesoAprox() !=  $_POST['txtPesoAprox'])
     {
         $oRep->setPesoAprox($_POST['txtPesoAprox']);
         $sCadena = $sCadena." ;se realizo cambio en el peso";
     }

     if($sCadena == ""){
         $sCadena = "Se presionó el botón Actualizar pero no se realizó ningún cambio a la información original";
     }

    $oRep->setObservaciones($_POST['observaciones']);

     try{
         //var_dump($oRep);
         if ($oRep->updatePartida($oPers->getUsuario(),$sCadena) == 1){
             echo " <script src='../../vendors/pnotify/dist/pnotify.js'></script> ";
             echo "<script src='../../vendors/pnotify/dist/pnotify.buttons.js' ></script> ";
             echo "<script src='../../vendors/pnotify/dist/pnotify.nonblock.js' ></script> ";
             echo " <script>
      $(document).ready(function() {
      new PNotify({
                                  title: 'Éxito',
                                  text: 'Información actualizada correctamente',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
      });
    </script> ";
         }else{

             echo " <script src='../../vendors/pnotify/dist/pnotify.js'></script> ";
             echo "<script src='../../vendors/pnotify/dist/pnotify.buttons.js' ></script> ";
             echo "<script src='../../vendors/pnotify/dist/pnotify.nonblock.js' ></script> ";
             echo " <script>
      $(document).ready(function() {
      new PNotify({
                                  title: 'Oh no',
                                  text: 'Error, faltan datos',
                                  type: 'error',
                                  styling: 'bootstrap3'
                              });
      });
    </script> ";
         }

     }catch (Exception $e){
        error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(),0);
        $sErr = "Error en base de datos, comunicarse con el administrador";
    }
}

}else {
    $sErr = "faltan datos";
}


?>