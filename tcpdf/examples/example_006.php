<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

//vars
$numFactura = 2;
$data = "30/02/1970";
$nomClient = "Mike Sniper";
$direccioClient = "Can Mothefucka 54";
$poblacioClient = "Sevilla city";
$nifClient = "41414141Z";
$numFactura = 213;
$dataFactura = "30/02/1970";
$concepteTemp = "LMAOOO";
$quantTemp = 9;
$importTemp = 23;
$baseImposable = 33;
$iva = 2;
$totalFactura = 900;
$dataVenciment = "30/02/1970";
$formaPagament= "TRANSFERENCIA ES72 89708907890798789789";
$arrayQuantitats = array();
$arrayConceptes = array();
$arrayImports = array();
$quantitatElements = 3;
$arrayQuantitats[] = 3;
$arrayQuantitats[] = 4;
$arrayQuantitats[] = 5;
$arrayConceptes[] = "LMAO";
$arrayConceptes[] = "AYY";
$arrayConceptes[] = "PINGAS";
$arrayImports[] = 3;
$arrayImports[] = 4;
$arrayImports[] = 5;


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
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

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '
<div style="text-align:right">
	<img src="../../pages/logo.jpg" alt="test alt attribute" width="200" height="120" border="0" />
</div>
<table style="width:100%">
	<tr>
		<td>
			' . $nomClient . '
			<br />' . $direccioClient . '
			<br />' . $poblacioClient . '
			<br />N.I.F. ' . $nifClient . '
		</td>
		<td>
			<div style="text-align:right">
				XEVI FALGORONA COLL
				<br /> Pol.Ind.La Canya
				<br /> C/Roselló, 18 
				<br /> 17800 OLOT
				<br /> Girona
				<br /> Tel. 608556991
				<br /> N.I.F. 46672373-Z
			</div>
		</td>
	</tr>
</table>
<br />
<br />
<br />
<table style="width:100%" border="1">
	<tr>
		<td style="text-align:center;background-color:#DDDDDD;">FRA Nº </td>
		<td colspan="4"> ' . $numFactura . ' </td>
		<td style="text-align:center;background-color:#DDDDDD;"> DATA  </td>
		<td colspan="4"> ' . $dataFactura . ' </td>
	</tr>
</table>
<br />
<br />
<table border="1">
	<tr>
		<td colspan="4" style="text-align:center;background-color:#DDDDDD;"> CONCEPTE </td>
		<td style="text-align:center;background-color:#DDDDDD;"> QUNATITAT </td>
		<td style="text-align:center;background-color:#DDDDDD;"> IMPORT </td>
	</tr>
	<tr>
		<td colspan="4" height="10" style="border-right: solid 1px #000;vertical-align:bottom"> </td>
		<td style="border-right: solid 1px #000;text-align:right"> </td>
		<td style="border-right: solid 1px #000;text-align:right"> </td>
	</tr>
';
for($i = 0; $i< $quantitatElements; $i++){
	$html = $html . '
	<tr>
	<td colspan="4" height="35" style="border-right: solid 1px #000;vertical-align:bottom"> ' . $arrayConceptes[$i] . '</td>
		<td style="border-right: solid 1px #000;text-align:right"> ' . $arrayQuantitats[$i] . '  &nbsp; </td>
		<td style="border-right: solid 1px #000;text-align:right"> ' . $arrayImports[$i] . '€ &nbsp; </td>
		</tr>
		';
}
// output the HTML content
$html = $html . '
</table>';
$pdf->writeHTMLCell(0,0,15,0,$html, false,true, false, true, false, '');
$html = '
		<table border="1">
			<tr>
				<td style="text-align:center;background-color:#DDDDDD;"> BASE IMPOSABLE </td>
				<td style="text-align:center;background-color:#DDDDDD;"> IVA 21% </td>
				<td style="text-align:center;background-color:#DDDDDD;"> TOTAL FACTURA </td>
			</tr>
			<tr>
				<td style="text-align:center"> ' . $baseImposable . ' </td>
				<td style="text-align:center"> ' . $iva . ' </td>
				<td style="text-align:center"> ' . $totalFactura . ' </td>
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

$pdf->writeHTMLCell(0,0,15,260,$html, false,true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
