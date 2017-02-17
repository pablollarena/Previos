<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 13/02/2017
 * Time: 05:02 PM
 */
include_once ("../Modelos/ReportePrevio.php");
include_once ("../Modelos/CargaMultiple.php");
include_once ("../Modelos/Sir60Referencias.php");
include_once ("../Modelos/Sir52Facturas.php");
session_start();
$oReporte = new ReportePrevio();
$oSir60 = null;
$oFactura = null;
$oCargarFotos = new CargaMultiple();
if (isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
     if( isset($_POST['txtFac1']) && !empty($_POST['txtFac1']) &&
          isset($_POST['txtRef1']) && !empty($_POST['txtRef1']) ){
         $vImagenes = $_FILES['FileImg']['name'];

         $oReporte->setSir60(new Sir60Referencias());
         $oReporte->setSir52(new Facturas());
         $oReporte->getSir60()->setReferencia($_POST['txtRef1']);
         $oReporte->getSir52()->setNumero($_POST['txtFac1']);
         $oReporte->getSir52()->setItem($_POST['txtItem']);

         $oReporte->setCant($_POST['txtCantidad']);
         if($_POST['Mercancia'] == 'COMP'){
             $oReporte->setCompleta(1);
             $oReporte->setSobrante(0);
             $oReporte->setFaltante(0);
         }else if( $_POST['Mercancia'] == 'FALT'){
             $oReporte->setCompleta(0);
             $oReporte->setSobrante(0);
             $oReporte->setFaltante(1);
         }else if ($_POST['Mercancia'] == 'SOBR'){
             $oReporte->setCompleta(0);
             $oReporte->setSobrante(1);
             $oReporte->setFaltante(0);
         }


         if ($_POST['Presentacion'] == 'PZA'){
             $oReporte->setPieza(1);
             $oReporte->setJuego(0);
             $oReporte->setOtro(0);
         }else if ($_POST['Presentacion'] == 'JGO'){
             $oReporte->setPieza(0);
             $oReporte->setJuego(1);
             $oReporte->setOtro(0);
         }else if ($_POST['Presentacion'] == 'OTRO'){
             $oReporte->setPieza(0);
             $oReporte->setJuego(0);
             $oReporte->setOtro(1);
         }
         $oReporte->setOrigen($_POST['txtOrigen']);
         $oReporte->setPesoAprox($_POST['txtPesoAprox']);
         $oReporte->setObservaciones($_POST['txtObservaciones']);

         try{
             if($oReporte->insertarReportePrevio() == 1){
                     echo " <script src='../../vendors/pnotify/dist/pnotify.js'></script> ";
                     echo "<script src='../../vendors/pnotify/dist/pnotify.buttons.js' ></script> ";
                     echo "<script src='../../vendors/pnotify/dist/pnotify.nonblock.js' ></script> ";
                     echo " <script>
      $(document).ready(function() {
      new PNotify({
                                  title: 'Éxito',
                                  text: 'Información guardada correctamente',
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


         }catch(Exception $e){

         }


     }

}


?>