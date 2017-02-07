<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 24/01/2017
 * Time: 04:30 PM
 */
include_once ("AccesoDatos.php");

class Sir09TiposContenedor
{
        private  $nIdTipoContenedor09 = 0;
        private  $sDimension = "";

    public function getIdTipoContenedor09()
    {
        return $this->nIdTipoContenedor09;
    }


    public function setIdTipoContenedor09($nIdTipoContenedor09)
    {
        $this->nIdTipoContenedor09 = $nIdTipoContenedor09;
    }


    public function getDimension()
    {
        return $this->sDimension;
    }


    public function setDimension($sDimension)
    {
        $this->sDimension = $sDimension;
    }

    public function getIniciales()
    {
        return $this->sIniciales;
    }


    public function setIniciales($sIniciales)
    {
        $this->sIniciales = $sIniciales;
    }
        private  $sIniciales = "";
}