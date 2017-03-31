<?php

/**
 * Created by PhpStorm.
 * User: SISTEMAS-PABLO
 * Date: 30/03/2017
 * Time: 03:42 PM
 */
include_once ("AccesoDatos2.php");
include_once ("Sir60Referencias.php");
include_once ("SobrantesPartida.php");
class ImagenesSobrantes
{

   private $sNumItem = "";
   private $sRuta = "";
   private $sNombreArchivo = "";
   private $oSobrante = null;


    public function getSobrante()
    {
        return $this->oSobrante;
    }


    public function setSobrante($oSobrante)
    {
        $this->oSobrante = $oSobrante;
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


    function insertarImagenesPartida()
    {
        $oAD = new AccesoDatos2();
        $sQuery = "";
        $nAfec = 0;
        if ($this->getSobrante()->getReferencia60()->getReferencia() == "")
        {
            throw new Exception("ImagenesSobrantes->insertarImagenes() : error faltan datos");
        }else{

            $sQuery = "exec [Previos].[dbo].insertarImagenesPartidas '".$this->getSobrante()->getReferencia60()->getReferencia()."',
             ".$this->getSobrante()->getNumItem().",
             '".$this->getRuta()."',
             '".$this->getNombreArchivo()."';";
            $nAfec = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();

        }
        return $nAfec;
    }

    function buscarImagenesSobrantes()
    {
        $oAD = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $i = 0;
        $oImagenesSobrantes = null;

        if ($this->getSobrante()->getReferencia60()->getReferencia() == "")
        {
            throw  new Exception("ImagenesSobrantes->buscarImagenesSobrantes(): error faltan datos");
        }else
        {
            $sQuery = "exec [Previos].[dbo].buscarFotos '".$this->getSobrante()->getReferencia60()->getReferencia()."',
            ".$this->getSobrante()->getNumItem().";";

            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
            if ($rst)
            {
                foreach ($rst as $vRow)
                {
                    $oImagenesSobrantes = new ImagenesSobrantes();
                    $oImagenesSobrantes->setRuta($vRow[0]);
                    $oImagenesSobrantes->setNombreArchivo($vRow[1]);
                    $vObj[$i] = $oImagenesSobrantes;
                    $i = $i + 1;
                }
            }else{
                $vObj = false;
            }
        }
        return $vObj;
    }



}