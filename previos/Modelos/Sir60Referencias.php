<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 19/01/2017
 * Time: 06:28 PM
 */
include_once ("AccesoDatos.php");
include_once ("Persona.php");
include_once ("Sir161ProgPreviosRef.php");
include_once ("cat_clientes.php");
include_once ("Sir675PrevioMovil.php");
include_once ("Sir132TipoPrevio.php");
include_once ("Sir311RecintosFiscalizados.php");
class Sir60Referencias
{
    private $oAD = null;
    private $nIdReferencia = 0;
    private $sReferencia = "";
    private $oSir161 = null;
    private $oCatCli = null;
    private $oSir675 = null;
    private $oSir132 = null;
    private $oSir311 = null;
    private $oPersona = null;


    public function getPersona()
    {
        return $this->oPersona;
    }


    public function setPersona($oPersona)
    {
        $this->oPersona = $oPersona;
    }


    public function getAD()
    {
        return $this->oAD;
    }


    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }


    public function getIdReferencia()
    {
        return $this->nIdReferencia;
    }


    public function setIdReferencia($nIdReferencia)
    {
        $this->nIdReferencia = $nIdReferencia;
    }


    public function getReferencia()
    {
        return $this->sReferencia;
    }


    public function setReferencia($sReferencia)
    {
        $this->sReferencia = $sReferencia;
    }


    public function getSir161()
    {
        return $this->oSir161;
    }


    public function setSir161($oSir161)
    {
        $this->oSir161 = $oSir161;
    }


    public function getCatCli()
    {
        return $this->oCatCli;
    }


    public function setCatCli($oCatCli)
    {
        $this->oCatCli = $oCatCli;
    }


    public function getSir675()
    {
        return $this->oSir675;
    }


    public function setSir675($oSir675)
    {
        $this->oSir675 = $oSir675;
    }


    public function getSir132()
    {
        return $this->oSir132;
    }


    public function setSir132($oSir132)
    {
        $this->oSir132 = $oSir132;
    }


    public function getSir311()
    {
        return $this->oSir311;
    }


    public function setSir311($oSir311)
    {
        $this->oSir311 = $oSir311;
    }


    function  buscarReferencias(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $i = 0;
        $oSir60 = null;
        if($this->getPersona()->getIdPersona() == 0){
            throw new Exception("Sir60Referencias->buscarReferencias() : error faltan datos");
        }else{
            $sQuery = "exec [1G_TRIMEX].[dbo].buscarRefAsignadas ".$this->getPersona()->getIdPersona().";";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
            if($rst){
                foreach ($rst as $vRow){
                    $oSir60 = new Sir60Referencias();
                    $oSir60->setCatCli(new cat_clientes());
                    $oSir60->setSir132(new Sir132TipoPrevio());
                    $oSir60->setSir675(new Sir675PrevioMovil());
                    $oSir60->setSir161(new Sir161ProgPreviosRef());
                    $oSir60->setSir311(new Sir311RecintosFiscalizados());
                    $oSir60->setIdReferencia($vRow[0]);
                    $oSir60->getCatCli()->setNom1($vRow[1]);
                    $oSir60->getSir132()->setDescrip($vRow[2]);
                    $oSir60->getSir675()->setSeleccion($vRow[3]);
                    $oSir60->getSir311()->setCiudad($vRow[4]);
                    $vObj[$i] = $oSir60;
                    $i = $i + 1;
                }
            }else{
                $vObj = false;
            }
        }
        return $vObj;
    }


}