<?php
	require('../fpdf/fpdf.php');
	include "../core/autoload.php";
	include "../core/app/model/ConstruccionData.php";
	/**************************************************************/
	header("Content-Type: text/html; charset=iso-8859-1 ");
	class PDF extends FPDF{
		// Cabecera de página
		function Header(){
			// Logo
			$this->Image('../plugins/imagenes/uriangato.png',10,10,20);
			// Arial bold 15
			$this->SetFont('Arial','B',12);
			// Título
			$this->Cell(0,10,utf8_decode('REPORTE DE LICENCIAS DE CONSTRUCCION'),0,0,'C');
			// Salto de línea
			$this->Ln(10);
			$fechaini=date('d-m-Y', strtotime($_GET["sd"]));
			$fechafin=date('d-m-Y', strtotime($_GET["ed"]));
			$this->Cell(0,10,'DEL '.$fechaini. ' AL '.$fechafin.'',0,0,'C');
			$this->Ln(10);
		}
		// Pie de página
		function Footer(){
			// Posición: a 1,5 cm del final
			$this->SetY(-15);
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			// Número de página
			$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}
	$pdf = new PDF('L');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	//Ponemos el cuerpo de los datos a mostrar
	$pdf->Ln(8);
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->SetFillColor(240, 118, 12);
	$pdf->Cell(10, 8, '#', 1,0,'C', True);
	$pdf->Cell(72, 8, 'Nombre Solicitante', 1,0,'C', True);
	$pdf->Cell(83, 8, 'Ubicacion de la Obra',1, 0,'C', True);
	$pdf->Cell(75, 8, 'Destino de la Obra',1, 0,'C', True);
	$pdf->Cell(35, 8, 'Vigencia',1, 0,'C', True);
	/*$pdf->Cell(25, 8, 'Vigenciain',1, 0,'C', True);*/
	$pdf->Ln(8);
	$pdf->SetFont('Arial', '', 8);
	if(isset($_GET["sd"]) && isset($_GET["ed"])){
		$operations = array();
		$operations = ConstruccionData::getAllByDateOp($_GET["sd"],$_GET["ed"]);
		$totalfolio = 0;
		if(count($operations)>0){
			$supertotal = 0;
			foreach($operations as $operation){
				$pdf->Cell(10, 8, $operation->numero_licencia, 1,0,'C');
				$pdf->Cell(72, 8, utf8_decode($operation->nombre_solicitante), 1,0,'L');
				$pdf->Cell(83, 8, utf8_decode($operation->ubicacion_obra), 1,0,'L');
				$pdf->Cell(75, 8, utf8_decode($operation->destino_obra), 1,0,'L');
				$oldvigencia1=$operation->vigencia1;
				$oldvigencia2=$operation->vigencia2;
				$pdf->Cell(35, 8, date('d-m-Y', strtotime($oldvigencia1)).' - '. date('d-m-Y', strtotime($oldvigencia2)), 1,0,'C');
				/*$pdf->Cell(25, 8, date('d-m-Y', strtotime($oldvigencia2)), 1,0,'C');*/
				$pdf->Ln(8);
				$totalfolio=($totalfolio+1);
			}
		}
		$pdf->Ln(15);
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(0,0,"Total de Licencias: ".$totalfolio."",0,0,'C');
	}
	$pdf->Output();
?>