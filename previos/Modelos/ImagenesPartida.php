<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 14/02/2017
 * Time: 11:23 AM
 */
include_once ("AccesoDatos2.php");
include_once ("Sir60Referencias.php");
class ImagenesPartida
{
    private $oAD2 = null;
    private $nIdImagen = 0;
    private $oSir60 = null;
    private $sNombreArchivo = "";
    private $sRutaArchivo = "";


    public function getAD2()
    {
        return $this->oAD2;
    }

    public function setAD2($oAD2)
    {
        $this->oAD2 = $oAD2;
    }

    public function getIdImagen()
    {
        return $this->nIdImagen;
    }

    public function setIdImagen($nIdImagen)
    {
        $this->nIdImagen = $nIdImagen;
    }

    public function getSir60()
    {
        return $this->oSir60;
    }

    public function setSir60($oSir60)
    {
        $this->oSir60 = $oSir60;
    }

    public function getNombreArchivo()
    {
        return $this->sNombreArchivo;
    }

    public function setNombreArchivo($sNombreArchivo)
    {
        $this->sNombreArchivo = $sNombreArchivo;
    }

    public function getRutaArchivo()
    {
        return $this->sRutaArchivo;
    }

    public function setRutaArchivo($sRutaArchivo)
    {
        $this->sRutaArchivo = $sRutaArchivo;
    }


    function  insertarImagenes ($nRef){
        $oAD2 = new AccesoDatos2();
        $sQuery = "" ;
        $nAfec = 0;
        if($nRef == ""){
            throw new Exception("ImagenesPartida->insertarImagenes : error faltan datos");
        }else{
            $sQuery = "exec [Previos].[dbo].insertarImagenes '".$nRef."',
                                                             '".$this->getNombreArchivo()."',
                                                             '".$this->getRutaArchivo()."' ;";
            $nAfec = $oAD2->ejecutaComando($sQuery);
        }
      return $nAfec;
    }


    function buscarImagenes (){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $i = 0;
        $oImagenes = null;

        if ($this->getSir60()->getReferencia() == ""){
            throw new Exception("ImagenesPartida->buscarImagenes() : error faltan datos");
        }else{
            $sQuery = "exec [Previos].[dbo].buscarImagenes '".$this->getSir60()->getReferencia()."'; ";
            $rst = $oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();
            if($rst){
                foreach ($rst as $vRow){
                    $oImagenes = new ImagenesPartida();
                    $oImagenes->setNombreArchivo($vRow[0]);
                    $oImagenes->setRutaArchivo($vRow[1]);
                    $vObj[$i] = $oImagenes;
                    $i = $i + 1;
                }
            }else{
                $vObj = false;
            }
            return $vObj;
        }
    }

}