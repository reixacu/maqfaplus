<?php
//============================================================+
// File name   : generarFacturaPDF.php
// Begin       : 2016-10-11
// Last Update : 2016-10-12
//
// Description : Generador de factures
//
// Author: El Klanco
//
// (c) Copyright:
//               El Klanco
//               www.slabbababba.com
//               klanc@slabbababba.com
//============================================================+

// Include the main TCPDF library (search for installation path).

include "funcions.php";
require_once('../tcpdf/tcpdf.php');

//vars

$idFactura = $_GET["id"];

$result = getFacturaData($idFactura);
$row = $result->fetch_assoc();

$result1 = getClientData($row["id_client_factura"]);
$row1 = $result1->fetch_assoc();

$resultDadesFactura = getLiniesFacturaData($idFactura);

$dataFactura = getDataDMY($row["data_factura"]);
$nomClient = getClientCognomNomNoComerc($row["id_client_factura"]);
$direccioClient = $row1["adreca_client"];
$poblacioClient = $row1["poblacio_client"];
$nifClient = $row1["nif_client"];
$provinciaClient = $row1["provincia_client"];
$numFactura = $row["numero_factura"];
$baseImposable = number_format($row["base_imposable_factura"] / 100,2);
$iva = $row["iva_factura"];
$ivaFactura = number_format($row["import_iva_factura"] / 100,2);
$totalFactura = number_format($row["total_factura"] / 100,2);
$dataVenciment = getDataDMY($row["data_venciment_factura"]);
$formaPagament= getNomFormaPagament($row["forma_pagament_factura"]);
$quantitatElements = getNumRowsDetallsFactura($idFactura);
$cpClient = $row1["cp_client"];
//$quantitatElements = $resultDadesFactura->mysql_num_rows; //EMPLENAR ARRAYS

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MAQFA');
$pdf->SetTitle('FacturaPDF');
$pdf->SetSubject('FacturaPDF');
$pdf->SetKeywords('PDF');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP/4, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM/4);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '
<div style="text-align:left">
	<img src="logo.jpg" alt="test alt attribute" width="200" height="118" border="0" />
</div>
<table style="width:100%">
	<tr>
		<td> </td>
		<td style="text-align:right"><b>CLIENT </b> </td>
	</tr>
	<tr>
		<td style="text-align:left">
				FALGARONA COLL, FRANCESC XAVIER
				<br /> C/Roselló, 19   Pol.Ind.La Canya
				<br /> 17800 OLOT
				<br /> (Girona)
				<br /> NIF 46672373-Z
				<br /> Tel. 608556991
				<br /> xevifaco@maqfa.cat
		</td>
		<td style="text-align:right">';
			if ($nomClient != "") $html = $html . $nomClient;
			if ($direccioClient != "") $html = $html . '<br />' . $direccioClient;
			if ($cpClient != "" && $poblacioClient != "") $html = $html . '<br />' . $cpClient ." ". $poblacioClient;
			if ($provinciaClient != "") $html = $html . '<br />' . $provinciaClient;
			if ($nifClient != "") $html = $html . '<br />CIF ' . $nifClient;
			$html = $html . '
		</td>
	</tr>
</table>
<br />
<br />
<br />
<table style="width:100%;" border="1">
	<tr>
		<td style="text-align:center;background-color:#DDDDDD;"><b>FRA Nº </b></td>
		<td colspan="4"> ' . $numFactura . ' </td>
		<td style="text-align:center;background-color:#DDDDDD;"><b>DATA  </b></td>
		<td colspan="4"> ' . $dataFactura . ' </td>
	</tr>
</table>
<br />
<br />
<table style="padding: 5px 5px 5px 1%;" border="1">
	<tr>
		<td colspan="4" style="text-align:center;background-color:#DDDDDD;"><b>CONCEPTE </b></td>
		<td style="text-align:center;background-color:#DDDDDD;"> <b>QUANT.</b> </td>
		<td style="text-align:center;background-color:#DDDDDD;"> <b>PREU</b> </td>
		<td style="text-align:center;background-color:#DDDDDD;"> <b>IMPORT</b> </td>
	</tr>
	<tr>
		<td colspan="4" height="10" style="border-right: solid 1px #000;vertical-align:bottom"> </td>
		<td style="border-right: solid 1px #000;text-align:right"> </td>
		<td style="border-right: solid 1px #000;text-align:right"> </td>
		<td style="border-right: solid 1px #000;text-align:right"> </td>
		<td height="498" rowspan="'. ($quantitatElements + 1) . '"> </td>
	</tr>
';

for($i = 0; $i< $quantitatElements; $i++){
	$rowDadesFactura = $resultDadesFactura->fetch_assoc();
	if ($rowDadesFactura["preu_total_df"] != "0")
	{
		// Tipus de línia amb preu quantitat i preu total
	$html = $html . '
	<tr>
	<td colspan="4" height="35" style="border-right: solid 1px #000;vertical-align:bottom"> ' . $rowDadesFactura["descripcio_df"] . '</td>
		<td style="border-right: solid 1px #000;text-align:right"> ' . ($rowDadesFactura["unitats_df"]/100) . '  &nbsp; </td>
		<td style="border-right: solid 1px #000;text-align:right"> ' . number_format($rowDadesFactura["preu_unitat_df"]/100,2) . ' € &nbsp; </td>
		<td style="border-right: solid 1px #000;text-align:right"> ' . number_format($rowDadesFactura["preu_total_df"]/100,2) . ' € &nbsp; </td>
		</tr>
		';
	} else {
		{
			// Tipus de línia sense preu. Són línies descriptives
		$html = $html . '
		<tr>
		 <td colspan="4" height="35" style="border-right: solid 1px #000;vertical-align:bottom"> ' . $rowDadesFactura["descripcio_df"] . '</td>
			<td style="border-right: solid 1px #000;text-align:right"></td>
			<td style="border-right: solid 1px #000;text-align:right"></td>
			<td style="border-right: solid 1px #000;text-align:right"></td>
		</tr>
			';
		}
	}
}

// output the HTML content
$html = $html . '
</table>';
$pdf->writeHTMLCell(0,0,15,10,$html, false,true, false, true, false, '');
$html = '
		<table border="1">
			<tr>
				<td style="text-align:center;background-color:#DDDDDD;"><b> BASE IMPOSABLE </b></td>
				<td style="text-align:center;background-color:#DDDDDD;"><b> IVA ' . $iva . '% </b></td>
				<td style="text-align:center;background-color:#DDDDDD;"><b> TOTAL FACTURA </b></td>
			</tr>
			<tr>
				<td style="text-align:center"> ' . $baseImposable . ' € </td>
				<td style="text-align:center"> ' . $ivaFactura . ' € </td>
				<td style="text-align:center"> ' . $totalFactura . ' € </td>
			</tr>
		</table>
		<br />
		<br />
		<table>
			<tr>
				<td> Forma pagament </td>
				<td colspan="4"> ' . $formaPagament . '</td>
			</tr>
			<tr>
				<td> Venciment </td>
				<td colspan="4"> ' . $dataVenciment . ' </td>
			</tr>
		</table>
';

$pdf->writeHTMLCell(0,0,15,250,$html, false,true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output( '/home/pi/factures/factura_' . $idFactura . '.pdf', 'F');
$pdf->Output( 'factura_' . $numFactura . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
