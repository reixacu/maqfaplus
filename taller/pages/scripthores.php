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

echo $array[0]['Feina'];

foreach ($array as &$valor)
{
	echo $valor['Feina'];
}

$count = sizeof($array);


for( $i = 0 ; $i< $count ; $i++)
{
	echo "Feina: " . $array[$i]['Feina'];
	echo "Dia: " . $array[$i]['Dia'];
	echo "Hores: " . $array[$i]['Hores'];
	echo "Detall: " . $array[$i]['Detall'];
	echo "Acabada?: " . $array[$i]['Acabada?'];
	
	//$sql="INSERT INTO hores VALUES ('".$array[$i]['] .'")
	$sql="INSERT INTO `maqfaplus`.`hores` (`id_hores`, `id_treballador_hores`, `id_feina_hores`, `hores_hores`, `dia_hores`, `dia_creacio_hores`, `timestamp_hores`) ";
	$sql=$sql."VALUES (NULL, '".$array[$i]['Hores']."', '".$array[$i]['Feina']."', '10', '2017-01-03', '2017-01-08', CURRENT_TIMESTAMP)"
	
}

echo sizeof($array);
// encode the PHP variable to JSON and send it back on client-side
//echo json_encode($v);
?>
