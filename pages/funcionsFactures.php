<?php

function printTaulaLiniesFactura($id) {
    include "mysql.php";
    //mysql_query("SET NAMES utf8;");
    $sql = "SELECT * FROM `detalls_factures` WHERE `id_factura_df` = $id";
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
            echo "<tr>                <form action='scriptModificarLiniaFactura.php' method='post'>
                                            <input type=\"hidden\" name=\"idDf\" value=" . $row["id_df"] .">
                                            <input type=\"hidden\" name=\"idFactura\" value=" . $row["id_factura_df"] .">
                                            <th><input name=\"descripcioDf\" class=\"form-control\" value=\"" . $row["descripcio_df"] ."\"></th>
                                            <th><input name=\"unitatsDf\" class=\"form-control\" value=\"" . $row["unitats_df"] ."\"></th>
                                            <th><input name=\"preuUnitatDf\" class=\"form-control\" value=\"" . $row["preu_unitat_df"] / 100 ."\"></th>
                                            <th>". $row["preu_unitat_df"] * $row["unitats_df"] / 100 ."</th>
                                            <th><button style='margin: 5px;' type='submit' class=\"btn btn-success\"><i class=\"fa fa-floppy-o\"></i></button></th>
                                        </form>
                                            <th><form action='scriptEliminarLiniaFactura.php' method='post'><input type=\"hidden\" name=\"idFactura\" value=\"" . $row["id_factura_df"] ."\">
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


function printEstatFacturaColum($id)
{
    $result = getFacturaData($id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if($row["numero_factura"] == "")
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
                                  <div class=\"huge\">Borrador</div>
                                  <div>La factura no s'ha generat</div>
                              </div>
                          </div>
                      </div>
                      <a href=\"canviarEstatFactura.php?id=". $id ."\">
                          <div class=\"panel-footer\">
                              <span class=\"pull-left\">Finalitzar la factura</span>
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

function printRowDetallsFactura($idFactura){
  $result = getFacturaData($idFactura);
  if ($result->num_rows > 0) {
      // output data of each row
      $row = $result->fetch_assoc();
      if($row["numero_factura"]!=""){
        echo "<!-- panell pagament factura -->
          <div class=\"row\">
        <div class=\"col-lg-4 col-md-4\">";
        if($row["pagament_realitzat_factura"]==0){echo "
            <div class=\"panel panel-yellow\">
                <!-- <div class=\"panel panel-primary\"> -->
                <div class=\"panel-heading\">
                    <div class=\"row\">
                        <div class=\"col-xs-3\">
                          <span class=\"fa-stack fa-3x\">
                            <i class=\"fa fa-money fa-stack-1x\"></i>
                            <i class=\"fa fa-ban fa-stack-2x text-danger\"></i>
                          </span>
                        </div>
                        <div class=\"col-xs-9 text-right\">
                            <div class=\"huge\">Per pagar</div>
                            <div>La factura no s'ha pagat</div>
                        </div>
                    </div>
                </div>";}
                else{ echo "
                  <div class=\"panel panel-primary\">
                      <!-- <div class=\"panel panel-primary\"> -->
                      <div class=\"panel-heading\">
                          <div class=\"row\">
                              <div class=\"col-xs-3\">
                                  <i class=\"fa fa-money fa-5x\"></i>
                              </div>
                              <div class=\"col-xs-9 text-right\">
                                  <div class=\"huge\">Pagada</div>
                                  <div>La factura ja s'ha pagat</div>
                              </div>
                          </div>
                      </div>";
                  }
                echo "
                <a href=\"scriptCanviarEstatPagamentFactura.php?idFactura=". $idFactura . "&estatPagament="  . $row["pagament_realitzat_factura"] ."\">
                    <div class=\"panel-footer\">
                        <span class=\"pull-left\">Canviar estat del pagament</span>
                        <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                        <div class=\"clearfix\"></div>
                    </div>
                </a>
            </div>
        </div>
        ";
        echo "<!-- panell dates factura -->
        <div class=\"col-lg-4\">
            <div class=\"panel panel-default\">
                <div class=\"panel-heading\">
                    Dates
                </div>
                <div class=\"panel-body\">
                    Data factura: " . getDataDMY($row["data_factura"]) ."
                    <br />
                    Data venciment: " . getDataDMY($row["data_venciment_factura"]) ."
                </div>
            </div>
        </div>
        ";
        echo "<!-- panell imports totals factura -->
        <div class=\"col-lg-4\">
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
}

function printRadioFormesPagamentClient($idClient, $idFactura)
{
  include "mysql.php";
  $sql = "SELECT `forma_pagament_client` FROM `clients` WHERE `id_client` = $idClient";
  $fdefault = "";
  $fprefe = "";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $fdefault = $row["forma_pagament_client"];
      $fprefe = $fdefault;
  }
  $conn->close();
  include "mysql.php";
  $sql = "SELECT `forma_pagament_factura` FROM `factures` WHERE `id_factura` = $idFactura";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if($row["forma_pagament_factura"]!= 0) $fdefault = $row["forma_pagament_factura"];
  }
  $conn->close();
  include "mysql.php";
  $sql = "SELECT * FROM `formes_pagament`";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          if ($row["id_fp"] == $fdefault)
          {
            echo '
            <div class="radio">
                <label>
                    <input type="radio" name="formaPagament" value="'.$row["id_fp"].'" checked="">'.$row["nom_fp"]; if($fprefe == $row["id_fp"]) {echo " (preferit client)";};
                echo '</label>
            </div>
            ';
          }
          else
          {
            echo '
            <div class="radio">
                <label>
                    <input type="radio" name="formaPagament" value="'.$row["id_fp"].'">'.$row["nom_fp"]; if($fprefe == $row["id_fp"]) {echo " (preferit client)";};
                echo '</label>
            </div>
            ';
          }
      }
   }
   $conn->close();
}
function printDataFactura($idFactura)
{
  $data = date("Y-m-d");
  include "mysql.php";
  $sql = "SELECT `data_factura` FROM `factures` WHERE `id_factura` = $idFactura";
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

function printDataVencimentFactura($idFactura)
{
  $data = date("Y-m-d");
  include "mysql.php";
  $sql = "SELECT `data_venciment_factura`, `id_client_factura` FROM `factures` WHERE `id_factura` = $idFactura";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if($row["data_venciment_factura"]!= "2000-01-01")
      {
        $data = $row["data_venciment_factura"];
        echo $data;
      }
      else
      {
        $idClient = $row["id_client_factura"];
        $conn->close();
        include "mysql.php";
        //$sql1 = "SELECT `data_venciment_factura`, `id_client_factura` FROM `factures` WHERE `id_factura` = $idFactura";
        $sql = "SELECT `dies_fins_pagament_client`, `dia_mensual_pagament_client`, `dia_mensual_pagament_2_client` FROM `clients` WHERE `id_client` = $idClient";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $diesAdd = $row["dies_fins_pagament_client"];
          $dia1 = $row["dia_mensual_pagament_client"];
          $dia2 = $row["dia_mensual_pagament_2_client"];
          $data = date('Y-m-d', strtotime($data. ' + '.$diesAdd.' days'));
          if ($dia1 != 0 && $dia2 != 0)
          {
            if ($dia1 > $dia2)
            {
              $temp = $dia1;
              $dia1 = $dia2;
              $dia2 = $temp;
            }
            $diames = date("d-m", strtotime($data));
            if ($diames <= $dia2)
            {
              echo "DATADATADATA".$data;
              echo "DIAMESDIAMES".$diames;
            }
          }
          //echo $data;
        }
      }
  }
  $conn->close();
}
/*
function addDayswithdate($date,$days){
    $date = strtotime("+".$days." days", strtotime($date));
    return  date("Y-m-d", $date);
}

function nextDate($userDay, $currentDay){
  $today = date('d',strtotime($currentDay)); // today
  $target = date('Y-m-'.$userDay,strtotime($currentDay));  // target day
  if($today <= $userDay){
   $return = strtotime($target);
  }
  else{
   $thisMonth = date('m',strtotime($currentDay)) + 1;
   $thisYear = date('Y',strtotime($currentDay));
   if($userDay >= 28 && $thisMonth == 2){
       $userDay = 28;
   }
   while(!checkdate($thisMonth,$userDay,$thisYear)){
     $thisMonth++;
     if($thisMonth == 13){
       $thisMonth = 1;
       $thisYear++;
     }
   }
   $return = strtotime($thisYear.'-'.$thisMonth.'-'.$userDay);
  }
  return $return;
}

function printDataVencimentFactura($idFactura){
  $dataFactura = date("Y-m-d");
  $dataFinalPagament= date("Y-m-d");
  $diaPagamentClient;
  $diesFinsPagament;

  include "mysql.php";
  $sql = "
    SELECT `data_factura`
      FROM `factures`
      WHERE `id_factura` = $idFactura";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if($row["data_factura"]!= "2001-01-01")
      {
        $dataFactura = $row["data_factura"];
      }
  }
  $conn->close();

  include "mysql.php";
  $sql = "
    SELECT `dies_fins_pagament`
      FROM `clients` JOIN factures ON `factures`.`id_client_factura` = `clients`.`id_client`
      WHERE `factures`.`id_factura` = $idFactura";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if($row["dies_fins_pagament"]!= 0) $diesFinsPagament =  $row["dies_fins_pagament"];
  }
  $conn->close();

  include "mysql.php";
  $sql = "
    SELECT `dia_mensual_pagament`
      FROM `clients` JOIN factures ON `factures`.`id_client_factura` = `clients`.`id_client`
      WHERE `factures`.`id_factura` = $idFactura";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if($row["dia_mensual_pagament"]!= 0) $diaPagamentClient = $row["dia_mensual_pagament"];
  }
  $conn->close();

  $dataAmbDiesAfegits = addDayswithdate($dataFactura, $diesFinsPagament);
  $dataFinalPagament = nextDate($diaPagamentClient,$dataAmbDiesAfegits);

  echo $dataFinalPagament;
}*/


function mostrarFactures($sql) {
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
                                            <th>Concepte</th>
                                            <th>Client</th>
                                            <th>Data factura</th>
                                            <th>Data venciment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";
        while($row = $result->fetch_assoc()) {
			if(strtotime($row["data_venciment_factura"]) >= strtotime(date("Y-m-d H:i:s"))){
              echo "<tr class=\"info\">
                                                      <td><a href='mostrarFactura.php?id=".$row["id_factura"]."'>". $row["numero_factura"] . "</td>
                                                    <td><i class=\"fa fa-money\" aria-hidden=\"true\"></i> Pendent </td>
                                                      <td>". $row["comentari_factura"] . "</td>
                                                      <td><a href='mostrarClient.php?id=" . $row["id_client_factura"] ."'>". getClientCognomNom($row["id_client_factura"]) . "</a></td>
                                                      <td>". getDataDMY($row["data_factura"]) . "</td>
                                                      <td>". getDataDMY($row["data_venciment_factura"]) . "</td>
                                                  </tr>";
            }
            else{
              echo "<tr class=\"danger\">
                                                      <td><a href='mostrarFactura.php?id=".$row["id_factura"]."'>". $row["numero_factura"] . "</td>
                                                    <td><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> Fora de termini</td>
                                                      <td>". $row["comentari_factura"] . "</td>
                                                      <td><a href='mostrarClient.php?id=" . $row["id_client_factura"] ."'>". getClientCognomNom($row["id_client_factura"]) . "</a></td>
                                                      <td>". getDataDMY($row["data_factura"]) . "</td>
                                                      <td>". getDataDMY($row["data_venciment_factura"]) . "</td>
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
