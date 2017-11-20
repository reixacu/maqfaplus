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
    <?php
    if ($_GET["id"] != NULL)
    {
        $id = $_GET["id"];
        $result = getClientData($id);
        echo '<div id="page-wrapper">';
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            if($row["es_empresa_client"] == 0)
            {
                echo"
                <div class=\"row\">
                    <div class=\"col-lg-12\">
                        <table style='margin-top: 20px;'>
                            <tr>
                                <td><form action='clients.php'><button style='margin: 5px;' type='submit' class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Tornar a clients</button></form></td>
                                <td><form action='editarClient.php' method='get'><input type=\"hidden\" name=\"id\" value=\"" . $id . "\"><button style='margin: 5px;' type='submit' class=\"btn btn-info\"><i class=\"fa fa-pencil\"></i> Editar client</button></form></td>
                                <td><form action='eliminarClient.php' method='get'><input type=\"hidden\" name=\"id\" value=\"" . $id . "\"><button style='margin: 5px;' type='submit' class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i> Eliminar client</button></form></td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class=\"row\">
                    <div class=\"col-lg-12\">
                        <h1 class=\"page-header\"><i class=\"fa fa-user\"></i> #". $row["id_client"] . " - " . $row["cognom_client"] . ", " . $row["nom_client"] . "</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class=\"row\">
                    <div class=\"col-lg-4\">
                        <div class=\"panel panel-primary\">
                            <div class=\"panel-heading\">
                                Dades bàsiques
                            </div>
                            <!-- /.panel-heading -->
                            <div class=\"panel-body\">
                                <h3>Número de client:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["id_client"] . "</strong></p>
                                </blockquote>
                                <h3>NIF:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["nif_client"] . "</strong></p>
                                </blockquote>
                                <h3>Nom:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["nom_client"] . "</strong></p>
                                </blockquote>
                                <h3>Cognoms:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["cognom_client"] . "</strong></p>
                                </blockquote>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-4 -->
                    <div class=\"col-lg-4\">
                        <div class=\"panel panel-primary\">
                            <div class=\"panel-heading\">
                                Detalls de contacte
                            </div>
                            <!-- /.panel-heading -->
                            <div class=\"panel-body\">
                            <h3>Correu electrònic:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["email_client"] . "</strong></p>
                                </blockquote>
                                ";
                if ($row["fix1_client"] != "")
                {
                    echo "
                                <h3>Telèfon fix 1:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["fix1_client"] . "</strong></p>
                                </blockquote>";
                }
                if ($row["fix2_client"] != "")
                {
                    echo "
                                <h3>Telèfon fix 2:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["fix2_client"] . "</strong></p>
                                </blockquote>";
                }
                if ($row["mobil1_client"] != "")
                {
                    echo "
                                <h3>Telèfon mòbil 1:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["mobil1_client"] . "</strong></p>
                                </blockquote>";
                }
                if ($row["mobil2_client"] != "")
                {
                    echo "
                                <h3>Telèfon mòbil 2:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["mobil2_client"] . "</strong></p>
                                </blockquote>";
                }
                echo "
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-4 -->
                    <div class=\"col-lg-4\">
                        <div class=\"panel panel-primary\">
                            <div class=\"panel-heading\">
                                Adreça
                            </div>
                            <!-- /.panel-heading -->
                            <div class=\"panel-body\">
                                <h3>Direcció:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["adreca_client"] . "</strong></p>
                                </blockquote>
                                <h3>Població:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["poblacio_client"] . "</strong></p>
                                </blockquote>
                                <h3>Codi postal:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["cp_client"] . "</strong></p>
                                </blockquote>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-4 -->
                     ";
                if ($row["comentari_client"] != "")
                {
                    echo "
                    <div class=\"col-lg-4\">
                        <div class=\"panel panel-yellow\">
                            <div class=\"panel-heading\">
                                Comentaris
                            </div>
                            <!-- /.panel-heading -->
                            <div class=\"panel-body\">
                                <p class='text-primary'><strong>". $row["comentari_client"] . "</strong></p>
                                </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-4 -->
                            ";
                }
                echo "
                    <div class=\"col-lg-12\">
                        <div class=\"panel panel-green\">
                            <div class=\"panel-heading\">
                                Feines realitzades al client
                            </div>
                            <!-- /.panel-heading -->
                            <div class=\"panel-body\">

                                ";
                                include "mysql.php";
                                $sql = "SELECT * FROM feines WHERE `id_client_feina` = $id ORDER BY `feines`.`id_feina` DESC";
                                mostrarFeines($sql);




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
            }
            else
            {
                // ************************************* EMPRESA *********************************
                echo"
                <div class=\"row\">
                    <div class=\"col-lg-12\">
                        <table style='margin-top: 20px;'>
                            <tr>
                                <td><form action='clients.php'><button style='margin: 5px;' type='submit' class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Tornar a clients</button></form></td>
                                <td><form action='editarClient.php' method='get'><input type=\"hidden\" name=\"id\" value=\"" . $id . "\"><button style='margin: 5px;' type='submit' class=\"btn btn-info\"><i class=\"fa fa-pencil\"></i> Editar client</button></form></td>
                                <td><form action='eliminarClient.php' method='get'><input type=\"hidden\" name=\"id\" value=\"" . $id . "\"><button style='margin: 5px;' type='submit' class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i> Eliminar client</button></form></td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class=\"row\">
                    <div class=\"col-lg-12\">
                        <h1 class=\"page-header\"><i class=\"fa fa-industry\"></i> #". $row["id_client"] . " - " . $row["rao_social_client"] . "</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class=\"row\">
                    <div class=\"col-lg-4\">
                        <div class=\"panel panel-primary\">
                            <div class=\"panel-heading\">
                                Dades bàsiques
                            </div>
                            <!-- /.panel-heading -->
                            <div class=\"panel-body\">
                                <h3>Número de client:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["id_client"] . "</strong></p>
                                </blockquote>
                                <h3>NIF:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["nif_client"] . "</strong></p>
                                </blockquote>
                                <h3>Raó social:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["rao_social_client"] . "</strong></p>
                                </blockquote>
                                <h3>Nom comercial:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["nom_comercial_client"] . "</strong></p>
                                </blockquote>
                                ";
                if ($row["persona_contacte1_client"] != "")
                {
                    echo "
                                <h3>Persona de contacte 1:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["persona_contacte1_client"] . "</strong></p>
                                </blockquote>";
                }
                if ($row["persona_contacte2_client"] != "")
                {
                    echo "
                                <h3>Persona de contacte 2:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["persona_contacte2_client"] . "</strong></p>
                                </blockquote>";
                }
                echo "
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-4 -->
                    <div class=\"col-lg-4\">
                        <div class=\"panel panel-primary\">
                            <div class=\"panel-heading\">
                                Detalls de contacte
                            </div>
                            <!-- /.panel-heading -->
                            <div class=\"panel-body\">
                            <h3>Correu electrònic:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["email_client"] . "</strong></p>
                                </blockquote>
                                ";
                if ($row["fix1_client"] != "")
                {
                    echo "
                                <h3>Telèfon fix 1:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["fix1_client"] . "</strong></p>
                                </blockquote>";
                }
                if ($row["fix2_client"] != "")
                {
                    echo "
                                <h3>Telèfon fix 2:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["fix2_client"] . "</strong></p>
                                </blockquote>";
                }
                if ($row["mobil1_client"] != "")
                {
                    echo "
                                <h3>Telèfon mòbil 1:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["mobil1_client"] . "</strong></p>
                                </blockquote>";
                }
                if ($row["mobil2_client"] != "")
                {
                    echo "
                                <h3>Telèfon mòbil 2:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["mobil2_client"] . "</strong></p>
                                </blockquote>";
                }
                echo "
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-4 -->
                    <div class=\"col-lg-4\">
                        <div class=\"panel panel-primary\">
                            <div class=\"panel-heading\">
                                Adreça
                            </div>
                            <!-- /.panel-heading -->
                            <div class=\"panel-body\">
                                <h3>Direcció:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["adreca_client"] . "</strong></p>
                                </blockquote>
                                <h3>Població:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["poblacio_client"] . "</strong></p>
                                </blockquote>
                                <h3>Codi postal:</h3>
                                <blockquote>
                                    <p class='text-primary'><strong>". $row["cp_client"] . "</strong></p>
                                </blockquote>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-4 -->
                     ";
                if ($row["comentari_client"] != "")
                {
                    echo "
                    <div class=\"col-lg-4\">
                        <div class=\"panel panel-yellow\">
                            <div class=\"panel-heading\">
                                Comentaris
                            </div>
                            <!-- /.panel-heading -->
                            <div class=\"panel-body\">
                                <p class='text-primary'><strong>". $row["comentari_client"] . "</strong></p>
                                </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-4 -->
                            ";
                }
                echo "
                    <div class=\"col-lg-12\">
                        <div class=\"panel panel-green\">
                            <div class=\"panel-heading\">
                                Feines realitzades a l'empresa
                            </div>
                            <!-- /.panel-heading -->
                            <div class=\"panel-body\">

                                ";
                $sql = "SELECT * FROM feines WHERE `id_client_feina` = $id ORDER BY `feines`.`id_feina` DESC";
                mostrarFeines($sql);



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
            }
        } else {
            echo "No s'ho trobat el client especificat";
        }
        
        echo "</div>";
    }
    else
    {
        echo "
        <div id=\"page-wrapper\">
        <h1>Error, no s'ha seleccionat cap client.</h1>
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