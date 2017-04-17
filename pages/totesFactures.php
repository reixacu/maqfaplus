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

    if(isset($_GET['idClient'])) {
      $idClient = $_GET['idClient'];
    } else {
      $idClient = 0;
    }

    ?>
    <?php
    if ($idClient == 0)
    {
      $sql = "SELECT * FROM `factures` WHERE `factures`.`numero_factura` != '' AND `factures`.`data_factura` >= '$desde' AND `factures`.`data_factura` <= '$fins' ORDER BY `factures`.`id_factura` DESC";
    } else {
      $sql = "SELECT * FROM `factures` WHERE `factures`.`numero_factura` != '' AND `factures`.`data_factura` >= '$desde' AND `factures`.`data_factura` <= '$fins' AND `factures`.`id_client_factura` = $idClient ORDER BY `factures`.`id_factura` DESC";
    }
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
                        Filtre
                    </div>
                    <!-- /.panel-heading -->
                    <div class=\"panel-body\">
                      <div class=\"row\">
                        <div class=\"col-lg-6\">
                          ";
                          printModalClient($desde, $fins);
                          echo "
                        </div>
                        <div class=\"col-lg-6\">
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
                <div class=\"panel panel-default\">
                    <!--<div class=\"panel-heading\">
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
                                                    <table class=\"table table-striped table-bordered table-hover\" id=\"clients1\">
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

<!-- DataTables JavaScript -->
<script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>


<!-- Page-Level Demo Scripts - Tables - Use for reference -->

<script>
    $(document).ready(function() {
        $('#clients11').DataTable({
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

<?php
function printFiltreDataForm($desde, $fins, $idClient)
{
  echo "
  <form action=\"totesFactures.php\" method=\"get\">
    <input type=\"hidden\" value=\"".$idClient."\" name=\"idClient\">
    <input type=\"date\" name=\"desde\" value=\"".$desde."\"> fins
    <input type=\"date\" name=\"fins\" value=\"".$fins."\">
    <button type=\"submit\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-search\" aria-hidden=\"true\"></i> Filtrar data</button>
  </form>
  ";
}
function printModalClient($desde, $fins)
{
  echo "
                            <button class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#myModal\">
                                  Triar Client
                              </button>
                              <!-- Modal -->
                              <div class=\"modal fade\" id=\"myModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
                                  <div class=\"modal-dialog modal-lg\">
                                      <div class=\"modal-content\">
                                          <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                                              <h4 class=\"modal-title\" id=\"myModalLabel\">Filtrar Client</h4>
                                          </div>
                                          <div class=\"modal-body\">
                                            <table class=\"table table-striped table-bordered table-hover\" id=\"clients11\">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>NIF</th>
                                                    <th>Tipus</th>
                                                    <th>Raó social/Cognom</th>
                                                    <th>Nom comercial/Nom</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                              ";
                                              include "mysql.php";

                                              $sql = "SELECT `id_client`, `nif_client`, `nom_client`, `cognom_client`, `poblacio_client`, `es_empresa_client`, `rao_social_client`, `nom_comercial_client` FROM `clients`";
                                              $result = $conn->query($sql);
                                              if ($result->num_rows > 0) {
                                                  // output data of each row
                                                  while($row = $result->fetch_assoc()) {
                                                      if (!$row["es_empresa_client"]) {
                                                          echo "<tr><td><a href='totesFactures.php?desde=".$desde."&fins=".$fins."&idClient=" . $row["id_client"] . "'>" . $row["id_client"] . "</a></td><td>" . $row["nif_client"] . "</td><td><i class=\"fa fa-user\"></i> Particular</td><td>" . $row["cognom_client"] . "</td><td>" . $row["nom_client"] . "</td></tr>";
                                                      }
                                                      else
                                                      {
                                                          echo "<tr><td><a href='totesFactures.php?desde=".$desde."&fins=".$fins."&idClient=" . $row["id_client"] . "'>" . $row["id_client"] . "</a></td><td>" . $row["nif_client"] . "</td><td><i class=\"fa fa-industry\"></i> Empresa</td><td>" . $row["rao_social_client"] . "</td><td>" . $row["nom_comercial_client"] . "</td></tr>";
                                                      }
                                                  }
                                              } else {
                                                  echo "No hi ha cap client";
                                              }
                                              //SELECT `id_client`, `nif_client`, `nom_client`, `cognom_client` FROM `clients`
                                              $conn->close();
                                              echo "
                                                </tbody>
                                            </table>
                                          </div>
                                          <div class=\"modal-footer\">
                                              <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Tancar</button>
                                          </div>
                                      </div>
                                      <!-- /.modal-content -->
                                  </div>
                                  <!-- /.modal-dialog -->
                              </div>
                              <!-- /.modal -->
  ";
}
 ?>
