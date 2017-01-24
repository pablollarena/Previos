<?php

/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 09/01/2017
 * Time: 13:25
 */
error_reporting(0);
class AccesoDatos2
{

    private $oConexion=null;
    /* Este método no se utilizará debido a que la conexión queda configurada en los métodos de ejecutaQuery y ejecutaComando
    /*function Conecta(){
        $bRet=false;
        try{
            $serverName = "SERVER-RECO\Trimex";
            $conexion = array("Database"=>"Previos","UID"=>"sa", "PWD"=>"sa2530", "CharacterSet"=>"UTF-8");
            $this->oConexion=sqlsrv_connect($serverName, $conexion);

        }catch(Exception $ex){
            throw $ex;
        }
        if( ($errors = sqlsrv_errors() ) != null) {
            foreach( $errors as $error ) {

            }
        }else{
            $bRet=true;
        }
        return $bRet;
    }
 */
    function Desconecta(){
        $bRet=true;
        if($this->oConexion !=null){
            $bRet=$this->oConexion->close();
        }
        return $bRet;
    }
    function ejecutaQuery($psQuery){
        $serverName = "SERVER-RECO\Trimex";
        $conexion = array("Database"=>"Previos","UID"=>"sa", "PWD"=>"sa2530", "CharacterSet"=>"UTF-8");
        $conn = sqlsrv_connect($serverName, $conexion);
        $arrRS=null;
        $rst=null;
        $oLinea=null;
        $sValCol="";
        $i=0;
        $j=0;
        if($psQuery == ""){
            throw new Exception("AccesoDatos->ejecutaQuery(): Falta indicar el query");
        }
        try{
            $rst=sqlsrv_query($conn,$psQuery);
        }catch(Exception $ex){
            throw $ex;
        }

        if($this->oConexion->error==""){
            while($oLinea = sqlsrv_fetch_object($rst)){
                foreach($oLinea as $sValCol){
                    $arrRS[$i][$j]=$sValCol;
                    $j++;
                }
                $j=0;
                $i++;
            }
            sqlsrv_close($conn);
        }
        else{
            throw new Exception($this->oConexion->error);
        }
        return $arrRS;
    }
    function ejecutaComando($psCommand){
        $nAfectados=-1;
        if($psCommand==""){
            throw new Exception("AccesoDatos->ejecutaComando: falta indicar el comando");
        }
        if($this->oConexion==null){
            throw new Exception("AccesoDatos->ejecutaComando: Falta conectar a la base de datos");
        }
        try{
            $this->oConexion->sqlsrv_query($psCommand);
            $nAfectados=$this->oConexion->affected_rows;
        }catch(Exception $ex){
            throw $ex;
        }
        return $nAfectados;
    }
}