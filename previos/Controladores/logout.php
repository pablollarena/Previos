<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 14/01/2017
 * Time: 12:28
 */
session_start();
$sErr="";
if(isset($_SESSION["sUser"])){
    session_destroy();
}
else
    $sErr="Faltan datos de sesión, es posible que no realizara el login";
if($sErr == "")
    header("Location:../index.php");
else
    header("Location:../error.php?sError=".$sErr);
?>
?>