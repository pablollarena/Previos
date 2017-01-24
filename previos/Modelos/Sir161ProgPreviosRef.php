<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 19/01/2017
 * Time: 06:16 PM
 */
include_once ("AccesoDatos.php");
class Sir161ProgPreviosRef
{
    private $oAD = null;
    private $nIdPrevRef161 = 0;


    public function getAD()
    {
        return $this->oAD;
    }


    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }


    public function getIdPrevRef161()
    {
        return $this->nIdPrevRef161;
    }


    public function setIdPrevRef161($nIdPrevRef161)
    {
        $this->nIdPrevRef161 = $nIdPrevRef161;
    }



}