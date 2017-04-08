<?php
function getHoresFeina($idFeina)
{
    include "mysql.php";
    $sql = "SELECT `hores`.`id_feina_hores`, `treballadors`.`nom_treballador`, `hores`.`hores_hores`, `hores`.`dia_hores`, `hores`.`id_hores`
              FROM `hores`
              LEFT JOIN `treballadors` ON `hores`.`id_treballador_hores` = `treballadors`.`id_treballador`
              WHERE (( `id_feina_hores` = $idFeina))
              ORDER BY `hores`.`dia_hores` DESC;";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
function getTotalHoresFeina($idFeina)
{
    include "mysql.php";
    $sql = "SELECT sum(`hores`.`hores_hores`)
              FROM `hores`
              WHERE (( `id_feina_hores` = $idFeina))";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0)
    {
      $row = $result->fetch_assoc();
      return $row["sum(`hores`.`hores_hores`)"]/100;
    }
    else
    {
      return 0;
    }
    return 0;
}
function modificarHores($idHores, $horesHores)
{
  include "mysql.php";
  $sql = "UPDATE `hores` SET `hores_hores` = $horesHores WHERE `hores`.`id_hores` = $idHores";
  if ($conn->query($sql) === TRUE) {
      return true;
  } else {
      echo "ERROR: " . $sql . "<br>" . $conn->error;
      return false;
  }
}
function eliminarHores($id)
{
    include "mysql.php";
    $sql = "DELETE FROM hores WHERE id_hores=$id";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "ERROR: " . mysqli_error($conn);
        return false;
    }
}
function mostrarHores($sql, $idTreballador) {
    $ultimDia = date("Y-m-d");
    $ultimDia = date('Y-m-d', strtotime("+3 months", strtotime($ultimDia)));
    $sumaTotalDia = 0;
    $sumaExtraDia = 0;
    $primer = true;
    $sumaTotalMes= 0;
    $sumaExtraMes = 0;
    $diaNou;
    $mesNou;
    if ($idTreballador != 0) {
      $horesDiaTreballador = getHoresTreballador($idTreballador);
    } else {
      $horesDiaTreballador = 800;
    }
    include "mysql.php";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (date_format(date_create($ultimDia), 'Y-m-d') > date_format(date_create($row["dia_hores"]), 'Y-m-d') ) $diaNou = true;
            if (date_format(date_create($ultimDia), 'Y-m') > date_format(date_create($row["dia_hores"]), 'Y-m') ) $mesNou = true;

            if ($diaNou)
            {
              $ultimDia = $row["dia_hores"];
              $sumaExtraMes+=$sumaExtraDia;
              $sumaTotalMes+=$sumaTotalDia;
              $sumaExtraDia = 0;
              $sumaTotalDia = 0;
            }

            if($mesNou)
            {
              if (!$primer)
              { echo "
                        </tbody>
                    </table>
                    <h3>Total Hores: ". number_format($sumaTotalMes / 100,2)." - Total Extres: ".number_format($sumaExtraMes / 100,2)."</h3>
                </div>
                    ";
              } else
              {
                $primer= false;
              }
              echo "
              <h1>".date_format(date_create($row["dia_hores"]), 'm-Y')."</h1>
                                <div class=\"table-responsive\">
                                      <table class=\"table table-striped\">
                                          <thead>
                                              <tr>
                                                  <th>Dia</th>
                                                  <th>Treballador</th>
                                                  <th>Feina</th>
                                                  <th>Detall</th>
                                                  <th>Hores</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                          ";

            }

            $sumaTotalDia+=$row["hores_hores"];
            if ($sumaTotalDia > $horesDiaTreballador) $sumaExtraDia = $sumaTotalDia - $horesDiaTreballador;


              echo "<tr>
                                                      <td>". getDataDMY($row["dia_hores"]) . "</td>
                                                      <td><a href='mostrarTreballador.php?id=".$row["id_treballador_hores"]."'>". getNomTreballador($row["id_treballador_hores"]) . "</a></td>
                                                      <td><a href='mostrarFeina.php?id=".$row["id_feina_hores"]."'>". getDescFeina($row["id_feina_hores"]) . "</a></td>
                                                      <td>". $row["detall_hores"] . "</td>
                                                      <td>". number_format($row["hores_hores"] / 100,2). "</td>
                                                  </tr>";
          $diaNou = false;
          $mesNou = false;
        }
        $sumaExtraMes+=$sumaExtraDia;
        $sumaTotalMes+=$sumaTotalDia;
        echo "
                                        </tbody>
                                    </table>
                                    <h3>Total Hores: ". number_format($sumaTotalMes / 100,2)." - Total Extres: ".number_format($sumaExtraMes / 100,2)."</h3>
                                </div>
                                    ";
    } else {
        echo "No s'ha trobat cap hora";
    }
    $conn->close();
}
 ?>
