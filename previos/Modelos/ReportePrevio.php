<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 13/02/2017
 * Time: 01:07 PM
 */
include_once ("Sir52Facturas.php");
include_once ("Sir60Referencias.php");
include_once ("AccesoDatos.php");
include_once ("AccesoDatos2.php");
class ReportePrevio
{
    private $oAD = null;
    private $oAD2 = null;
    private $oSir60 = null;
    private $oSir52 = null;
    private $nCant = 0;
    private $nCompleta = 0;
    private $nFaltante = 0;
    private $nSobrante = 0;
    private $nPieza = 0;
    private $nJuego = 0;
    private $nOtro = 0;
    private $sOrigen = "";
    private $nPesoAprox = 0;
    private $sObservaciones = "";


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getAD2()
    {
        return $this->oAD2;
    }

    public function setAD2($oAD2)
    {
        $this->oAD2 = $oAD2;
    }

    public function getSir60()
    {
        return $this->oSir60;
    }

    public function setSir60($oSir60)
    {
        $this->oSir60 = $oSir60;
    }

    public function getSir52()
    {
        return $this->oSir52;
    }

    public function setSir52($oSir52)
    {
        $this->oSir52 = $oSir52;
    }

    public function getCant()
    {
        return $this->nCant;
    }

    public function setCant($nCant)
    {
        $this->nCant = $nCant;
    }

    public function getCompleta()
    {
        return $this->nCompleta;
    }

    public function setCompleta($nCompleta)
    {
        $this->nCompleta = $nCompleta;
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

    public function getPieza()
    {
        return $this->nPieza;
    }

    public function setPieza($nPieza)
    {
        $this->nPieza = $nPieza;
    }

    public function getJuego()
    {
        return $this->nJuego;
    }

    public function setJuego($nJuego)
    {
        $this->nJuego = $nJuego;
    }

    public function getOtro()
    {
        return $this->nOtro;
    }

    public function setOtro($nOtro)
    {
        $this->nOtro = $nOtro;
    }

    public function getOrigen()
    {
        return $this->sOrigen;
    }

    public function setOrigen($sOrigen)
    {
        $this->sOrigen = $sOrigen;
    }

    public function getPesoAprox()
    {
        return $this->nPesoAprox;
    }

    public function setPesoAprox($nPesoAprox)
    {
        $this->nPesoAprox = $nPesoAprox;
    }

    public function getObservaciones()
    {
        return $this->sObservaciones;
    }

    public function setObservaciones($sObservaciones)
    {
        $this->sObservaciones = $sObservaciones;
    }


    function buscarItemsPorFactura(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $i = 0;
        $oRep = null;
        if($this->getSir60()->getReferencia() == "" AND $this->getSir52()->getNumero() == ""){
            throw new Exception("ReportePrevio->buscarItemsPorFactura(): error, faltan datos");
        }else{
            $sQuery = "exec [1G_TRIMEX].[dbo].buscarPartida '".$this->getSir52()->getNumero()."','".$this->getSir60()->getReferencia()."';";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
            if($rst){
                foreach ($rst as $vRow){
                    $oRep = new ReportePrevio();
                    $oRep->setSir52(new Facturas());
                    $oRep->getSir52()->setItem($vRow[0]);
                    $vObj[$i] = $oRep;
                    $i = $i + 1;
                }
            }else{
                $vObj = false;
            }
        }
        return $vObj;
    }

    function insertarReportePrevio(){
        $oAD = new AccesoDatos2();
        $sQuery = "";
        $nAfec = 0;

        if($this->getSir60()->getReferencia() == "" AND $this->getSir52()->getNumero() == ""){
            throw  new Exception("ReportePrevio->insertarPartida(): error faltan datos ");
        }else{
            $sQuery = " exec [Previos].[dbo].insertarReportePrevio '".$this->getSir60()->getReferencia()."',
            '".$this->getSir52()->getNumero()."',
             ".$this->getSir52()->getItem().",
             ".$this->getCant().",
             ".$this->getCompleta().",
             ".$this->getFaltante().",
             ".$this->getSobrante().",
             ".$this->getPieza().",
             ".$this->getJuego().",
             ".$this->getOtro().",
             '".$this->getOrigen()."',
             ".$this->getPesoAprox().",
             '".$this->getObservaciones()."';";

            $nAfec = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();

        }
            return $nAfec;
    }

    function consultarInfoItem (){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $i = 0 ;
        $oReporte = null;

        if ($this->getSir60()->getReferencia() == "" and $this->getSir52()->getItem() == ""){
            throw new Exception("ReportePrevio->consultarInfoItem(): error faltan datos");
        }else{
            $sQuery = " exec [Previos].[dbo].consultarInfoItem '".$this->getSir60()->getReferencia()."','".$this->getSir52()->getNumero()."'; ";
            $rst = $oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();
            if ($rst){
                foreach ($rst as $vRow){
                    $oReporte = new ReportePrevio();
                    $oReporte->setSir52(new Facturas());
                    $oReporte->getSir52()->setNumero($vRow [1]);
                    $oReporte->getSir52()->setItem($vRow [2]);
                    $oReporte->setCant($vRow[3]);
                    $oReporte->setCompleta($vRow[4]);
                    $oReporte->setFaltante($vRow[5]);
                    $oReporte->setSobrante($vRow [6]);
                    $oReporte->setPieza($vRow[7]);
                    $oReporte->setJuego($vRow[8]);
                    $oReporte->setOtro($vRow[9]);
                    $oReporte->setOrigen($vRow[10]);
                    $oReporte->setPesoAprox($vRow[11]);
                    $oReporte->setObservaciones($vRow[12]);
                    $vObj[$i] = $oReporte;
                    $i = $i + 1 ;

                }
            }else{
                $vObj = false;
            }
            return $vObj;


        }

    }

    function validarItem ($sRef,$nItem,$nFactura){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $bRet = false;

        if($sRef == "" and $nItem == "" and $nFactura == ""){
            throw new Exception("ReportePrevio->validadItem(): error en los datos");

        }else{
            $sQuery = "exec validaPartidas '".$sRef."',".$nItem.",'".$nFactura."'; ";
            $rst = $oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();

            if (count($rst) == 1){
                $bRet = true;
            }
        }
        return $bRet;
    }

    function buscarInfoPartida(){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $bRet = false;
        if($this->getSir60()->getReferencia() == ""  && $this->getSir52()->getNumero() == "" and $this->getSir52()->getItem() == 0){
            throw new Exception("ReportePrevio->buscarInfoPartida(): error, faltan datos");
        }else{
            $sQuery = "EXEC [Previos].[dbo].buscarDatosPartida '".$this->getSir60()->getReferencia()."','".$this->getSir52()->getNumero()."',".$this->getSir52()->getItem().";";
            $rst = $oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();
            if($rst){
                $this->setCant($rst[0][0]);
                $this->setCompleta($rst[0][1]);
                $this->setFaltante($rst[0][2]);
                $this->setSobrante($rst[0][3]);
                $this->setPieza($rst[0][4]);
                $this->setJuego($rst[0][5]);
                $this->setOtro($rst[0][6]);
                $this->setOrigen($rst[0][7]);
                $this->setPesoAprox($rst[0][8]);
                $bRet = true;
            }
        }
    }

    function  updatePartida($sUsuario,$sAccion){
        $oAD = new AccesoDatos2();
        $sQuery = "";
        $nAfec = 0;

        if ($this->getSir60()->getReferencia() == ""  && $this->getSir52()->getNumero() == "" and $this->getSir52()->getItem() == 0)
        {
            throw  new Exception("ReportePrevio->updatePartida() : error faltan datos");
        }else{

            $sQuery = "exec [Previos].[dbo].updatePartidas '".$this->getSir60()->getReferencia()."',
                                                            '".$this->getSir52()->getNumero()."',
                                                            ".$this->getSir52()->getItem().",
                                                            ".$this->getCant().",
                                                             ".$this->getCompleta().",
                                                             ".$this->getFaltante().",
                                                             ".$this->getSobrante().",
                                                             ".$this->getPieza().",
                                                             ".$this->getJuego().",
                                                             ".$this->getOtro().",
                                                             '".$this->getOrigen()."',
                                                             ".$this->getPesoAprox().",
                                                             '".$this->getObservaciones()."',
                                                             '".$sUsuario."',
                                                             '".$sAccion."';";
            $nAfec = $oAD->ejecutaComando($sQuery);
        }
        return $nAfec;

    }

    function  estadoReferencia(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $bBand = false;

        if ($this->getSir60()->getReferencia() == "")
        {
            throw new Exception("ReportePrevio->estadoReferencia() : error faltan datos");
        }else {
            $sQuery = "exec [1G_TRIMEX].[dbo].buscarEstadoReferencia'".$this->getSir60()->getReferencia()."';";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();

            if ($rst != null){
              $bBand = true;
            }
        }
        return $bBand;
    }

    function buscarReporteReferencia(){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $i = 0;
        $oReporte = null;
        if($this->getSir60()->getReferencia() == ""){
            throw new Exception("ReportePrevio->buscarReportePrevio(): error, faltan datos");
        }else{
            $sQuery = "EXEC [Previos].[dbo].reportePartidas '".$this->getSir60()->getReferencia()."';";
            $rst = $oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();
            if ($rst){
                foreach ($rst as $vRow){
                    $oReporte = new ReportePrevio();
                    $oReporte->setSir52(new Facturas());
                    $oReporte->getSir52()->setNumero($vRow[0]);
                    $oReporte->getSir52()->setItem($vRow[1]);
                    $oReporte->setCant($vRow[2]);
                    $oReporte->setCompleta($vRow[3]);
                    $oReporte->setFaltante($vRow[4]);
                    $oReporte->setSobrante($vRow[5]);
                    $oReporte->setPieza($vRow[6]);
                    $oReporte->setJuego($vRow[7]);
                    $oReporte->setOtro($vRow[8]);
                    $oReporte->setOrigen($vRow[9]);
                    $oReporte->setPesoAprox($vRow[10]);
                    $oReporte->setObservaciones($vRow[11]);
                    $vObj[$i] = $oReporte;
                    $i = $i + 1;
                }
            }else{
                $vObj = false;
            }
        }
        return $vObj;
    }


}