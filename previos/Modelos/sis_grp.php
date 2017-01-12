<?php

include_once ("AccesoDatos2.php");
class sis_grp
{
  private $oAD2 = null;
  private $nIdGrp = 0;
  private $sNomGrp = "";


    public function getAD2()
    {
        return $this->oAD2;
    }


    public function setAD2($oAD2)
    {
        $this->oAD2 = $oAD2;
    }


    public function getIdGrp()
    {
        return $this->nIdGrp;
    }


    public function setIdGrp($nIdGrp)
    {
        $this->nIdGrp = $nIdGrp;
    }


    public function getNomGrp()
    {
        return $this->sNomGrp;
    }


    public function setNomGrp($sNomGrp)
    {
        $this->sNomGrp = $sNomGrp;
    }


    function buscarTodos(){
        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $vObj = null;
        $i=0;
        $oGrp=null;

        if ($oAD2->Conecta()){
            $sQuery = "exec [Previos].[dbo].buscarTodosGrp";
            $rst=$oAD2->ejecutaQuery($sQuery);
            $oAD2->Desconecta();
        }
        if($rst){
            foreach ($rst as $vRow){
                $oGrp= new sis_grp();
                $oGrp->setIdGrp($vRow[0]);
                $oGrp->setNomGrp($vRow[1]);
                $vObj[$i] = $oGrp;
                $i=$i+1;
            }

        }else{
            $vObj = false;
        }
        return $vObj;
    }

}