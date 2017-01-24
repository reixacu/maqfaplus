<?php
// Handling data in JSON format on the server-side using PHP
//
header("Content-Type: application/json");
// build a PHP variable from JSON sent using POST method
$v = json_decode(stripslashes(file_get_contents("php://input")));
// build a PHP variable from JSON sent using GET method
$v = json_decode(stripslashes($_GET["data"]));

$array = json_decode($_GET["data"], true);
var_dump($array);

//echo $array[0]['Feina'];

/*foreach ($array as &$valor)
{
	echo $valor['Feina'];
}*/

$count = sizeof($array);

include "mysql.php";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
	die("ERROR AL CONNECTAR AMB LA BASE DE DADES: " . $conn->connect_error);

$idTreballador1 = $_GET["idtreballador"];
$sql="DELETE FROM `hores` WHERE `dia_creacio_hores`=CURRENT_DATE() AND `id_treballador_hores`=$idTreballador1;";
$conn->query($sql);

for( $i = 0 ; $i< $count ; $i++)
{
	if($array[$i]['Hores']!=""){
		echo " Feina: " . $array[$i]['Feina'];//
		echo " Dia: " . $array[$i]['Dia'];//
		echo " Hores: " . $array[$i]['Hores'];//
		echo " Detall: " . $array[$i]['Detall'];//
		echo " Acabada: " . $array[$i]['Acabada']." \n"; //s'ha de posar a algun lloc que encara no existeix
		$esAcabadaB = $array[$i]['Acabada'];
		$esAcabada = 0;
		if ($esAcabadaB == true) $esAcabada = 1;

		$sql="INSERT INTO `maqfaplus`.`hores` (`id_hores`, `id_treballador_hores`, `id_feina_hores`, `hores_hores`, `detall_hores`, `dia_hores`, `dia_creacio_hores`, `timestamp_hores`, `feina_acabada_hores`) ";
		$sql=$sql."VALUES (NULL, '".$_GET["idtreballador"]."', '".$array[$i]['Feina']."', '".$array[$i]['Hores']."', `".$array[$i]['Detall']."`,'".$array[$i]['Dia']."', CURRENT_DATE, CURRENT_TIMESTAMP, ". $esAcabada.");";
		$result = $conn->query($sql);
		//echo $sql;
	}
}

$conn->close();
//echo sizeof($array);
// encode the PHP variable to JSON and send it back on client-side
//echo json_encode($v);
?>
