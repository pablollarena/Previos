<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 19/01/2017
 * Time: 09:02 AM
 */
include_once ("AccesoDatos2.php");
include_once ("sis_grp.php");
class Persona
{
    private  $oAD=null;
    private  $oGrp = null;
    private  $nIdPersona = 0;
    private  $sNom = "";
    private  $sApPat = "";
    private  $sApMat = "";
    private  $sNomCompleto = "";
    private  $sUsuario = "";
    private  $sPass = "";
    private  $sNom2 = "";
    private  $sDir = "";
    private  $nGrupo = 0;
    private  $nReferen = 0;

    public function getAD()
    {
        return $this->oAD;
    }


    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getGrp()
    {
        return $this->oGrp;
    }

    public function setGrp($oGrp)
    {
        $this->oGrp = $oGrp;
    }

    public function getIdPersona()
    {
        return $this->nIdPersona;
    }

    public function setIdPersona($nIdPersona)
    {
        $this->nIdPersona = $nIdPersona;
    }

    public function getNom()
    {
        return $this->sNom;
    }

    public function setNom($sNom)
    {
        $this->sNom = $sNom;
    }

    public function getApPat()
    {
        return $this->sApPat;
    }

    public function setApPat($sApPat)
    {
        $this->sApPat = $sApPat;
    }

    public function getApMat()
    {
        return $this->sApMat;
    }

    public function setApMat($sApMat)
    {
        $this->sApMat = $sApMat;
    }

    public function getNomCompleto()
    {
        return $this->sNomCompleto;
    }

    public function setNomCompleto($sNomCompleto)
    {
        $this->sNomCompleto = $sNomCompleto;
    }

    public function getUsuario()
    {
        return $this->sUsuario;
    }

    public function setUsuario($sUsuario)
    {
        $this->sUsuario = $sUsuario;
    }

    public function getPass()
    {
        return $this->sPass;
    }

    public function setPass($sPass)
    {
        $this->sPass = $sPass;
    }

    public function getNom2()
    {
        return $this->sNom2;
    }

    public function setNom2($sNom2)
    {
        $this->sNom2 = $sNom2;
    }

    public function getDir()
    {
        return $this->sDir;
    }

    public function setDir($sDir)
    {
        $this->sDir = $sDir;
    }

    public function getGrupo()
    {
        return $this->nGrupo;
    }

    public function setGrupo($nGrupo)
    {
        $this->nGrupo = $nGrupo;
    }

    public function getReferen()
    {
        return $this->nReferen;
    }

    public function setReferen($nReferen)
    {
        $this->nReferen = $nReferen;
    }




    function buscarDatosLogin(){
        $oAD = new AccesoDatos2();
        $sQuery = "";
        $rst = null;
        $nRef = 0;
        if($this->getUsuario() == "" && $this->getPass() == ""){
            throw new Exception("Persona->buscarDatosLogin(): error, faltan datos");
        }else{
            $sQuery = "exec [Previos].[dbo].buscarDatosLogin '".$this->getUsuario()."', '".$this->getPass()."';";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
            if($rst){
                if($rst[0][3] == 1){
                    $this->setGrp(new sis_grp());
                    $this->setIdPersona($rst[0][0]);
                    $this->setNomCompleto($rst[0][1]);
                    $this->getGrp()->setIdGrp($rst[0][2]);
                    $this->setReferen($rst[0][3]);
                    $nRef = $rst[0][3];
                }else if($rst [0][3] == 2 ){
                    $this->setIdPersona($rst[0][0]);
                    $this->setUsuario($rst[0][1]);
                    $this->setNomCompleto($rst[0][2]);
                    $this->setReferen($rst[0][3]);
                    $this->setGrupo(27);
                    $nRef=$rst[0][3];
                }else if($rst [0][3] == 3){
                    $this->setIdPersona($rst[0][0]);
                    $this->setUsuario($rst[0][1]);
                    $this->setNomCompleto($rst[0][2]);
                    $this->setReferen($rst[0][3]);
                    $this->setGrupo(16);
                    $nRef=$rst[0][3];
                }else{
                    $nRef = 0;
                }
            }
        }
        return $nRef;
    }

}