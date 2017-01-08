<?php
function printEstatFeinaColum($id)
{
    $result = getFeinaData($id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        switch ($row["estat_feina"])
        {
            case 0:
                break;
            case 1:
                echo "
                <div class=\"col-lg-4 col-md-6\">
                    <div class=\"panel panel-primary\">
                        <!-- <div class=\"panel panel-primary\"> -->
                        <div class=\"panel-heading\">
                            <div class=\"row\">
                                <div class=\"col-xs-3\">
                                    <i class=\"fa fa-cog fa-5x\"></i>
                                </div>
                                <div class=\"col-xs-9 text-right\">
                                    <div class=\"huge\">Activa</div>
                                    <div>La feina està actualment activa</div>
                                </div>
                            </div>
                        </div>
                        <a href=\"canviarEstatFeina.php?id=". $id ."\">
                            <div class=\"panel-footer\">
                                <span class=\"pull-left\">Canviar estat</span>
                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                                <div class=\"clearfix\"></div>
                            </div>
                        </a>
                    </div>
                </div>
                ";
                break;
            case 2:
                echo "
                <div class=\"col-lg-4 col-md-6\">
                    <div class=\"panel panel-yellow\">
                        <!-- <div class=\"panel panel-primary\"> -->
                        <div class=\"panel-heading\">
                            <div class=\"row\">
                                <div class=\"col-xs-3\">
                                    <i class=\"fa fa-check-square-o fa-5x\"></i>
                                </div>
                                <div class=\"col-xs-9 text-right\">
                                    <div class=\"huge\">Finalitzada</div>
                                    <div>La feina està pendent de facturar</div>
                                </div>
                            </div>
                        </div>
                        <a href=\"canviarEstatFeina.php?id=". $id ."\">
                            <div class=\"panel-footer\">
                                <span class=\"pull-left\">Canviar estat</span>
                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                                <div class=\"clearfix\"></div>
                            </div>
                        </a>
                    </div>
                </div>
                ";
                break;
            case 3:
                echo "
                <div class=\"col-lg-4 col-md-6\">
                    <div class=\"panel panel-green\">
                        <!-- <div class=\"panel panel-primary\"> -->
                        <div class=\"panel-heading\">
                            <div class=\"row\">
                                <div class=\"col-xs-3\">
                                    <i class=\"fa fa-check-square fa-5x\"></i>
                                </div>
                                <div class=\"col-xs-9 text-right\">
                                    <div class=\"huge\">Facturada</div>
                                    <div>No cal realitzar més operacions</div>
                                </div>
                            </div>
                        </div>
                        <a href=\"canviarEstatFeina.php?id=". $id ."\">
                            <div class=\"panel-footer\">
                                <span class=\"pull-left\">Canviar estat</span>
                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>
                                <div class=\"clearfix\"></div>
                            </div>
                        </a>
                    </div>
                </div>
                ";
                break;
        }
    }
}
function printTaulaHoresFeina($idFeina)
{
  include_once "funcionsHores.php";
  $result = getHoresFeina($idFeina);
  if ($result->num_rows > 0)
  {
    echo "<div class=\"table-responsive\">
                            <table class=\"table table-striped table-bordered table-hover\">
                                <thead>
                                    <tr>
                                        <th>Dia</th>
                                        <th>Treballador</th>
                                        <th>Hores</th>
                                        <th>ModificarWIP</th>
                                        <th>EliminarWIP</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                    <form action='scriptModificarHoresFeina.php' method='post'>
                                        <input type=\"hidden\" name=\"idHores\" value=" . $row["id_hores"] .">
                                        <input type=\"hidden\" name=\"idFeina\" value=" . $idFeina .">
                                        <th>".$row["dia_hores"]."</th>
                                        <th>".$row["nom_treballador"]."</th>
                                        <th><input name=\"horesHores\" class=\"form-control\" value=\"" . $row["hores_hores"] ."\"></th>
                                        <th><button style='margin: 5px;' type='submit' class=\"btn btn-success\"><i class=\"fa fa-floppy-o\"></i></button></th>
                                    </form>

                                        <th><form action='scriptEliminarHoresFeina.php' method='post'>
                                        <input type=\"hidden\" name=\"idFeina\" value=" . $idFeina .">
                                        <input type=\"hidden\" name=\"idHores\" value=\"" . $row["id_hores"] ."\">
                                        <button style='margin: 5px;' type='submit' class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i></button></form></th>
                                    </tr>";
                                }
      echo "</tbody>
                              </table>
                          </div>
                          <!-- /.table-responsive -->";
    } else {
      echo "Encara no hi ha cap hora de feina";
    }
}

function printTaulaLiniesFeina($id) {
    include "mysql.php";
    //mysql_query("SET NAMES utf8;");
    $sql = "SELECT * FROM `productes_feines` WHERE `id_feina_pf` = $id";
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
            echo "<tr>                <form action='scriptModificarLinia.php' method='post'>
                                            <input type=\"hidden\" name=\"idLinia\" value=" . $row["id_linia_pf"] .">
                                            <input type=\"hidden\" name=\"idFeina\" value=" . $row["id_feina_pf"] .">
                                            <th><input name=\"descripcioPf\" class=\"form-control\" value=\"" . $row["descripcio_pf"] ."\"></th>
                                            <th><input name=\"unitatsPf\" class=\"form-control\" value=\"" . $row["unitats_pf"] ."\"></th>
                                            <th><input name=\"preuUnitatPf\" class=\"form-control\" value=\"" . $row["preu_unitat_pf"] ."\"></th>
                                            <th>". $row["preu_unitat_pf"] * $row["unitats_pf"] ."</th>
                                            <th><button style='margin: 5px;' type='submit' class=\"btn btn-success\"><i class=\"fa fa-floppy-o\"></i></button></th>
                                        </form>
                                            <th><form action='scriptEliminarLinia.php' method='post'><input type=\"hidden\" name=\"idFeina\" value=\"" . $row["id_feina_pf"] ."\">
                                            <input type=\"hidden\" name=\"idLinia\" value=" . $row["id_linia_pf"] ."><button style='margin: 5px;' type='submit' class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i></button></form></th>
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
function printNuvolProductes($idFeina, $idClient) {
    include "mysql.php";
    $sql = "SELECT * FROM `productes`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        echo "<table><td>";
        while($row = $result->fetch_assoc()) {
            echo "<form action='scriptAfegirLinia.php' method='post'><input type=\"hidden\" name=\"idFeina\" value=\"" . $idFeina ."\">
                                            <input type=\"hidden\" name=\"idClient\" value=" . $idClient .">
                                            <input type=\"hidden\" name=\"idProducte\" value=" . $row["id_producte"] .">
                                            <input type=\"hidden\" name=\"sonHores\" value=" . $row["son_hores_producte"] .">
                                            <input type=\"hidden\" name=\"preuProducte\" value=" . $row["preu_unitat_base_producte"].">
                                            <input type=\"hidden\" name=\"nomProducte\" value=\"" . $row["nom_base_producte"]."\">
                                            <th><button style='margin: 5px;' type='submit' class=\"btn btn-primary btn-lg\">";
                                            if ($row["son_hores_producte"])
                                            {
                                              echo "<i class=\"fa fa-wrench\" aria-hidden=\"true\"></i> " . $row["nom_base_producte"];
                                            }
                                            else
                                            {
                                              echo "<i class=\"fa fa-cube\" aria-hidden=\"true\"></i> " . $row["nom_base_producte"];
                                            }
                                            echo "</button>	&nbsp;</form></th>";
        }
        echo "</td></table>";
    } else {
        echo "Encara no hi ha cap producte";
    }
}
function modificarDescripcioFeina($idFeina, $descripcioFeina)
{
  include "mysql.php";
  $sql = "UPDATE `feines` SET `descripcio_feina` = '$descripcioFeina' WHERE `feines`.`id_feina` = '$idFeina'";
  if ($conn->query($sql) === TRUE) {
      return true;
  } else {
      echo "ERROR: " . $sql . "<br>" . $conn->error;
      return false;
  }
}



?>
