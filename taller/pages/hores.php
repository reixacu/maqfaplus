<!DOCTYPE html>
<html lang="ca">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MAQFA TALLER</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="dist/switchery.css" />
    <script src="dist/switchery.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>

      .noTanMiniText { width: 100px;}
      .noTanMiniText1 { width: 100px;}
      .miniText { width: 70px;}
    </style>
</head>

<?php
$idTreballador = $_GET["treballador"];

 ?>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                EMPLEAT NUMERO <?php echo $_GET["treballador"]; ?>

                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Entrada d'hores
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Feina</th>
                                            <th>Dia</th>
                                            <th>Hores</th>
                                            <th>Detall</th>
                                            <th>Acabada?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php printNewLines($idTreballador); ?>
                                    </tbody>
                                </table>
								<button style='margin: 5px;' type='submit' class="btn btn-success btn-lg"><i class="fa fa-floppy-o"></i> Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


    <script>
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
      var switchery = new Switchery(html);
    });
    </script>

</body>

</html>
<?php
function printNewLines($idTreballador)
{
  for ($i = 1; $i <=5; $i++)
  {
    echo
    "<tr>
        <td class=\"noTanMiniText\">";
        printDesplegableFeinesActives();
        echo"</td>
        <td class=\"noTanMiniText1\"><input type=\"date\" value=\"". date("Y-m-d") ."\" class=\"form-control\" placeholder=\"Descripció\"></td>
        <td class=\"miniText\"><input class=\"form-control\" placeholder=\"h\"></td>
        <td><input class=\"form-control\" placeholder=\"Descripció del producte\"></td>
        <td><input type=\"checkbox\" class=\"js-switch\" />
    </tr>";
  }
}

function printDesplegableFeinesActives()
{
  echo "<select class=\"form-control\">";
  $result = getFeinesActivesIdDesc();
      if ($result->num_rows > 0) {
      // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<option>".$row["id_feina"]."- ".$row["descripcio_feina"]."</option>";
        }
      };
  echo "</select>";
}

function getFeinesActivesIdDesc()
{
  include "mysql.php";
  $sql = "SELECT id_feina, descripcio_feina FROM feines WHERE estat_feina=1;";
  $result = $conn->query($sql);
  $conn->close();
  return $result;
}

?>
