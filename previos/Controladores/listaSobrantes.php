<?php
/**
 * Created by PhpStorm.
 * User: SISTEMAS-PABLO
 * Date: 30/03/2017
 * Time: 10:28 AM
 */
include_once ("../Modelos/SobrantesPartida.php");
$oSobrantes = new SobrantesPartida();
$nCant = 0;
$sErr = "";
$sRef = $_POST['sRef'];
$oSobrantes->setReferencia60(new Sir60Referencias());
$oSobrantes->getReferencia60()->setReferencia($sRef);
$nReg = $oSobrantes->consultarSobrantesInsertador();
if (isset($_POST['txtSobrante']) && !empty($_POST['txtSobrante']))
{
    $nCant = $_POST['txtSobrante'];
}else{
    $sErr = "No ingresó una cantidad";
}

if($sErr != "")
    header("Location: ../error2.php?sError=".$sErr);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Previos</title>
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

</head>

<div class="x_content">
   <h2>Total de Sobrantes ya registrados:  <?php echo $nReg?>. Referencia Actual <?php echo $sRef;?></h2>
    <form method="post" action="../Controladores/altaSobrantes.php" enctype="multipart/form-data">
        <input type="hidden" name="txtRefe" value="<?php echo $sRef; ?>">
        <?php
        for ($i=1;$i <= $nCant;$i++){
           ?>
            <div class="x_panel">
                <div class="x_title">
                    <input type="file" name="fotoSobrante<?php echo $i;?>[]" multiple required>
                    <br>
                    <label>Observaciones</label>
                    <textarea id="message" required="required" class="form-control" name="Sobrante[]" required></textarea>
                    <br/>
                    <!-- end form for validations -->
                </div>
            </div>
        <?php
        }
        ?>
        <input type="submit" name="guardaDaltante" id="guardaDaltante" class="btn btn-primary" value="Guardar">
    </form>

</div>
<!-- iCheck -->
<script src="../../vendors/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../vendors/fastclick/lib/fastclick.js"></script>
<!-- /page content -->


