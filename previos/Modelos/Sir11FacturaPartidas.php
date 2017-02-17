<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 10/02/2017
 * Time: 05:28 PM
 */
include_once ("AccesoDatos.php");
include_once ("Sir60Referencias.php");
include_once ("Sir52Facturas.php");
class Sir11FacturaPartidas
{
    private $oAD = null;
    private $oSir60 = null;
    private $oSir52 = null;
    private $nPartida = 0;
    private $sOrigen = "";
    private $nPeso = 0;
    private $sUsuario = "";


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getSir60()
    {
        return $this->oSir60;
    }

    public function setSir60($oSir60)
    {
        $this->oSir60 = $oSir60;
    }

    public function getSir52()
    {
        return $this->oSir52;
    }

    public function setSir52($oSir52)
    {
        $this->oSir52 = $oSir52;
    }

    public function getPartida()
    {
        return $this->nPartida;
    }

    public function setPartida($nPartida)
    {
        $this->nPartida = $nPartida;
    }

    public function getOrigen()
    {
        return $this->sOrigen;
    }

    public function setOrigen($sOrigen)
    {
        $this->sOrigen = $sOrigen;
    }

    public function getPeso()
    {
        return $this->nPeso;
    }

    public function setPeso($nPeso)
    {
        $this->nPeso = $nPeso;
    }

    public function getUsuario()
    {
        return $this->sUsuario;
    }

    public function setUsuario($sUsuario)
    {
        $this->sUsuario = $sUsuario;
    }

}