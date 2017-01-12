<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 11/01/2017
 * Time: 16:13
 */
include_once ("AccesoDatos2.php");
include_once ("sis_grp.php");
class cat_user
{
    private $oAD2 = null;
    private $oGrp = null;
    private $nIdUsr = 0;
    private $sUsr = "";
    private $sNom = "";
    private $sPass = "";


    public function getPass()
    {
        return $this->sPass;
    }


    public function setPass($sPass)
    {
        $this->sPass = $sPass;
    }

    public function getAD2()
    {
        return $this->oAD2;
    }

    public function setAD2($oAD2)
    {
        $this->oAD2 = $oAD2;
    }

    public function getGrp()
    {
        return $this->oGrp;
    }

    public function setGrp($oGrp)
    {
        $this->oGrp = $oGrp;
    }

    public function getIdUsr()
    {
        return $this->nIdUsr;
    }

    public function setIdUsr($nIdUsr)
    {
        $this->nIdUsr = $nIdUsr;
    }

    public function getUsr()
    {
        return $this->sUsr;
    }

    public function setUsr($sUsr)
    {
        $this->sUsr = $sUsr;
    }

    public function getNom()
    {
        return $this->sNom;
    }

    public function setNom($sNom)
    {
        $this->sNom = $sNom;
    }


    function buscarCvePass () {

        $oAD2 = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $bRet = false;

        if($this->getUsr() == "" and $this->getPass() == ""){
            throw new Exception("cat_user->buscarCvePass: error datos incompletos");
        }else{
            if ($oAD2->Conecta()){
                $sQuery="exec [Previos].[dbo].[buscarCvePass] ".$this->getUsr().",".$this->getPass().";";
                $rst=$oAD2->ejecutaQuery($sQuery);
                $oAD2->Desconecta();
            }
            if ($rst){
                $this->setGrp(new sis_grp());
                $this->setIdUsr($rst[0][0]);
                $this->setNom($rst[0][1]);
                $this->getGrp()->setIdGrp($rst[0][2]);
                $bRet = true;
            }
        }
        return $bRet;
    }


}