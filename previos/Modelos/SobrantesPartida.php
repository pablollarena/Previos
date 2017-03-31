<?php

/**
 * Created by PhpStorm.
 * User: SISTEMAS-PABLO
 * Date: 29/03/2017
 * Time: 11:48 AM
 */

include_once ("AccesoDatos2.php");
include_once ("Sir60Referencias.php");
class SobrantesPartida
{
   private $nIdSobrantePartida = 0;
   private  $oReferencia60 = null;
   private  $sObservaciones = "";
   private $oAD = null;
   private $nNumItem = 0;


    public function getNumItem()
    {
        return $this->nNumItem;
    }


    public function setNumItem($nNumItem)
    {
        $this->nNumItem = $nNumItem;
    }


    public function getIdSobrantePartida()
    {
        return $this->nIdSobrantePartida;
    }


    public function setIdSobrantePartida($nIdSobrantePartida)
    {
        $this->nIdSobrantePartida = $nIdSobrantePartida;
    }


    public function getReferencia60()
    {
        return $this->oReferencia60;
    }


    public function setReferencia60($oReferencia60)
    {
        $this->oReferencia60 = $oReferencia60;
    }


    public function getObservaciones()
    {
        return $this->sObservaciones;
    }


    public function setObservaciones($sObservaciones)
    {
        $this->sObservaciones = $sObservaciones;
    }

    public function getAD()
    {
        return $this->oAD;
    }


    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }


    function insertarSobrantesPartidas()
    {
        $oAD = new  AccesoDatos2();
        $nAfec = 0;
        $sQuery = "";
        if($this->getReferencia60()->getReferencia() == "")
        {
            throw new Exception("SobrantesPartida->insertarSobrantesPartidas(): error, faltan datos");
        }else
        {
            $sQuery ="exec [Previos].[dbo].insertarSobrantes '".$this->getReferencia60()->getReferencia()."',
            ".$this->getNumItem().",
            '".$this->getObservaciones()."';";
            $nAfec = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();

        }
        return $nAfec;
    }

    function buscarTodosSobrantesPartida()
    {
        $oAD = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $i = 0;
        $oSobrante = null;

        if ($this->getReferencia60()->getReferencia() == "")
        {
            throw new Exception("SobrantesPartidas:buscarTodosSobrantesPartida() : error faltan datos");
        }else
        {
            $sQuery = "exec [Previos].[dbo].buscarSobrantesPartida'".$this->getReferencia60()->getReferencia()."'";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
            if ($rst)
            {
                foreach ($rst as $vRow)
                {
                    $oSobrante = new SobrantesPartida();
                    $oSobrante->setNumItem($vRow[0]);
                    $oSobrante->setObservaciones($vRow[1]);

                    $vObj[$i]=$oSobrante;
                    $i = $i +1;
                }
            }else
            {
                $vObj = false;
            }

        }
        return $vObj;
    }

    function  consultarSobrantesInsertador()
    {
        $oAD = new AccesoDatos2();
        $sQuery = "";
        $rst = "";
        $nTotal = 0;

        if ($this->getReferencia60()->getReferencia() == "")
        {
            throw  new Exception("SobrantesPartida->consultarSobrantesInsertador() : error faltan datos");
        }else
        {
            $sQuery = "exec [Previos].[dbo].consultarSobrantesInsertador '".$this->getReferencia60()->getReferencia()."';";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();

            if ($rst)
            {
                $nTotal = $rst[0][0];
            }

        }
        return $nTotal;

    }

    function buscarUltimoItem()
    {
        $oAD = new  AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $nUltimoInsertado = 0;

        if($this->getReferencia60()->getReferencia() == "")
        {
            throw  new Exception("SobrantesPartida->buscarUltimoItem() : error faltan datos");
        }else{
            $sQuery = "exec [Previos].[dbo].buscarUltimoItem '".$this->getReferencia60()->getReferencia()."';";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
            if ($rst[0][0] == null)
            {
                $nUltimoInsertado = 0;
            }else if($rst[0][0] != null){
                $nUltimoInsertado = $rst[0][0];
            }
        }

        return $nUltimoInsertado;
    }

    function  buscarObservaciones()
    {
        $oAD = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $i = 0;
        $oObservaciones = null;

        if($this->getReferencia60()->getReferencia() == "")
        {
            throw  new Exception("SobrantesPartida->buscarObservaciones() : error faltan datos");
        }else
        {
            $sQuery = "exec [Previos].[dbo].buscarObservaciones '".$this->getReferencia60()->getReferencia()."';";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
            if ($rst)
            {
                foreach ($rst as $vRow)
                {
                    $oObservaciones = new SobrantesPartida();
                    $oObservaciones->setObservaciones($vRow[0]);
                    $oObservaciones->setNumItem($vRow[1]);
                    $vObj[$i] = $oObservaciones;
                    $i = $i + 1;
                }
            }else{
                $vObj = false;
            }
        }
        return  $vObj;
    }


}