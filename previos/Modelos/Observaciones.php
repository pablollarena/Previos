<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 20/02/2017
 * Time: 03:31 PM
 */

include_once ("AccesoDatos2.php");
include_once ("Sir60Referencias.php");
class Observaciones
{
    private $oAD2 = null;
    private $nIdObservacion = 0;
    private $oSir60 = null;
    private $sObservacion = "";
    private $sUsuario = "";
    private $dFecha = null;


    public function getAD2()
    {
        return $this->oAD2;
    }

    public function setAD2($oAD2)
    {
        $this->oAD2 = $oAD2;
    }

    public function getIdObservacion()
    {
        return $this->nIdObservacion;
    }

    public function setIdObservacion($nIdObservacion)
    {
        $this->nIdObservacion = $nIdObservacion;
    }

    public function getSir60()
    {
        return $this->oSir60;
    }

    public function setSir60($oSir60)
    {
        $this->oSir60 = $oSir60;
    }

    public function getObservacion()
    {
        return $this->sObservacion;
    }

    public function setObservacion($sObservacion)
    {
        $this->sObservacion = $sObservacion;
    }

    public function getUsuario()
    {
        return $this->sUsuario;
    }

    public function setUsuario($sUsuario)
    {
        $this->sUsuario = $sUsuario;
    }

    public function getFecha()
    {
        return $this->dFecha;
    }

    public function setFecha($dFecha)
    {
        $this->dFecha = $dFecha;
    }

    function buscarTodosObser(){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $oObser = null;
        $i = 0;
        if($this->getSir60()->getReferencia() == ""){
            throw new Exception("Observaciones->buscarTodosObser(): error, faltan datos");
        }else{
            $sQuery = "EXEC [Previos].[dbo].consultarObservaciones '".$this->getSir60()->getReferencia()."';";
            $rst = $oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();
            if($rst){
                foreach ($rst as $vRow){
                    $oObser = new Observaciones();
                    $oObser->setSir60(new Sir60Referencias());
                    $oObser->getSir60()->setReferencia($vRow[0]);
                    $oObser->setObservacion($vRow[1]);
                    $oObser->setUsuario($vRow[2]);
                    $oObser->setFecha(date_format($vRow[3],'Y-m-d H:i:s'));
                    $vObj[$i] = $oObser;
                    $i =  $i + 1;
                }
            }else{
                $vObj = false;
            }
        }
        return $vObj;
    }

    function insertarObservaciones(){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $nAfec = 0;

        if ($this->getSir60()->getReferencia() == ""){
            throw new  Exception("Observaciones->insertarObservaciones() : error faltan datos");
        }else{
            $sQuery = "exec [Previos].[dbo].insertarObservacion '".$this->getSir60()->getReferencia()."', 
            '".$this->getObservacion()."',
            '".$this->getUsuario()."',
            '".$this->getFecha()."';";
            $nAfec = $oAD2->ejecutaComando($sQuery);
            $oAD2->Desconecta();
        }
        return $nAfec;
    }


    function  validaReferencia(){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $i = false;

        if ($this->getSir60()->getReferencia() == ""){
            throw new Exception("Observaciones->validaReferencia() : error en los datos");
        }else{
            $sQuery = "exec [Previos].[dbo].validaReferencia '".$this->getSir60()->getReferencia()."'";
            $rst = $oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();

            if (count($rst) == 1){
                $i = true;
            }
        }
        return $i;

    }


}