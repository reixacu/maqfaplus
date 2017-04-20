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
                      <a href=\"canviarEstatFactura.php?id=". $id ."\">
                          <div class=\"panel-footer\">
                              <span class=\"pull-left\">Associar a factura OJO</span>
                              <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                              <div class=\"clearfix\"></div>
                          </div>
                      </a>
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
                              <div class=\"huge\">Factura nº ". $row["numero_factura"] ."</div>
                              <div>La factura ja te assignat un número</div>
                          </div>
                      </div>
                  </div>
                  <a href=\"canviarEstatFactura.php?id=". $id ."\">
                      <div class=\"panel-footer\">
                          <span class=\"pull-left\">Corretgir detalls de la factura</span>
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

function printRowDetallsAlbara($idFactura){
  $result = getAlbaraData($idFactura);
  if ($result->num_rows > 0) {
      // output data of each row
      $row = $result->fetch_assoc();
      echo "<!-- panell dates factura -->
      <div class=\"col-lg-6\">
          <div class=\"panel panel-default\">
              <div class=\"panel-heading\">
                  Data
              </div>
              <div class=\"panel-body\">
                  <h2>" . getDataDMY($row["data_factura"]) ."</h2>
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

function mostrarBorradorsFactures($sql) {
    include "mysql.php";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "
                          <div class=\"table-responsive\">
                                <table class=\"table table-striped\">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Concepte</th>
                                            <th>Client</th>
                                            <th>Data factura</th>
                                            <th>Data venciment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";
        while($row = $result->fetch_assoc()) {
              echo "<tr>
                                                      <td><a href='mostrarFactura.php?id=".$row["id_factura"]."'>". $row["id_factura"] . "</td>
                                                      <td>". $row["comentari_factura"] . "</td>
                                                      <td><a href='mostrarClient.php?id=" . $row["id_client_factura"] ."'>". getClientCognomNom($row["id_client_factura"]) . "</a></td>
                                                      <td>". getDataDMY($row["data_factura"]) . "</td>
                                                      <td>". getDataDMY($row["data_venciment_factura"]) . "</td>
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