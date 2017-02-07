<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 25/01/2017
 * Time: 12:53 PM
 */

include_once ("AccesoDatos2.php");
class Mercancia
{
    private $sNumeroContenedor = "";
    private $sReferencia = "";
    private $nConformeFactura = 0;
    private $nFaltante = 0;
    private $nSobrante = 0;
    private $nCantidad = 0;


    public function getNumeroContenedor()
    {
        return $this->sNumeroContenedor;
    }


    public function setNumeroContenedor($sNumeroContenedor)
    {
        $this->sNumeroContenedor = $sNumeroContenedor;
    }


    public function getReferencia()
    {
        return $this->sReferencia;
    }


    public function setReferencia($sReferencia)
    {
        $this->sReferencia = $sReferencia;
    }


    public function getConformeFactura()
    {
        return $this->nConformeFactura;
    }


    public function setConformeFactura($nConformeFactura)
    {
        $this->nConformeFactura = $nConformeFactura;
    }


    public function getFaltante()
    {
        return $this->nFaltante;
    }


    public function setFaltante($nFaltante)
    {
        $this->nFaltante = $nFaltante;
    }



    public function getSobrante()
    {
        return $this->nSobrante;
    }


    public function setSobrante($nSobrante)
    {
        $this->nSobrante = $nSobrante;
    }


    public function getCantidad()
    {
        return $this->nCantidad;
    }


    public function setCantidad($nCantidad)
    {
        $this->nCantidad = $nCantidad;
    }



}