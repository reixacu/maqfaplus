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
                        Control d'hores
                    </div>
                    <!-- /.panel-heading -->
                    <div class=\"panel-body\">
                        ";
                        echo "testpanell";
                    echo "
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
