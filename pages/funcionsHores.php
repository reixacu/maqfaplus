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



 ?>
