<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 30/01/2017
 * Time: 03:38 PM
 */

include_once ("../Modelos/cat_user.php");
include_once ("../Modelos/Menu.php");
include_once ("../Modelos/cat_clientes.php");
include_once ("../Modelos/Sir76Contenedores.php");
session_start();
$oUser = new cat_user();
$oMenu = new Menu();
$oCliente = new cat_clientes();
$sErr ="";
$sNom = "";
$nGrp = 0;
$arrMenu = null;
$oContendor = new Sir76Contenedores();
if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    if (isset($_POST['tamaño'])&& !empty($_POST['tamaño']) &&
         isset($_POST['tipo']) && !empty($_POST['tipo'])&&
          isset($_POST['txtSelloColocado']) && !empty($_POST['txtSelloColocado']) &&
           isset($_POST['txtPeso1']) && !empty($_POST['txtPeso1']) &&
           isset($_POST['txtCantiBultos']) && !empty($_POST['txtCantiBultos'])

    ){
        if($_POST['operacion'] == 'content'){
            $bultos = $_POST['bultosPresen'];
            $previos = $_POST['Previos'];
            $daños = $_POST['daños'];
            $oContendor->setReferencia60(new Sir60Referencias());
            $oContendor->setConten(new Contenedor());
            $oContendor->setDaño(new  Danios());
            $oContendor->setMercancia(new Mercancia());
            $oContendor->setPrevio(new Previo());
            $oContendor->setPeso($_POST['txtPeso'] != null ? $_POST['txtPeso'] : 0);
            $oContendor->getReferencia60()->setReferencia($_POST['txtRef']);
            $oContendor->getConten()->setNumeroContenedor($_POST['txtNumConten']);
            $oContendor->getConten()->setTamaño($_POST['tamaño']);
            $oContendor->getConten()->setTipo($_POST['tipo']);
            $oContendor->getConten()->setSelloColocado($_POST['txtSelloColocado']);
            $oContendor->getConten()->setPeso($_POST['txtPeso1']);
            $oContendor->getConten()->setIMO($_POST['imo']);

            $v1 = 0; $v2 =0; $v3 = 0; $v4 = 0; $v5 = 0; $v6 = 0; $v7 = 0; $v8 = 0; $v9 = 0; $v10 = 0; $v11 = 0; $v12 = 0;
            for( $i = 0 ; $i < count($daños); $i ++){
                if ($daños[$i] == 'Origen'){
                    $v1 = 1;
                }elseif ( $daños[$i] == 'Recinto'){
                    $v2 = 1;
                }elseif ($daños[$i] == 'Frente'){
                    $v3 = 1;
                }elseif ($daños[$i] == 'PanelIzq'){
                    $v4 = 1;
                }elseif ($daños[$i] == 'Piso'){
                    $v5 = 1;
                }elseif ($daños[$i] == 'Techo'){
                    $v6 = 1;
                }elseif ($daños[$i] == 'PanelDer'){
                    $v7 = 1;
                }elseif ($daños[$i] == 'Puertas'){
                    $v8 = 1;
                }elseif ($daños[$i] == 'BarrasPuerta'){
                    $v9 = 1;
                }elseif ($daños[$i] == 'Seguros'){
                    $v10 = 1;
                }elseif ($daños[$i] == 'Abrazaderas'){
                    $v11 = 1;
                }elseif ($daños[$i] == 'LonaBarra'){
                    $v12 = 1;
                }
            }

            $oContendor->getDaño()->setOrigen($v1 == 1 ? 1 : 0);
            $oContendor->getDaño()->setRecinto($v2 == 1 ? 1 : 0 );
            $oContendor->getDaño()->setFrente($v3 == 1 ? 1 : 0);
            $oContendor->getDaño()->setPanelIzq($v4 == 1 ? 1: 0 );
            $oContendor->getDaño()->setPiso($v5 == 1 ? 1 : 0);
            $oContendor->getDaño()->setTecho($v6 == 1 ? 1 : 0);
            $oContendor->getDaño()->setPanelDer($v7 == 1 ? 1 : 0);
            $oContendor->getDaño()->setPuertas($v8 == 1 ? 1 : 0);
            $oContendor->getDaño()->setBarrasPuerta($v9 == 1 ? 1 : 0);
            $oContendor->getDaño()->setSeguros($v10 == 1 ? 1 : 0);
            $oContendor->getDaño()->setAbrazaderas($v11 == 1 ? 1 : 0);
            $oContendor->getDaño()->setLonasBarras($v12 == 1 ? 1 : 0);
            $oContendor->getDaño()->setOtros($_POST['txtOtros'] == "" ? 'No se registraron otros daños' : $_POST['txtOtros']);
            $oContendor->getConten()->setCantidadBultos($_POST['txtCantiBultos']);
            $oContendor->getConten()->setBultosDañados($_POST['bDañados']);
            if($_POST['bDañados'] == 1){
                $oContendor->getConten()->setCantBultDañados($_POST['txtCantiDañados']);
            }else if($_POST['bDañados'] == 0){
                $oContendor->getConten()->setCantBultDañados(0);
            }

            $z1 = 0; $z2 =0; $z3 = 0; $z4 = 0; $z5 = 0; $z6 = 0; $z7 = 0; $z8 = 0; $z9 = 0; $z10 = 0; $z11 = 0; $z12 = 0;
            for ($j = 0; $j < count($bultos) ; $j++){
                if ($bultos[$j] == 'PalletsMadera'){
                    $z1 = 1;
                }elseif ($bultos[$j] == 'PalletsPlastico'){
                    $z2 = 1;
                }elseif ($bultos[$j] == 'Cartonada'){
                    $z3 = 1;
                }elseif ($bultos[$j] == 'Cuñetes'){
                    $z4 = 1;
                }elseif ($bultos[$j] == 'Sacos'){
                    $z5 = 1;
                }elseif ($bultos[$j] == 'SuperBolsas'){
                    $z6 = 1;
                }elseif ($bultos[$j] == 'Bidones'){
                    $z7 = 1;
                }elseif ($bultos[$j] == 'Cont1000L'){
                    $z8 = 1;
                }elseif ($bultos[$j] == 'HuacalesMadera'){
                    $z9 = 1;
                }elseif ($bultos[$j] == 'CajasMadera'){
                    $z10 = 1;
                }elseif ($bultos[$j] == 'RacksMetalicos'){
                    $z11 = 1;
                }elseif ($bultos[$j] == 'Granel'){
                    $z12 = 1;
                }
            }
            $oContendor->getConten()->setPalletsMadera($z1 == 1 ? 1 : 0);
            $oContendor->getConten()->setPalletsPlastico($z2 == 1 ? 1 : 0);
            $oContendor->getConten()->setCartonada($z3 == 1 ? 1 : 0 );
            $oContendor->getConten()->setCuñetes($z4 == 1 ? 1 : 0 );
            $oContendor->getConten()->setSacos($z5 == 1 ? 1 : 0);
            $oContendor->getConten()->setSuperBolsas($z6 == 1 ? 1 : 0  );
            $oContendor->getConten()->setBidones($z7 == 1 ? 1 : 0 );
            $oContendor->getConten()->setCont1000L($z8 == 1 ? 1 : 0);
            $oContendor->getConten()->setHuacalesMadera($z9 == 1 ? 1 : 0);
            $oContendor->getConten()->setCajasMadera($z10 == 1 ? 1 : 0 );
            $oContendor->getConten()->setRacksMetalicos($z11 == 1 ? 1 : 0);
            $oContendor->getConten()->setGranel($z12 == 1 ? 1 : 0);
            $oContendor->getConten()->setOtros($_POST['txtOtrosPresen'] == "" ? 'No se registraron otras presentaciones' : $_POST['txtOtrosPresen']);
            if ($_POST['averias'] == 1) {
                $oContendor->getConten()->setAveriasOrigen(1);
                $oContendor->getConten()->setAveriasRecinto(0);
            }else if($_POST['averias'] ==  0){
                $oContendor->getConten()->setAveriasRecinto(1);
                $oContendor->getConten()->setAveriasOrigen(0);
            }
            $oContendor->getConten()->setFumigado($_POST['txtFumigado']);
            if ($_POST['mercancia'] == 1){
                $oContendor->getMercancia()->setConformeFactura(1);
                $oContendor->getMercancia()->setFaltante(0);
                $oContendor->getMercancia()->setSobrante(0);
                $oContendor->getMercancia()->setCantidad(0);

            }else if ($_POST['mercancia'] == 2){
                $oContendor->getMercancia()->setFaltante(1);
                $oContendor->getMercancia()->setCantidad($_POST['txtCanMer1']);
                $oContendor->getMercancia()->setConformeFactura(0);
                $oContendor->getMercancia()->setSobrante(0);
            }else if( $_POST['mercancia' == 3])
            {
                $oContendor->getMercancia()->setSobrante(1);
                $oContendor->getMercancia()->setCantidad($_POST['txtCanMer1']);
                $oContendor->getMercancia()->setConformeFactura(0);
                $oContendor->getMercancia()->setFaltante(0);
            }
            $x1 = 0; $x2= 0; $x3 = 0; $x4 = 0; $x5 = 0;
            for ($i = 0 ; $i < count($previos);$i++){
               if ($previos[$i] == 'DesYCon'){
                  $x1 = 1;
               }elseif ($previos[$i] == 'Separacion'){
                   $x2= 1;
               }elseif ($previos[$i] == 'Ocular'){
                   $x3 = 1;
               }elseif ($previos[$i] == 'RevisionC/Autoridad'){
                   $x4= 1;
               }elseif ($previos[$i] == 'Etiquetado'){
                   $x5 = 1;
               }
            }

            $oContendor->getPrevio()->setDesYCon($x1 == 1 ? 1 : 0);
            $oContendor->getPrevio()->setSeparacion($x2 == 1 ? 1 : 0);
            $oContendor->getPrevio()->setOcular($x3 == 1 ? 1 : 0);
            $oContendor->getPrevio()->setRevConautoridad($x4 == 1 ? 1 : 0);
            $oContendor->getPrevio()->setEtiquetado($x5 == 1 ? 1 : 0);
        }

        try{
            if($oContendor->insertarCargaContenerizada($_POST['operacion']) == 1){
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
    }else if( isset($_POST['txtSelloColocado']) && !empty($_POST['txtSelloColocado']) &&
                  isset($_POST['txtCantiBultos']) && !empty($_POST['txtCantiBultos']) &&
                    $_POST['operacion'] == 'CargaSuelta'){
            $daños = $_POST['daños'];
            $bultos = $_POST['bultosPresen'];
            $previos = $_POST['Previos'];
            $oContendor->setReferencia60(new Sir60Referencias());
            $oContendor->setConten(new Contenedor());
            $oContendor->setDaño(new  Danios());
            $oContendor->setMercancia(new Mercancia());
            $oContendor->setPrevio(new Previo());
            $oContendor->setPeso($_POST['txtPeso'] != null ? $_POST['txtPeso'] : 0);
            $oContendor->getReferencia60()->setReferencia($_POST['txtRef']);
            $oContendor->getConten()->setNumeroContenedor($_POST['txtNumConten']);
            $oContendor->getConten()->setTamaño($_POST['tamaño']);
            $oContendor->getConten()->setTipo($_POST['tipo']);
            $oContendor->getConten()->setSelloOrigen($_POST['txtSellos']);
            $oContendor->getConten()->setSelloColocado($_POST['txtSelloColocado']);
            $oContendor->getConten()->setPeso($_POST['Peso']);
            $oContendor->getConten()->setIMO($_POST['imo']);

            $oContendor->getConten()->setCantidadBultos($_POST['txtCantiBultos']);
            $oContendor->getConten()->setBultosDañados($_POST['bDañados']);
            $oContendor->getConten()->setBultosDañados($_POST['bDañados']);
            if($_POST['bDañados'] == 1){
                $oContendor->getConten()->setCantBultDañados($_POST['txtCantiDañados']);
            }else if($_POST['bDañados'] == 0){
                $oContendor->getConten()->setCantBultDañados(0);
            }

            $z1 = 0; $z2 =0; $z3 = 0; $z4 = 0; $z5 = 0; $z6 = 0; $z7 = 0; $z8 = 0; $z9 = 0; $z10 = 0; $z11 = 0; $z12 = 0;
            for ($i = 0; $i < count($bultos) ; $i++){
                if ($bultos[$i] == 'PalletsMadera'){
                    $z1 = 1;
                }elseif ($bultos[$i] == 'PalletsPlastico'){
                    $z2 = 1;
                }elseif ($bultos[$i] == 'Cartonada'){
                    $z3 = 1;
                }elseif ($bultos[$i] == 'Cuñetes'){
                    $z4 = 1;
                }elseif ($bultos[$i] == 'Sacos'){
                    $z5 = 1;
                }elseif ($bultos[$i] == 'SuperBolsas'){
                    $z6 = 1;
                }elseif ($bultos[$i] == 'Bidones'){
                    $z7 = 1;
                }elseif ($bultos[$i] == 'Cont1000L'){
                    $z8 = 1;
                }elseif ($bultos[$i] == 'HuacalesMadera'){
                    $z9 = 1;
                }elseif ($bultos[$i] == 'CajasMadera'){
                    $z10 = 1;
                }elseif ($bultos[$i] == 'RacksMetalicos'){
                    $z11 = 1;
                }elseif ($bultos[$i] == 'Granel'){
                    $z12 = 1;
                }
            }
            $oContendor->getConten()->setPalletsMadera($z1 == 1 ? 1 : 0);
            $oContendor->getConten()->setPalletsPlastico($z2 == 1 ? 1 : 0);
            $oContendor->getConten()->setCartonada($z3 == 1 ? 1 : 0 );
            $oContendor->getConten()->setCuñetes($z4 == 1 ? 1 : 0 );
            $oContendor->getConten()->setSacos($z5 == 1 ? 1 : 0);
            $oContendor->getConten()->setSuperBolsas($z6 == 1 ? 1 : 0  );
            $oContendor->getConten()->setBidones($z7 == 1 ? 1 : 0 );
            $oContendor->getConten()->setCont1000L($z8 == 1 ? 1 : 0);
            $oContendor->getConten()->setHuacalesMadera($z9 == 1 ? 1 : 0);
            $oContendor->getConten()->setCajasMadera($z10 == 1 ? 1 : 0 );
            $oContendor->getConten()->setRacksMetalicos($z11 == 1 ? 1 : 0);
            $oContendor->getConten()->setGranel($z12 == 1 ? 1 : 0);

            $oContendor->getConten()->setOtros($_POST['txtOtrosPresen'] == "" ? 'No se registraron otras presentaciones' : $_POST['txtOtrosPresen']);
            if ($_POST['averias'] == 1) {
                $oContendor->getConten()->setAveriasOrigen(1);
                $oContendor->getConten()->setAveriasRecinto(0);
            }else if($_POST['averias'] ==  0){
                $oContendor->getConten()->setAveriasRecinto(1);
                $oContendor->getConten()->setAveriasOrigen(0);
            }
            $oContendor->getConten()->setFumigado($_POST['txtFumigado']);
            if ($_POST['mercancia'] == 1){
                $oContendor->getMercancia()->setConformeFactura(1);
                $oContendor->getMercancia()->setFaltante(0);
                $oContendor->getMercancia()->setSobrante(0);
                $oContendor->getMercancia()->setCantidad(0);

            }else if ($_POST['mercancia'] == 2){
                $oContendor->getMercancia()->setFaltante(1);
                $oContendor->getMercancia()->setCantidad($_POST['txtCanMer1']);
                $oContendor->getMercancia()->setConformeFactura(0);
                $oContendor->getMercancia()->setSobrante(0);
            }else if( $_POST['mercancia' == 3])
            {
                $oContendor->getMercancia()->setSobrante(1);
                $oContendor->getMercancia()->setCantidad($_POST['txtCanMer1']);
                $oContendor->getMercancia()->setConformeFactura(0);
                $oContendor->getMercancia()->setFaltante(0);
            }

            $x1 = 0; $x2= 0; $x3 = 0; $x4 = 0; $x5 = 0;
            for ($i = 0 ; $i < count($previos);$i++){
                if ($previos[$i] == 'DesYCon'){
                    $x1 = 1;
                }elseif ($previos[$i] == 'Separacion'){
                    $x2= 1;
                }elseif ($previos[$i] == 'Ocular'){
                    $x3 = 1;
                }elseif ($previos[$i] == 'RevisionC/Autoridad'){
                    $x4= 1;
                }elseif ($previos[$i] == 'Etiquetado'){
                    $x5 = 1;
                }
            }

            $oContendor->getPrevio()->setDesYCon($x1 == 1 ? 1 : 0);
            $oContendor->getPrevio()->setSeparacion($x2 == 1 ? 1 : 0);
            $oContendor->getPrevio()->setOcular($x3 == 1 ? 1 : 0);
            $oContendor->getPrevio()->setRevConautoridad($x4 == 1 ? 1 : 0);
            $oContendor->getPrevio()->setEtiquetado($x5 == 1 ? 1 : 0);
            $oContendor->getConten()->setBL($_POST['txtBL']);




        try{
            if($oContendor->insertarCargaContenerizada($_POST['operacion']) == 1){
                var_dump($oContendor);
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

}else{
    $sErr = "Faltan datos de Sesión";
}

if($sErr != ""){
    header("Location: ../error.php?sError=".$sErr);
}
?>