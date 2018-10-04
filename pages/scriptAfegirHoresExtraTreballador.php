<?php
$idTreballador = $_POST["idTreballador"];
$numHores = $_POST["numHores"];
$numHores = $numHores * 100;

if (modificarExtra($idTreballador, $numHores)) {
    echo "
                            <script>
                            window.location.replace(\"totesHores.php?id=".$idTreballador."\");
                            </script>
                            ";
} else {
    echo "ERROR";
}



function modificarExtra($idTreballador, $numHores)
{
  include "mysql.php";
  $sql = "UPDATE `treballadors` SET `hores_extra_treballador` = `hores_extra_treballador` + $numHores WHERE `treballadors`.`id_treballador` = $idTreballador";
  if ($conn->query($sql) === TRUE) {
      return true;
  } else {
      echo "ERROR: " . $sql . "<br>" . $conn->error;
      return false;
  }
}
?>
