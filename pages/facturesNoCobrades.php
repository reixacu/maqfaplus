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
    include "funcionsFactures.php";
    include "menu.php";

    if(isset($_GET['fins'])) {
      $fins = $_GET['fins'];
    } else {
      $fins = date('Y-m-d');
    }

    if(isset($_GET['desde'])) {
      $desde = $_GET['desde'];
    } else {
      $desde = date('Y-m-d', strtotime("-3 months", strtotime($fins)));
    }


    ?>
    <?php
    $sql = "SELECT * FROM `factures`  WHERE `pagament_realitzat_factura`=0 AND `numero_factura` != '' AND `factures`.`data_venciment_factura` >= '$desde' AND `factures`.`data_venciment_factura` <= '$fins' ORDER BY `factures`.`id_factura` DESC ";
    echo "
    <div id=\"page-wrapper\">
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <table cellpadding=\"10\">
                    <tr>
                        <td><h1 class=\"page-header\"><i class=\"fa fa-money\"></i> Factures pendents de cobrar</h1></td>
                        <td><form class=\"page-header\" action='afegirFactura.php'> <button style=\"margin-top: 5px; margin-left: 15px\" type='submit' class=\"btn btn-primary \"><i class=\"fa fa-plus\"></i> Afegir una factura</button></form></td>
                    </tr>
                </table>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <div class=\"panel panel-primary\">
                    <div class=\"panel-heading\">
                        Filtre
                    </div>
                    <!-- /.panel-heading -->
                    <div class=\"panel-body\">
                      <div class=\"row\">
                        <div class=\"col-lg-12\">
                          ";
                            printFiltreDataForm($desde, $fins, $idClient);
                            echo "
                        </div>
                      </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <div class=\"panel panel-primary\">
                    <div class=\"panel-heading\">
                        Factures que no s'han cobrat
                    </div>
                    <!-- /.panel-heading -->
                    <div class=\"panel-body\">
                        ";
                        mostrarFacturesPendents($sql);
                    echo "
                    </div>
                </div>
            </div>
        </div>
    </div>";
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

<?php

function printFiltreDataForm($desde, $fins, $idClient)
{
  echo "
  <form action=\"facturesNoCobrades.php\" method=\"get\">
    <input type=\"hidden\" value=\"".$idClient."\" name=\"idClient\">
    <input type=\"date\" name=\"desde\" value=\"".$desde."\"> fins
    <input type=\"date\" name=\"fins\" value=\"".$fins."\">
    <button type=\"submit\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i> Filtrar data</button>
  </form>
  ";
}

 ?>
