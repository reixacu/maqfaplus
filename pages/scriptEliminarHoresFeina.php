<?php
$idHores = $_POST["idHores"];
$idFeina = $_POST["idFeina"];
include_once "funcionsHores.php";
if (eliminarHores($idHores)) {
    echo "
                            <script>
                            window.location.replace(\"mostrarFeina.php?id=".$idFeina."\");
                            </script>
                            ";
} else {
    echo "ERROR";
}
?>
