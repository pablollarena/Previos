<?php
/**
 * Created by PhpStorm.
 * User: PLLARENA
 * Date: 14/01/2017
 * Time: 12:40
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Previos </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <div align="top">
                <img src="images/trimex.png" class="img-responsive">
            </div>
            </br>
            <section class="login_content">
                <form method="post" action="Controladores/controlLogin.php">
                    <div>
                        <input type="text" class="form-control" id="txtUser" name="txtUser" required/>
                    </div>
                    <div>
                        <input type="password" class="form-control" id="txtPass" name="txtPass" required/>
                    </div>
                    <div class="clearfix"></div>
                    <div align="center">
                        <input type="submit" class="btn btn-primary" value="Ingresar" />
                    </div>

                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>

