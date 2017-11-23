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
    include "funcionsFactures.php";
    $idFactura = $_GET["id"];
    $result = getFacturaData($idFactura);
    $row = $result->fetch_assoc();
    ?>

    <?php //$row["dia_mensual_pagament_2_client"] $row["dia_mensual_pagament_client"] ?>
    <script>
      var datafactura=document.getElementById("dataFactura");
      var datavenciment=document.getElementById("dataVenciment");
      //datafactura.innerHTML = "My First JavaScript";
      var data = Date(2020,12,30);
      document.getElementById("dataFactura").value="2016-05-01";
      datavenciment.value=data;
      /*datafactura.addEventListener('input', function (evt)) {
        something(this.value);
      });*/
    </script>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <table style='margin-top: 20px;'>
                    <tr>
                        <td><form type='submit' action='mostrarFactura.php'><input type="hidden" name="id" value="<?php echo $idFactura; ?>"><button style='margin: 5px;' type='submit' class="btn btn-primary"><i class="fa fa-arrow-left"></i> Tornar a la factura</button></form></td>
                    </tr>
                </table>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-pencil" aria-hidden="true"></i> Modificar factura <?php //echo getClientCognomNom($idClient); ?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Finalitzar factura
                    </div>
                    <div class="panel-body">
                        <form role="form" action="scriptCanviarEstatFactura.php" method="post">
                            <div class="row">

                                <div class="col-lg-4">
                                    <h1>Numero factura</h1>
                                    <div class="form-group">
                                        <label>Serialització</label>
                                        <input name="numeroFactura" class="form-control" placeholder="Número de factura" value="<?php mostrarNumeroFactura($row["numero_factura"]); ?>">
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-4">
                                    <h1>Dates</h1>
                                    <div class="form-group">
                                        <label>Data de la factura</label><br \>
                                        <input type="date" id="dataFactura" name="dataFactura" value="<?php printDataFactura($idFactura);?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Data màxima pagament</label><br \>
                                        <input type="date" id="dataVenciment" name="dataVenciment" value="<?php printDataVencimentFactura($idFactura);?>">
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <h1>Pagament</h1>
                                    <div class="form-group">
                                        <label>Forma de pagament</label>
                                        <?php printRadioFormesPagamentClient($row["id_client_factura"], $idFactura); ?>
                                    </div>
                                    <label>IVA Factura</label>
                                    <div class="form-group input-group">

                                        <input name="ivaFactura" class="form-control" value="21">
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                  <input type="hidden" name="idFactura" value="<?php echo $idFactura; ?>">
                                  <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar canvis</button>

                                </div>

                            </div>
                            <!-- /.row (nested) -->
                        </form>

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

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
