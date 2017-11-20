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
        include "mysql.php";
        $sql = "SELECT * FROM clients WHERE id_client=$id;";
        $result = $conn->query($sql);
        $conn->close();
        echo '<div id="page-wrapper">';
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            echo"
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <table style='margin-top: 20px;'>
                        <tr>
                            <td><form action='mostrarClient.php' method='get'><input type=\"hidden\" name=\"id\" value=\"" . $id . "\"><button style='margin: 5px;' type='submit' class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Tornar al client</button></form></td>
                            <td><form action='eliminarClient.php' method='get'><input type=\"hidden\" name=\"id\" value=\"" . $id . "\"><button style='margin: 5px;' type='submit' class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i> Eliminar client</button></form></td>
                            <form role=\"form\" action=\"scriptEditarClient.php\" method=\"post\">
                            <td><button style='margin: 5px;' type='submit' class=\"btn btn-success\"><i class=\"fa fa-floppy-o\"></i> Guardar</button></td>
                        </tr>
                    </table>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <!-- /.row -->
            <div class=\"row\">
                <div class=\"col-lg-12\">";
                if ($row["es_empresa_client"]==0)
                    {
                        echo "<h1 class=\"page-header\"><span class=\"text-danger\"><i class=\"fa fa-pencil\"></i> </span><i class=\"fa fa-user\"></i> #". $row["id_client"] . " - " . $row["cognom_client"] . ", " . $row["nom_client"] . "</h1>";
                    } else {
                        echo "<h1 class=\"page-header\"><span class=\"text-danger\"><i class=\"fa fa-pencil\"></i> </span><i class=\"fa fa-industry\"></i> #". $row["id_client"] . " - " . $row["rao_social_client"] . "</h1>";
                };
            echo "
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
                            <input type=\"hidden\" name=\"id\" value=\"" . $id ."\">
                            <blockquote>
                                <p class='text-primary'><strong>". $row["id_client"] . "</strong></p>
                            </blockquote>
                            <h3>NIF:</h3>
                                <div class=\"form-group\">
                                    <input name=\"nif\" class=\"form-control\" value=\"" . $row["nif_client"] ."\">
                                </div>
                                ";
            if ($row["es_empresa_client"]!=0)
            {
            echo "          <h3>Raó social:</h3>
                            <div class=\"form-group\">
                                    <input name=\"raoSocial\" class=\"form-control\" value=\"" . $row["rao_social_client"] ."\">
                            </div>
                            <h3>Nom comercial:</h3>
                            <div class=\"form-group\">
                                    <input name=\"nomComercial\" class=\"form-control\" value=\"" . $row["nom_comercial_client"] ."\">
                            </div>
                            <h3>Persona de contacte 1:</h3>
                            <div class=\"form-group\">
                                    <input name=\"p1\" class=\"form-control\" value=\"" . $row["persona_contacte1_client"] ."\">
                            </div>
                            <h3>Correu persona de contacte 1:</h3>
                            <div class=\"form-group\">
                                    <input name=\"p1Mail\" class=\"form-control\" value=\"" . $row["p1_email_client"] ."\">
                            </div>
                            <h3>Persona de contacte 2:</h3>
                            <div class=\"form-group\">
                                    <input name=\"p2\" class=\"form-control\" value=\"" . $row["persona_contacte2_client"] ."\">
                            </div>
                            <h3>Correu persona de contacte 2:</h3>
                            <div class=\"form-group\">
                                    <input name=\"p2Mail\" class=\"form-control\" value=\"" . $row["persona_contacte2_client"] ."\">
                            </div>
                            <input type=\"hidden\" name=\"nom\" value=\"\">
                            <input type=\"hidden\" name=\"cognoms\" value=\"\">
                ";
            } else {
                echo        "<h3>Nom:</h3>
                            <div class=\"form-group\">
                                    <input name=\"nom\" class=\"form-control\" value=\"" . $row["nom_client"] ."\">
                            </div>
                            <h3>Cognoms:</h3>
                            <div class=\"form-group\">
                                    <input name=\"cognoms\" class=\"form-control\" value=\"" . $row["cognom_client"] ."\">
                            </div>
                            <input type=\"hidden\" name=\"raoSocial\" value=\"\">
                            <input type=\"hidden\" name=\"nomComercial\" value=\"\">
                            <input type=\"hidden\" name=\"p1\" value=\"\">
                            <input type=\"hidden\" name=\"p1Mail\" value=\"\">
                            <input type=\"hidden\" name=\"p2\" value=\"\">
                            <input type=\"hidden\" name=\"p2Mail\" value=\"\">";
            }
                            echo "
                            <h3>Dies fins al pagament:</h3>
                            <div class=\"form-group\">
                                    <input name=\"formaPagament\" class=\"form-control\" value=\"" . $row["forma_pagament_client"] ."\">
                            </div>
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
                            <div class=\"form-group\">
                                    <input name=\"mail\" class=\"form-control\" value=\"" . $row["email_client"] ."\">
                            </div>


                            <h3>Telèfon fix 1:</h3>
                            <div class=\"form-group\">
                                    <input name=\"fix1\" class=\"form-control\" value=\"" . $row["fix1_client"] ."\">
                            </div>
                            <h3>Telèfon fix 2:</h3>
                            <div class=\"form-group\">
                                    <input name=\"fix2\" class=\"form-control\" value=\"" . $row["fix2_client"] ."\">
                            </div>
                            <h3>Telèfon mòbil 1:</h3>
                            <div class=\"form-group\">
                                    <input name=\"mobil1\" class=\"form-control\" value=\"" . $row["mobil1_client"] ."\">
                            </div>
                            <h3>Telèfon mòbil 2:</h3>
                            <div class=\"form-group\">
                                    <input name=\"mobil2\" class=\"form-control\" value=\"" . $row["mobil2_client"] ."\">
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
				<div class=\"col-lg-4\">
                    <div class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            Detalls dels pagaments
                        </div>
                        <!-- /.panel-heading -->
                        <div class=\"panel-body\">
                            <div class=\"form-group\">
											<label>Forma de pagament</label>
											" . printRadioFormesPagamentClient1(0); echo("<h1>WIP</h1>") . "
										</div>
										<div class=\"form-group\">
                                            <label>Dies fins pagament (nº dies)</label>
                                            <input name=\"diesFinsPagament\" class=\"form-control\" placeholder=\"Dies fins que el client hagi d'efectuar el pagament\" value=\"" . $row["dies_fins_pagament_client"] ."\">
                                        </div>
										<div class=\"form-group\">
                                            <label>Dia mensual de pagament</label>
                                            <input name=\"diaMensualPagament\" class=\"form-control\" placeholder=\"Dia preferit del client per als pagaments\" value=\"" . $row["dia_mensual_pagament_client"] ."\">
                                        </div>
										<div class=\"form-group\">
                                            <label>IBAN</label>
                                            <input name=\"IBAN\" class=\"form-control\" placeholder=\"IBAN\" value=\"" . $row["numero_conta_client"] ."\">
                                        </div>
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
                            <h3>Carrer i número:</h3>
                            <div class=\"form-group\">
                                    <input name=\"direccio\" class=\"form-control\" value=\"" . $row["adreca_client"] ."\">
                            </div>
                            <h3>Població:</h3>
                            <div class=\"form-group\">
                                    <input name=\"poblacio\" class=\"form-control\" value=\"" . $row["poblacio_client"] ."\">
                            </div>
                            <h3>Codi postal:</h3>
                            <div class=\"form-group\">
                                    <input name=\"cp\" class=\"form-control\" value=\"" . $row["cp_client"] ."\">
                            </div>
                            <h3>Província:</h3>
                            <div class=\"form-group\">
                                    <input name=\"provincia\" class=\"form-control\" value=\"" . $row["provincia_client"] ."\">
                            </div>
                            <h3>País:</h3>
                            <div class=\"form-group\">
                                    <input name=\"pais\" class=\"form-control\" value=\"" . $row["pais_client"] ."\">
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
                <div class=\"col-lg-4\">
                    <div class=\"panel panel-yellow\">
                        <div class=\"panel-heading\">
                            Comentaris
                        </div>
                        <!-- /.panel-heading -->
                        <div class=\"panel-body\">
                            <div class=\"form-group\">
                                    <textarea name=\"comentari\" class=\"form-control\" rows=\"3\">" . $row["comentari_client"] ."</textarea>
                                </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
            ";

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
    </form>
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