<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 23/02/2017
 * Time: 04:23 PM
 */
include_once ("../Modelos/Sir76Contenedores.php");
session_start();
$oCarga = new Sir76Contenedores();
$sErr = "";

if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){

    if ($_POST['operacion'] == 'content') {
        $oCarga->setConten(new Contenedor());
        $oCarga->setDaño(new Danios());
        $oCarga->setMercancia(new  Mercancia());
        $oCarga->setReferencia60(new Sir60Referencias());
        $oCarga->setPrevio(new Previo());
        $oCarga->setNumero($_POST['txtNumConten']);
        $oCarga->getReferencia60()->setReferencia($_POST['txtRef']);
        $bultos = $_POST['bultosPresen'];
        $previos = $_POST['Previos'];
        $daños = $_POST['daños'];

        if(!empty($_POST['tamaño'])){
            $oCarga->getConten()->setTamaño($_POST['tamaño']);
        }else{
            $oCarga->getConten()->setTamaño($_POST['txtTamaño']);
        }

        if(!empty($_POST['tipo'])){
            $oCarga->getConten()->setTipo($_POST['tipo']);
        }else{
            $oCarga->getConten()->setTipo($_POST['txtTipo1']);
        }

        $oCarga->getConten()->setSelloOrigen($_POST['txtValorSello']);
        $oCarga->getConten()->setSelloColocado($_POST['txtSelloColocado']);
        $oCarga->getConten()->setPesoCarga($_POST['txtPesoCarga']);

        $v1 = 0;
        $v2 = 0;
        $v3 = 0;
        $v4 = 0;
        $v5 = 0;
        $v6 = 0;
        $v7 = 0;
        $v8 = 0;
        $v9 = 0;
        $v10 = 0;
        $v11 = 0;
        $v12 = 0;
        for ($i = 0; $i < count($daños); $i++) {
            if ($daños[$i] == 'Origen') {
                $v1 = 1;
            } elseif ($daños[$i] == 'Recinto') {
                $v2 = 1;
            } elseif ($daños[$i] == 'Frente') {
                $v3 = 1;
            } elseif ($daños[$i] == 'PanelIzq') {
                $v4 = 1;
            } elseif ($daños[$i] == 'Piso') {
                $v5 = 1;
            } elseif ($daños[$i] == 'Techo') {
                $v6 = 1;
            } elseif ($daños[$i] == 'PanelDer') {
                $v7 = 1;
            } elseif ($daños[$i] == 'Puertas') {
                $v8 = 1;
            } elseif ($daños[$i] == 'BarrasPuerta') {
                $v9 = 1;
            } elseif ($daños[$i] == 'Seguros') {
                $v10 = 1;
            } elseif ($daños[$i] == 'Abrazaderas') {
                $v11 = 1;
            } elseif ($daños[$i] == 'LonaBarra') {
                $v12 = 1;
            }
        }
        $oCarga->getDaño()->setOrigen($v1 == 1 ? 1 : 0);
        $oCarga->getDaño()->setRecinto($v2 == 1 ? 1 : 0);
        $oCarga->getDaño()->setFrente($v3 == 1 ? 1 : 0);
        $oCarga->getDaño()->setPanelIzq($v4 == 1 ? 1 : 0);
        $oCarga->getDaño()->setPiso($v5 == 1 ? 1 : 0);
        $oCarga->getDaño()->setTecho($v6 == 1 ? 1 : 0);
        $oCarga->getDaño()->setPanelDer($v7 == 1 ? 1 : 0);
        $oCarga->getDaño()->setPuertas($v8 == 1 ? 1 : 0);
        $oCarga->getDaño()->setBarrasPuerta($v9 == 1 ? 1 : 0);
        $oCarga->getDaño()->setSeguros($v10 == 1 ? 1 : 0);
        $oCarga->getDaño()->setAbrazaderas($v11 == 1 ? 1 : 0);
        $oCarga->getDaño()->setLonasBarras($v12 == 1 ? 1 : 0);
        $oCarga->getDaño()->setOtros($_POST['txtOtros'] == "" ? 'No se registraron otros daños' : $_POST['txtOtros']);
        $oCarga->getConten()->setCantidadBultos($_POST['txtCantiBultos']);


        if ($_POST['bDañados'] == 1) {
            $oCarga->getConten()->setBultosDañados($_POST['bDañados']);
            $oCarga->getConten()->setCantBultDañados($_POST['txtCantiDañados']);
        } else if ($_POST['bDañados'] == 0) {
            $oCarga->getConten()->setBultosDañados($_POST['bDañados']);
            $oCarga->getConten()->setCantBultDañados(0);
        }

        if ($_POST['bDañados'] == "") {
            if ($_POST['txtBultDañados'] == 1) {
                $oCarga->getConten()->setBultosDañados(1);
                $oCarga->getConten()->setCantBultDañados($_POST['txtCantBultDañados']);
            } else if (isset($_POST['txtBultDañados1'])) {
                $oCarga->getConten()->setBultosDañados(0);
                $oCarga->getConten()->setCantBultDañados($_POST['txtCantBultDañados1']);
            }
        }


        $z1 = 0;
        $z2 = 0;
        $z3 = 0;
        $z4 = 0;
        $z5 = 0;
        $z6 = 0;
        $z7 = 0;
        $z8 = 0;
        $z9 = 0;
        $z10 = 0;
        $z11 = 0;
        $z12 = 0;
        for ($j = 0; $j < count($bultos); $j++) {
            if ($bultos[$j] == 'PalletsMadera') {
                $z1 = 1;
            } elseif ($bultos[$j] == 'PalletsPlastico') {
                $z2 = 1;
            } elseif ($bultos[$j] == 'Cartonada') {
                $z3 = 1;
            } elseif ($bultos[$j] == 'Cuñetes') {
                $z4 = 1;
            } elseif ($bultos[$j] == 'Sacos') {
                $z5 = 1;
            } elseif ($bultos[$j] == 'SuperBolsas') {
                $z6 = 1;
            } elseif ($bultos[$j] == 'Bidones') {
                $z7 = 1;
            } elseif ($bultos[$j] == 'Cont1000L') {
                $z8 = 1;
            } elseif ($bultos[$j] == 'HuacalesMadera') {
                $z9 = 1;
            } elseif ($bultos[$j] == 'CajasMadera') {
                $z10 = 1;
            } elseif ($bultos[$j] == 'RacksMetalicos') {
                $z11 = 1;
            } elseif ($bultos[$j] == 'Granel') {
                $z12 = 1;
            }
        }
        $oCarga->getConten()->setPalletsMadera($z1 == 1 ? 1 : 0);
        $oCarga->getConten()->setPalletsPlastico($z2 == 1 ? 1 : 0);
        $oCarga->getConten()->setCartonada($z3 == 1 ? 1 : 0);
        $oCarga->getConten()->setCuñetes($z4 == 1 ? 1 : 0);
        $oCarga->getConten()->setSacos($z5 == 1 ? 1 : 0);
        $oCarga->getConten()->setSuperBolsas($z6 == 1 ? 1 : 0);
        $oCarga->getConten()->setBidones($z7 == 1 ? 1 : 0);
        $oCarga->getConten()->setCont1000L($z8 == 1 ? 1 : 0);
        $oCarga->getConten()->setHuacalesMadera($z9 == 1 ? 1 : 0);
        $oCarga->getConten()->setCajasMadera($z10 == 1 ? 1 : 0);
        $oCarga->getConten()->setRacksMetalicos($z11 == 1 ? 1 : 0);
        $oCarga->getConten()->setGranel($z12 == 1 ? 1 : 0);
        $oCarga->getConten()->setOtros($_POST['txtOtrosPresen'] == "" ? 'No se registraron otras presentaciones' : $_POST['txtOtrosPresen']);

        if ($_POST['averias'] == 1) {
            $oCarga->getConten()->setAveriasOrigen(1);
            $oCarga->getConten()->setAveriasRecinto(0);
        } else if ($_POST['averias'] == 0) {
            $oCarga->getConten()->setAveriasOrigen(0);
            $oCarga->getConten()->setAveriasRecinto(1);
        } else if (isset($_POST['AveriaOrigen']) && !empty($_POST['AveriaOrigen'])) {
            $oCarga->getConten()->setAveriasOrigen(1);
            $oCarga->getConten()->setAveriasRecinto(0);
        } else if (isset($_POST['AveriaRecinto']) && !empty($_POST['AveriaRecinto'])) {
            $oCarga->getConten()->setAveriasOrigen(0);
            $oCarga->getConten()->setAveriasRecinto(1);
        }

        if (!empty($_POST['fumigado'])) {
            $oCarga->getConten()->setFumigado($_POST['fumigado']);
        } else {
            $oCarga->getConten()->setFumigado($_POST['txtFumigado']);
        }

        if ($_POST['mercancia'] == 1) {
            $oCarga->getMercancia()->setConformeFactura(1);
            $oCarga->getMercancia()->setFaltante(0);
            $oCarga->getMercancia()->setSobrante(0);
            $oCarga->getMercancia()->setCantidad(0);
        } else if ($_POST['mercancia'] == 2) {
            $oCarga->getMercancia()->setFaltante(1);
            $oCarga->getMercancia()->setCantidad($_POST['txtCanMer1']);
            $oCarga->getMercancia()->setConformeFactura(0);
            $oCarga->getMercancia()->setSobrante(0);
        }else if($_POST['mercancia'] == 3){
            $oCarga->getMercancia()->setSobrante(1);
            $oCarga->getMercancia()->setCantidad($_POST['txtCanMer1']);
            $oCarga->getMercancia()->setConformeFactura(0);
            $oCarga->getMercancia()->setFaltante(0);
        }else if (empty($_POST['mercancia'])){
            if(isset($_POST['txtConforme']) && !empty($_POST['txtConforme'])){
                $oCarga->getMercancia()->setConformeFactura(1);
                $oCarga->getMercancia()->setFaltante(0);
                $oCarga->getMercancia()->setSobrante(0);
                $oCarga->getMercancia()->setCantidad(0);
            }else if (isset($_POST['txtFaltante']) && !empty($_POST['txtFaltante'])){
                $oCarga->getMercancia()->setFaltante(1);
                $oCarga->getMercancia()->setCantidad($_POST['txtCantidad1']);
                $oCarga->getMercancia()->setConformeFactura(0);
                $oCarga->getMercancia()->setSobrante(0);
            }else if (isset($_POST['txtSobrante']) && !empty($_POST['txtSobrante'])){
                $oCarga->getMercancia()->setSobrante(1);
                $oCarga->getMercancia()->setCantidad($_POST['txtCantidad2']);
                $oCarga->getMercancia()->setConformeFactura(0);
                $oCarga->getMercancia()->setFaltante(0);
            }
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

        $oCarga->getPrevio()->setDesYCon($x1 == 1 ? 1 : 0);
        $oCarga->getPrevio()->setSeparacion($x2 == 1 ? 1 : 0);
        $oCarga->getPrevio()->setOcular($x3 == 1 ? 1 : 0);
        $oCarga->getPrevio()->setRevConautoridad($x4 == 1 ? 1 : 0);
        $oCarga->getPrevio()->setEtiquetado($x5 == 1 ? 1 : 0);

        try{
            if($oCarga->actualizarInfoReferencia($_POST['operacion']) == 1){
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


    }else if ($_POST['operacion'] == 'CargaSuelta'){

        $oCarga->setConten(new Contenedor());
        $oCarga->setDaño(new Danios());
        $oCarga->setMercancia(new  Mercancia());
        $oCarga->setReferencia60(new Sir60Referencias());
        $oCarga->setPrevio(new Previo());
        $oCarga->setNumero($_POST['txtNumConten']);
        $oCarga->getReferencia60()->setReferencia($_POST['txtRef']);
        $bultos = $_POST['bultosPresen'];
        $previos = $_POST['Previos'];
        $daños = $_POST['daños'];


        if(!empty($_POST['tamaño'])){
            $oCarga->getConten()->setTamaño($_POST['tamaño']);
        }else{
            $oCarga->getConten()->setTamaño($_POST['txtTamaño']);
        }

        if(!empty($_POST['tipo'])){
            $oCarga->getConten()->setTipo($_POST['tipo']);
        }else{
            $oCarga->getConten()->setTipo($_POST['txtTipo1']);
        }
        $oCarga->getConten()->setIMO($_POST['txtIMO']);
        $oCarga->getConten()->setBL($_POST['txtBL']);
        $oCarga->getConten()->setSelloOrigen($_POST['txtSellos']);
        $oCarga->getConten()->setSelloColocado($_POST['txtSelloColocado']);
        $oCarga->getConten()->setPesoCarga($_POST['Peso']);
        $oCarga->getConten()->setCantidadBultos($_POST['txtCantiBultos']);

        if ($_POST['bDañados'] == 1) {
            $oCarga->getConten()->setBultosDañados($_POST['bDañados']);
            $oCarga->getConten()->setCantBultDañados($_POST['txtCantiDañados']);
        } else if ($_POST['bDañados'] == 0) {
            $oCarga->getConten()->setBultosDañados($_POST['bDañados']);
            $oCarga->getConten()->setCantBultDañados(0);
        }

        if ($_POST['bDañados'] == "") {
            if ($_POST['txtBultDañados'] == 1) {
                $oCarga->getConten()->setBultosDañados(1);
                $oCarga->getConten()->setCantBultDañados($_POST['txtCantBultDañados']);
            } else if (isset($_POST['txtBultDañados1'])) {
                $oCarga->getConten()->setBultosDañados(0);
                $oCarga->getConten()->setCantBultDañados($_POST['txtCantBultDañados1']);
            }
        }


        $z1 = 0;
        $z2 = 0;
        $z3 = 0;
        $z4 = 0;
        $z5 = 0;
        $z6 = 0;
        $z7 = 0;
        $z8 = 0;
        $z9 = 0;
        $z10 = 0;
        $z11 = 0;
        $z12 = 0;
        for ($j = 0; $j < count($bultos); $j++) {
            if ($bultos[$j] == 'PalletsMadera') {
                $z1 = 1;
            } elseif ($bultos[$j] == 'PalletsPlastico') {
                $z2 = 1;
            } elseif ($bultos[$j] == 'Cartonada') {
                $z3 = 1;
            } elseif ($bultos[$j] == 'Cuñetes') {
                $z4 = 1;
            } elseif ($bultos[$j] == 'Sacos') {
                $z5 = 1;
            } elseif ($bultos[$j] == 'SuperBolsas') {
                $z6 = 1;
            } elseif ($bultos[$j] == 'Bidones') {
                $z7 = 1;
            } elseif ($bultos[$j] == 'Cont1000L') {
                $z8 = 1;
            } elseif ($bultos[$j] == 'HuacalesMadera') {
                $z9 = 1;
            } elseif ($bultos[$j] == 'CajasMadera') {
                $z10 = 1;
            } elseif ($bultos[$j] == 'RacksMetalicos') {
                $z11 = 1;
            } elseif ($bultos[$j] == 'Granel') {
                $z12 = 1;
            }
        }
        $oCarga->getConten()->setPalletsMadera($z1 == 1 ? 1 : 0);
        $oCarga->getConten()->setPalletsPlastico($z2 == 1 ? 1 : 0);
        $oCarga->getConten()->setCartonada($z3 == 1 ? 1 : 0);
        $oCarga->getConten()->setCuñetes($z4 == 1 ? 1 : 0);
        $oCarga->getConten()->setSacos($z5 == 1 ? 1 : 0);
        $oCarga->getConten()->setSuperBolsas($z6 == 1 ? 1 : 0);
        $oCarga->getConten()->setBidones($z7 == 1 ? 1 : 0);
        $oCarga->getConten()->setCont1000L($z8 == 1 ? 1 : 0);
        $oCarga->getConten()->setHuacalesMadera($z9 == 1 ? 1 : 0);
        $oCarga->getConten()->setCajasMadera($z10 == 1 ? 1 : 0);
        $oCarga->getConten()->setRacksMetalicos($z11 == 1 ? 1 : 0);
        $oCarga->getConten()->setGranel($z12 == 1 ? 1 : 0);
        $oCarga->getConten()->setOtros($_POST['txtOtrosPresen'] == "" ? 'No se registraron otras presentaciones' : $_POST['txtOtrosPresen']);

        if ($_POST['averias'] == 1) {
            $oCarga->getConten()->setAveriasOrigen(1);
            $oCarga->getConten()->setAveriasRecinto(0);
        } else if ($_POST['averias'] == 0) {
            $oCarga->getConten()->setAveriasOrigen(0);
            $oCarga->getConten()->setAveriasRecinto(1);
        } else if (isset($_POST['AveriaOrigen']) && !empty($_POST['AveriaOrigen'])) {
            $oCarga->getConten()->setAveriasOrigen(1);
            $oCarga->getConten()->setAveriasRecinto(0);
        } else if (isset($_POST['AveriaRecinto']) && !empty($_POST['AveriaRecinto'])) {
            $oCarga->getConten()->setAveriasOrigen(0);
            $oCarga->getConten()->setAveriasRecinto(1);
        }

        if (!empty($_POST['fumigado'])) {
            $oCarga->getConten()->setFumigado($_POST['fumigado']);
        } else {
            $oCarga->getConten()->setFumigado($_POST['txtFumigado']);
        }

        if ($_POST['mercancia'] == 1) {
            $oCarga->getMercancia()->setConformeFactura(1);
            $oCarga->getMercancia()->setFaltante(0);
            $oCarga->getMercancia()->setSobrante(0);
            $oCarga->getMercancia()->setCantidad(0);
        } else if ($_POST['mercancia'] == 2) {
            $oCarga->getMercancia()->setFaltante(1);
            $oCarga->getMercancia()->setCantidad($_POST['txtCanMer1']);
            $oCarga->getMercancia()->setConformeFactura(0);
            $oCarga->getMercancia()->setSobrante(0);
        }else if($_POST['mercancia'] == 3){
            $oCarga->getMercancia()->setSobrante(1);
            $oCarga->getMercancia()->setCantidad($_POST['txtCanMer1']);
            $oCarga->getMercancia()->setConformeFactura(0);
            $oCarga->getMercancia()->setFaltante(0);
        }else if (empty($_POST['mercancia'])){
            if(isset($_POST['txtConforme']) && !empty($_POST['txtConforme'])){
                $oCarga->getMercancia()->setConformeFactura(1);
                $oCarga->getMercancia()->setFaltante(0);
                $oCarga->getMercancia()->setSobrante(0);
                $oCarga->getMercancia()->setCantidad(0);
            }else if (isset($_POST['txtFaltante']) && !empty($_POST['txtFaltante'])){
                $oCarga->getMercancia()->setFaltante(1);
                $oCarga->getMercancia()->setCantidad($_POST['txtCantidad1']);
                $oCarga->getMercancia()->setConformeFactura(0);
                $oCarga->getMercancia()->setSobrante(0);
            }else if (isset($_POST['txtSobrante']) && !empty($_POST['txtSobrante'])){
                $oCarga->getMercancia()->setSobrante(1);
                $oCarga->getMercancia()->setCantidad($_POST['txtCantidad2']);
                $oCarga->getMercancia()->setConformeFactura(0);
                $oCarga->getMercancia()->setFaltante(0);
            }
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

        $oCarga->getPrevio()->setDesYCon($x1 == 1 ? 1 : 0);
        $oCarga->getPrevio()->setSeparacion($x2 == 1 ? 1 : 0);
        $oCarga->getPrevio()->setOcular($x3 == 1 ? 1 : 0);
        $oCarga->getPrevio()->setRevConautoridad($x4 == 1 ? 1 : 0);
        $oCarga->getPrevio()->setEtiquetado($x5 == 1 ? 1 : 0);
        try{
            if($oCarga->actualizarInfoReferencia($_POST['operacion']) == 1){
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



}else{
    $sErr = "Faltan datos";
}
?>