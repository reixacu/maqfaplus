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
    ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <table cellpadding="10">
                    <tr>
                        <td><h1 class="page-header"><i class="fa fa-globe"></i> Selecciona el client del qual vols crear la feina</h1></td>
                        <td><form action="mostrarClient.php" method="get"><input type="hidden" name="mode" value="0"><button style="margin-top: 5px; margin-left: 15px" type='submit' class="btn btn-primary "><i class="fa fa-user-plus"></i> Afegir un client</button></form></td>
                    </tr>
                </table>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12" style="margin=10px">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Cercador de clients
                    </div>
                    <div  style="margin: 20px">
                        <table class="table table-striped table-bordered table-hover" id="clients1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>NIF</th>
                                <th>Tipus</th>
                                <th>Raó social/Cognom</th>
                                <th>Nom comercial/Nom</th>
                                <th>Població</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            include "mysql.php";

                            $sql = "SELECT `id_client`, `nif_client`, `nom_client`, `cognom_client`, `poblacio_client`, `es_empresa_client`, `rao_social_client`, `nom_comercial_client` FROM `clients`";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    if (!$row["es_empresa_client"]) {
                                        echo "<tr><td><a href='afegirFeina2.php?id=" . $row["id_client"] . "'>" . $row["id_client"] . "</a></td><td>" . $row["nif_client"] . "</td><td><i class=\"fa fa-user\"></i> Particular</td><td>" . $row["cognom_client"] . "</td><td>" . $row["nom_client"] . "</td><td>" . $row["poblacio_client"] . "</td></tr>";
                                    }
                                    else
                                    {
                                        echo "<tr><td><a href='afegirFeina2.php?id=" . $row["id_client"] . "'>" . $row["id_client"] . "</a></td><td>" . $row["nif_client"] . "</td><td><i class=\"fa fa-industry\"></i> Empresa</td><td>" . $row["rao_social_client"] . "</td><td>" . $row["nom_comercial_client"] . "</td><td>" . $row["poblacio_client"] . "</td></tr>";
                                    }
                                }
                            } else {
                                echo "No hi ha cap client particular";
                            }
                            //SELECT `id_client`, `nif_client`, `nom_client`, `cognom_client` FROM `clients`
                            $conn->close();
                            ?>
                            </tbody>
                        </table>
                    </div>
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

<!-- DataTables JavaScript -->
<script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#clients1').DataTable({
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