<?php

function printTaulaLiniesAlbara($id) {
    include "mysql.php";
    //mysql_query("SET NAMES utf8;");
    $sql = "SELECT * FROM `detalls_albarans` WHERE `id_factura_df` = $id";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        echo "<div class=\"table-responsive\">
                                <table class=\"table table-striped table-bordered table-hover\">
                                    <thead>
                                        <tr>
                                            <th>Descripció</th>
                                            <th>Quantitat</th>
                                            <th>Preu unitat</th>
                                            <th>Total</th>
                                            <th>Modificar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>                <form action='scriptModificarLiniaAlbara.php' method='post'>
                                            <input type=\"hidden\" name=\"idDf\" value=" . $row["id_df"] .">
                                            <input type=\"hidden\" name=\"idFactura\" value=" . $row["id_factura_df"] .">
                                            <th><input name=\"descripcioDf\" class=\"form-control\" value=\"" . $row["descripcio_df"] ."\"></th>
                                            <th><input name=\"unitatsDf\" class=\"form-control\" value=\"" . $row["unitats_df"]/ 100 ."\"></th>
                                            <th><input name=\"preuUnitatDf\" class=\"form-control\" value=\"" . $row["preu_unitat_df"] / 100 ."\"></th>
                                            <th>". $row["preu_unitat_df"]/ 100 * $row["unitats_df"] / 100 ."</th>
                                            <th><button style='margin: 5px;' type='submit' class=\"btn btn-success\"><i class=\"fa fa-floppy-o\"></i></button></th>
                                        </form>
                                            <th><form action='scriptEliminarLiniaAlbara.php' method='post'><input type=\"hidden\" name=\"idFactura\" value=\"" . $row["id_factura_df"] ."\">
                                            <input type=\"hidden\" name=\"idDf\" value=" . $row["id_df"] ."><button style='margin: 5px;' type='submit' class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i></button></form></th>
                                        </tr>";
        }
        echo "</tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->";
    } else {
        echo "Encara no hi ha cap línia";
    }

}


function printEstatAlbaraColum($id)
{
    $result = getAlbaraData($id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if($row["id_factura_albara"] == 0)
        {
              echo "
              <div class=\"col-lg-6 col-md-6\">
                  <div class=\"panel panel-yellow\">
                      <!-- <div class=\"panel panel-primary\"> -->
                      <div class=\"panel-heading\">
                          <div class=\"row\">
                              <div class=\"col-xs-3\">
                                  <i class=\"fa fa-exclamation-triangle fa-5x\"></i>
                              </div>
                              <div class=\"col-xs-9 text-right\">
                                  <div class=\"huge\">No facturat</div>
                                  <div>No s'ha creat factura de l'albarà</div>
                              </div>
                          </div>
                      </div>
                      ";
                      printModalClient($id);
                      echo "
                      <!--
                      <a href=\"scriptAlbaraNovaFactura.php?id=". $id ."\">
                          <div class=\"panel-footer\">
                              <span class=\"pull-left\">Associar a una nova factura</span>
                              <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                              <div class=\"clearfix\"></div>
                          </div>
                      </a>
                      -->
                  </div>
              </div>
              ";
        }
        else
        {
          echo "
          <div class=\"col-lg-6 col-md-6\">
              <div class=\"panel panel-green\">
                  <!-- <div class=\"panel panel-primary\"> -->
                  <div class=\"panel-heading\">
                      <div class=\"row\">
                          <div class=\"col-xs-3\">
                              <i class=\"fa fa-check-circle fa-5x\"></i>
                          </div>
                          <div class=\"col-xs-9 text-right\">
                              <div class=\"huge\">Factura nº ". $row["id_factura_albara"] ."</div>
                              <div>Ja s'ha creat una factura d'aquest albarà</div>
                          </div>
                      </div>
                  </div>
                  <a href=\"mostrarFactura.php?id=". $row["id_factura_albara"] ."\">
                      <div class=\"panel-footer\">
                          <span class=\"pull-left\">Veure la factura</span>
                          <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                          <div class=\"clearfix\"></div>
                      </div>
                  </a>
              </div>
          </div>
          ";
        }
    }
}

function printModalClient($idAlbara)
{
  if ($idAlbara == 0)
  {
                            echo "
                              <button class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#myModal\">
                                  <i class=\"fa fa-search\" aria-hidden=\"true\"></i> Filtrar Client
                              </button>";
}
else {
  echo "<h4>";
  echo "wip";//getClientCognomNom($idAlbara);
  echo "</h4>";
  echo "
    <button class=\"btn btn-primary btn-sm\" data-toggle=\"modal\" data-target=\"#myModal\">
        <i class=\"fa fa-search\" aria-hidden=\"true\"></i> Filtrar un altre client
    </button>
    <form method=\"get\" action=\"totesFactures.php\"><input type=\"hidden\" name=\"desde\" value=\"".$desde."\"><input type=\"hidden\" name=\"fins\" value=\"".$fins."\">
    <button class=\"btn btn-warning btn-sm\" type\"submit\">
        Esborrar Filtre
    </button>
    </form>
    ";
}
                              echo "
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
                                                          echo "<tr><td><a href='totesFactures.php?desde=".$desde."&fins=".$fins."&idAlbara=" . $row["id_client"] . "'>" . $row["id_client"] . "</a></td><td>" . $row["nif_client"] . "</td><td><i class=\"fa fa-user\"></i> Particular</td><td>" . $row["cognom_client"] . "</td><td>" . $row["nom_client"] . "</td></tr>";
                                                      }
                                                      else
                                                      {
                                                          echo "<tr><td><a href='totesFactures.php?desde=".$desde."&fins=".$fins."&idAlbara=" . $row["id_client"] . "'>" . $row["id_client"] . "</a></td><td>" . $row["nif_client"] . "</td><td><i class=\"fa fa-industry\"></i> Empresa</td><td>" . $row["rao_social_client"] . "</td><td>" . $row["nom_comercial_client"] . "</td></tr>";
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


function printRowDetallsAlbara($idFactura){
  $result = getAlbaraData($idFactura);
  if ($result->num_rows > 0) {
      // output data of each row
      $row = $result->fetch_assoc();
      echo "<!-- panell dates factura -->
      <div class=\"col-lg-6\">
          <div class=\"panel panel-default\">
              <div class=\"panel-heading\">
                  Data i IVA
              </div>
              <div class=\"panel-body\">
                <div class=\"row\">
                  <form role=\"form\" action=\"scriptCanviarDataAlbara.php\" method=\"post\">
                    <div class=\"col-lg-4\">
                      <input name=\"dataFactura\" type=\"date\" class=\"form-control\" value=\"".$row["data_factura"]."\">
                    </div>
                    <div class=\"col-lg-4\">
                      <div class=\"form-group input-group\">
                        <input name=\"ivaFactura\" class=\"form-control\" value=\"".$row["iva_factura"]."\"><span class=\"input-group-addon\">%</span>
                      </div>
                    </div>
                    <div class=\"col-lg-4\">
                      <input type=\"hidden\" name=\"idFactura\" value=\"".$row["id_factura"]."\">
                      <button type=\"submit\" class=\"btn btn-success btn-sm\"><i class=\"fa fa-floppy-o\" aria-hidden=\"true\"></i> Guardar canvis</button>
                    </div>
                  </form>
                </div>
              </div>
          </div>
      </div>
      ";
      echo "<!-- panell imports totals factura -->
      <div class=\"col-lg-6\">
          <div class=\"panel panel-default\">
              <div class=\"panel-heading\">
                  Imports
              </div>
              <div class=\"panel-body\">
                  Preu base: " . getPriceString($row["base_imposable_factura"]) . "
                  <br />
                  Iva: " . getPriceString($row["import_iva_factura"]) . "
                  <br />
                  Import total: " . getPriceString($row["total_factura"]) . "
              </div>
          </div>
      </div>
      <!-- /.row -->
  ";

  }
}


function printDataAlbara($idFactura)
{
  $data = date("Y-m-d");
  include "mysql.php";
  $sql = "SELECT `data_factura` FROM `albarans` WHERE `id_factura` = $idFactura";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if($row["data_factura"]!= "2000-01-01")
      {
        $data = $row["data_factura"];
      }
  }
  $conn->close();
  echo $data;
}


function mostrarAlbarans($sql) {
    include "mysql.php";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "
                          <div class=\"table-responsive\">
                                <table class=\"table\">
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
}

function mostrarFacturesPendents($sql) {
    include "mysql.php";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "
                          <div class=\"table-responsive\">
                                <table class=\"table\">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Estat</th>
                                            <th>Marcar pagada</th>
                                            <th>Client</th>
                                            <th>Data factura</th>
                                            <th>Data venciment</th>
                                            <th>Import IVA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";
        while($row = $result->fetch_assoc()) {
			if(strtotime($row["data_venciment_factura"]) >= strtotime(date("Y-m-d H:i:s"))){
              echo "<tr class=\"info\">
                                                      <td><a href='mostrarFactura.php?id=".$row["id_factura"]."'>". $row["numero_factura"] . "</td>
                                                    <td><i class=\"fa fa-money\" aria-hidden=\"true\"></i> Pendent </td>
                                                      <td><form method=\"get\" action=\"scriptCanviarEstatPagamentFacturaLlista.php\"><input type=\"hidden\" name=\"idFactura\" value=\"".$row["id_factura"]."\"><button type=\"submit\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i> Marcar pagada</button></form></td>
                                                      <td><a href='mostrarClient.php?id=" . $row["id_client_factura"] ."'>". getClientCognomNom($row["id_client_factura"]) . "</a></td>
                                                      <td>". getDataDMY($row["data_factura"]) . "</td>
                                                      <td>". getDataDMY($row["data_venciment_factura"]) . "</td>
                                                      <td>".  number_format($row["total_factura"] / 100,2) . "€</td>
                                                  </tr>";
            }
            else{
              echo "<tr class=\"danger\">
                                                      <td><a href='mostrarFactura.php?id=".$row["id_factura"]."'>". $row["numero_factura"] . "</td>
                                                    <td><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> Fora de termini</td>
                                                    <td><form method=\"get\" action=\"scriptCanviarEstatPagamentFacturaLlista.php\"><input type=\"hidden\" name=\"idFactura\" value=\"".$row["id_factura"]."\"><button type=\"submit\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i> Marcar pagada</button></form></td>
                                                      <td><a href='mostrarClient.php?id=" . $row["id_client_factura"] ."'>". getClientCognomNom($row["id_client_factura"]) . "</a></td>
                                                      <td>". getDataDMY($row["data_factura"]) . "</td>
                                                      <td>". getDataDMY($row["data_venciment_factura"]) . "</td>
                                                      <td>".  number_format($row["total_factura"] / 100,2) . "€</td>
                                                  </tr>";
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
}

function mostrarBorradorsAlbarans($sql) {
    include "mysql.php";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "
                          <div class=\"table-responsive\">
                                <table class=\"table table-striped\">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Client</th>
                                            <th>Data albara</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";
        while($row = $result->fetch_assoc()) {
              echo "<tr>
                                                      <td><a href='mostrarAlbara.php?id=".$row["id_factura"]."'>". $row["id_factura"] . "</td>
                                                      <td><a href='mostrarClient.php?id=" . $row["id_client_factura"] ."'>". getClientCognomNom($row["id_client_factura"]) . "</a></td>
                                                      <td>". getDataDMY($row["data_factura"]) . "</td>
                                                      <td>".  number_format($row["base_imposable_factura"] / 100,2) . "€</td>
                                                      <td>".  number_format($row["total_factura"] / 100,2) . "€</td>
                                                  </tr>";
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
}
 ?>
