<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 25/01/2017
 * Time: 05:21 PM
 */
ini_set("session.cookie_lifetime","7200");
ini_set("session.gc_maxlifetime","7200");
include_once ("../Modelos/Sir76Contenedores.php");
include_once ("../Modelos/Sir60Referencias.php");
$oConten = new Sir76Contenedores();
$arrConte = null;
if(isset($_POST['txtRef']) && !empty($_POST['txtRef'])){
    $oConten->setReferencia60(new Sir60Referencias());
    $oConten->getReferencia60()->setReferencia($_POST['txtRef']);
    $arrConte = $oConten->buscarContenedoresPorRef2();

}
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- iCheck -->
    <script src="../../vendors/iCheck/icheck.min.js"></script>
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
</head>
        <div class="x_content">
            <div class="main_container">
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Información de la Carga</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            <div class="x_content">
                                <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                    <?php
                                    if($arrConte){
                                        foreach ($arrConte as $vRow){
                                            if($vRow->getConten()->getNumeroContenedor() != ""){
                                                ?>
                                                <div class="x_content">
                                                    <form name="frmContent<?php echo $nCon;?>" id="frmContent<?php echo $nCon;?>">
                                                        <input type="hidden" name="txtRef" value="<?php echo $sRef;?>"/>
                                                        <input type="hidden" name="operacion" value="content"/>
                                                        <input type="hidden" name="txtNumConten" value="<?php echo $vRow->getConten()->getNumeroContenedor();?>"/>
                                                        <div class="panel">
                                                            <a class="panel-heading" role="tab" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $vRow->getConten()->getNumeroContenedor();?>" aria-expanded="false" aria-controls="<?php  echo $vRow->getConten()->getNumeroContenedor();?>">
                                                                <h5 class="panel-title">CONTENEDOR <?php echo $vRow->getConten()->getNumeroContenedor();?></h5>

                                                            </a>
                                                            <div id="<?php echo $vRow->getConten()->getNumeroContenedor();?>" class="panel-collapse collapse in" role="tabpanel">
                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-1 col-sm-1 col-xs-1" >Peso</span>
                                                                        </label>
                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                            <input type="text" id="txtPeso" name="txtPeso" required="required" class="form-control col-md-7 col-xs-12"
                                                                                   value="<?php echo $vRow->getConten()->getPeso(); ?>" disabled>
                                                                        </div>
                                                                        <label class="control-label col-md-1 col-sm-1 col-xs-3" >Sellos</span>
                                                                        </label>
                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                            <input type="text" id="txtSellos" name="txtSellos" required="required" class="form-control col-md-7 col-xs-12"
                                                                                   value="<?php echo $vRow->getConten()->getSelloOrigen(); ?>" disabled>
                                                                        </div>
                                                                        <label class="control-label col-md-1 col-sm-4 col-xs-12">IMO</label>
                                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                                            <input type="text" id="txtPeso" name="txtPeso" required="required" class="form-control col-md-7 col-xs-12"
                                                                                   value="<?php echo ($vRow->getConten()->getIMO() == 1 ? "SI" : "NO"); ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <br/><br/>
                                                                    <div class="clearfix"></div>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-1 col-sm-1 col-xs-1" >Recinto</span>
                                                                        </label>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                            <input type="text" id="txtRecinto" name="txtRecinto" required="required" class="form-control col-md-7 col-xs-12"
                                                                                   value="<?php echo $vRow->getConten()->getRecintoPrevio(); ?>" disabled>
                                                                        </div>

                                                                    </div>
                                                                    <br/>
                                                                    <br/>
                                                                    <br/>
                                                                    <table class="table table-striped table-bordered dt-responsive nowrap">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Tamaño</small></th>
                                                                            <th>Tipo</th>
                                                                            <th>Sello Colocado</th>
                                                                            <th>Peso de Carga S/Contenerizar</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Tamaño</label>
                                                                                    <div class="col-md-7 col-sm-9 col-xs-12">
                                                                                        <input type="text" id="txtTamaño" name="txtTamaño" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $vRow->getConten()->getTamaño();?>" disabled
                                                                                        >

                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Tipo</label>
                                                                                    <div class="col-md-7 col-sm-9 col-xs-12">
                                                                                        <input type="text" id="txtTipo" name="txtTipo" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $vRow->getConten()->getTipo();?>" disabled
                                                                                        >

                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-3 col-sm-2 col-xs-3" for="txtSelloColocado">Sellos</span>
                                                                                    </label>
                                                                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                        <input type="text" id="txtSelloColocado" name="txtSelloColocado" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $vRow->getConten()->getSelloColocado();?>" disabled
                                                                                        >
                                                                                    </div>

                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-3 col-sm-2 col-xs-3">Peso Kg</span>
                                                                                    </label>
                                                                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                        <input type="text" id="txtPeso1" name="txtPeso1" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $vRow->getConten()->getPeso();?>" disabled
                                                                                        >
                                                                                    </div>

                                                                                </div>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td colspan="4" rowspan="1">
                                                                                <h5 align="center"> Daños</h5>
                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4" rowspan="1">
                                                                                <div class="form-group">

                                                                                    <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nOrigen = $vRow->getDaño()->getOrigen();?>
                                                                                                <input type="checkbox" class="flat" name="daños[]" id="daños1" value="Origen" <?php echo($nOrigen == 1 ? 'Checked="Checked"' : '');?> disabled>Origen
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nRecinto = $vRow->getDaño()->getRecinto();?>
                                                                                                <input type="checkbox" class="flat" name="daños[]" id="daños2" value="Recinto" <?php echo($nRecinto == 1 ? 'Checked="Checked"' : '');?> disabled> Recinto
                                                                                            </label>
                                                                                        </div>


                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nFrente = $vRow->getDaño()->getFrente();?>
                                                                                                <input type="checkbox" class="flat" name="daños[]" id="daños3" value="Frente" <?php echo ($nFrente == 1 ? 'Checked="Checked"' : ''); ?> disabled> Frente
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nPanelIzq = $vRow->getDaño()->getPanelIzq();?>
                                                                                                <input type="checkbox" class="flat" name="daños[]" id="daños4" value="PanelIzq" <?php echo ($nPanelIzq == 1 ? 'Checked="Checked"' : ''); ?> disabled> Panel Izq.
                                                                                            </label>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nPiso = $vRow->getDaño()->getPiso();?>
                                                                                                <input type="checkbox" class="flat" name="daños[]" id="daños5" value="Piso" <?php echo ($nPiso == 1 ? 'Checked="Checked"' : ''); ?> disabled> Piso
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nTecho = $vRow->getDaño()->getTecho();?>
                                                                                                <input type="checkbox" class="flat" name="daños[]" id="daños6" value="Techo" <?php echo ($nTecho == 1 ? 'Checked="Checked"' : ''); ?> disabled> Techo
                                                                                            </label>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nPanelDer = $vRow->getDaño()->getPanelDer();?>
                                                                                                <input type="checkbox" class="flat" name="daños[]" id="daños7" value="PanelDer" <?php echo ($nPanelDer == 1 ? 'Checked="Checked"' : ''); ?>disabled > Panel Der.
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nPuertas = $vRow->getDaño()->getPuertas(); ?>
                                                                                                <input type="checkbox" class="flat" name="daños[]" id="daños8" value="Puertas" <?php echo  ( $nPuertas == 1 ? 'Checked="Checked"' : '');?> disabled> Puertas
                                                                                            </label>
                                                                                        </div>


                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nBarraPuerta = $vRow->getDaño()->getBarrasPuerta();?>
                                                                                                <input type="checkbox" class="flat" name="daños[]" id="daños9" value="BarrasPuerta" <?php echo  ( $nBarraPuerta == 1 ? 'Checked="Checked"' : '');?> disabled > Barras Puerta
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nSeguros = $vRow->getDaño()->getSeguros(); ?>
                                                                                                <input type="checkbox" class="flat" name="daños[]" id="daños10" value="Seguros" <?php echo  ( $nSeguros == 1 ? 'Checked="Checked"' : '');?> disabled > Seguros
                                                                                            </label>
                                                                                        </div>


                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nAbrazadera = $vRow->getDaño()->getAbrazaderas();?>
                                                                                                <input type="checkbox" class="flat" name="daños[]" id="daños11" value="Abrazaderas" <?php echo($nAbrazadera == 1 ? 'Checked="Checked"' : '');?> disabled> Abrazaderas
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nLonaBarra = $vRow->getDaño()->getLonasBarras();?>
                                                                                                <input type="checkbox" class="flat" name="daños[]" id="daños12" value="LonaBarra"  <?php echo($nLonaBarra == 1 ? 'Checked="Checked"' : '');?>disabled > Lona/Barra
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-md-12 col-sm-9 col-xs-12">
                                                                                        <input type="text" class="resizable_textarea form-control" name="txtOtros" id="txtOtros" placeholder="Otros" value="<?php echo $vRow->getDaño()->getOtros() ;?>" disabled />
                                                                                    </div>
                                                                                </div>

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4" rowspan="1">
                                                                                <h5 align="center"> Bultos</h5>
                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                        <thead>
                                                                        <tr>
                                                                            <th colspan="1">Cantidad de Bultos</th>
                                                                            <th colspan="3">Bultos Dañados y Cuantos</th>

                                                                        </tr>
                                                                        </thead>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="1" rowspan="1">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-3 col-sm-2 col-xs-3" for="txtCantiBultos">Cantidad</span>
                                                                                    </label>
                                                                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                        <input type="text" id="txtCantiBultos" name="txtCantiBultos" class="form-control col-md-7 col-xs-12"
                                                                                               value=" <?php echo $vRow->getConten()->getCantidadBultos();?>" disabled>
                                                                                    </div>

                                                                                </div>
                                                                            </td>
                                                                            <td colspan="3" rowspan="1">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12">Bultos Dañados</label>
                                                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                        <p>
                                                                                            SI:
                                                                                            <?php $bDañado = $vRow->getConten()->getBultosDañados();?>
                                                                                            <input type="radio" class="flat" name="bDañados" id="bDañados" value="1"  <?php echo($bDañado == 1 ? 'Checked="Checked"' : '');?> disabled /> NO:
                                                                                            <input type="radio" class="flat" name="bDañados" id="bDañados" value="0"  <?php echo($bDañado == 0 ? 'Checked="Checked"' : '');?> disabled />
                                                                                        </p>
                                                                                    </div>
                                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="txtCantiDañados">Cantidad</span>
                                                                                    </label>
                                                                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                        <input type="text" id="txtCantiDañados" name="txtCantiDañados" class="form-control col-md-7 col-xs-12"
                                                                                               value="<?php echo $vRow->getConten()->getCantBultDañados();?>" disabled>
                                                                                    </div>
                                                                                </div>

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4" rowspan="1">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-3 col-sm-2 col-xs-3" for="txtNombre">Presentación de los Bultos</span>
                                                                                    </label>

                                                                                </div>
                                                                                <br/><br/>
                                                                                <div class="form-group">

                                                                                    <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nPalletsMadera = $vRow->getConten()->getPalletsMadera(); ?>
                                                                                                <input type="checkbox" class="flat" name="bultosPresen[]" id="PalletsMadera" value="PalletsMadera" <?php echo ($nPalletsMadera == 1 ? 'Checked="Checked"' : '');?> disabled> Pallets de Madera
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nPalletsPlastico = $vRow->getConten()->getPalletsPlastico(); ?>
                                                                                                <input type="checkbox" class="flat" name="bultosPresen[]" id="PalletsPlastico" value="PalletsPlastico" <?php echo ($nPalletsPlastico == 1 ? 'Checked="Checked"' : '');?> disabled> Pallets de Plástico
                                                                                            </label>
                                                                                        </div>


                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nCartonada = $vRow->getConten()->getCartonada(); ?>
                                                                                                <input type="checkbox" class="flat" name="bultosPresen[]" id="Cartonada" value="Cartonada" <?php echo ($nCartonada == 1 ? 'Checked="Checked"' : '');?> disabled > Cartonada
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nCuñetes = $vRow->getConten()->getCuñetes(); ?>
                                                                                                <input type="checkbox" class="flat" name="bultosPresen[]" id="Cuñetes" value="Cuñetes"   <?php echo ($nCuñetes == 1 ? 'Checked="Checked"' : '');?> disabled > Cuñetes
                                                                                            </label>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nSacos = $vRow->getConten()->getSacos(); ?>
                                                                                                <input type="checkbox" class="flat" name="bultosPresen[]" id="Sacos" value="Sacos"  <?php echo ($nSacos == 1 ? 'Checked="Checked"' : '');?> disabled > Sacos
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nSuperBolsas = $vRow->getConten()->getSuperBolsas(); ?>
                                                                                                <input type="checkbox" class="flat" name="bultosPresen[]" id="SuperBolsas" value="SuperBolsas"  <?php echo ($nSuperBolsas == 1 ? 'Checked="Checked"' : '');?>disabled> Superbolsas
                                                                                            </label>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nBidones = $vRow->getConten()->getBidones(); ?>
                                                                                                <input type="checkbox" class="flat" name="bultosPresen[]" id="Bidones" value="Bidones" <?php echo ($nBidones == 1 ? 'Checked="Checked"' : '');?> disabled> Bidones
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nCont1000L = $vRow->getConten()->getCont1000L(); ?>
                                                                                                <input type="checkbox" class="flat" name="bultosPresen[]" id="Cont1000L" value="Cont1000L"   <?php echo ($nCont1000L == 1 ? 'Checked="Checked"' : '');?> disabled > Cont.1000L
                                                                                            </label>
                                                                                        </div>


                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nHuacales = $vRow->getConten()->getHuacalesMadera(); ?>
                                                                                                <input type="checkbox" class="flat" name="bultosPresen[]" id="HuacalesMadera" value="HuacalesMadera"  <?php echo ($nHuacales == 1 ? 'Checked="Checked"' : '');?> disabled > Huacales de Madera
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nCajasMedera = $vRow->getConten()->getCajasMadera(); ?>
                                                                                                <input type="checkbox" class="flat" name="bultosPresen[]" id="CajasMadera" value="CajasMadera" <?php echo ($nCajasMedera == 1 ? 'Checked="Checked"' : '');?> disabled> Cajas de Madera
                                                                                            </label>
                                                                                        </div>


                                                                                    </div>
                                                                                    <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nRacks = $vRow->getConten()->getRacksMetalicos(); ?>
                                                                                                <input type="checkbox" class="flat" name="bultosPresen[]" id="RacksMetalicos" value="RacksMetalicos"  <?php echo ($nRacks == 1 ? 'Checked="Checked"' : '');?> disabled> Racks Metalicos
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $nGranel = $vRow->getConten()->getGranel(); ?>
                                                                                                <input type="checkbox" class="flat" name="bultosPresen[]" id="Granel" value="Granel" <?php echo ($nGranel == 1 ? 'Checked="Checked"' : '');?> disabled> Granel
                                                                                            </label>
                                                                                        </div>


                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-md-12 col-sm-9 col-xs-12">
                                                                                        <input class="resizable_textarea form-control" placeholder="Otros (Especifique)" name="txtOtrosPresen" id="txtOtrosPresen"  value="<?php echo $vRow->getConten()->getOtros();?> " disabled />
                                                                                    </div>
                                                                                </div>

                                                                            </td>

                                                                        </tr>
                                                                        <tr>
                                                                            <thead>
                                                                            <tr>
                                                                                <th colspan="2">Averias</th>
                                                                                <th colspan="2">Fumigado</th>

                                                                            </tr>
                                                                            </thead>
                                                                        </tr>
                                                                        <tr>

                                                                            <td colspan="2" rowspan="1">
                                                                                <div class="form-group">
                                                                                    <div class="col-md-4 col-sm-3 col-xs-12">
                                                                                        <p>
                                                                                            Origen:
                                                                                            <?php $nAveriasOrigen = $vRow->getConten()->getAveriasOrigen(); ?>
                                                                                            <?php $nAveriasRecinto = $vRow->getConten()->getAveriasRecinto(); ?>
                                                                                            <input type="radio" class="flat" name="averias" id="averias" value="1" <?php echo($nAveriasOrigen == 1 ? 'Checked="Checked"' : '');?> disabled/> <br/>
                                                                                            Recinto:
                                                                                            <input type="radio" class="flat" name="averias" id="averias" value="0" <?php echo($nAveriasRecinto == 1 ? 'Checked="Checked"' : '');?> disabled />
                                                                                        </p>
                                                                                    </div>

                                                                                </div>

                                                                            </td>
                                                                            <td colspan="2" rowspan="1">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-3 col-sm-4 col-xs-12">Fumigado</label>
                                                                                    <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                        <input type="text" id="txtCantiDañados" name="txtCantiDañados" class="form-control col-md-7 col-xs-12"
                                                                                               value="<?php echo $vRow->getConten()->getFumigado();?>" disabled>
                                                                                    </div>

                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <thead>
                                                                            <tr>
                                                                                <th colspan="2">Mercancia</th>
                                                                                <th colspan="2">Previo</th>
                                                                            </tr>
                                                                            </thead>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2" rowspan="1">
                                                                                <?php
                                                                                    if($vRow->getMercancia()->getConformeFactura() != 0){
                                                                                        ?>
                                                                                        <div class="form-group">
                                                                                            <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtConFact">Conforme a factura</span>
                                                                                            </label>
                                                                                            <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                                <input type="text" id="txtConFact" name="txtConFact"  required="required" class="form-control col-md-7 col-xs-12"
                                                                                                value="<?php echo($vRow->getMercancia()->getConformeFactura() == 1 ? 'SI' : ''); ?>" disabled/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php
                                                                                    }else if($vRow->getMercancia()->getFaltante() != 0){
                                                                                        ?>
                                                                                        <div class="form-group">
                                                                                            <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtConFact">Faltante</span>
                                                                                            </label>
                                                                                            <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                                <input type="text" id="txtConFact" name="txtConFact"  required="required" class="form-control col-md-7 col-xs-12"
                                                                                                       value="<?php echo($vRow->getMercancia()->getFaltante() == 1 ? 'SI' : ''); ?>" disabled/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <br/><br/>
                                                                                        <div class="form-group">
                                                                                            <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtConFact">Cantidad Faltante</span>
                                                                                            </label>
                                                                                            <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                                <input type="text" id="txtConFact" name="txtConFact"  required="required" class="form-control col-md-7 col-xs-12"
                                                                                                       value="<?php echo $vRow->getMercancia()->getCantidad(); ?>" disabled/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php
                                                                                    }else if($vRow->getMercancia()->getSobrante() != 0){
                                                                                        ?>
                                                                                        <div class="form-group">
                                                                                            <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtConFact">Sobrante</span>
                                                                                            </label>
                                                                                            <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                                <input type="text" id="txtConFact" name="txtConFact"  required="required" class="form-control col-md-7 col-xs-12"
                                                                                                       value="<?php echo($vRow->getMercancia()->getSobrante() == 1 ? 'SI' : ''); ?>" disabled/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <br/><br/>
                                                                                        <div class="form-group">
                                                                                            <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtConFact">Cantidad Sobrante</span>
                                                                                            </label>
                                                                                            <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                                <input type="text" id="txtConFact" name="txtConFact"  required="required" class="form-control col-md-7 col-xs-12"
                                                                                                       value="<?php echo $vRow->getMercancia()->getCantidad(); ?>" disabled/>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                            <td colspan="2" rowspan="1">
                                                                                <div class="form-group">
                                                                                    <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $DesYCon = $vRow->getPrevio()->getDesYCon();?>
                                                                                                <input type="checkbox" class="flat" name="Previos[]" id="DesYCon" value="DesYCon" <?php echo ($DesYCon == 1 ? 'Checked="Checked"' : ''); ?> disabled> DesYCon
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $Separacion = $vRow->getPrevio()->getSeparacion(); ?>
                                                                                                <input type="checkbox" class="flat" name="Previos[]" id="Separacion" value="Separacion" <?php echo ($Separacion == 1 ? 'Checked="Checked"' : ''); ?> disabled> Separación
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $Ocular = $vRow->getPrevio()->getOcular(); ?>
                                                                                                <input type="checkbox" class="flat" name="Previos[]" id="Ocular" value="Ocular" <?php echo ($Ocular == 1 ? 'Checked="Checked"' : ''); ?> disabled> Ocular
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $Revision = $vRow->getPrevio()->getRevConAutoridad(); ?>
                                                                                                <input type="checkbox" class="flat" name="Previos[]" id="RevisiónC/Autoridad" value="RevisionC/Autoridad" <?php echo ($vRow->getPrevio()->getRevConAutoridad() == 1 ? 'Checked="Checked"' : ''); ?> disabled> Revisión C/Autoridad
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                        <div class="checkbox">
                                                                                            <label>
                                                                                                <?php $Etiquetado = $vRow->getPrevio()->getEtiquetado();?>
                                                                                                <input type="checkbox" class="flat" name="Previos[]" id="Etiquetado" value="Etiquetado" <?php echo ($Etiquetado == 1 ? 'Checked="Checked"' : ''); ?> disabled > Etiquetado
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <?php
                                                $nCon = $nCon + 1;
                                            }else{
                                                ?>
                                                <div class="x_content">
                                                    <form id="cargaSuelta">
                                                        <input type="hidden" name="txtRef" value="<?php echo $sRef;?>"/>
                                                        <input type="hidden" name="operacion" value="CargaSuelta" />
                                                        <div class="panel-body">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-1 col-sm-1 col-xs-3" >Sello de Origen</span>
                                                                </label>
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <input type="text" id="txtSellos" name="txtSellos" required="required" class="form-control col-md-7 col-xs-12"
                                                                    value="<?php echo $vRow->getConten()->getSelloOrigen(); ?>" disabled/>
                                                                </div>
                                                                <label class="control-label col-md-1 col-sm-1 col-xs-3" >No. BL</span>
                                                                </label>
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <input type="text" id="txtBL" name="txtBL" required="required" value="<?php echo $vRow->getConten()->getBL(); ?> " class="form-control col-md-7 col-xs-12" disabled />
                                                                </div>
                                                                <label class="control-label col-md-1 col-sm-4 col-xs-12">IMO</label>
                                                                <div class="col-md-3 col-sm-9 col-xs-12">
                                                                    <input type="text" id="txtIMO" name="txtIMO" required="required" value="<?php echo ($vRow->getConten()->getIMO() == 1 ? 'SI' : 'NO'  ); ?> " class="form-control col-md-7 col-xs-12"  disabled/>
                                                                </div>
                                                            </div>
                                                            <br/><br/>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-1 col-sm-2 col-xs-3" for="txtNombre">Sello Colocado</span>
                                                                </label>
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <input type="text" id="txtSelloColocado" name="txtSelloColocado" required="required" class="form-control col-md-7 col-xs-12"
                                                                    value="<?php  echo $vRow->getConten()->getSelloColocado();?>" disabled >
                                                                </div>
                                                                <label class="control-label col-md-1 col-sm-2 col-xs-3" for="txtNombre">Peso</span>
                                                                </label>
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <input type="text" id="Peso" name="Peso" required="required" class="form-control col-md-7 col-xs-12"
                                                                   value="<?php echo $vRow->getConten()->getPeso(); ?>" disabled >
                                                                </div>
                                                                <label class="control-label col-md-1 col-sm-2 col-xs-3" for="RecintoPrevio">Recinto</span>
                                                                </label>
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <input type="text" id="RecintoPrevio" name="RecintoPrevio" required="required" class="form-control col-md-7 col-xs-12"
                                                                           value="<?php echo $vRow->getConten()->getRecintoPrevio(); ?>" disabled >
                                                                </div>
                                                            </div>
                                                            <br/>
                                                            <br/>
                                                            <br/>
                                                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                                                <thead>
                                                                <tr>
                                                                    <td colspan="4" rowspan="1">
                                                                        <h5 align="center"> Bultos</h5>
                                                                    </td>

                                                                </tr>
                                                                </thead>

                                                                <tr>
                                                                    <th colspan="1">Cantidad de Bultos</th>
                                                                    <th colspan="3">Bultos Dañados y Cuantos</th>

                                                                </tr>
                                                                <tr>
                                                                    <td colspan="1" rowspan="1">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-3 col-sm-2 col-xs-3" for="txtCantiBultos">Cantidad</span>
                                                                            </label>
                                                                            <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                <input type="text" id="txtCantiBultos" name="txtCantiBultos" required="required" class="form-control col-md-7 col-xs-12"
                                                                               value="<?php echo $vRow->getConten()->getCantidadBultos();?>" disabled >
                                                                            </div>

                                                                        </div>
                                                                    </td>
                                                                    <td colspan="3" rowspan="1">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Bultos Dañados</label>
                                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                <p>
                                                                                    <?php $bDañados = $vRow->getConten()->getBultosDañados(); ?>
                                                                                    SI:
                                                                                    <input type="radio" class="flat" name="bDañados" id="bDañados" value="1"  <?php echo ($bDañado == 1 ? 'Checked="Checked"' : ''); ?> disabled/> NO:
                                                                                    <input type="radio" class="flat" name="bDañados" id="bDañados" value="0" <?php echo ($bDañado == 0 ? 'Checked="Checked"' : ''); ?> disabled/>
                                                                                </p>
                                                                            </div>
                                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="txtCantiDañados">Cantidad</span>
                                                                            </label>
                                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                                <input type="text" id="txtCantiDañados" name="txtCantiDañados" required="required" class="form-control col-md-7 col-xs-12"
                                                                                value="<?php echo  $vRow->getConten()->getCantBultDañados();?>" disabled >
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4" rowspan="1">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-3 col-sm-2 col-xs-3" for="txtNombre">Presentación de los Bultos</span>
                                                                            </label>

                                                                        </div>
                                                                        <br/><br/>
                                                                        <div class="form-group">

                                                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $pMadera = $vRow->getConten()->getPalletsMadera(); ?>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen1" value="PalletsMadera" <?php echo ($pMadera == 1 ? 'Checked="Checked"' : ''); ?> disabled> Pallets de Madera
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $pPlastico = $vRow->getConten()->getPalletsPlastico(); ?>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen2" value="PalletsPlastico"  <?php echo ($pPlastico == 1 ? 'Checked="Checked"' : ''); ?> disabled  > Pallets de Plástico
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $Cartonada = $vRow->getConten()->getCartonada(); ?>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen2" value="Cartonada" <?php echo ($Cartonada == 1 ? 'Checked="Checked"' : '' ); ?> disabled> Cartonada
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $cuñetas = $vRow->getConten()->getCuñetes(); ?>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen3" value="Cuñetes" <?php echo ($cuñetas == 1 ? 'Checked="Checked"' : '' ); ?> disabled > Cuñetes
                                                                                    </label>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $saco = $vRow->getConten()->getSacos(); ?>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen4" value="Sacos" <?php echo ($saco == 1 ? 'Checked="Checked"' : '' ); ?> disabled > Sacos
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $bolsas = $vRow->getConten()->getSuperBolsas(); ?>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen5" value="SuperBolsas" <?php echo ($bolsas == 1 ? 'Checked="Checked"' : '' ); ?> disabled > Superbolsas
                                                                                    </label>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $bidones = $vRow->getConten()->getBidones(); ?>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen6" value="Bidones" <?php echo ($bidones == 1 ? 'Checked="Checked"' : '' ); ?>  disabled > Bidones
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $Cont1000L = $vRow->getConten()->getCont1000L(); ?>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen7" value="Cont1000L"  <?php echo ($Cont1000L == 1 ? 'Checked="Checked"' : '' ); ?> disabled  > Cont.1000L
                                                                                    </label>
                                                                                </div>


                                                                            </div>
                                                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $huacales = $vRow->getConten()->getHuacalesMadera(); ?>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen8" value="HuacalesMadera" <?php echo ($huacales == 1 ? 'Checked="Checked"' : '' ); ?> disabled > Huacales de Madera
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $cajas = $vRow->getConten()->getCajasMadera(); ?>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen9" value="CajasMadera" <?php echo ($cajas == 1 ? 'Checked="Checked"' : '' ); ?> disabled > Cajas de Madera
                                                                                    </label>
                                                                                </div>


                                                                            </div>
                                                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $Racks = $vRow->getConten()->getRacksMetalicos(); ?>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen10" value="RacksMetalicos" <?php echo ($Racks == 1 ? 'Checked="Checked"' : '' ); ?>  disabled> Racks Metalicos
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $granel = $vRow->getConten()->getGranel(); ?>
                                                                                        <input type="checkbox" class="flat" name="bultosPresen[]" id="bultosPresen11" value="Granel" <?php echo ($granel == 1 ? 'Checked="Checked"' : '' ); ?> disabled> Granel
                                                                                    </label>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-md-12 col-sm-9 col-xs-12">
                                                                                <input class="resizable_textarea form-control" placeholder="Otros (Especifique)" name="txtOtrosPresen" id="txtOtrosPresen" value="<?php echo $vRow->getConten()->getOtros(); ?> " disabled/>
                                                                            </div>
                                                                        </div>

                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <thead>
                                                                    <tr>
                                                                        <th colspan="2">Averias</th>
                                                                        <th colspan="2">Fumigado</th>

                                                                    </tr>
                                                                    </thead>
                                                                </tr>
                                                                <tr>

                                                                    <td colspan="2" rowspan="1">
                                                                        <div class="form-group">
                                                                            <div class="col-md-4 col-sm-3 col-xs-12">
                                                                                <p>
                                                                                    <?php $averiasOrigen = $vRow->getConten()->getAveriasOrigen(); ?>
                                                                                    <?php $averiasRecinto = $vRow->getConten()->getAveriasRecinto(); ?>
                                                                                    Origen:
                                                                                    <input type="radio" class="flat" name="averias" id="averias" value="1" <?php echo ($averiasOrigen == 1 ? 'Checked="Checked"' : '' ); ?> disabled />
                                                                                    <br/>
                                                                                    Recinto:
                                                                                    <input type="radio" class="flat" name="averias" id="averias" value="0" <?php echo ($averiasRecinto == 1 ? 'Checked="Checked"' : '' ); ?> disabled />
                                                                                </p>
                                                                            </div>

                                                                        </div>

                                                                    </td>
                                                                    <td colspan="2" rowspan="1">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-3 col-sm-4 col-xs-12">FUMIGADO</label>
                                                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                                                <input type="text" class="form-control col-md-7 col-xs-12"  name="txtFumigado" id="txtFumigado" value=" <?php echo ($vRow->getConten()->getFumigado() == 1 ? 'SI' : 'NO') ;?>" disabled>
                                                                            </div>

                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <thead>
                                                                    <tr>
                                                                        <th colspan="2">Mercancia</th>
                                                                        <th colspan="2">Previo</th>

                                                                    </tr>
                                                                    </thead>
                                                                </tr>
                                                                <tr>

                                                                    <td colspan="2" rowspan="1">
                                                                        <?php
                                                                        if($vRow->getMercancia()->getConformeFactura() == 1){
                                                                            ?>
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtConFact">Conforme a factura</span>
                                                                                </label>
                                                                                <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                    <input type="text" id="txtConFact" name="txtConFact"  required="required" class="form-control col-md-7 col-xs-12"
                                                                                           value="<?php echo($vRow->getMercancia()->getConformeFactura() == 1 ? 'SI' : ''); ?>" disabled/>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }else if($vRow->getMercancia()->getFaltante() == 1){
                                                                            ?>
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtConFact">Faltante</span>
                                                                                </label>
                                                                                <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                    <input type="text" id="txtConFact" name="txtConFact"  required="required" class="form-control col-md-7 col-xs-12"
                                                                                           value="<?php echo($vRow->getMercancia()->getFaltante() == 1 ? 'SI' : ''); ?>" disabled/>
                                                                                </div>
                                                                            </div>
                                                                            <br/><br/>
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtConFact">Cantidad Faltante</span>
                                                                                </label>
                                                                                <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                    <input type="text" id="txtConFact" name="txtConFact"  required="required" class="form-control col-md-7 col-xs-12"
                                                                                           value="<?php echo $vRow->getMercancia()->getCantidad(); ?>" disabled/>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }else if($vRow->getMercancia()->getSobrante() == 1){
                                                                            ?>
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtConFact1">Sobrante</span>
                                                                                </label>
                                                                                <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                    <input type="text" id="txtConFact1" name="txtConFact1"  required="required" class="form-control col-md-7 col-xs-12"
                                                                                           value="<?php echo($vRow->getMercancia()->getSobrante() == 1 ? 'SI' : ''); ?>" disabled/>
                                                                                </div>
                                                                            </div>
                                                                            <br/><br/>
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtConFact1">Cantidad Sobrante</span>
                                                                                </label>
                                                                                <div class="col-md-7 col-sm-6 col-xs-12">
                                                                                    <input type="text" id="txtConFact1" name="txtConFact1"  required="required" class="form-control col-md-7 col-xs-12"
                                                                                           value="<?php echo $vRow->getMercancia()->getCantidad(); ?>" disabled/>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }else{
                                                                            ?>
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-4 col-sm-2 col-xs-3" for="txtConFact1">No se registró información</span>
                                                                                </label>

                                                                            </div>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td colspan="2" rowspan="1">
                                                                        <div class="form-group">

                                                                            <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $separacion = $vRow->getPrevio()->getSeparacion(); ?>
                                                                                        <input type="checkbox" class="flat" name="Previos[]" id="bultosPresen2" value="Separacion" <?php echo ($separacion == 1 ? 'Checked="Checked"' : ''); ?> disabled> Separacion
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $ocular = $vRow->getPrevio()->getOcular(); ?>
                                                                                        <input type="checkbox" class="flat" name="Previos[]" id="bultosPresen3" value="Ocular" <?php echo ($ocular == 1 ? 'Checked="Checked"' : ''); ?> disabled> Ocular
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-9 col-xs-12">
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $revision = $vRow->getPrevio()->getRevConAutoridad(); ?>
                                                                                        <input type="checkbox" class="flat" name="Previos[]" id="bultosPresen4" value="RevisionC/Autoridad" <?php echo ($revision == 1 ? 'Checked="Checked"' : ''); ?> disabled> Revisión C/Autoridad
                                                                                    </label>
                                                                                </div>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <?php $etiquetado = $vRow->getPrevio()->getEtiquetado(); ?>
                                                                                        <input type="checkbox" class="flat" name="Previos[]" id="bultosPresen5" value="Etiquetado" <?php echo ($etiquetado == 1 ? 'Checked="Checked"' : ''); ?>disabled > Etiquetado
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </form>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>



            </div>
