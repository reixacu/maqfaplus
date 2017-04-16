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
    ?>
    <?php
    $sql = "SELECT * FROM `factures` WHERE `factures`.`numero_factura` != '' ORDER BY `factures`.`id_factura` DESC";
    echo "
    <div id=\"page-wrapper\">
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <table cellpadding=\"10\">
                    <tr>
                        <td><h1 class=\"page-header\"><i class=\"fa fa-globe\"></i> Totes les factures</h1></td>
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
                        Totes les factures
                    </div>
                    <!-- /.panel-heading -->
                    <div class=\"panel-body\">
                        ";
                        include "mysql.php";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "
                                              <div class=\"table-responsive\">
                                                    <table class=\"table\">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Estat</th>
                                                                <th>Concepte</th>
                                                                <th>Client</th>
                                                                <th>Data factura</th>
                                                                <th>Data venciment</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        ";
                            while($row = $result->fetch_assoc()) {
                                if ($row["numero_factura"] == "")
                                {
                                        echo "<tr class=\"warning\">
                                                                                <td><a href='mostrarFactura.php?id=".$row["id_factura"]."'>". $row["id_factura"] . "</td>
                                                                                <td><i class=\"fa fa-eraser\" aria-hidden=\"true\"></i> Borrador</td>
                                                                                <td>". $row["comentari_factura"] . "</td>
                                                                                <td><a href='mostrarClient.php?id=" . $row["id_client_factura"] ."'>". getClientCognomNom($row["id_client_factura"]) . "</a></td>
                                                                                <td>". getDataDMY($row["data_factura"]) . "</td>
                                                                                <td>". getDataDMY($row["data_venciment_factura"]) . "</td>
                                                                            </tr>";
                                }
                                else if ($row["pagament_realitzat_factura"] == 0){
                                  echo "<tr class=\"danger\">
                                                                          <td><a href='mostrarFactura.php?id=".$row["id_factura"]."'>". $row["numero_factura"] . "</td>
                                                                        <td><i class=\"fa fa-money\" aria-hidden=\"true\"></i> Pendent de cobrament</td>
                                                                          <td>". $row["comentari_factura"] . "</td>
                                                                          <td><a href='mostrarClient.php?id=" . $row["id_client_factura"] ."'>". getClientCognomNom($row["id_client_factura"]) . "</a></td>
                                                                          <td>". getDataDMY($row["data_factura"]) . "</td>
                                                                          <td>". getDataDMY($row["data_venciment_factura"]) . "</td>
                                                                      </tr>";
                                }
                                else if ($row["pagament_realitzat_factura"] == 1){
                                  echo "<tr class=\"success\">
                                                                          <td><a href='mostrarFactura.php?id=".$row["id_factura"]."'>". $row["numero_factura"] . "</td>
                                                                        <td><i class=\"fa fa-money\" aria-hidden=\"true\"></i> Cobrada</td>
                                                                          <td>". $row["comentari_factura"] . "</td>
                                                                          <td><a href='mostrarClient.php?id=" . $row["id_client_factura"] ."'>". getClientCognomNom($row["id_client_factura"]) . "</a></td>
                                                                          <td>". getDataDMY($row["data_factura"]) . "</td>
                                                                          <td>". getDataDMY($row["data_venciment_factura"]) . "</td>
                                                                      </tr>";
                                } else {
                                  echo "<tr>ERROR</tr>";
                                }
                            }
                            echo "
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                        ";
                        } else {
                            echo "No s'ha trobat cap factura";
                        }
                        $conn->close();
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
