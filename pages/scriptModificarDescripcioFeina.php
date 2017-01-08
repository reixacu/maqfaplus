<?php
$idFeina = $_POST["idFeina"];
$descripcioFeina = $_POST["descripcio"];
include_once "funcionsFeines.php";
if (modificarDescripcioFeina($idFeina, $descripcioFeina)) {
    echo "
                            <script>
                            window.location.replace(\"mostrarFeina.php?id=".$idFeina."\");
                            </script>
                            ";
} else {
    echo "ERROR";
}
?>
