<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 24/01/2017
 * Time: 04:19 PM
 */

include_once ("AccesoDatos.php");
class Sir74ConocimientosMaritimos
{
        private  $nIdBl79 = 0;
        private  $nNumeroBL = 0;


    public function getIdBl79()
    {
        return $this->nIdBl79;
    }


    public function setIdBl79($nIdBl79)
    {
        $this->nIdBl79 = $nIdBl79;
    }


    public function getNumeroBL()
    {
        return $this->nNumeroBL;
    }


    public function setNumeroBL($nNumeroBL)
    {
        $this->nNumeroBL = $nNumeroBL;
    }


}