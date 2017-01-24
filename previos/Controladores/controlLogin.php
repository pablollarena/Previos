<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 12/01/2017
 * Time: 9:39
 */

include_once ("../Modelos/cat_user.php");
include_once ("../Modelos/cat_clientes.php");
include_once ("../Modelos/Empleados.php");
include_once ("../Modelos/Persona.php");
session_start();
$oPersona = new Persona();
$sErr = "";
$sUser = "";
$sPass = "";
$nick="";
$nom = "";
    if(isset($_POST['txtUser']) && !empty($_POST['txtUser']) &&
        isset($_POST['txtPass']) && !empty($_POST['txtPass'])){
        $sUser = $_POST['txtUser'];
        $sPass = $_POST['txtPass'];
        $oPersona->setUsuario($sUser);
        $oPersona->setPass($sPass);

        try{
            if($oPersona->buscarDatosLogin() == 1){
                $_SESSION['sUser'] = $oPersona;
                header("Location: ../Vistas/menuPrincipal.php");
            }else if($oPersona->buscarDatosLogin() == 2){
                $_SESSION['sUser'] = $oPersona;
                header("Location: ../Vistas/menuPrincipal.php");
            }else{
                $_SESSION['sUser'] = $oPersona;
                header("Location: ../Vistas/menuPrincipal.php");
            }
        }catch (Exception $e){
            error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
            $sErr = "Error en base de datos, comunicarse con el administrador";
        }
    }else{
        $sErr = "Faltan datos";
    }

    if($sErr != ""){
       header("Location: ../error.php?sError=".$sErr);
    }
?>