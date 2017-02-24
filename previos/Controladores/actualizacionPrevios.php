<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 23/02/2017
 * Time: 04:23 PM
 */
include_once ("../Modelos/Sir76Contenedores.php");
session_start();
$oCarga = new Sir76Contenedores();
$sErr = "";

if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){

}else{
    $sErr = "Faltan datos";
}
?>