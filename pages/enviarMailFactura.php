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
      include_once "funcionsFactures.php";
      include_once "funcionsFeines.php";
      ?>
      <?php
      if ($_GET["id"] != NULL)
      {
          $id = $_GET["id"];
          $result = getFacturaData($id);
          //$numeroFactura = $_GET["numero_factura"];
          echo '<div id="page-wrapper">';
          if ($result->num_rows > 0) {
              // output data of each row
              $row = $result->fetch_assoc();
              echo"
              <div class=\"row\">
                  <div class=\"col-lg-12\">
                      <table style='margin-top: 20px;'>
                          <tr>
                              <td><form action='mostrarFactura.php'><button style='margin: 5px;' type='submit' class=\"btn btn-primary\"><input type=\"hidden\" name=\"id\" value=\"" . $id . "\"><i class=\"fa fa-arrow-left\"></i> Tornar a la factura</button></form></td>
                          </tr>
                      </table>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class=\"row\">
                  <div class=\"col-lg-12\">
                      <h1 class=\"page-header\"><i class=\"fa fa-envelope\" aria-hidden=\"true\"></i> Enviar correu factura #". $row["numero_factura"] . "</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class=\"row\">
                  <div class=\"col-lg-12\">
                      <div class=\"panel panel-default\">
                          <div class=\"panel-heading\">
                              Detalls de la Factura
                          </div>
                          <!-- /.panel-heading -->
                          <div class=\"panel-body\">
                              <div class=\"form-group\">
                                  <label>Destinatari:</label>
                                  <input name=\"destinatari\" class=\"form-control\" value=\"".printEmailClient($row["id_client_factura"])."\">
                              </div>
                              <div class=\"form-group\">
                                  <label>Destinatari:</label>
                                  <input name=\"destinatari\" class=\"form-control\" value=\"Factura n ".$row["numero_factura"]."\">
                              </div>
                              <div class=\"form-group\">
                                  <textarea name=\"cos\" class=\"form-control\" rows=\"3\" value=\"Bones,&#10;Adjuntem la factura nuero ".$row["numero_factura"]."&#10;Salutacions,&#10;Gemma\"></textarea>
                              </div>
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
              echo "No s'ha trobat la factura especificada";
          }

          echo "</div>";
      }
      else
      {
          echo "
          <div id=\"page-wrapper\">
          <h1>Error, no s'ha seleccionat cap factura.</h1>
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

</body>

</html>
