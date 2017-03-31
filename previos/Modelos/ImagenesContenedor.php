<?php

/**
 * Created by PhpStorm.
 * User: SISTEMAS-PABLO
 * Date: 24/03/2017
 * Time: 11:20 AM
 */
include_once ("AccesoDatos2.php");
include_once ("Sir60Referencias.php");
include_once ("Sir76Contenedores.php");
class ImagenesContenedor
{
    private $oAD2 = null;
    private $oSir60 = null;
    private $oSir76 = null;
    private $sRuta = "";
    private $sNombreArchivo = "";


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

    public function getSir76()
    {
        return $this->oSir76;
    }

    public function setSir76($oSir76)
    {
        $this->oSir76 = $oSir76;
    }

    public function getRuta()
    {
        return $this->sRuta;
    }

    public function setRuta($sRuta)
    {
        $this->sRuta = $sRuta;
    }

    public function getNombreArchivo()
    {
        return $this->sNombreArchivo;
    }

    public function setNombreArchivo($sNombreArchivo)
    {
        $this->sNombreArchivo = $sNombreArchivo;
    }

    function buscarImagenesContenedor(){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $vObj = null;
        $rst = null;
        $i = 0;
        $oImg = null;
        if($this->getSir60()->getReferencia() == "" && $this->getSir76()->getNumero() == ""){
            throw new Exception("ImagenesContenedor->buscarImagenesContenedor(): error, faltan datos");
        }else{
            $sQuery=  "EXEC [Previos].[dbo].buscarImagenesContenedor '".$this->getSir60()->getReferencia()."','".$this->getSir76()->getNumero()."';";
            $rst = $oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();
            if($rst){
                foreach ($rst as $vRow){
                    $oImg = new ImagenesContenedor();
                    $oImg->setRuta($vRow[0]);
                    $oImg->setNombreArchivo($vRow[1]);
                    $vObj[$i] = $oImg;
                    $i = $i + 1;
                }
            }else{
                $vObj = false;
            }
        }
        return $vObj;
    }

    function insertarImagenContenedor(){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $nAfec = 0;
        if($this->getSir60()->getReferencia() == ""){
            throw new Exception("ImagenesContenedor->insertarImagenContenedor(): error, faltan datos");
        }else{
            $sQuery = "EXEC [Previos].[dbo].insertarImagenesContenedor '".$this->getSir60()->getReferencia()."',
                     '".$this->getSir76()->getNumero()."',
                     '".$this->getRuta()."',
                     '".$this->getNombreArchivo()."';";
            $nAfec = $oAD2->ejecutaComando($sQuery);
            $oAD2->Desconecta();
        }
        return $nAfec;
    }

}