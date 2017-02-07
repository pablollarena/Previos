<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 24/01/2017
 * Time: 04:25 PM
 */
include_once ("AccesoDatos.php");
class Sir107ContenedorSello
{
    private $nIdSello = 0;
    private $sSellos = "";


    public function getIdSello()
    {
        return $this->nIdSello;
    }


    public function setIdSello($nIdSello)
    {
        $this->nIdSello = $nIdSello;
    }


    public function getSellos()
    {
        return $this->sSellos;
    }


    public function setSellos($sSellos)
    {
        $this->sSellos = $sSellos;
    }


}