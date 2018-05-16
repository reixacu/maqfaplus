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
    include_once "funcionsHores.php";
    include_once "funcionsAlbarans.php";
    include_once "funcionsFeines.php";
    ?>
    <?php
    if ($_GET["id"] != NULL)
    {
        $id = $_GET["id"];
        $result = getAlbaraData($id);
        echo '<div id="page-wrapper">';
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            echo"
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <table style='margin-top: 20px;'>
                        <tr>
                            <td><form action='totsAlbarans.php'><button style='margin: 5px;' type='submit' class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Tots els albarans</button></form></td>
                            <td><form action='generarAlbaraPDF.php' method='get'><input type=\"hidden\" name=\"id\" value=\"" . $id . "\"><button style='margin: 5px;' type='submit' class=\"btn btn-info\"><i class=\"fa fa-print \"></i> Imprimir albarà</button></form>
                            ";
                             if ($row["mail_enviat_factura"] == "1")
                             {
                               echo "<td><form action='enviarMailAlbara.php' method='get'><input type=\"hidden\" name=\"id\" value=\"" . $id . "\"><button style='margin: 5px;' type='submit' class=\"btn btn-success\"><i class=\"fa fa-envelope \"></i> <i class=\"fa fa-check-circle\"></i> Tornar a enviar</button></form>";
                             }
                             else {
                               echo "<td><form action='enviarMailAlbara.php' method='get'><input type=\"hidden\" name=\"id\" value=\"" . $id . "\"><button style='margin: 5px;' type='submit' class=\"btn btn-info\"><i class=\"fa fa-envelope \"></i> Enviar albarà</button></form>";
                             }
                            echo "
                        </tr>
                    </table>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <h1 class=\"page-header\"><i class=\"fa fa-file-text-o\" aria-hidden=\"true\"></i> Albarà #". $row["id_factura"] . "</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class=\"row\">
                ";
            printEstatAlbaraColum($id);
            echo "
                <div class=\"col-lg-6\">
                    <div class=\"panel panel-default\">
                        <div class=\"panel-heading\">
                            Client
                        </div>
                        <!-- /.panel-heading -->
                        <div class=\"panel-body\">
                        <a href='mostrarClient.php?id=" . $row["id_client_factura"] . "'>
                            <h3><i class=\"fa fa-user\"></i> ";
                            echo getClientCognomNom($row["id_client_factura"]);
            echo "</h3></a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
                <!-- /.row -->
                ";

                printRowDetallsAlbara($id);

            echo "
              <div class=\"row\">
                <div class=\"col-lg-12\">
                    <div class=\"panel panel-default\">
                        <div class=\"panel-heading\">
                            Detalls de l'albarà
                        </div>
                        <!-- /.panel-heading -->
                        <div class=\"panel-body\">
                            <form action='scriptAfegirLiniaAlbara.php' method='get'><input type=\"hidden\" name=\"idFactura\" value=\"" . $id . "\"><input type=\"hidden\" name=\"idClient\" value=\"" . $row["id_client_factura"] . "\"><button style='margin: 5px;' type='submit' class=\"btn btn-success\"><i class=\"fa fa-plus-square\"></i> Afegir línia</button></form><br />
                            <h3>Productes</h3>";
                            printTaulaLiniesAlbara($id);
            echo "
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            ";
        } else {
            echo "No s'ha trobat l'albarà especificat'";
        }

        echo "</div>";
    }
    else
    {
        echo "
        <div id=\"page-wrapper\">
        <h1>Error, no s'ha seleccionat cap albarà.</h1>
        </div>";
    }



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

<!-- DataTables JavaScript -->
<script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>


<script>
    $(document).ready(function() {
        $('#factures1').DataTable({
            responsive: true,
            order: [[ 0, "desc" ]],
            language: {
                processing:   "Processant...",
                lengthMenu:   "Mostra _MENU_ registres",
                zeroRecords:  "No s'han trobat registres.",
                info:         "Mostrant de _START_ a _END_ de _TOTAL_ registres",
                infoEmpty:    "Mostrant de 0 a 0 de 0 registres",
                tnfoFiltered: "(filtrat de _MAX_ total registres)",
                infoPostFix:  "",
                search:       "Filtrar: ",
                url:          "",
                paginate: {
                    first:    "Primer",
                    previous: "Anterior",
                    next:     "Següent",
                    last:     "Últim"
                }
            },
            "fnDrawCallback": function () {

                $('#clients1 tbody tr').click(function () {

                    // get position of the selected row
                    var position = cell.fnGetPosition(this);

                    // value of the first column (can be hidden)
                    var id = table.fnGetData(position)[0];

                    // redirect
                    document.location.href = "?q=node/6?id=" + id;
                });

            }
        });
    });
</script>



</body>

</html>
