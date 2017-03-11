<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 12/01/2017
 * Time: 11:29
 */

include_once ("../Modelos/Menu.php");
include_once ("../Modelos/Persona.php");
include_once ("../Modelos/ImagenesPartida.php");
session_start();
$oMenu = new Menu();
$oPers = new Persona();
$oImg = new ImagenesPartida();
$arrImg = null;
$sErr ="";
$sNom = "";
$nGrp = 0;
$arrMenu = null;
$nick = "";


if(isset($_SESSION['sUser']) && !empty($_SESSION['sUser'])){
    $oPers = $_SESSION['sUser'];
    $sNom = $oPers->getNomCompleto();
    $nick = $oPers->getUsuario();
    $sRef = $_POST['txtRef1'];
    $nFact = $_POST['txtFac1'];
    $nItem = $_POST['txtItem'];
    $sCad1 = substr($sRef,0,3);
    $sCad2 = substr($sRef,4,5);
    $sCad3 = substr($sRef, 10, 4);
    $sRef = $sCad1."-".$sCad2."-".$sCad3;
    $oImg->setSir60(new Sir60Referencias());
    $oImg->getSir60()->setReferencia($sRef);
    $oImg->setFactura($nFact);
    $oImg->setItem($nItem);
    $arrImg = $oImg->buscarImagenes();
    if($oPers->getReferen() == 1){
        $arrMenu = $oMenu->generarMenu($oPers->getGrp()->getIdGrp());
    }else if($oPers->getReferen() == 2 or $oPers->getReferen() == 3){
        $arrMenu = $oMenu->generarMenu(($oPers->getGrupo()));
    }else{
        $sErr = "Error en el menú";
    }

}else{
    $sErr = "Faltan datos de Sesión";
}

if($sErr != ""){
    header("Location: ../error.php?sError=".$sErr);
}

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

    <link href="../css/estilos.css" type="text/css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- iCheck -->
    <!--<script src="../../vendors/iCheck/icheck.min.js"-->

    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
                                                           <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
                                                                                                                                         <script type="text/javascript">
    window.alert = function(){};
    var defaultCSS = document.getElementById('bootstrap-css');
    function changeCSS(css){
    if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />');
        else $('head > link').filter(':first').replaceWith(defaultCSS);
    }
    $( document ).ready(function() {
        var iframe_height = parseInt($('html').height());
        window.parent.postMessage( iframe_height, 'http://bootsnipp.com');
    });
    </script>

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
    <script>
        !function ($) {

            "use strict"; // jshint ;_;


            /* MAGNIFY PUBLIC CLASS DEFINITION
             * =============================== */

            var Magnify = function (element, options) {
                this.init('magnify', element, options)
            }

            Magnify.prototype = {

                constructor: Magnify

                , init: function (type, element, options) {
                    var event = 'mousemove'
                        , eventOut = 'mouseleave';

                    this.type = type
                    this.$element = $(element)
                    this.options = this.getOptions(options)
                    this.nativeWidth = 0
                    this.nativeHeight = 0

                    this.$element.wrap('<div class="magnify" \>');
                    this.$element.parent('.magnify').append('<div class="magnify-large" \>');
                    this.$element.siblings(".magnify-large").css("background","url('" + this.$element.attr("src") + "') no-repeat");

                    this.$element.parent('.magnify').on(event + '.' + this.type, $.proxy(this.check, this));
                    this.$element.parent('.magnify').on(eventOut + '.' + this.type, $.proxy(this.check, this));
                }

                , getOptions: function (options) {
                    options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data())

                    if (options.delay && typeof options.delay == 'number') {
                        options.delay = {
                            show: options.delay
                            , hide: options.delay
                        }
                    }

                    return options
                }

                , check: function (e) {
                    var container = $(e.currentTarget);
                    var self = container.children('img');
                    var mag = container.children(".magnify-large");

                    // Get the native dimensions of the image
                    if(!this.nativeWidth && !this.nativeHeight) {
                        var image = new Image();
                        image.src = self.attr("src");

                        this.nativeWidth = image.width;
                        this.nativeHeight = image.height;

                    } else {

                        var magnifyOffset = container.offset();
                        var mx = e.pageX - magnifyOffset.left;
                        var my = e.pageY - magnifyOffset.top;

                        if (mx < container.width() && my < container.height() && mx > 0 && my > 0) {
                            mag.fadeIn(100);
                        } else {
                            mag.fadeOut(100);
                        }

                        if(mag.is(":visible"))
                        {
                            var rx = Math.round(mx/container.width()*this.nativeWidth - mag.width()/2)*-1;
                            var ry = Math.round(my/container.height()*this.nativeHeight - mag.height()/2)*-1;
                            var bgp = rx + "px " + ry + "px";

                            var px = mx - mag.width()/2;
                            var py = my - mag.height()/2;

                            mag.css({left: px, top: py, backgroundPosition: bgp});
                        }
                    }

                }
            }


            /* MAGNIFY PLUGIN DEFINITION
             * ========================= */

            $.fn.magnify = function ( option ) {
                return this.each(function () {
                    var $this = $(this)
                        , data = $this.data('magnify')
                        , options = typeof option == 'object' && option
                    if (!data) $this.data('tooltip', (data = new Magnify(this, options)))
                    if (typeof option == 'string') data[option]()
                })
            }

            $.fn.magnify.Constructor = Magnify

            $.fn.magnify.defaults = {
                delay: 0
            }


            /* MAGNIFY DATA-API
             * ================ */

            $(window).on('load', function () {
                $('[data-toggle="magnify"]').each(function () {
                    var $mag = $(this);
                    $mag.magnify()
                })
            })

        } ( window.jQuery );
    </script>
    <style>
      a:link {
          text-decoration:none;
      }

    .green, .green a {
        color: #339900;
    }


    body{
        background-color:#111;
        color:white;
    }


    .col-md-12{
        padding: 120px;
    }

    .mag {
        width:450px;
        margin: 0 auto;
        float: none;
    }

    .mag img {
        max-width: 100%;
    }


    .mag1 {
        width:120px;
        margin: 0 auto;
        float: none;
    }

    .mag1 img {
        max-width: 100%;
    }

    .mag2 {
        width:900px;
        margin: 0 auto;
        float: none;
    }

    .mag2 img {
        max-width: 100%;
    }

    .magnify {
        position: relative;
        cursor: none
    }

    .magnify-large {
        position: absolute;
        display: none;
        width: 300px;
        height: 300px;

        -webkit-box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.55), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
        -moz-box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.55), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
        box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.55), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);

        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%
    }
    </style>

    <!--Galeria>

    <!-- -->
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <img src="../images/trimex.png" class="img-responsive" />
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_info">
                        <span>Bienvenido</span>
                        <h2><?php echo $sNom;?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br /><br /><br /><br /><br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> Página Principal <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="menuPrincipal.php">Inicio</a></li>
                                </ul>
                            </li>
                        </ul>
                        <?php
                        for($i=0;$i<count($arrMenu);$i++){
                            ?>
                            <ul class="nav side-menu">
                                <li>
                                    <a><i class="<?php echo $arrMenu[$i]['icon'];?>"></i> <?php echo $arrMenu[$i]['titulo']; ?><span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <?php
                                        if(count($arrMenu[$i]['subcategoria'])>0){
                                            for($j=0;$j<count($arrMenu[$i]['subcategoria']);$j++){
                                                ?>
                                                <li><a href="<?php echo $arrMenu[$i]['subcategoria'][$j]['enlace'];?>"><?php echo $arrMenu[$i]['subcategoria'][$j]['titulo'];?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>

                </div>
                <!-- /sidebar menu -->
                <div class="clearfix"></div>

            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <?php echo $nick;?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="../Controladores/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <br/><br/><br/>
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="clearfix"></div>

                <div class="row">
                    <div class="x_panel">
                        <div class="x_content">

                            <div class="container">

                                <?php
                                $nCon = 0;
                                if($arrImg != null){
                                    foreach ($arrImg as $vImg){
                                        ?>
                                        <div class="col-md-6">
                                            <div class="image view view-first">
                                                <img data-toggle="magnify" src="<?php echo $vImg->getRutaArchivo()."/".$vImg->getNombreArchivo(); ?>"style="width: 100%; display: block;" class="img-responsive img-rounded center-block" alt="image">
                                            </div>
                                            <br/><br/>
                                        </div> <!--/.cool-md-12-->
                                        <?php
                                        $nCon ++;
                                    }

                                }

                                ?>

                                <!--/.row-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
    <!-- jQuery -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="../../vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- morris.js -->
    <script src="../../vendors/raphael/raphael.min.js"></script>
    <script src="../../vendors/morris.js/morris.min.js"></script>
    <!-- gauge.js -->
    <script src="../../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- Skycons -->
    <script src="../../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../../vendors/Flot/jquery.flot.js"></script>
    <script src="../../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../../vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../../vendors/moment/min/moment.min.js"></script>
    <script src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>

    <!-- Flot -->

    <!-- /Flot -->

    <!-- jQuery Sparklines -->

    <!-- /jQuery Sparklines -->

    <!-- Doughnut Chart -->

    <!-- /Doughnut Chart -->

    <!-- bootstrap-daterangepicker -->

    <!-- /bootstrap-daterangepicker -->

    <!-- morris.js -->

    <!-- /morris.js -->

    <!-- Skycons -->

    <!-- /Skycons -->

    <!-- gauge.js -->

    <!-- /gauge.js -->

</body>
</html>




