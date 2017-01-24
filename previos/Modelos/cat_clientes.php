<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 06/01/2017
 * Time: 11:11
 */
include_once ("AccesoDatos2.php");
class cat_clientes
{
    private $oAD2 = null;
    private $nIdCliente=0;
    private $sNom1 = "";
    private $sClave = "";
    private $sNom2="";
    private $sDir = "";
    private $sPass="";
    private $nGrp = 0;


    public function getGrp()
    {
        return $this->nGrp;
    }

    public function setGrp($nGrp)
    {
        $this->nGrp = $nGrp;
    }

    public function getClave()
    {
        return $this->sClave;
    }


    public function setClave($sClave)
    {
        $this->sClave = $sClave;
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


    public function getPass()
    {
        return $this->sPass;
    }


    public function setPass($sPass)
    {
        $this->sPass = $sPass;
    }


    public function getAD()
    {
        return $this->oAD;
    }

    public function setAD($oAD)
    {
        $this->oAD = $oAD;
    }

    public function getIdCliente()
    {
        return $this->nIdCliente;
    }

    public function setIdCliente($nIdCliente)
    {
        $this->nIdCliente = $nIdCliente;
    }

    public function getNom1()
    {
        return $this->sNom1;
    }

    public function setNom1($sNom1)
    {
        $this->sNom1 = $sNom1;
    }

    function buscarTodos(){
        $oAD = new AccesoDatos();
        $vObj = null;
        $rst = null;
        $i = 0;
        $sQuery = "";
        $oCliente = null;
        if($oAD->Conecta2()){
            $sQuery = "exec [Previos].[dbo].buscarTodosClientes;";
            $rst = $oAD->ejecutaQuery($sQuery);
            $oAD->Desconecta();
        }
        if($rst){
            $oCliente = new cat_clientes();
            foreach ($rst as $vRow){
                $oCliente->setIdCliente($vRow[0]);
                $oCliente->setNom1($vRow[1]);
                $vObj[$i] = $oCliente;
                $i = $i + 1;
            }
        }else{
            $vObj = false;
        }
        return $vObj;
    }

    function buscarClientePorClave(){
        $oAD2 = new AccesoDatos2();
        $rst = null;
        $sQuery = "";
        $bRet = false;
        if($this->getClave() == ''){
            throw new Exception("cat_cliente->buscarClientePorClave: error, falta indicar la clave del cliente");
        }else{
                $sQuery = "exec [Previos].[dbo].buscarClientesClave '".$this->getClave()."', '".$this->getPass()."';";
                $rst = $oAD2->ejecutaQuery($sQuery);
                $oAD2->Desconecta();
            if($rst){
                $this->setIdCliente($rst[0][0]);
                $this->setNom1($rst[0][1]);
                $bRet = true;
            }
        }
        return $bRet;
    }

    function insertar(){
        $oAD = new AccesoDatos();
        $nAfectados = 0;
        $sQuery = "";
        if($oAD->Conecta()){
            $sQuery = "exec [Previos].[dbo].insertarCliente ".$this->getNom1().";";
            $nAfectados = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();
        }
        return $nAfectados;
    }

    function eliminar(){
        $oAD = new AccesoDatos();
        $sQuery = "";
        $nAfectados = 0;

        if($this->getIdCliente() == 0){
            throw  new  Exception("cat_clientes->eliminar():elemento vacio");
        }else if($oAD->Conecta()){
            $sQuery =" exec [Previos].[dbo].eliminarCliente ".$this->getIdCliente().";";
            $nAfectados = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();
        }
        return $nAfectados;
    }

    function  updateCliente(){
        $oAD = new AccesoDatos();
        $nAfectados = 0;
        $sQuery ="";

        if ($this->getIdCliente() == 0 and $this->getNom1() == ""){
            throw  new  Exception("cat_clientes->update():elemento vacio");
        }else if($oAD ->Conecta()){
            $sQuery = "exec [Previos].[dbo].updateCliente ".$this->getIdCliente().", '".$this->getNom1()."'';";
            $nAfectados = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();
        }
        return $nAfectados;
    }

}