<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 25/01/2017
 * Time: 01:00 PM
 */
include_once ("AccesoDatos2.php");
class Danios
{
    private $sNumeroContenedor = "";
    private $nOrigen = 0;
    private $nRecinto = 0;
    private $nFrente = 0;
    private $nPanelIzq = 0;
    private $nPiso = 0;
    private $nTecho = 0;
    private $nPanelDer = 0;
    private $nPuertas = 0;
    private $nBarrasPuerta = 0;
    private $nSeguros = 0;
    private $nAbrazaderas = 0;
    private $nLonasBarras = 0;
    private $sOtros = "";
    private $oAD2 = null;
    private $sReferencia = "";


    public function getReferencia()
    {
        return $this->sReferencia;
    }

    public function setReferencia($sReferencia)
    {
        $this->sReferencia = $sReferencia;
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


    public function getOrigen()
    {
        return $this->nOrigen;
    }


    public function setOrigen($nOrigen)
    {
        $this->nOrigen = $nOrigen;
    }


    public function getRecinto()
    {
        return $this->nRecinto;
    }


    public function setRecinto($nRecinto)
    {
        $this->nRecinto = $nRecinto;
    }


    public function getFrente()
    {
        return $this->nFrente;
    }


    public function setFrente($nFrente)
    {
        $this->nFrente = $nFrente;
    }


    public function getPanelIzq()
    {
        return $this->nPanelIzq;
    }

    public function setPanelIzq($nPanelIzq)
    {
        $this->nPanelIzq = $nPanelIzq;
    }


    public function getPiso()
    {
        return $this->nPiso;
    }


    public function setPiso($nPiso)
    {
        $this->nPiso = $nPiso;
    }


    public function getTecho()
    {
        return $this->nTecho;
    }


    public function setTecho($nTecho)
    {
        $this->nTecho = $nTecho;
    }


    public function getPanelDer()
    {
        return $this->nPanelDer;
    }


    public function setPanelDer($nPanelDer)
    {
        $this->nPanelDer = $nPanelDer;
    }


    public function getPuertas()
    {
        return $this->nPuertas;
    }


    public function setPuertas($nPuertas)
    {
        $this->nPuertas = $nPuertas;
    }


    public function getBarrasPuerta()
    {
        return $this->nBarrasPuerta;
    }


    public function setBarrasPuerta($nBarrasPuerta)
    {
        $this->nBarrasPuerta = $nBarrasPuerta;
    }


    public function getSeguros()
    {
        return $this->nSeguros;
    }


    public function setSeguros($nSeguros)
    {
        $this->nSeguros = $nSeguros;
    }


    public function getAbrazaderas()
    {
        return $this->nAbrazaderas;
    }


    public function setAbrazaderas($nAbrazaderas)
    {
        $this->nAbrazaderas = $nAbrazaderas;
    }


    public function getLonasBarras()
    {
        return $this->nLonasBarras;
    }


    public function setLonasBarras($nLonasBarras)
    {
        $this->nLonasBarras = $nLonasBarras;
    }


    public function getOtros()
    {
        return $this->sOtros;
    }


    public function setOtros($sOtros)
    {
        $this->sOtros = $sOtros;
    }

    function buscarDañosConten(){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $oDaños = null;
        if($this->getNumeroContenedor() == "" and $this->getReferencia() == ""){
            throw new Exception("Danios->buscarDañosConten: error, faltan datos");
        }else{
            $sQuery = "exec [Previos].[dbo].buscarDañosConten '".$this->getNumeroContenedor()."','".$this->getReferencia()."';";
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


}