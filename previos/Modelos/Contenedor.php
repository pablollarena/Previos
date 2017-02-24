<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 25/01/2017
 * Time: 12:01 PM
 */

include_once ("AccesoDatos2.php");
class Contenedor
{
    private  $sNumeroContenedor = "";
    private  $nIMO = 0;
    private $nTamaño= 0;
    private $nPeso = 0;
    private $nTipo = "";
    private $sSelloOrigen = "";
    private $sSelloColocado = "";
    private $nPesoCarga = 0;
    private $nCantidadBultos = 0;
    private $bBultosDañados = 0;
    private $nCantBultDañados = 0;
    private $nPalletsMadera = 0;
    private $nSacos = 0;
    private $nHuacalesMadera = 0;
    private $nPalletsPlastico = 0;
    private $nSuperBolsas = 0;
    private $nCajasMadera = 0;
    private $nCartonada = 0;
    private $nBidones = 0;
    private $RacksMetalicos = 0;
    private $nCuñetes = 0;
    private $Cont1000L = 0;
    private $nGranel = 0;
    private $sOtros = "";
    private $bAveriasOrigen = 0;
    private $bAveriasRecinto = 0;
    private $bFumigado = "";
    private $oAD2 = null;
    private $sSello = "";
    private $sBL = "";
    private $nPeso2 = 0;
    private $RecintoPrevio = "";


    public function getRecintoPrevio()
    {
        return $this->RecintoPrevio;
    }


    public function setRecintoPrevio($RecintoPrevio)
    {
        $this->RecintoPrevio = $RecintoPrevio;
    }


    public function getPeso2()
    {
        return $this->nPeso2;
    }


    public function setPeso2($nPeso2)
    {
        $this->nPeso2 = $nPeso2;
    }


    public function getSello()
    {
        return $this->sSello;
    }

    public function setSello($sSello)
    {
        $this->sSello = $sSello;
    }

    public function getBL()
    {
        return $this->sBL;
    }

    public function setBL($sBL)
    {
        $this->sBL = $sBL;
    }

    public function getAD2()
    {
        return $this->oAD2;
    }

    public function setAD2($oAD2)
    {
        $this->oAD2 = $oAD2;
    }


    public function getNumeroContenedor()
    {
        return $this->sNumeroContenedor;
    }


    public function setNumeroContenedor($sNumeroContenedor)
    {
        $this->sNumeroContenedor = $sNumeroContenedor;
    }


    public function getIMO()
    {
        return $this->nIMO;
    }


    public function setIMO($nIMO)
    {
        $this->nIMO = $nIMO;
    }


    public function getTamaño()
    {
        return $this->nTamaño;
    }


    public function setTamaño($nTamaño)
    {
        $this->nTamaño = $nTamaño;
    }


    public function getPeso()
    {
        return $this->nPeso;
    }


    public function setPeso($nPeso)
    {
        $this->nPeso = $nPeso;
    }


    public function getTipo()
    {
        return $this->nTipo;
    }


    public function setTipo($nTipo)
    {
        $this->nTipo = $nTipo;
    }


    public function getSelloOrigen()
    {
        return $this->sSelloOrigen;
    }


    public function setSelloOrigen($sSelloOrigen)
    {
        $this->sSelloOrigen = $sSelloOrigen;
    }


    public function getSelloColocado()
    {
        return $this->sSelloColocado;
    }


    public function setSelloColocado($sSelloColocado)
    {
        $this->sSelloColocado = $sSelloColocado;
    }


    public function getNPesoCarga()
    {
        return $this->nPesoCarga;
    }


    public function setPesoCarga($nPesoCarga)
    {
        $this->nPesoCarga = $nPesoCarga;
    }


    public function getCantidadBultos()
    {
        return $this->nCantidadBultos;
    }


    public function setCantidadBultos($nCantidadBultos)
    {
        $this->nCantidadBultos = $nCantidadBultos;
    }


    public function getBultosDañados()
    {
        return $this->bBultosDañados;
    }


    public function setBultosDañados($bBultosDañados)
    {
        $this->bBultosDañados = $bBultosDañados;
    }


    public function getCantBultDañados()
    {
        return $this->nCantBultDañados;
    }


    public function setCantBultDañados($nCantBultDañados)
    {
        $this->nCantBultDañados = $nCantBultDañados;
    }


    public function getPalletsMadera()
    {
        return $this->nPalletsMadera;
    }


    public function setPalletsMadera($nPalletsMadera)
    {
        $this->nPalletsMadera = $nPalletsMadera;
    }


    public function getSacos()
    {
        return $this->nSacos;
    }


    public function setSacos($nSacos)
    {
        $this->nSacos = $nSacos;
    }


    public function getHuacalesMadera()
    {
        return $this->nHuacalesMadera;
    }


    public function setHuacalesMadera($nHuacalesMadera)
    {
        $this->nHuacalesMadera = $nHuacalesMadera;
    }


    public function getPalletsPlastico()
    {
        return $this->nPalletsPlastico;
    }


    public function setPalletsPlastico($nPalletsPlastico)
    {
        $this->nPalletsPlastico = $nPalletsPlastico;
    }


    public function getSuperBolsas()
    {
        return $this->nSuperBolsas;
    }

    public function setSuperBolsas($nSuperBolsas)
    {
        $this->nSuperBolsas = $nSuperBolsas;
    }


    public function getCajasMadera()
    {
        return $this->nCajasMadera;
    }


    public function setCajasMadera($nCajasMadera)
    {
        $this->nCajasMadera = $nCajasMadera;
    }


    public function getCartonada()
    {
        return $this->nCartonada;
    }


    public function setCartonada($nCartonada)
    {
        $this->nCartonada = $nCartonada;
    }


    public function getBidones()
    {
        return $this->nBidones;
    }

    public function setBidones($nBidones)
    {
        $this->nBidones = $nBidones;
    }


    public function getRacksMetalicos()
    {
        return $this->RacksMetalicos;
    }


    public function setRacksMetalicos($RacksMetalicos)
    {
        $this->RacksMetalicos = $RacksMetalicos;
    }


    public function getCuñetes()
    {
        return $this->nCuñetes;
    }


    public function setCuñetes($nCuñetes)
    {
        $this->nCuñetes = $nCuñetes;
    }


    public function getCont1000L()
    {
        return $this->Cont1000L;
    }


    public function setCont1000L($Cont1000L)
    {
        $this->Cont1000L = $Cont1000L;
    }


    public function getGranel()
    {
        return $this->nGranel;
    }


    public function setGranel($nGranel)
    {
        $this->nGranel = $nGranel;
    }


    public function getOtros()
    {
        return $this->sOtros;
    }


    public function setOtros($sOtros)
    {
        $this->sOtros = $sOtros;
    }


    public function getAveriasOrigen()
    {
        return $this->bAveriasOrigen;
    }


    public function setAveriasOrigen($bAveriasOrigen)
    {
        $this->bAveriasOrigen = $bAveriasOrigen;
    }


    public function getAveriasRecinto()
    {
        return $this->bAveriasRecinto;
    }


    public function setAveriasRecinto($bAveriasRecinto)
    {
        $this->bAveriasRecinto = $bAveriasRecinto;
    }

    public function getFumigado()
    {
        return $this->bFumigado;
    }


    public function setFumigado($bFumigado)
    {
        $this->bFumigado = $bFumigado;
    }

    function buscarInfoContenedor(){
        $oAD2 = new AccesoDatos2();
        $oContenedor = null;
        $rst = null;
        $sQuery = "";
        if($this->getNumeroContenedor() == ""){
            throw new Exception("Contenedor->buscarInfoContenedor(): error, faltan datos");
        }else{
            $sQuery = "exec [Previos].[dbo].buscarInfoConten '".$this->getNumeroContenedor()."';";
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
        }
        return $oContenedor;
    }





}