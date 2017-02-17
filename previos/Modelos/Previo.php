<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 25/01/2017
 * Time: 01:14 PM
 */
include_once ("AccesoDatos.php");
include_once ("Sir60Referencias.php");
include_once ("Sir76Contenedores.php");
include_once ("Contenedor.php");
include_once ("Mercancia.php");
class Previo
{
    private $sNumeroContenedor = "";
    private $oReferencia = null;
    private $nDesYCon = 0;
    private $nOcular = 0;
    private $nEtiquetado = 0;
    private $nSeparacion = 0;
    private $nRevConAutoridad = 0;
    private $oContenedor = null;
    private $oMercancia = null;
    private $oSir76 = null;
    private $sObsClasificador = "";


    public function getObsClasificador()
    {
        return $this->sObsClasificador;
    }

    public function setObsClasificador($sObsClasificador)
    {
        $this->sObsClasificador = $sObsClasificador;
    }

    public function getSir76()
    {
        return $this->oSir76;
    }

    public function setSir76($oSir76)
    {
        $this->oSir76 = $oSir76;
    }


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
        return $this->oReferencia;
    }


    public function setReferencia($oReferencia)
    {
        $this->oReferencia = $oReferencia;
    }


    public function getDesYCon()
    {
        return $this->nDesYCon;
    }


    public function setDesYCon($nDesYCon)
    {
        $this->nDesYCon = $nDesYCon;
    }


    public function getOcular()
    {
        return $this->nOcular;
    }


    public function setOcular($nOcular)
    {
        $this->nOcular = $nOcular;
    }


    public function getEtiquetado()
    {
        return $this->nEtiquetado;
    }


    public function setEtiquetado($nEtiquetado)
    {
        $this->nEtiquetado = $nEtiquetado;
    }


    public function getSeparacion()
    {
        return $this->nSeparacion;
    }


    public function setSeparacion($nSeparacion)
    {
        $this->nSeparacion = $nSeparacion;
    }


    public function getRevConAutoridad()
    {
        return $this->nRevConAutoridad;
    }


    public function setRevConAutoridad($nRevConAutoridad)
    {
        $this->nRevConAutoridad = $nRevConAutoridad;
    }


    public function getContenedor()
    {
        return $this->oContenedor;
    }


    public function setOContenedor($oContenedor)
    {
        $this->oContenedor = $oContenedor;
    }


    public function getMercancia()
    {
        return $this->oMercancia;
    }


    public function setMercancia($oMercancia)
    {
        $this->oMercancia = $oMercancia;
    }


}