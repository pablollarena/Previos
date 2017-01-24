<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 16/01/2017
 * Time: 18:28
 */

include_once ('AccesoDatos2.php');
class Empleados
{
    private $oAD = null;
    private $id_emp = 0;
    private $id_usr = 0;
    private $id_depto = 0;
    private $id_puesto = 0;
    private $nom = "";
    private  $ap_pat = "";
    private  $ap_mat="";
    private  $nick="";
    private  $pass = "";


    public function getoAD()
    {
        return $this->oAD;
    }


    public function setoAD($oAD)
    {
        $this->oAD = $oAD;
    }


    public function getIdEmp()
    {
        return $this->id_emp;
    }


    public function setIdEmp($id_emp)
    {
        $this->id_emp = $id_emp;
    }


    public function getIdUsr()
    {
        return $this->id_usr;
    }


    public function setIdUsr($id_usr)
    {
        $this->id_usr = $id_usr;
    }


    public function getIdDepto()
    {
        return $this->id_depto;
    }


    public function setIdDepto($id_depto)
    {
        $this->id_depto = $id_depto;
    }


    public function getIdPuesto()
    {
        return $this->id_puesto;
    }


    public function setIdPuesto($id_puesto)
    {
        $this->id_puesto = $id_puesto;
    }


    public function getNom()
    {
        return $this->nom;
    }


    public function setNom($nom)
    {
        $this->nom = $nom;
    }


    public function getApPat()
    {
        return $this->ap_pat;
    }


    public function setApPat($ap_pat)
    {
        $this->ap_pat = $ap_pat;
    }


    public function getApMat()
    {
        return $this->ap_mat;
    }


    public function setApMat($ap_mat)
    {
        $this->ap_mat = $ap_mat;
    }


    public function getNick()
    {
        return $this->nick;
    }

    public function setNick($nick)
    {
        $this->nick = $nick;
    }


    public function getPass()
    {
        return $this->pass;
    }


    public function setPass($pass)
    {
        $this->pass = $pass;
    }


    function  buscarEmpleado(){

        $oAD = new AccesoDatos2();
        $rst =  null;
        $sQuery = "";
        $bRet = false;
        if($this->getNick() == "" ){
            throw  new Exception(" Empleados->buscarEmpleados : datos incompletos ");
        }else{
            $sQuery = " exec [Previos].[dbo].buscarEmpleado '".$this->getNick()."','".$this->getPass()."';";
            $rst=$oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
            if($rst){
                $this->setIdEmp($rst[0][0]);
                $this->setNick($rst[0][1]);
                $this->setNom($rst[0][2]);
                $this->setApPat($rst[0][3]);
                $bRet=true;
            }
        }
        return $bRet;
    }


}