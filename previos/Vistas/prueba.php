<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 22/02/2017
 * Time: 11:12 AM
 */
session_start();
$sRef = $_REQUEST['sRef'];
$nFac = $_REQUEST['nFactura'];
$sCad1 = substr($sRef,0,3);
$sCad2 = substr($sRef,4,5);
$sCad3 = substr($sRef, 10, 4);
$sVal = $sCad1."".$sCad2."".$sCad3;
if($_SESSION['sUser'] && !empty($_SESSION['sUser'])){
    if(isset($_COOKIE["cRef"]) && isset($_COOKIE['cFact'])){
        setCookie("cRef","", time()+60*5);
        setCookie("cFact","", time()+60*5);
        setCookie("cRef",$sVal, time()+60*5);
        setCookie("cFact",$nFac, time()+60*5);
    }else{
        setCookie("cRef",$sVal, time()+60*5);
        setCookie("cFact",$nFac, time()+60*5);
    }
    header("Location: itemsPorPartida.php");
}
?>