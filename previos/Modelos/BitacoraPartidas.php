<?php

/**
 * Created by PhpStorm.
 * User: SISTEMAS-PABLO
 * Date: 11/03/2017
 * Time: 09:48 AM
 */
include_once ("AccesoDatos2.php");
include_once ("Sir60Referencias.php");
include_once ("Sir52Facturas.php");
class BitacoraPartidas
{

    private  $nIdBitacora = 0;
    private  $sUsuario = "";
    private  $oReferencia60 = null;
    private  $dFechaModificacion = null;
    private  $sFactura52 = "";
    private  $sAccion = "";
    private  $sTabla = "";
    private  $oAD = null;


    public function getIdBitacora()
    {
        return $this->nIdBitacora;
    }


    public function setIdBitacora($nIdBitacora)
    {
        $this->nIdBitacora = $nIdBitacora;
    }


    public function getUsuario()
    {
        return $this->sUsuario;
    }


    public function setUsuario($sUsuario)
    {
        $this->sUsuario = $sUsuario;
    }


    public function getReferencia60()
    {
        return $this->oReferencia60;
    }


    public function setReferencia60($oReferencia60)
    {
        $this->oReferencia60 = $oReferencia60;
    }


    public function getFechaModificacion()
    {
        return $this->dFechaModificacion;
    }


    public function setFechaModificacion($dFechaModificacion)
    {
        $this->dFechaModificacion = $dFechaModificacion;
    }


    public function getFactura52()
    {
        return $this->sFactura52;
    }


    public function setFactura52($sFactura52)
    {
        $this->sFactura52 = $sFactura52;
    }


    public function getAccion()
    {
        return $this->sAccion;
    }

    public function setAccion($sAccion)
    {
        $this->sAccion = $sAccion;
    }


    public function getTabla()
    {
        return $this->sTabla;
    }


    public function setTabla($sTabla)
    {
        $this->sTabla = $sTabla;
    }


    public function getAD()
    {
        return $this->oAD;
    }


    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }



    function buscarBitacoraPartidas (){

        $oAD = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $i = 0;
        $vOBj = null;
        $oBitacora = null;
        if($this->getReferencia60()->getReferencia() == ""){
            throw new Exception("BitacoraPartidas->buscarBitacoraPartida() : error faltan datos");
        }else{
            $sQuery = "exec [Previos].[dbo].consultarBitacora '".$this->getReferencia60()->getReferencia()."';";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
            if ($rst != null){
                foreach ($rst as $vRow)
                {
                    $oBitacora = new BitacoraPartidas();
                    $oBitacora->setFactura52(new Facturas());
                    $oBitacora->getFactura52()->setNumero($vRow[0]);
                    $oBitacora->getFactura52()->setItem($vRow[1]);
                    $oBitacora->setUsuario($vRow[2]);
                    $oBitacora->setFechaModificacion(date_format($vRow[3],'Y-m-d H:i:s'));
                    $oBitacora->setAccion($vRow[4]);
                    $vOBj[$i] = $oBitacora;
                    $i = $i + 1;
                }

            }else{
                $vOBj = false;
            }
        }
        return $vOBj;
    }

    function insetarBitacoraPartidas($sUsuario){
        $oAD = new AccesoDatos2();
        $sQuery = "";
        $nAfec = 0;

        if($this->getReferencia60()->getReferencia() == "" and $this->getFactura52()->getNumero() == "" and $this->getFactura52()->getItem() == 0){
           throw new Exception("BitacoraPartidas()->insertarBitacoraPartidas() : error faltan datos");
        }else{
            $sQuery = "exec [Previos].[dbo].insertarBitacoraPartidas '".$sUsuario."','".$this->getReferencia60()->getReferencia()."',
            '".$this->getFechaModificacion()."',
            '".$this->getFactura52()->getNumero()."',
            ".$this->getFactura52()->getItem().",
            '".$this->getAccion()."',
            '".$this->getTabla()."';";

            $nAfec = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        return $nAfec;
    }

}