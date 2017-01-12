<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 09/01/2017
 * Time: 17:33
 */
include_once ("AccesoDatos.php");
class Sir311RecintosFiscalizados
{
    private $oAD = null;
    private $nClave = 0;
    private $sCiudad = "";

    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getClave()
    {
        return $this->nClave;
    }

    public function setClave($nClave)
    {
        $this->nClave = $nClave;
    }

    public function getCiudad()
    {
        return $this->sCiudad;
    }

    public function setCiudad($sCiudad)
    {
        $this->sCiudad = $sCiudad;
    }


    function buscarTodos(){
        $oAD = new AccesoDatos();
        $rst = null;
        $i = 0;
        $sQuery = "";
        $vObj =null;
        $oRecinto = null;

        if  ($oAD->Conecta()){
            $sQuery = "exec [1G_TRIMEX].[dbo].buscarTodos";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if ($rst){
            foreach ($rst as $vRow){
                $oRecinto = new  Sir311RecintosFiscalizados();
                $oRecinto->setClave($vRow[0]);
                $oRecinto->setCiudad($vRow[1]);
                $vObj[$i]=$oRecinto;
                $i=$i+1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

}