<?php

include_once ("../Modelos/Observaciones.php");
include_once ("../Modelos/cat_user.php");
session_start();
$oObservacion = new Observaciones();
$oUser = new cat_user();
$arrObservacion = null;
if (isset($_SESSION['sUser']) and !empty($_SESSION['sUser'])){
    $oUser = $_SESSION['sUser'];
    $sNick = $oUser->getUsuario();
    $oObservacion->setSir60(new Sir60Referencias());
    $oObservacion->getSir60()->setReferencia($_POST['txtRef']);
    $arrObservacion = $oObservacion->buscarTodosObser();
    $dFecha = new DateTime();
}else{
    $sErr = "Faltan datos de sesión";
}
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- iCheck -->
    <script src="../../vendors/iCheck/icheck.min.js"></script>
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <!-- Datatables -->

    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script>
        $(function(){
            $("#btnObs").click(function () {
                var url = "../Controladores/insertarObservaciones.php";
                $.ajax({
                    type: "POST",
                    url : url,
                    data : $("#guardarOb").serialize(),
                    success: function(data)
                    {
                        $("#respuesta").html(data);
                    }
                });
                return false;
            });
        });
    </script>
</head>
<div class="col-md-12 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Panel de Observaciones <small>(Fecha de registro de Observación: <?php echo $dFecha->format('Y-m-d');?>)</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="guardarOb">
                <input type="hidden" value="<?php echo $_POST['txtRef'] ;?>" name="txtRef">
                <input type="hidden" value="<?php echo $sNick;?>" name="txtNick" >
                <input type="hidden" value="<?php echo $dFecha->format('Y-m-d');?>" name="dFechaReg">
                <div class="form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12">Ingrese la observación: </label>
                    <textarea class="resizable_textarea form-control" name="txtObservacion" ></textarea>
                    <br>
                </div>
                <div align="center">
                        <input type="button"
                               id="btnObs"
                               value="Guardar"
                               class="btn btn-round btn-primary">
                </div>
                <div id="respuesta">

                </div>
            </form>
            <br/><br/>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Lista de las observaciones de la referencia <?php echo strtoupper($_POST['txtRef']);?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30">
                            Las observaciones mostradas en la siguiente tabla no pueden ser borradas ni modificadas
                        </p>
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Observación</th>
                                <th>Realizada por:</th>
                                <th>Fecha de registro</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if($arrObservacion != null){
                                    foreach ($arrObservacion as $item) {
                                        ?>
                                        <tr>
                                            <td width="60%"><?php echo $item->getObservacion();?></td>
                                            <td width="20%"><?php echo $item->getUsuario();?></td>
                                            <td width="20%"><?php echo $item->getFecha();?></td>
                                        </tr>
                            <?php
                                    }
                                }else{
                                    ?>
                                    <tr>
                                        <td rowspan="2" colspan="3">No se han registrado observaciones para esta referencia</td>

                                    </tr>
                            <?php
                                }
                            ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Datatables -->
<script src="../../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../../build/js/custom.min.js"></script>


<!-- /Datatables -->