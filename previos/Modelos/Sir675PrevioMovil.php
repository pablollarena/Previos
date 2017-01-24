<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 19/01/2017
 * Time: 06:13 PM
 */
include_once ("AccesoDatos.php");
class Sir675PrevioMovil
{
    private $oAD = null;
    private $nIdPrevioMovil675 = 0;
    private $dSeleccion = null;


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getIdPrevioMovil675()
    {
        return $this->nIdPrevioMovil675;
    }

    public function setIdPrevioMovil675($nIdPrevioMovil675)
    {
        $this->nIdPrevioMovil675 = $nIdPrevioMovil675;
    }

    public function getSeleccion()
    {
        return $this->dSeleccion;
    }

    public function setSeleccion($dSeleccion)
    {
        $this->dSeleccion = $dSeleccion;
    }

}