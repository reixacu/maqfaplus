<?php
// Imprimeix el número de feines actives sense format
function getCountFeinesActives()
{
    include "mysql.php";
    $sql = "SELECT id_feina FROM feines WHERE estat_feina=1;";
    $result = $conn->query($sql);
    if ($result = mysqli_query($conn, $sql)) {
        // Return the number of rows in result set
        $rowcount = mysqli_num_rows($result);
        echo $rowcount;
        // Free result set
        mysqli_free_result($result);
    }
    $conn->close();
}
function getCountFeinesFinalitzades()
{
    include "mysql.php";
    $sql = "SELECT id_feina FROM feines WHERE estat_feina=2;";
    $result = $conn->query($sql);
    if ($result = mysqli_query($conn, $sql)) {
        // Return the number of rows in result set
        $rowcount = mysqli_num_rows($result);
        echo $rowcount;
        // Free result set
        mysqli_free_result($result);
    }
    $conn->close();
}
// Retorna un array amb totes les dades d'un  client
function getClientData($numClient)
{
    include "mysql.php";
    $sql = "SELECT * FROM clients WHERE id_client=$numClient;";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

// Retorna un array amb totes les dades d'una feina
function getFeinaData($idFeina)
{
    include "mysql.php";
    $sql = "SELECT * FROM feines WHERE id_feina=$idFeina;";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
function getTreballadorData($idTreballador)
{
    include "mysql.php";
    $sql = "SELECT * FROM treballadors WHERE id_treballador=$idTreballador;";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
function getFacturaData($idFactura)
{
    include "mysql.php";
    $sql = "SELECT * FROM factures WHERE id_factura=$idFactura;";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
function getAlbaraData($idFactura)
{
    include "mysql.php";
    $sql = "SELECT * FROM albarans WHERE id_factura=$idFactura;";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
function getLiniesFacturaData($idFactura)
{
    include "mysql.php";
    $sql = "SELECT * FROM detalls_factures WHERE id_factura_df=$idFactura;";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
function getLiniesAlbaraData($idFactura)
{
    include "mysql.php";
    $sql = "SELECT * FROM detalls_albarans WHERE id_factura_df=$idFactura;";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
function getNumRowsDetallsFactura($idFactura)
{
  include "mysql.php";
  $sql = "SELECT * FROM `detalls_factures` WHERE `id_factura_df` = $idFactura;";
  $rowcount = 0;
  $result = $conn->query($sql);
  if ($result = mysqli_query($conn, $sql)) {
      // Return the number of rows in result set
      $rowcount = mysqli_num_rows($result);
      // Free result set
      mysqli_free_result($result);
  }
  $conn->close();
  return $rowcount;
}
function getNumRowsDetallsAlbara($idFactura)
{
  include "mysql.php";
  $sql = "SELECT * FROM `detalls_albarans` WHERE `id_factura_df` = $idFactura;";
  $rowcount = 0;
  $result = $conn->query($sql);
  if ($result = mysqli_query($conn, $sql)) {
      // Return the number of rows in result set
      $rowcount = mysqli_num_rows($result);
      // Free result set
      mysqli_free_result($result);
  }
  $conn->close();
  return $rowcount;
}
function changeEstatFeina($id, $estat) {
    include "mysql.php";

    $sql = "UPDATE `feines` SET `estat_feina` = '$estat' WHERE `feines`.`id_feina` = $id;";
    $conn->query($sql);
    switch ($estat){
        case 1:
            $sql = "UPDATE `feines` SET `inci_feina` = CURDATE() WHERE `feines`.`id_feina` = $id;";
            break;
        case 2:
            $sql = "UPDATE `feines` SET `acabament_feina` = CURDATE() WHERE `feines`.`id_feina` = $id;";
            break;
        case 3:
            $sql = "UPDATE `feines` SET `facturacio_feina` = CURDATE() WHERE `feines`.`id_feina` = $id;";
            break;
    }
    $conn->query($sql);
}
// retorna l'id del client d'una feina
function getClientFeina ($id) {
    $result = getFeinaData($id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["id_client_feina"];
    }
}
function getDescFeina ($id) {
    $result = getFeinaData($id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["descripcio_feina"];
    }
    else {
      return "Altres / Varis";
    }
}
function getHoresTreballador ($id) {
    $result = getTreballadorData($id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["hores_dia_treballador"];
    }
    else {
      return 8;
    }
}

function getNomTreballador ($id) {
    $result = getTreballadorData($id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["nom_treballador"];
    }
    else {
      return "Error amb el nom del treballador";
    }
}
// Comprova si el nom no és nul o la raó social no és nula
function checkEsEmpresa($nom, $raoSocial){
    if(($nom==NULL)&&($raoSocial==NULL))
    {
        return -1;
    } else if (($nom!=NULL)&&($raoSocial!=NULL))
    {
        return 2;
    } else if ($nom !=NULL)
    {
        return 0;
    } else {
        return 1;
    }
}
function checkEsEmpresaById($id)
{
    include "mysql.php";
    $sql = "SELECT es_empresa_client FROM clients WHERE id_client=$id;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $retorna = $row["es_empresa_client"];
    } else {
        return 2;
    }
    $conn->close();
    return $retorna;
}
function getLastFeinaId() {
    include "mysql.php";
    $sql = "SELECT `id_feina` FROM `feines` ORDER BY `feines`.`id_feina`  DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $retorna = $row["id_feina"];
    }
    $conn->close();
    return $retorna;
}
function getLastFacturaId() {
    include "mysql.php";
    $sql = "SELECT `id_factura` FROM `factures` ORDER BY `factures`.`id_factura`  DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $retorna = $row["id_factura"];
    }
    $conn->close();
    return $retorna;
}
function getLastAlbaraId() {
    include "mysql.php";
    $sql = "SELECT `id_factura` FROM `albarans` ORDER BY `albarans`.`id_factura`  DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $retorna = $row["id_factura"];
    }
    $conn->close();
    return $retorna;
}
function getLastPressupostId() {
    include "mysql.php";
    $sql = "SELECT `id_factura` FROM `pressupostos` ORDER BY `pressupostos`.`id_factura`  DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $retorna = $row["id_factura"];
    }
    $conn->close();
    return $retorna;
}
function getClientCognomNom($id)
{
    include "mysql.php";
    $retorna;
    switch (checkEsEmpresaById($id))
    {
        case 0:
            $sql = "SELECT nom_client, cognom_client FROM clients WHERE id_client=$id;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $retorna = $row["cognom_client"] . ", " . $row["nom_client"] ;
            }
            break;
        case 1:
            $sql = "SELECT rao_social_client, nom_comercial_client FROM clients WHERE id_client=$id;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $retorna = $row["rao_social_client"] . ", " . $row["nom_comercial_client"] ;
            }
            break;
          default:
            $retorna = 0 ;

    }
    $conn->close();
    return $retorna;
}
function getClientCognomNomNoComerc($id)
{
    include "mysql.php";
    $retorna;
    switch (checkEsEmpresaById($id))
    {
        case 0:
            $sql = "SELECT nom_client, cognom_client FROM clients WHERE id_client=$id;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $retorna = $row["cognom_client"] . ", " . $row["nom_client"] ;
            }
            break;
        case 1:
            $sql = "SELECT rao_social_client FROM clients WHERE id_client=$id;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $retorna = $row["rao_social_client"];
            }
            break;
          default:
            $retorna = 0 ;

    }
    $conn->close();
    return $retorna;
}
function getNomFormaPagament($idPagament)
{
	include "mysql.php";
  $sql = "SELECT `detall_fp` FROM `formes_pagament` WHERE `id_fp` = $idPagament";
  $fdefault = "";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $fdefault = $row["detall_fp"];
  }
  $conn->close();
  return $fdefault;
}
// Retorna l'ID d'un client partint d'un NIF
function getClientIdFromNIF($nif){
    include "mysql.php";
    $sql = "SELECT id_client FROM clients WHERE nif_client='$nif';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row["id_client"];
    } else {
        return 0;
    }
    $conn->close();
    return $id;
}

//Converteix la data de format ISO 8601 a format DD-MM-YYYY
function getDataDMY($data){
    $dataFormatINT = strtotime($data);
    return date('d/m/Y', $dataFormatINT);
}

//Retorna el preu entrat en format string, amb comes i símbols de moneda
function getPriceString($price){
    return (floor(($price / 100)) . "," . ($price % 100) . "€");
}



// Crea una taula HTML per mostrar les dades d'un client concret
// S'usa en diverses parts del programa
function mostrarClientTaula($id){
    $result = getClientData($id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<div class=\"table-responsive\">
                            <table class=\"table table-striped table-bordered table-hover\">
                                <thead>
                                    <tr>
                                        <th>Camp</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Número de client</td>
                                        <td>".$row["id_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>NIF</td>
                                        <td>".$row["nif_client"]."</td>
                                    </tr>
                                    ";
        if ($row["es_empresa_client"] == 0) {
            echo"
                                <tr>
                                    <td>Nom</td>
                                    <td>".$row["nom_client"]."</td>
                                </tr>
                                <tr>
                                    <td>Cognoms</td>
                                    <td>".$row["cognom_client"]."</td>
                                </tr>
            ";
        } else {
            echo "
                                    <tr>
                                        <td>Raó social</td>
                                        <td>".$row["rao_social_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Nom comercial</td>
                                        <td>".$row["nom_comercial_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Persona contacte 1</td>
                                        <td>".$row["persona_contacte1_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Correu contacte 1</td>
                                        <td>".$row["p1_email_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Persona contacte 2</td>
                                        <td>".$row["persona_contacte2_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Email contacte 2</td>
                                        <td>".$row["p2_email_client"]."</td>
                                    </tr>
            ";
        }
        echo "
                                    <tr>
                                        <td>Email</td>
                                        <td>".$row["email_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Fix 1</td>
                                        <td>".$row["fix1_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Fix 2</td>
                                        <td>".$row["fix2_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Mòbil 1</td>
                                        <td>".$row["mobil1_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Mòbil 2</td>
                                        <td>".$row["mobil2_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Direcció</td>
                                        <td>".$row["adreca_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Població</td>
                                        <td>".$row["poblacio_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Codi postal</td>
                                        <td>".$row["cp_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Provincia</td>
                                        <td>".$row["provincia_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Pais</td>
                                        <td>".$row["pais_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Dies fins a pagament</td>
                                        <td>".$row["forma_pagament_client"]."</td>
                                    </tr>
                                    <tr>
                                        <td>Comentari</td>
                                        <td>".$row["comentari_client"]."</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->";

    }
}
// Insereix un client a la base de dades donat l'insert sql
function insertClientBD($conn, $sql){
    if ($conn->query($sql) === TRUE) {
        echo "
                            <p>Operació efectuada correctament</p>
                            ";
    } else {
        echo "ERROR: " . $sql . "<br>" . $conn->error;
    }
}
// Esborra un client de la base de dades partint d'un ID
function deleteClientBD($id)
{
    include "mysql.php";
    $sql = "DELETE FROM clients WHERE id_client=$id";

    if (mysqli_query($conn, $sql)) {
        echo "    <div class=\"panel-heading\">
                    S'ha eliminat el client #" . $id . "
                    </div>
                    <div class=\"panel-body\">
                        <td><form type='submit' action='clients.php'><button style='margin: 5px;' type='submit' class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Tornar a clients</button></form></td>
                    </div>";
    } else {
        echo "ERROR AL ELIMINAR EL CLIENT: " . mysqli_error($conn);
    }
}

function deleteFeinaBD($id)
{
    include "mysql.php";
    $sql = "DELETE FROM feines WHERE id_feina=$id";

    if (mysqli_query($conn, $sql)) {
        echo "    <div class=\"panel-heading\">
                    S'ha eliminat la feina #" . $id . "
                    </div>
                    <div class=\"panel-body\">
                        <td><form type='submit' action='totesFeines.php'><button style='margin: 5px;' type='submit' class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Tornar a feines</button></form></td>
                    </div>";
    } else {
        echo "ERROR AL ELIMINAR EL CLIENT: " . mysqli_error($conn);
    }
}

function mostrarFeines($sql) {
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
                                            <th>Client</th>
                                            <th>Descripció</th>
                                            <th>Data inici</th>
                                            <th>Data acabament</th>
                                            <th>Data facturació</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";
        while($row = $result->fetch_assoc()) {
            switch ($row["estat_feina"])
            {
                case 0:
                    echo "<tr class=\"success\">
                                                            <td>". $row["id_feina"] . "</td>
                                                            <td>DESCONEGUT</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>";
                    break;
                case 1:
                    echo "<tr class=\"info\">
                                                            <td><a href='mostrarFeina.php?id=".$row["id_feina"]."'>". $row["id_feina"] . "</td>
                                                            <td><i class=\"fa fa-cog fa-spin\"></i> Activa</td>
                                                            <td><a href='mostrarClient.php?id=" . $row["id_client_feina"] ."'>". getClientCognomNom($row["id_client_feina"]) . "</a></td>
                                                            <td>". getDescFeina($row["id_feina"])  . "</td>
                                                            <td>". getDataDMY($row["inci_feina"]) . "</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>";
                    break;
                case 2:
                    echo "<tr class=\"warning\">
                                                            <td><a href='mostrarFeina.php?id=".$row["id_feina"]."'>". $row["id_feina"] . "</td>
                                                            <td><i class=\"fa fa-check-square-o\"></i></i> Finalitzada</td>
                                                            <td><a href='mostrarClient.php?id=" . $row["id_client_feina"] ."'>". getClientCognomNom($row["id_client_feina"]) . "</a></td>
                                                            <td>". getDescFeina($row["id_feina"])  . "</td>
                                                            <td>". getDataDMY($row["inci_feina"]) . "</td>
                                                            <td>". getDataDMY($row["acabament_feina"]) . "</td>
                                                            <td></td>
                                                        </tr>";
                    break;
                case 3:
                    echo "<tr class=\"success\">
                                                            <td><a href='mostrarFeina.php?id=".$row["id_feina"]."'>". $row["id_feina"] . "</td>
                                                            <td><i class=\"fa fa-file-text\"></i> Facturada</td>
                                                            <td><a href='mostrarClient.php?id=" . $row["id_client_feina"] ."'>". getClientCognomNom($row["id_client_feina"]) . "</a></td>
                                                            <td>". getDescFeina($row["id_feina"])  . "</td>
                                                            <td>". getDataDMY($row["inci_feina"]) . "</td>
                                                            <td>". getDataDMY($row["acabament_feina"]) . "</td>
                                                            <td>". getDataDMY($row["facturacio_feina"]) . "</td>
                                                        </tr>";
                    break;
            }
        }
        echo "
                                        </tbody>
                                    </table>
                                </div>
                                    ";
    } else {
        echo "No s'ha fet cap feina per aquest client";
    }
    $conn->close();
}
function printRadioFormesPagamentClient1($idClient)
{
  include "mysql.php";
  $sql = "SELECT `forma_pagament_client` FROM `clients` WHERE `id_client` = $idClient";
  $fdefault = "";
  $fprefe = "";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $fdefault = $row["forma_pagament_client"];
  }
  $conn->close();
  if ($idClient == 0) $fdefault = 1;
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
                    <input type="radio" name="formaPagament" value="'.$row["id_fp"].'" checked="">'.$row["nom_fp"];
                echo '</label>
            </div>
            ';
          }
          else
          {
            echo '
            <div class="radio">
                <label>
                    <input type="radio" name="formaPagament" value="'.$row["id_fp"].'">'.$row["nom_fp"];
                echo '</label>
            </div>
            ';
          }
      }
   }
   $conn->close();
}

?>
