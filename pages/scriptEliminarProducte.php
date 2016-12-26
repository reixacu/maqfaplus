<?php
$id = $_POST["id"];

include "mysql.php";
$sql = "DELETE FROM `productes` WHERE `productes`.`id_producte` = $id";

if ($conn->query($sql) === TRUE) {
    echo "
                            <script>
                            window.location.replace(\"productes.php\");
                            </script>
                            ";
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}
?>