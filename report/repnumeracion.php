<?php
	require('../fpdf/fpdf.php');
	include "../core/autoload.php";
	include "../core/app/model/NumeracionData.php";
	include "../core/app/model/VialidadData.php";
	include "../core/app/model/ColoniaData.php";
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
			$this->Cell(0,10,utf8_decode('REPORTE DE ALINEAMIENTO Y NUMERO OFICIAL'),0,0,'C');
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
	$pdf->Cell(15, 8, '#', 1,0,'C', True);
	$pdf->Cell(65, 8, 'Nombre Solicitante', 1,0,'C', True);
	$pdf->Cell(30, 8, 'Cta Catastral',1, 0,'C', True);
	$pdf->Cell(60, 8, 'Vialidad',1, 0,'C', True);
	$pdf->Cell(25, 8, 'No. Oficial',1, 0,'C', True);
	$pdf->Cell(55, 8, 'Colonia',1, 0,'C', True);
	$pdf->Cell(30, 8, 'Fecha Exp.',1, 0,'C', True);
	$pdf->Ln(8);
	$pdf->SetFont('Arial', '', 9);
	if(isset($_GET["sd"]) && isset($_GET["ed"])){
		$operations = array();
		$operations = NumeracionData::getAllByDateOp($_GET["sd"],$_GET["ed"]);
		$totalfolio = 0;
		if(count($operations)>0){
			$supertotal = 0;
			foreach($operations as $operation){
				$pdf->Cell(15, 8, $operation->numero_licencia, 1,0,'C');
				$pdf->Cell(65, 8, utf8_decode($operation->nombre_solicitante), 1,0,'C');
				$pdf->Cell(30, 8, utf8_decode($operation->predial_obra), 1,0,'C');
				$idv= $operation->ubicacion_obra;
				$datosvialidad=VialidadData::getById($idv);
				$pdf->Cell(60, 8, utf8_decode($datosvialidad->nombre), 1,0,'C');
				$pdf->Cell(25, 8, utf8_decode($operation->oficial), 1,0,'C');
				$idc=$operation->colonia;
				$datoscolonia=ColoniaData::getById($idc);
				$pdf->Cell(55, 8, utf8_decode($datoscolonia->nombre), 1,0,'C');
				$oldfecha=$operation->fecha;
				$pdf->Cell(30, 8, date('d-m-Y', strtotime($oldfecha)), 1,0,'C');
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