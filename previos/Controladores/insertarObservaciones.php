<?php

include_once ("../Modelos/Observaciones.php");
session_start();
$oObservaciones = new Observaciones();


   if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){

       $oObservaciones->setSir60(new Sir60Referencias());
       $oObservaciones->getSir60()->setReferencia($_POST['txtRef']);
       $oObservaciones->setUsuario($_POST['txtNick']);
       $oObservaciones->setObservacion($_POST['txtObservacion']);
       $oObservaciones->setFecha($_POST['dFechaReg']);


       try{
           if ($oObservaciones->insertarObservaciones() == 1){
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

       }catch (Exception $e){
           error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(),0);
           $sErr2 = "Error en base de datos, comunicarse con el administrador";
       }


   }
?>