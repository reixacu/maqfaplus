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
    include "mysql.php";
    if(!isset($_GET["mode"])) $mode=2; //0 - afegir, 1 - modificar, 2 - mostrar
    else $mode=$_GET["mode"];
    if($mode!=0){ //mode mostrar
      $id=$_GET["id"];
      $result = getClientData($id);
      $row = $result->fetch_assoc();
    }
    ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <table style='margin-top: 20px;'>
                    <tr>
                        <td><form type='submit' action='clients.php'>
                          <button style='margin: 5px;' type='submit' class="btn btn-primary">
                            <i class="fa fa-arrow-left"></i>
                              Tornar a clients
                          </button></form></td>
                          <?php
                            if($mode==2)
                            echo '<td><form action="mostrarClient.php" method="get">
                              <input type="hidden" name="mode" value="1">
                              <input type="hidden" name="id" value="'.$id.'">
                              <button style="margin: 5px;" type="submit" class="btn btn-info">
                                <i class="fa fa-pencil"></i>
                                Editar client</button>
                              </form></td>';
                          ?>
                    </tr>
                </table>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                  if($mode==0) echo '<h1 class="page-header"><i class="fa fa-user-plus"></i> Afegir un nou client</h1>';
                  elseif($mode==1) echo '<h1 class="page-header"><i class="fa fa-pencil"></i> Modificar client</h1>';
                  else echo '<h1 class="page-header"><i class="fa fa-industry"></i> Mostrar client</h1>';
                 ?>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php
                          if($mode==0) echo 'Formulari afegir client';
                          elseif($mode==1) echo 'Formulari modificar client';
                          else echo 'Dades client';
                        ?>
                    </div>
                    <div class="panel-body">
                      <?php
                        if($mode==0) echo '<form role="form" action="scriptAfegirClient.php" method="post">';
                        elseif($mode==1) echo '<form role="form" action="scriptEditarClient.php" method="post">';
                        else echo '<form role="form" action="RES.php" method="post">';
                      ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h1>Dades bàsiques</h1>
                                    <div class="form-group">
                                        <label>Número de client</label>
                                        <?php
                                          if($mode==0) echo '<p class="form-control-static">S\'assignarà al crear</p>';
                                          elseif($mode==1) echo '<p class="form-control-static">'. $row["id_client"].'</p>';
                                          else echo '<p class="form-control-static">'. $row["id_client"].'</p>';
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>NIF</label>
                                        <?php
                                          if($mode==0) echo '<input name="nif" class="form-control" placeholder="00000000A">';
                                          elseif($mode==1) echo '<input name="nif" class="form-control" value="'. $row["nif_client"].'">';
                                          else echo '<p class="form-control-static">'. $row["nif_client"].'</p>';
                                        ?>
                                    </div>
                                    <!--<div class="panel-body">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#empresa" data-toggle="tab"><i class="fa fa-industry"></i> Empresa</a>
                                            </li>
                                            <li><a href="#particular" data-toggle="tab"><i class="fa fa-user"></i> Particular</a>
                                            </li>
                                        </ul>-->

                                        <!--<div class="tab-content">
                                        <div class="tab-pane fade" id="particular">
                                                <div class="form-group">
                                                    <br />
                                                    <label>Nom client particular</label>
                                                    <input name="nom" class="form-control" placeholder="Nom del client (obligatori)">
                                                </div>
                                                <div class="form-group">
                                                    <label>Cognoms</label>
                                                    <input name="cognoms" class="form-control" placeholder="Cognoms del client">
                                                </div>
                                            </div>-->
                                            <div class="tab-pane fade in active" id="empresa">
                                                <div class="form-group">
                                                    <br />
                                                    <label>Raó social:</label>
                                                    <?php
                                                      if($mode==0) echo '<input name="raoSocial" class="form-control" placeholder="Raó social (obligatori)">';
                                                      elseif($mode==1) echo '<input name="raoSocial" class="form-control" value="'. $row["rao_social_client"].'">';
                                                      else echo '<p class="form-control-static">'. $row["rao_social_client"].'</p>';
                                                      //imprimirCamp($row["asd"], $mode, "raoSocial");
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <br />
                                                    <label>Nom comercial:</label>
                                                    <?php
                                                      if($mode==0) echo '<input name="nomComercial" class="form-control">';
                                                      elseif($mode==1) echo '<input name="nomComercial" class="form-control" value="'. $row["nom_comercial_client"].'">';
                                                      else echo '<p class="form-control-static">'. $row["nom_comercial_client"].'</p>';
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Persona de contacte 1</label>
                                                    <?php
                                                      if($mode==0) echo '<input name="p1" class="form-control" placeholder="Persona de contacte principal">';
                                                      elseif($mode==1) echo '<input name="p1" class="form-control" value="'. $row["persona_contacte1_client"].'">';
                                                      else echo '<p class="form-control-static">'. $row["persona_contacte1_client"].'</p>';
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Correu persona de contacte 1</label>
                                                    <?php
                                                      if($mode==0) echo '<input name="p1Mail" class="form-control" placeholder="Correu electrònic de la persona de contacte 1">';
                                                      elseif($mode==1) echo '<input name="p1Mail" class="form-control" value="'. $row["p1_email_client"].'">';
                                                      else echo '<p class="form-control-static">'. $row["p1_email_client"].'</p>';
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Persona de contacte 2</label>
                                                    <?php
                                                      if($mode==0) echo '<input name="p2" class="form-control" placeholder="Persona de contacte alternativa">';
                                                      elseif($mode==1) echo '<input name="p2" class="form-control" value="'. $row["persona_contacte2_client"].'">';
                                                      else echo '<p class="form-control-static">'. $row["persona_contacte2_client"].'</p>';
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Correu persona de contacte 2</label>
                                                    <?php
                                                      if($mode==0) echo '<input name="p2Mail" class="form-control" placeholder="Correu electrònic de la persona de contacte 2">';
                                                      elseif($mode==1) echo '<input name="p2Mail" class="form-control" value="'. $row["p2_email_client"].'">';
                                                      else echo '<p class="form-control-static">'. $row["p2_email_client"].'</p>';
                                                    ?>
                                                </div>
                                            </div>
                                        <!--</div>-->
                                    <!--</div>-->
                                </div>
								<div class="col-lg-6">
                                    <h1>Detalls pagament</h1>
									<div class="form-group">
											<label>Forma de pagament</label>
											<?php
                        if($mode==0) printRadioFormesPagamentClient1(0);
                        elseif($mode==1) printRadioFormesPagamentClient1($id);
                        else printRadioFormesPagamentClient2($id);
                       ?>
										</div>
										<div class="form-group">
                        <label>Dies fins pagament (nº dies)</label>
                        <?php
                          if($mode==0) echo '<input name="diesFinsPagament" class="form-control" placeholder="Dies fins que el client hagi d\'efectuar el pagament">';
                          elseif($mode==1) echo '<input name="diesFinsPagament" class="form-control" value="'. $row["dies_fins_pagament_client"].'">';
                          else echo '<p class="form-control-static">'. $row["dies_fins_pagament_client"].'</p>';
                        ?>
                    </div>
										<div class="form-group">
                        <label>Dia mensual de pagament</label>
                        <?php
                          if($mode==0) echo '<input name="diaMensualPagament" class="form-control" placeholder="Dia preferit del client per als pagaments">';
                          elseif($mode==1) echo '<input name="diaMensualPagament" class="form-control" value="'. $row["dia_mensual_pagament_client"].'">';
                          else echo '<p class="form-control-static">'. $row["dia_mensual_pagament_client"].'</p>';
                        ?>
                    </div>
										<div class="form-group">
                        <label>IBAN</label>
                        <?php
                          if($mode==0) echo '<input name="IBAN" class="form-control" placeholder="IBAN">';
                          elseif($mode==1) echo '<input name="IBAN" class="form-control" value="'. $row["numero_conta_client"].'">';
                          else echo '<p class="form-control-static">'. $row["numero_conta_client"].'</p>';
                        ?>
                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <h1>Detalls contacte</h1>
                                    <div class="form-group">
                                        <label>Correu electrònic</label>
                                        <?php
                                          if($mode==0) echo '<input name="mail" class="form-control">';
                                          elseif($mode==1) echo '<input name="mail" class="form-control" value="'. $row["email_client"].'">';
                                          else echo '<p class="form-control-static">'. $row["email_client"].'</p>';
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Telèfon Fix 1</label>
                                        <?php
                                          if($mode==0) echo '<input name="fix1" class="form-control" placeholder="Telèfon fix principal">';
                                          elseif($mode==1) echo '<input name="fix1" class="form-control" value="'. $row["fix1_client"].'">';
                                          else echo '<p class="form-control-static">'. $row["fix1_client"].'</p>';
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Telèfon Fix 2</label>
                                        <?php
                                          if($mode==0) echo '<input name="fix2" class="form-control" placeholder="Telèfon fix secundari">';
                                          elseif($mode==1) echo '<input name="fix2" class="form-control" value="'. $row["fix2_client"].'">';
                                          else echo '<p class="form-control-static">'. $row["fix2_client"].'</p>';
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Telèfon Mòbil 1</label>
                                        <?php
                                          if($mode==0) echo '<input name="mobil1" class="form-control" placeholder="Telèfon mòbil principal">';
                                          elseif($mode==1) echo '<input name="mobil1" class="form-control" value="'. $row["mobil1_client"].'">';
                                          else echo '<p class="form-control-static">'. $row["mobil1_client"].'</p>';
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Telèfon Mòbil 2</label>
                                        <?php
                                          if($mode==0) echo '<input name="mobil2" class="form-control" placeholder="Telèfon mòbil secundari">';
                                          elseif($mode==1) echo '<input name="mobil2" class="form-control" value="'. $row["mobil2_client"].'">';
                                          else echo '<p class="form-control-static">'. $row["mobil2_client"].'</p>';
                                        ?>
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <div class="row">
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <h1>Adreça</h1>
                                    <div class="form-group">
                                        <label>Carrer i número</label>
                                        <?php
                                          if($mode==0) echo '<input name="direccio" class="form-control" placeholder="Carrer, número, escala, pis, porta">';
                                          elseif($mode==1) echo '<input name="direccio" class="form-control" value="'. $row["adreca_client"].'">';
                                          else echo '<p class="form-control-static">'. $row["adreca_client"].'</p>';
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Població</label>
                                        <?php
                                          if($mode==0) echo '<input name="poblacio" class="form-control">';
                                          elseif($mode==1) echo '<input name="poblacio" class="form-control" value="'. $row["poblacio_client"].'">';
                                          else echo '<p class="form-control-static">'. $row["poblacio_client"].'</p>';
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Codi Postal</label>
                                        <?php
                                          if($mode==0) echo '<input name="cp" class="form-control">';
                                          elseif($mode==1) echo '<input name="cp" class="form-control" value="'. $row["cp_client"].'">';
                                          else echo '<p class="form-control-static">'. $row["cp_client"].'</p>';
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Província</label>
                                        <?php
                                          if($mode==0) echo '<input name="provincia" class="form-control">';
                                          elseif($mode==1) echo '<input name="provincia" class="form-control" value="'. $row["provincia_client"].'">';
                                          else echo '<p class="form-control-static">'. $row["provincia_client"].'</p>';
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>País</label>
                                        <?php
                                          if($mode==0) echo '<input name="pais" class="form-control">';
                                          elseif($mode==1) echo '<input name="pais" class="form-control" value="'. $row["pais_client"].'">';
                                          else echo '<p class="form-control-static">'. $row["pais_client"].'</p>';
                                        ?>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <h1>Comentaris</h1>
                                    <div class="form-group">
                                      <?php
                                        if($mode==0) echo '<textarea name="comentari" class="form-control" rows="3"></textarea>';
                                        elseif($mode==1) echo '<textarea name="comentari" class="form-control" rows="3" value='. $row["comentari_client"].'></textarea>';
                                        else echo '<p class="form-control-static">'. $row["comentari_client"].'</p>';
                                      ?>
                                    </div>
                                    <?php
                                      if($mode==0){
                                        echo '<button type="submit" class="btn btn-primary">Crear el client</button>';
                                        echo '<button type="reset" class="btn btn-warning btn-outline">Netejar els camps</button>';
                                      }
                                      elseif($mode==1){
                                        echo '<input type="hidden" name="id" value="'.$id.'">';
                                        echo '<button type="submit" class="btn btn-primary">Modificar dades client</button>';
                                        echo '<button type="reset" class="btn btn-warning btn-outline">Netejar els camps</button>';
                                      }
                                      else{ //el mostrar no té botons
                                      }
                                      ?>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </form>

                    </div>
                    <!-- /.panel-body -->
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

</body>

</html>
