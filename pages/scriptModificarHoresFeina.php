<?php
$idHores = $_POST["idHores"];
$idFeina = $_POST["idFeina"];
$horesHores = $_POST["horesHores"];
include_once "funcionsHores.php";
if (modificarHores($idHores, $horesHores)) {
    echo "
                            <script>
                            window.location.replace(\"mostrarFeina.php?id=".$idFeina."\");
                            </script>
                            ";
} else {
    echo "ERROR";
}
?>
