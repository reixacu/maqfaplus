<?php
$id = $_POST["id"];
$estat = $_POST["estat"];
include "funcions.php";
changeEstatFeina($id, $estat);

echo "
                            <script>
                            window.location.replace(\"mostrarFeina.php?id=".$id."\");
                            </script>
                            ";
?>