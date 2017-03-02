<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 24/01/2017
 * Time: 04:11 PM
 */
include_once ("Sir60Referencias.php");
include_once ("AccesoDatos.php");
include_once ("Sir74ConocimientosMaritimos.php");
include_once ("Sir107ContenedorSello.php");
include_once  ("Sir09TiposContenedor.php");
include_once ("Contenedor.php");
include_once ("Danios.php");
include_once ("Mercancia.php");
include_once ("Previo.php");
class Sir76Contenedores
{
   private $nIdContendor = 0;
   private  $sNumero = 0;
   private  $nPeso = 0;
   private  $oReferencia60 = null;
   private  $oSir74 = null;
   private $oSir107 = null;
   private  $oSir09 = null;
   private $oAD = null;
    private $oConten= null;
    private $oDaño = null;
    private $oMercancia = null;
    private $oPrevio = null;


    public function getMercancia()
    {
        return $this->oMercancia;
    }


    public function setMercancia($oMercancia)
    {
        $this->oMercancia = $oMercancia;
    }

    public function getPrevio()
    {
        return $this->oPrevio;
    }


    public function setPrevio($oPrevio)
    {
        $this->oPrevio = $oPrevio;
    }

    public function getDaño()
    {
        return $this->oDaño;
    }

    public function setDaño($oDaño)
    {
        $this->oDaño = $oDaño;
    }


    public function getConten()
    {
        return $this->oConten;
    }

    public function setConten($oConten)
    {
        $this->oConten = $oConten;
    }

    public function getSir74()
    {
        return $this->oSir74;
    }


    public function setSir74($oSir74)
    {
        $this->oSir74 = $oSir74;
    }


    public function getSir107()
    {
        return $this->oSir107;
    }


    public function setSir107($oSir107)
    {
        $this->oSir107 = $oSir107;
    }


    public function getSir09()
    {
        return $this->oSir09;
    }


    public function setSir09($oSir09)
    {
        $this->oSir09 = $oSir09;
    }


    public function getAD()
    {
        return $this->oAD;
    }


    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }


    public function getIdContendor()
    {
        return $this->nIdContendor;
    }


    public function setIdContendor($nIdContendor)
    {
        $this->nIdContendor = $nIdContendor;
    }


    public function getNumero()
    {
        return $this->sNumero;
    }


    public function setNumero($sNumero)
    {
        $this->sNumero = $sNumero;
    }


    public function getPeso()
    {
        return $this->nPeso;
    }


    public function setPeso($nPeso)
    {
        $this->nPeso = $nPeso;
    }

    public function getReferencia60()
    {
        return $this->oReferencia60;
    }

    public function setReferencia60($oReferencia60)
    {
        $this->oReferencia60 = $oReferencia60;
    }

    function  buscarContenedoresPorRef(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $oCont = null;
        $oDan = null;
        $i=0;
        $oSir76 = null;
        if($this->getReferencia60()->getReferencia() == "" ){
            throw new Exception("Sir76Contenedores->buscarContenedoresPorRef(): faltan datos");
        }else{
                $sQuery = "exec [1G_TRIMEX].[dbo].ConsultarContenedorPorRef '".$this->getReferencia60()->getReferencia()."'; ";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    foreach ($rst as $vRow){
                        $oSir76 = new Sir76Contenedores();
                        $oSir76->setSir74(new Sir74ConocimientosMaritimos());
                        $oSir76->setSir107(new Sir107ContenedorSello());
                        $oSir76->setSir09(new Sir09TiposContenedor());
                        $oSir76->setNumero( $vRow[0]);
                        $oSir76->getSir74()->setNumeroBL($vRow[1]);
                        $oSir76->setPeso($vRow[2]);
                        $oSir76->getSir107()->setSellos($vRow[3]);
                        $oSir76->getSir09()->setDimension($vRow[4]);
                        $oSir76->getSir09()->setIniciales($vRow[5]);
                        $vObj[$i] = $oSir76;
                        $i=$i+1;
                    }
                }
        }
        return $vObj;
    }

    function  buscarContenedoresPorRef2(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $oCont = null;
        $oDan = null;
        $i=0;
        $oSir76 = null;
        $nTipo = $this->buscarTipoCarga();
        if($this->getReferencia60()->getReferencia() == "" ){
            throw new Exception("Sir76Contenedores->buscarContenedoresPorRef(): faltan datos");
        }else{
            if($nTipo == 1){
                $sQuery = "exec [1G_TRIMEX].[dbo].ConsultarContenedorPorRef '".$this->getReferencia60()->getReferencia()."'; ";

                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
                if($rst){
                    foreach ($rst as $vRow){
                        $oSir76 = new Sir76Contenedores();
                        $oSir76->setSir74(new Sir74ConocimientosMaritimos());
                        $oSir76->setSir107(new Sir107ContenedorSello());
                        $oSir76->setSir09(new Sir09TiposContenedor());
                        $oSir76->setNumero( $vRow[0]);
                        $oSir76->getSir74()->setNumeroBL($vRow[1]);
                        $oSir76->setPeso($vRow[2]);
                        $oSir76->getSir107()->setSellos($vRow[3]);
                        $oSir76->getSir09()->setDimension($vRow[4]);
                        $oSir76->getSir09()->setIniciales($vRow[5]);
                        $oSir76->setConten($this->buscarInfoContenedor($vRow[0], $this->getReferencia60()->getReferencia(), $nTipo));
                        $oSir76->setDaño($this->buscarDañosConten($this->getReferencia60()->getReferencia(),$vRow[0]));
                        $oSir76->setMercancia($this->buscarMercanciaConten($vRow[0], $this->getReferencia60()->getReferencia(), $nTipo));
                        $oSir76->setPrevio($this->buscarInfoPrevio($vRow[0], $this->getReferencia60()->getReferencia(),  $nTipo));
                        $vObj[$i] = $oSir76;
                        $i=$i+1;
                    }
                }
            }else if($nTipo == 2){
                $oSir76 = new Sir76Contenedores();
                $oSir76->setConten($this->buscarInfoContenedor(0, $this->getReferencia60()->getReferencia(), $nTipo));
                $oSir76->setMercancia($this->buscarMercanciaConten(0, $this->getReferencia60()->getReferencia(), $nTipo));
                $oSir76->setPrevio($this->buscarInfoPrevio(0, $this->getReferencia60()->getReferencia(),  $nTipo));
                $vObj[$i] = $oSir76;
            }
        }
        return $vObj;
    }

    function buscarInfoContenedor($nNumCon, $sNumRef, $nTipo){
        $oAD2 = new AccesoDatos2();
        $oContenedor = null;
        $rst = null;
        $sQuery = "";
        if($sNumRef == ""){
            throw new Exception("Contenedor->buscarInfoContenedor(): error, faltan datos");
        }else{
            if($nTipo == 1){
                $sQuery = "exec [Previos].[dbo].buscarInfoConten '".$nNumCon."','".$sNumRef."';";

                $rst = $oAD2->ejecutaQuery($sQuery);
                $oAD2->Desconecta();
                if($rst){
                    $oContenedor = new Contenedor();
                    $oContenedor->setNumeroContenedor($rst[0][1]);
                    $oContenedor->setIMO($rst[0][1]);
                    $oContenedor->setTamaño($rst[0][2]);
                    $oContenedor->setPeso($rst[0][3]);
                    $oContenedor->setTipo($rst [0][4]);
                    $oContenedor->setSelloOrigen($rst [0][5]);
                    $oContenedor->setSelloColocado($rst [0][6]);
                    $oContenedor->setPesoCarga($rst [0][7]);
                    $oContenedor->setCantidadBultos($rst [0][8]);
                    $oContenedor->setBultosDañados($rst[0][9]);
                    $oContenedor->setCantBultDañados($rst[0][10]);
                    $oContenedor->setPalletsMadera($rst [0][11]);
                    $oContenedor->setSacos($rst [0][12]);
                    $oContenedor->setHuacalesMadera($rst [0][13]);
                    $oContenedor->setPalletsPlastico($rst [0][14]);
                    $oContenedor->setSuperBolsas($rst [0][15]);
                    $oContenedor->setCajasMadera($rst[0][16]);
                    $oContenedor->setCartonada($rst [0][17]);
                    $oContenedor->setBidones($rst [0][18]);
                    $oContenedor->setRacksMetalicos($rst [0][19]);
                    $oContenedor->setCuñetes($rst [0][20]);
                    $oContenedor->setCont1000L($rst [0][21]);
                    $oContenedor->setGranel($rst [0][22]);
                    $oContenedor->setOtros($rst [0][23]);
                    $oContenedor->setAveriasOrigen($rst [0][24]);
                    $oContenedor->setAveriasRecinto($rst [0][25]);
                    $oContenedor->setFumigado($rst [0][26]);
                    $oContenedor->setRecintoPrevio($rst [0][27]);
                }
            }else if($nTipo == 2){
                $sQuery = "exec [Previos].[dbo].consultarCargaSuelta '".$sNumRef."';";
                $rst = $oAD2->ejecutaQuery($sQuery);
                $oAD2->Desconecta();
                if($rst){
                    $oContenedor = new Contenedor();
                    $oContenedor->setSelloOrigen($rst [0][0]);
                    $oContenedor->setSelloColocado($rst [0][1]);
                    $oContenedor->setPeso($rst[0][2]);
                    $oContenedor->setBL($rst [0][3]);
                    $oContenedor->setIMO($rst[0][4]);
                    $oContenedor->setCantidadBultos($rst [0][5]);
                    $oContenedor->setBultosDañados($rst[0][6]);
                    $oContenedor->setCantBultDañados($rst[0][7]);
                    $oContenedor->setPalletsMadera($rst [0][8]);
                    $oContenedor->setPalletsPlastico($rst [0][9]);
                    $oContenedor->setCartonada($rst [0][10]);
                    $oContenedor->setCuñetes($rst [0][11]);
                    $oContenedor->setSacos($rst [0][12]);
                    $oContenedor->setSuperBolsas($rst [0][13]);
                    $oContenedor->setBidones($rst [0][14]);
                    $oContenedor->setCont1000L($rst [0][15]);
                    $oContenedor->setHuacalesMadera($rst [0][16]);
                    $oContenedor->setCajasMadera($rst[0][17]);
                    $oContenedor->setRacksMetalicos($rst [0][18]);
                    $oContenedor->setGranel($rst [0][19]);
                    $oContenedor->setOtros($rst [0][20]);
                    $oContenedor->setAveriasOrigen($rst [0][21]);
                    $oContenedor->setAveriasRecinto($rst [0][22]);
                    $oContenedor->setFumigado($rst [0][23]);
                    $oContenedor->setRecintoPrevio($rst[0][24]);
                }
            }
        }
        return $oContenedor;
    }

    function buscarDañosConten($Referencia60,$nContenedor){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $oDaños = null;
        if($Referencia60 == "" ){
            throw new Exception("Danios->buscarDañosConten: error, faltan datos");
        }else{
            $sQuery = "exec [Previos].[dbo].buscarDañosConten '".$Referencia60."','".$nContenedor."';";
            $rst = $oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();
            if($rst){
                $oDaños = new Danios();
                $oDaños->setNumeroContenedor($rst[0][0]);
                $oDaños->setOrigen($rst[0][1]);
                $oDaños->setRecinto($rst[0][2]);
                $oDaños->setFrente($rst[0][3]);
                $oDaños->setPanelIzq($rst[0][4]);
                $oDaños->setPiso($rst[0][5]);
                $oDaños->setTecho($rst[0][6]);
                $oDaños->setPanelDer($rst[0][7]);
                $oDaños->setPuertas($rst[0][8]);
                $oDaños->setBarrasPuerta($rst[0][9]);
                $oDaños->setSeguros($rst[0][10]);
                $oDaños->setAbrazaderas($rst[0][11]);
                $oDaños->setLonasBarras($rst[0][12]);
                $oDaños->setOtros($rst[0][13]);
            }
        }
        return $oDaños;
    }

    function buscarMercanciaConten($nContenedor,$Referencia60, $nTipo){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $oMer = null;
        if($Referencia60 == ""){
            throw new Exception("Sir76Contenedores->buscarMercanciaConten(): error, faltan datos");
        }else{
            if($nTipo == 1){
                $sQuery = "exec [Previos].[dbo].buscarMercanciaPorReferencia '".$Referencia60."','".$nContenedor."';";
                $rst = $oAD2->ejecutaQuery($sQuery);
                $oAD2->Desconecta();
                if($rst){
                    $oMer = new Mercancia();
                    $oMer->setNumeroContenedor($rst[0][0]);
                    $oMer->setReferencia($rst[0][1]);
                    $oMer->setConformeFactura($rst[0][2]);
                    $oMer->setFaltante($rst[0][3]);
                    $oMer->setSobrante($rst[0][4]);
                    $oMer->setCantidad($rst[0][5]);
                }
            }else if($nTipo == 2){
                $sQuery = "exec [Previos].[dbo].consultarMercanciaCS '".$Referencia60."';";
                $rst = $oAD2->ejecutaQuery($sQuery);
                $oAD2->Desconecta();
                if($rst){
                    $oMer = new Mercancia();
                    $oMer->setReferencia($rst[0][0]);
                    $oMer->setConformeFactura($rst[0][1]);
                    $oMer->setFaltante($rst[0][2]);
                    $oMer->setSobrante($rst[0][3]);
                    $oMer->setCantidad($rst[0][4]);
                }
            }

        }
        return $oMer;
    }

    function buscarInfoPrevio($nContenedor,$Referencia60, $nTipo){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst =  null;
        $oPrevio = null;
        if($Referencia60 == ""){
            throw new Exception("Sir76Contenedores->buscarInfoPrevio(): error, faltan datos");
        }else{
            if($nTipo == 1){
                $sQuery = "exec [Previos].[dbo].buscarPrevioPorReferencia '".$Referencia60."','".$nContenedor."';";
                $rst = $oAD2->ejecutaQuery($sQuery);
                $oAD2->Desconecta();
                if($rst){
                    $oPrevio = new Previo();
                    $oPrevio->setNumeroContenedor($rst[0][0]);
                    $oPrevio->setReferencia($rst[0][1]);
                    $oPrevio->setDesYCon($rst[0][2]);
                    $oPrevio->setOcular($rst[0][3]);
                    $oPrevio->setEtiquetado($rst[0][4]);
                    $oPrevio->setSeparacion($rst[0][5]);
                    $oPrevio->setRevConAutoridad($rst[0][6]);
                }
            }else if($nTipo == 2){
                $sQuery = "exec [Previos].[dbo].consultarPrevioCS '".$Referencia60."';";
                $rst = $oAD2->ejecutaQuery($sQuery);
                $oAD2->Desconecta();
                if($rst){
                    $oPrevio = new Previo();
                    $oPrevio->setOcular($rst[0][0]);
                    $oPrevio->setEtiquetado($rst[0][1]);
                    $oPrevio->setSeparacion($rst[0][2]);
                    $oPrevio->setRevConAutoridad($rst[0][3]);
                    $oPrevio->setObsClasificador($rst[0][4]);
                }
            }

        }
        return $oPrevio;
    }

    function insertarCargaContenerizada($sOpe){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $nAfec = 0;
        if($sOpe == 'content'){
            $sQuery = "exec [Previos].[dbo].insertarDatosCarga '".$this->getConten()->getNumeroContenedor()."',
            '".$this->getReferencia60()->getReferencia()."',
             1,
             ".$this->getConten()->getIMO().",
             ".$this->getConten()->getTamaño().",
             ".$this->getConten()->getPeso().",
             '".$this->getConten()->getTipo()."',
             '".$this->getConten()->getSelloOrigen()."',
             '".$this->getConten()->getSelloColocado()."',
             ".$this->getPeso().",
             ".$this->getConten()->getCantidadBultos().",
             ".$this->getConten()->getBultosDañados().",
             ".$this->getConten()->getCantBultDañados().",
             ".$this->getConten()->getPalletsMadera().",
             ".$this->getConten()->getSacos().",
             ".$this->getConten()->getHuacalesMadera().",
             ".$this->getConten()->getPalletsPlastico().",
             ".$this->getConten()->getSuperBolsas().",
             ".$this->getConten()->getCajasMadera().",
             ".$this->getConten()->getCartonada().",
             ".$this->getConten()->getBidones().",
             ".$this->getConten()->getRacksMetalicos().",
             ".$this->getConten()->getCuñetes().",
             ".$this->getConten()->getCont1000L().",
             ".$this->getConten()->getGranel().",
             '".$this->getConten()->getOtros()."',
             ".$this->getConten()->getAveriasOrigen().",
             ".$this->getConten()->getAveriasRecinto().",
             '".$this->getConten()->getFumigado()."',
             1,
             'Sin BL',
             ".$this->getDaño()->getOrigen().",
             ".$this->getDaño()->getRecinto().", 
             ".$this->getDaño()->getFrente().",
             ".$this->getDaño()->getPanelIzq().",
             ".$this->getDaño()->getPiso().",
             ".$this->getDaño()->getTecho().",
             ".$this->getDaño()->getPanelDer().",
             ".$this->getDaño()->getPuertas().",
             ".$this->getDaño()->getBarrasPuerta().",
             ".$this->getDaño()->getSeguros().",
             ".$this->getDaño()->getAbrazaderas().",
             ".$this->getDaño()->getLonasBarras().",
             '".$this->getDaño()->getOtros()."',
             ".$this->getMercancia()->getConformeFactura().",
             ".$this->getMercancia()->getFaltante().",
             ".$this->getMercancia()->getSobrante().",
             ".$this->getMercancia()->getCantidad().",
             ".$this->getPrevio()->getDesYCon().",
             ".$this->getPrevio()->getOcular().",
             ".$this->getPrevio()->getEtiquetado().",
             ".$this->getPrevio()->getSeparacion().",
             ".$this->getPrevio()->getRevConAutoridad().",'Sin Observaciones',
             '".$this->getConten()->getRecintoPrevio()."';";
            $nAfec = $oAD2->ejecutaComando($sQuery);
            $oAD2->Desconecta();
        }else if ($sOpe == 'CargaSuelta'){
            $sQuery = "exec [Previos].[dbo].insertarDatosCarga '".$this->getConten()->getNumeroContenedor()."',
            '".$this->getReferencia60()->getReferencia()."',
             2,
             ".$this->getConten()->getIMO().",
             0,
             ".$this->getConten()->getPeso().",
             'NT',
             '".$this->getConten()->getSelloOrigen()."',
             '".$this->getConten()->getSelloColocado()."',
             0,
             ".$this->getConten()->getCantidadBultos().",
             ".$this->getConten()->getBultosDañados().",
             ".$this->getConten()->getCantBultDañados().",
             ".$this->getConten()->getPalletsMadera().",
             ".$this->getConten()->getSacos().",
             ".$this->getConten()->getHuacalesMadera().",
             ".$this->getConten()->getPalletsPlastico().",
             ".$this->getConten()->getSuperBolsas().",
             ".$this->getConten()->getCajasMadera().",
             ".$this->getConten()->getCartonada().",
             ".$this->getConten()->getBidones().",
             ".$this->getConten()->getRacksMetalicos().",
             ".$this->getConten()->getCuñetes().",
             ".$this->getConten()->getCont1000L().",
             ".$this->getConten()->getGranel().",
             '".$this->getConten()->getOtros()."',
             ".$this->getConten()->getAveriasOrigen().",
             ".$this->getConten()->getAveriasRecinto().",
             '".$this->getConten()->getFumigado()."',
             2,
             '".$this->getConten()->getBL()."',
             0,
             0,
             0,
             0,
             0,
             0,
             0,
             0,
             0,
             0,
             0,
             0,
             'nada',
             ".$this->getMercancia()->getConformeFactura().",
             ".$this->getMercancia()->getFaltante().",
             ".$this->getMercancia()->getSobrante().",
             ".$this->getMercancia()->getCantidad().",
             ".$this->getPrevio()->getDesYCon().",
             ".$this->getPrevio()->getOcular().",
             ".$this->getPrevio()->getEtiquetado().",
             ".$this->getPrevio()->getSeparacion().",
             ".$this->getPrevio()->getRevConAutoridad().",'Sin Observaciones',
             '".$this->getConten()->getRecintoPrevio()."';";
            $nAfec = $oAD2->ejecutaComando($sQuery);
            $oAD2->Desconecta();
        }
        return $nAfec;
    }

    function  buscarTipoCarga (){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $TipoCarga = 0;
        if($this->getReferencia60()->getReferencia() == ""){
            throw new Exception("Sir76Contenedores->buscarTipoCarga(): error, faltan datos");
        }else{
            $sQuery = "Exec [Previos].[dbo].TipoOperacion '".$this->getReferencia60()->getReferencia()."';";
            $rst  = $oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();
            if($rst){
                $TipoCarga = $rst[0][0];
            }
        }
        return $TipoCarga;
    }

    function validaContenedor($sRef, $sCont){
        $oAD2 = new AccesoDatos2();
        $sQuery ="";
        $rst = null;
        $bRet = false;
        if($sRef == "" AND $sCont == ""){
            throw new Exception("Sir76Contenedores->validaContenedor(): error, faltan datos");
        }else{
            $sQuery = "EXEC [Previos].[dbo].validarContenedor '".$sRef."','".$sCont."';";
            $rst = $oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();
            if(count($rst) == 1){
                $bRet = true;
            }
        }
        return $bRet;
    }

    function validaCarga($sRef){
        $oAD2 = new AccesoDatos2();
        $sQuery ="";
        $rst = null;
        $bRet = false;
        if($sRef == ""){
            throw new Exception("Sir76Contenedores->validaCarga(): error, faltan datos");
        }else{
            $sQuery = "EXEC [Previos].[dbo].varlidarCarga '".$sRef."';";
            $rst = $oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();
            if(count($rst) == 1){
                $bRet = true;
            }
        }
        return $bRet;
    }

    function actualizarInfoReferencia ($tipoOperacion){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $nAfec = 0;
        if ($tipoOperacion == 'content'){
            if ($this->getReferencia60()->getReferencia() == "" and $this->getNumero() == ""){
                throw new Exception("Sir76Contenedores->actualizarInfoReferencia(): error, faltan datos");
            }else{
                $sQuery = "EXEC [Previos].dbo.actualizarDatosCarga '".$this->getNumero()."',
                ".$this->getConten()->getIMO().",
                ".$this->getConten()->getTamaño().",
                ".$this->getConten()->getPeso().",
                '".$this->getConten()->getTipo()."',
                '".$this->getConten()->getSelloColocado()."',
                ".$this->getConten()->getPesoCarga().",
                ".$this->getConten()->getCantidadBultos().",
                ".$this->getConten()->getBultosDañados().",
                ".$this->getConten()->getCantBultDañados().",
                ".$this->getConten()->getPalletsMadera().",
                ".$this->getConten()->getSacos().",
                ".$this->getConten()->getHuacalesMadera().",
                ".$this->getConten()->getPalletsPlastico().",
                ".$this->getConten()->getSuperBolsas().",
                ".$this->getConten()->getCajasMadera().",
                ".$this->getConten()->getCartonada().",
                ".$this->getConten()->getBidones().",
                ".$this->getConten()->getRacksMetalicos().",
                ".$this->getConten()->getCuñetes().",
                ".$this->getConten()->getCont1000L().",
                ".$this->getConten()->getGranel().",
                '".$this->getConten()->getOtros()."',
                ".$this->getConten()->getAveriasOrigen().",
                ".$this->getConten()->getAveriasRecinto().",
                ".$this->getConten()->getFumigado().",
                '".$this->getReferencia60()->getReferencia()."',
                1,
                '".$this->getConten()->getRecintoPrevio()."',
                ".$this->getDaño()->getOrigen().",
                ".$this->getDaño()->getRecinto().",
                ".$this->getDaño()->getFrente().",
                ".$this->getDaño()->getPanelIzq().",
                ".$this->getDaño()->getPiso().",
                ".$this->getDaño()->getTecho().",
                ".$this->getDaño()->getPanelDer().",
                ".$this->getDaño()->getPuertas().",
                ".$this->getDaño()->getBarrasPuerta().",
                ".$this->getDaño()->getSeguros().",
                ".$this->getDaño()->getAbrazaderas().",
                ".$this->getDaño()->getLonasBarras().",
                '".$this->getDaño()->getOtros()."',
                ".$this->getMercancia()->getConformeFactura().",
                ".$this->getMercancia()->getFaltante().",
                ".$this->getMercancia()->getSobrante().",
                ".$this->getMercancia()->getCantidad().",
                ".$this->getPrevio()->getDesYCon().",
                ".$this->getPrevio()->getOcular().",
                ".$this->getPrevio()->getEtiquetado().",
                ".$this->getPrevio()->getSeparacion().",
                ".$this->getPrevio()->getRevConAutoridad().",
                '".$this->getConten()->getBL()."';";
                $nAfec = $oAD2->ejecutaComando($sQuery);
                $oAD2->Desconecta();
            }
        }else if($tipoOperacion == 'CargaSuelta'){
            if($this->getReferencia60()->getReferencia() == ""){
                throw new Exception("Sir76Contenedores->actualizarInfoReferencia(): error, faltan datos");
            }else{
                $sQuery = "EXEC [Previos].dbo.actualizarDatosCarga 'Sin Contenedor',
                ".$this->getConten()->getIMO().",
                0,
                ".$this->getConten()->getPesoCarga().",
                'no',
                '".$this->getConten()->getSelloColocado()."',
                ".$this->getConten()->getPesoCarga().",
                ".$this->getConten()->getCantidadBultos().",
                ".$this->getConten()->getBultosDañados().",
                ".$this->getConten()->getCantBultDañados().",
                ".$this->getConten()->getPalletsMadera().",
                ".$this->getConten()->getSacos().",
                ".$this->getConten()->getHuacalesMadera().",
                ".$this->getConten()->getPalletsPlastico().",
                ".$this->getConten()->getSuperBolsas().",
                ".$this->getConten()->getCajasMadera().",
                ".$this->getConten()->getCartonada().",
                ".$this->getConten()->getBidones().",
                ".$this->getConten()->getRacksMetalicos().",
                ".$this->getConten()->getCuñetes().",
                ".$this->getConten()->getCont1000L().",
                ".$this->getConten()->getGranel().",
                '".$this->getConten()->getOtros()."',
                ".$this->getConten()->getAveriasOrigen().",
                ".$this->getConten()->getAveriasRecinto().",
                '".$this->getConten()->getFumigado()."',
                '".$this->getReferencia60()->getReferencia()."',
                2,
                '".$this->getConten()->getRecintoPrevio()."',
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                0,
                'Sin otros daños',
                ".$this->getMercancia()->getConformeFactura().",
                ".$this->getMercancia()->getFaltante().",
                ".$this->getMercancia()->getSobrante().",
                ".$this->getMercancia()->getCantidad().",
                ".$this->getPrevio()->getDesYCon().",
                ".$this->getPrevio()->getOcular().",
                ".$this->getPrevio()->getEtiquetado().",
                ".$this->getPrevio()->getSeparacion().",
                ".$this->getPrevio()->getRevConAutoridad().",
                '".$this->getConten()->getBL()."';";
                $nAfec = $oAD2->ejecutaComando($sQuery);
                $oAD2->Desconecta();
            }

        }
        return $nAfec;
    }

}