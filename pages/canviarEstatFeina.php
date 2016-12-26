<!DOCTYPE html>
<html lang="ca">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MaqfaPlus</title>
    <link href="../images/favicon.ico" type="image/x-icon" rel="shorcut icon" />

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">
    <?php
    include "menu.php";
    include "funcionsFeines.php"
    ?>
    <?php
    $idFeina = $_GET["id"];
    echo '<div id="page-wrapper">';
    echo"
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <h1 class=\"page-header\"><i class=\"fa fa-tasks\"></i> Canviar estat</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class=\"row\"> 
                <div class=\"col-lg-12\">
                    <div class=\"panel panel-default\">
                        <div class=\"panel-heading\">
                            Nou estat de la feina
                        </div>
                        <!-- /.panel-heading -->
                        <div class=\"panel-body\">
                            <table><td>
                            <form action='scriptCanviarEstatFeina.php' method='post'>
                                            <input type=\"hidden\" name=\"id\" value=" . $idFeina.">
                                            <input type=\"hidden\" name=\"estat\" value=1>
                                            <th><button style='margin: 5px;' type='submit' class=\"btn btn-primary\"><i class=\"fa fa-cog fa-spin\"></i> Activa</button>	&nbsp;</th></form>
                                            <form action='scriptCanviarEstatFeina.php' method='post'>
                                            <input type=\"hidden\" name=\"id\" value=" . $idFeina.">
                                            <input type=\"hidden\" name=\"estat\" value=2>
                                            <th><button style='margin: 5px;' type='submit' class=\"btn btn-warning\"><i class=\"fa fa-check-square-o\"></i> Finalitzada</button>	&nbsp;</form></th>
                                            <form action='scriptCanviarEstatFeina.php' method='post'>
                                            <input type=\"hidden\" name=\"id\" value=" . $idFeina.">
                                            <input type=\"hidden\" name=\"estat\" value=3>
                                            <th><button style='margin: 5px;' type='submit' class=\"btn btn-success\"><i class=\"fa fa-check-square\"></i> Facturada</button>	&nbsp;</form></th>
                                            
                            </td></table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            ";
    echo "</div>";

    ?>
</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>