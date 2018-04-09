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
    include "funcionsHores.php";
    include "menu.php";
    if ($_GET["id"] != NULL)
    {
        $id = $_GET["id"];
    }
    else {
      $id = 0;
    }
    ?>
    <?php
    if ($id == 0)
    {
      $sql = "SELECT * FROM `hores` ORDER BY `hores`.`dia_hores` DESC";
    } else {
      $sql = "SELECT * FROM `hores` WHERE `id_treballador_hores` = $id ORDER BY `hores`.`dia_hores` DESC";
    }

    echo "
    <div id=\"page-wrapper\">
        <div class=\"row\">
            <div class=\"col-lg-12\">";
                    if ($id==0)
                    {
                        echo "<td><h1 class=\"page-header\"><i class=\"fa fa-globe\"></i> Totes les hores</h1></td>";
                      }else{
                          echo "<td><h1 class=\"page-header\"><i class=\"fa fa-globe\"></i> Hores ". getNomTreballador($id) ."</h1></td>";
                        }
                        echo "
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <div class=\"panel panel-primary\">
                    <div class=\"panel-heading\">
                        Control d'hores extra
                    </div>
                    <!-- /.panel-heading -->
                    <div class=\"panel-body\">
                        <div class=\"row\">
                            <div class=\"col-lg-6\">
                                <h2>Hores extra restants: ". number_format(getTotalExtresMenysResta($sql, $id) / 100,2) ."</h2>
                            </div>
                            <div class=\"col-lg-6\">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <div class=\"panel panel-primary\">
                    <div class=\"panel-heading\">
                        Control d'hores
                    </div>
                    <!-- /.panel-heading -->
                    <div class=\"panel-body\">
                        ";
                        mostrarHores($sql, $id);
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

function getTotalExtresMenysResta($sql, $idTreballador) {
    $sumadorGlobal = 0;
    $ultimDia = date("Y-m-d");
    $ultimDia = date('Y-m-d', strtotime("+3 months", strtotime($ultimDia)));
    $sumaTotalDia = 0;
    $sumaExtraDia = 0;
    $primer = true;
    $sumaTotalMes= 0;
    $sumaExtraMes = 0;
    $diaNou;
    $mesNou;
    if ($idTreballador != 0) {
      $horesDiaTreballador = getHoresTreballador($idTreballador);
    } else {
      $horesDiaTreballador = 800;
    }
    include "mysql.php";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (date_format(date_create($ultimDia), 'Y-m-d') > date_format(date_create($row["dia_hores"]), 'Y-m-d') ) $diaNou = true;
            if (date_format(date_create($ultimDia), 'Y-m') > date_format(date_create($row["dia_hores"]), 'Y-m') ) $mesNou = true;

            if ($diaNou)
            {
              $ultimDia = $row["dia_hores"];
              $sumaExtraMes+=$sumaExtraDia;
              $sumaTotalMes+=$sumaTotalDia;
              $sumaExtraDia = 0;
              $sumaTotalDia = 0;
            }

            if($mesNou)
            {
              if (!$primer)
              {
              } else
              {
                $primer= false;
              }
              $sumaTotalMes = 0;
              $sumaExtraMes = 0;
            }

            $sumaTotalDia+=$row["hores_hores"];
            if ($sumaTotalDia > $horesDiaTreballador) $sumaExtraDia = $sumaTotalDia - $horesDiaTreballador;
          $diaNou = false;
          $mesNou = false;
        }
        $sumaExtraMes+=$sumaExtraDia;
        $sumaTotalMes+=$sumaTotalDia;
        $sumadorGlobal+=$sumaExtraMes;

    } else {
        return 0;
    }
    $conn->close();

    return $sumadorGlobal;
}
?>
