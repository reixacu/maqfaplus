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
                <h1 class="page-header">Procés editar client</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Procés
                    </div>
                    <div class="panel-body">
                        <?php
                        include "mysql.php";
                        $id = $_POST["id"];
                        $nif = $_POST["nif"];
                        $nom="";//$nom = $_POST["nom"];
                        $cognoms="";//$cognoms = $_POST["cognoms"];
                        $raoSocial = $_POST["raoSocial"];
                        $nomComercial = $_POST["nomComercial"];
                        $p1 = $_POST["p1"];
                        $p2 = $_POST["p2"];
                        $p1Mail = $_POST["p1Mail"];
                        $p2Mail = $_POST["p2Mail"];
                        $direccio = $_POST["direccio"];
                        $poblacio = $_POST["poblacio"];
                        $cp = $_POST["cp"];
                        $mail = $_POST["mail"];
                        $fix1 = $_POST["fix1"];
                        $fix2 = $_POST["fix2"];
                        $mobil1 = $_POST["mobil1"];
                        $mobil2 = $_POST["mobil2"];
                        $comentari = $_POST["comentari"];
                        $provincia = $_POST["provincia"];
                        $pais = $_POST["pais"];
                        $formaPagament = $_POST["formaPagament"];
            						$diesFinsPagament = $_POST["diesFinsPagament"];
            						$diaMensualPagament = $_POST["diaMensualPagament"];
                        $diaMensualPagament2 = $_POST["diaMensualPagament2"];
            						$IBAN = $_POST["IBAN"];

                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("ERROR AL CONNECTAR AMB LA BASE DE DAES: " . $conn->connect_error);
                        }
                        echo "<div class=\"col-lg-6\">";

                        // var per saber si no hi ha hagut error
                        $errorComprovarEsEmpresa = true;
                        switch(checkEsEmpresaById($id))
                        {
                            case 0:
                                $sql = "UPDATE `clients` SET `nif_client` = '$nif', `nom_client` = '$nom',
                                `cognom_client` = '$cognoms', `adreca_client` = '$direccio', `poblacio_client` = '$poblacio',
                                `provincia_client` = '$provincia', `pais_client` = '$pais', `cp_client` = '$cp',
                                `email_client` = '$mail', `fix1_client` = '$fix1', `fix2_client` = '$fix2', `mobil1_client` = '$mobil1',
                                `mobil2_client` = '$mobil2', `comentari_client` = '$comentari', `dia_mensual_pagament_client` = '$diaMensualPagament', `numero_conta_client` = '$IBAN',`dies_fins_pagament_client` = '$diesFinsPagament', `forma_pagament_client` = '$formaPagament' WHERE `clients`.`id_client` = $id;";
                                insertClientBD($conn, $sql);
                                $errorComprovarEsEmpresa = false;
                                break;
                            case 1: //EMPRESA
                                $sql = "UPDATE `clients` SET `nif_client` = '$nif', `rao_social_client` = '$raoSocial',
                                `nom_comercial_client` = '$nomComercial', `adreca_client` = '$direccio', `poblacio_client` = '$poblacio',
                                `provincia_client` = '$provincia', `pais_client` = '$pais', `cp_client` = '$cp',
                                `email_client` = '$mail', `fix1_client` = '$fix1', `fix2_client` = '$fix2', `mobil1_client` = '$mobil1',
                                `mobil2_client` = '$mobil2', `persona_contacte1_client` = '$p1', `p1_email_client` = '$p1Mail', `dia_mensual_pagament_2_client` = '$diaMensualPagament2',
                                `persona_contacte2_client` = '$p2', `p2_email_client` = '$p2Mail', `comentari_client` = '$comentari', `dia_mensual_pagament_client` = '$diaMensualPagament',
                                 `numero_conta_client` = '$IBAN',`dies_fins_pagament_client` = '$diesFinsPagament', `forma_pagament_client` = '$formaPagament' WHERE `clients`.`id_client` = $id;";
                                insertClientBD($conn, $sql);
                                $errorComprovarEsEmpresa = false;
                                break;
                            case 2:
                                echo "ERROR 1001. CONSULTA EL MANUAL";
                                break;
                        }
                        if (!$errorComprovarEsEmpresa)
                        {
                            echo "
                            <div class=\"col-lg-12\">
                                <table style='margin-top: 20px;'>
                                    <tr>
                                        <td><form type='submit' action='mostrarClient.php' method='get'><input type=\"hidden\" name=\"id\" value=\"" . getClientIdFromNIF($nif) . "\"><button style='margin: 5px;' type='submit' class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Mostrar el client</button></form></td>
                                        <td><form type='submit' action='mostrarClient.php' method='get'><input type=\"hidden\" name=\"mode\" value=\"1\"><input type=\"hidden\" name=\"id\" value=\"" . getClientIdFromNIF($nif) . "\"><button style='margin: 5px;' type='submit' class=\"btn btn-info\"><i class=\"fa fa-pencil\"></i> Torna a editar</button></form></td>
                                    </tr>
                                </table>
                                <br />

                            ";
                            mostrarClientTaula(getClientIdFromNIF($nif));
                            echo"</div>
                            <!-- /.col-lg-12 -->";
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
