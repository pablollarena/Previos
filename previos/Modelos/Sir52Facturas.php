<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 08/02/2017
 * Time: 06:52 PM
 */
include_once ("AccesoDatos.php");
include_once ("Sir60Referencias.php");
class Facturas
{
    private $oAD = null;
    private $oSir60 = null;
    private $nNumero = "";
    private $nItem = 0;


    public function getItem()
    {
        return $this->nItem;
    }

    public function setItem($nItem)
    {
        $this->nItem = $nItem;
    }

    public function getAD()
    {
        return $this->oAD;
    }


    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }


    public function getSir60()
    {
        return $this->oSir60;
    }


    public function setSir60($oSir60)
    {
        $this->oSir60 = $oSir60;
    }


    public function getNumero()
    {
        return $this->nNumero;
    }


    public function setNumero($nNumero)
    {
        $this->nNumero = $nNumero;
    }

    function buscarItemFactura(){

        $oAD = new AccesoDatos();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $oFactura = null;
        $i = 0;

        if ($this->getSir60()->getReferencia() == ""){
            throw  new Exception("Facturas->buscarItemFactura(): error faltan datos");
        }else {
            $sQuery = " exec [1G_TRIMEX].[dbo].buscarItemsPorReferencia '".$this->getSir60()->getReferencia()."'; ";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
            if ($rst){
                foreach ($rst as $vRow){
                    $oFactura = new Facturas();
                    $oFactura->setNumero($vRow[0]);
                    $vObj[$i] = $oFactura;
                    $i = $i + 1;
                }

            }else{
                $vObj = false;
            }
        }
        return $vObj;
    }

}