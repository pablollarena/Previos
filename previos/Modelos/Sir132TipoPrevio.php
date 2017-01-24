<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 19/01/2017
 * Time: 06:22 PM
 */
include_once ("AccesoDatos.php");
class Sir132TipoPrevio
{


    private $oAD = null;
    private  $nIdTipoPrevio132 = 0;
    private  $sDescrip = "";


    public function getAD()
    {
        return $this->oAD;
    }


    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }


    public function getIdTipoPrevio132()
    {
        return $this->nIdTipoPrevio132;
    }


    public function setIdTipoPrevio132($nIdTipoPrevio132)
    {
        $this->nIdTipoPrevio132 = $nIdTipoPrevio132;
    }


    public function getDescrip()
    {
        return $this->sDescrip;
    }


    public function setDescrip($sDescrip)
    {
        $this->sDescrip = $sDescrip;
    }


}