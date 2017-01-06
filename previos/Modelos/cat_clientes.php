<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 06/01/2017
 * Time: 11:11
 */
include_once ("AccesoDatos.php");
class cat_clientes
{
    private $oAD = null;
    private $nIdCliente=0;
    private $sNom1 = "";


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
        if($oAD->Conecta()){
            $sQuery = "exec [1G_TRIMEX].[dbo].buscarTodos;";
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
        $oAD = new AccesoDatos();
        $rst = null;
        $sQuery = "";
        $bRet = false;
        if($this->getIdCliente()){
            throw new Exception("cat_cliente->buscarClientePorClave: error, falta indicar la clave del cliente");
        }else{
            if($oAD->Conecta()){
                $sQuery = "exec [Prueba].[dbo].buscarClientesPorClave ".$this->getIdCliente().";";
                $rst = $oAD->ejecutaQuery($sQuery);
                $oAD->Desconecta();
            }
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
            $sQuery = "exec [Prueba].[dbo].insertarCliente ".$this->getNom1().";";
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
            $sQuery =" exec [Prueba].[dbo].eliminarCliente ".$this->getIdCliente().";";
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
            $sQuery = "exec [Prueba].[dbo].updateCliente ".$this->getIdCliente().", '".$this->getNom1()."'';";
            $nAfectados = $oAD->ejecutaComando($sQuery);
            $oAD->Desconecta();
        }
        return $nAfectados;

    }

}