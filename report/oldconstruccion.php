<?php
	require('../fpdf/fpdf.php');
	/***********Clases para la estraccion de los datos*************/
	include "../core/autoload.php";
	include "../core/app/model/ConstruccionData.php";
	/**************************************************************/
	header("Content-Type: text/html; charset=iso-8859-1 ");
	class PDF_FlowingBlock extends FPDF{
		var $flowingBlockAttr;
		function saveFont(){
			$saved = array();
			$saved[ 'family' ] = $this->FontFamily;
			$saved[ 'style' ] = $this->FontStyle;
			$saved[ 'sizePt' ] = $this->FontSizePt;
			$saved[ 'size' ] = $this->FontSize;
			$saved[ 'curr' ] =& $this->CurrentFont;
			return $saved;
		}
		function restoreFont( $saved ){
	
			$this->FontFamily = $saved[ 'family' ];
			$this->FontStyle = $saved[ 'style' ];
			$this->FontSizePt = $saved[ 'sizePt' ];
			$this->FontSize = $saved[ 'size' ];
			$this->CurrentFont =& $saved[ 'curr' ];
			if( $this->page > 0)
				$this->_out( sprintf( 'BT /F%d %.2F Tf ET', $this->CurrentFont[ 'i' ], $this->FontSizePt ) );
		}
	
		function newFlowingBlock( $w, $h, $b = 0, $a = 'J', $f = 0 ){
			// cell width in points
			$this->flowingBlockAttr[ 'width' ] = $w * $this->k;
			// line height in user units
			$this->flowingBlockAttr[ 'height' ] = $h;
			$this->flowingBlockAttr[ 'lineCount' ] = 0;
			$this->flowingBlockAttr[ 'border' ] = $b;
			$this->flowingBlockAttr[ 'align' ] = $a;
			$this->flowingBlockAttr[ 'fill' ] = $f;
			$this->flowingBlockAttr[ 'font' ] = array();
			$this->flowingBlockAttr[ 'content' ] = array();
			$this->flowingBlockAttr[ 'contentWidth' ] = 0;
		}
	
		function finishFlowingBlock(){
			$maxWidth =& $this->flowingBlockAttr[ 'width' ];
			$lineHeight =& $this->flowingBlockAttr[ 'height' ];
			$border =& $this->flowingBlockAttr[ 'border' ];
			$align =& $this->flowingBlockAttr[ 'align' ];
			$fill =& $this->flowingBlockAttr[ 'fill' ];
			$content =& $this->flowingBlockAttr[ 'content' ];
			$font =& $this->flowingBlockAttr[ 'font' ];
			// set normal spacing
			$this->_out( sprintf( '%.3F Tw', 0 ) );
			// print out each chunk
			// the amount of space taken up so far in user units
			$usedWidth = 0;
			foreach ( $content as $k => $chunk ){
				$b = '';
				if ( is_int( strpos( $border, 'B' ) ) )
					$b .= 'B';
	
				if ( $k == 0 && is_int( strpos( $border, 'L' ) ) )
					$b .= 'L';
	
				if ( $k == count( $content ) - 1 && is_int( strpos( $border, 'R' ) ) )
					$b .= 'R';
	
				$this->restoreFont( $font[ $k ] );
				// if it's the last chunk of this line, move to the next line after
				if ( $k == count( $content ) - 1 )
					$this->Cell( ( $maxWidth / $this->k ) - $usedWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 1, $align, $fill );
				else
					$this->Cell( $this->GetStringWidth( $chunk ), $lineHeight, $chunk, $b, 0, $align, $fill );
	
				$usedWidth += $this->GetStringWidth( $chunk );
			}
		}
		function WriteFlowingBlock( $s ){
			// width of all the content so far in points
			$contentWidth =& $this->flowingBlockAttr[ 'contentWidth' ];
			// cell width in points
			$maxWidth =& $this->flowingBlockAttr[ 'width' ];
			$lineCount =& $this->flowingBlockAttr[ 'lineCount' ];
			// line height in user units
			$lineHeight =& $this->flowingBlockAttr[ 'height' ];
			$border =& $this->flowingBlockAttr[ 'border' ];
			$align =& $this->flowingBlockAttr[ 'align' ];
			$fill =& $this->flowingBlockAttr[ 'fill' ];
			$content =& $this->flowingBlockAttr[ 'content' ];
			$font =& $this->flowingBlockAttr[ 'font' ];
			$font[] = $this->saveFont();
			$content[] = '';
			$currContent =& $content[ count( $content ) - 1 ];
			// where the line should be cutoff if it is to be justified
			$cutoffWidth = $contentWidth;
	
			// for every character in the string
			for ( $i = 0; $i < strlen( $s ); $i++ ){
				// extract the current character
				$c = $s[ $i ];
				// get the width of the character in points
				$cw = $this->CurrentFont[ 'cw' ][ $c ] * ( $this->FontSizePt / 1000 );
				if ( $c == ' ' ){
					$currContent .= ' ';
					$cutoffWidth = $contentWidth;
					$contentWidth += $cw;
					continue;
				}
	
				// try adding another char
				if ( $contentWidth + $cw > $maxWidth ){
					// won't fit, output what we have
					$lineCount++;
					// contains any content that didn't make it into this print
					$savedContent = '';
					$savedFont = array();
					// first, cut off and save any partial words at the end of the string
					$words = explode( ' ', $currContent );
					// if it looks like we didn't finish any words for this chunk
					if ( count( $words ) == 1 ){
						// save and crop off the content currently on the stack
						$savedContent = array_pop( $content );
						$savedFont = array_pop( $font );
						// trim any trailing spaces off the last bit of content
						$currContent =& $content[ count( $content ) - 1 ];
						$currContent = rtrim( $currContent );
					}
	
					// otherwise, we need to find which bit to cut off
					else{
						$lastContent = '';
						for ( $w = 0; $w < count( $words ) - 1; $w++)
							$lastContent .= "{$words[ $w ]} ";
	
						$savedContent = $words[ count( $words ) - 1 ];
						$savedFont = $this->saveFont();
						// replace the current content with the cropped version
						$currContent = rtrim( $lastContent );
					}
	
					// update $contentWidth and $cutoffWidth since they changed with cropping
					$contentWidth = 0;
					foreach ( $content as $k => $chunk ){
						$this->restoreFont( $font[ $k ] );
						$contentWidth += $this->GetStringWidth( $chunk ) * $this->k;
					}
					$cutoffWidth = $contentWidth;
					// if it's justified, we need to find the char spacing
					if( $align == 'J' ){
						// count how many spaces there are in the entire content string
						$numSpaces = 0;
						foreach ( $content as $chunk )
							$numSpaces += substr_count( $chunk, ' ' );
	
						// if there's more than one space, find word spacing in points
						if ( $numSpaces > 0 )
							$this->ws = ( $maxWidth - $cutoffWidth ) / $numSpaces;
						else
							$this->ws = 0;
	
						$this->_out( sprintf( '%.3F Tw', $this->ws ) );
					}
					// otherwise, we want normal spacing
					else
						$this->_out( sprintf( '%.3F Tw', 0 ) );
	
					// print out each chunk
					$usedWidth = 0;
					foreach ( $content as $k => $chunk ){
						$this->restoreFont( $font[ $k ] );
						$stringWidth = $this->GetStringWidth( $chunk ) + ( $this->ws * substr_count( $chunk, ' ' ) / $this->k );
						// determine which borders should be used
						$b = ' ';
						if ( $lineCount == 1 && is_int( strpos( $border, 'T' ) ) )
							$b .= 'T';
	
						if ( $k == 0 && is_int( strpos( $border, 'L' ) ) )
							$b .= 'L';
	
						if ( $k == count( $content ) - 1 && is_int( strpos( $border, 'R' ) ) )
							$b .= 'R';
	
						// if it's the last chunk of this line, move to the next line after
							if ( $k == count( $content ) - 1 )
							$this->Cell( ( $maxWidth / $this->k ) - $usedWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 1, $align, $fill );
						else{
							$this->Cell( $stringWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 0, $align, $fill );
							$this->x -= 2 * $this->cMargin;
						}
						$usedWidth += $stringWidth;
					}
					// move on to the next line, reset variables, tack on saved content and current char
					$this->restoreFont( $savedFont );
					$font = array( $savedFont );
					$content = array( $savedContent . $s[ $i ] );
					$currContent =& $content[ 0 ];
					$contentWidth = $this->GetStringWidth( $currContent ) * $this->k;
					$cutoffWidth = $contentWidth;
				}
	
				// another character will fit, so add it on
				else{
					$contentWidth += $cw;
					$currContent .= $s[ $i ];
				}
			}
		}
		
		// Cabecera de página
		function Header(){
			// Logo1
			$this->Image('../plugins/imagenes/escudomin.png',4,4,35);
			$this->Image('../plugins/imagenes/logo.png',133,8,68);
		}
		// Pie de página
		function Footer(){
			// Posición: a 1,5 cm del final
			$this->SetY(-15);
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			// Número de página
			$this->Cell(0,10,'Presidencia Municipal, Morelos No. 1 Zona Centro. Uriangato Gto. C.P. 38980, Tel. 4575022 y 4575032 Ext. 115',0,0,'C');
			$this->Ln(5);
			$this->Cell(0,10,'durbano@uriangato.gob.mx		uriangato.gob.mx',0,0,'C');
		}
	}
	$pdf = new PDF_FlowingBlock();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$fecha=date('d-m-Y');
	list($dia, $mes, $anio) = explode("-",$fecha);
	if($mes == '01'){$mes='Enero';}
	elseif($mes == '02'){$mes='Febrero';}
	elseif($mes == '03'){$mes='Marzo';}
	elseif($mes == '04'){$mes='Abril';}
	elseif($mes == '05'){$mes='Mayo';}
	elseif($mes == '06'){$mes='Junio';}
	elseif($mes == '07'){$mes='Julio';}
	elseif($mes == '08'){$mes='Agosto';}
	elseif($mes == '09'){$mes='Septiembre';}
	elseif($mes == '10'){$mes='Octubre';}
	elseif($mes == '11'){$mes='Noviembre';}
	else{$mes='Diciembre';}	
	if(isset($_GET["var"])){
		$datos= ConstruccionData::getAllRecibo($_GET["var"]);
		if(count($datos)>0){
			$pdf->SetXY(120,33);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(15, 8, 'Uriangato Guanajuato., a '.$dia.' de '.$mes.' de '.$anio, 0,0, 'L');
			$pdf->SetXY(111,38);
			$oldvigencia1=$datos->vigencia1;
			$oldvigencia2=$datos->vigencia2;
			$nvigencia1=
			$pdf->Cell(15, 8, 'Licencia No. '.$datos->numero_licencia.' con vigencia '. date('d-m-Y', strtotime($oldvigencia1)).' a '. date('d-m-Y', strtotime($oldvigencia2)), 0,0, 'L');
			$pdf->Ln(20);
			$pdf->SetFont( 'Arial', 'B', 12 );
			$pdf->Cell(15, 8, utf8_decode('Desarrollo Urbano'),0,0,'L');
			$pdf->Ln(5);
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->Cell(15, 8, utf8_decode(' Arq. Abraham Martínez Castro'),0,0,'L');
			//Contenido con el texto justificado
			$pdf->Ln(10);
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode('Por medio del presente se le otorga al C. '));
			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->WriteFlowingBlock( utf8_decode($datos->nombre_solicitante));
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode(' con dirección '));
			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->WriteFlowingBlock( utf8_decode($datos->domicilio_solicitante));
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode(' en la ciudad de '));
			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->WriteFlowingBlock( utf8_decode($datos->ciudad_solicitante));
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode(' la "LICENCIA DE CONSTRUCCIÓN" con fundamento en el Artículo 115 V inciso f) de la Constitución Política de los Estados Unidos Mexicanos, Artículos 98 y 99 fracción I inciso a), 124 fracción X, 167 fracción VI de la Ley Orgánica Municipal para el Estado de Guanajuato y 35 Fracción I, VI, 36, II III IV 40, 41, 42, 43 y 46 del Código Territorial para el Estado de Guanajuato y sus Municipios. Nombrando como responsable de la obra a '));
			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->WriteFlowingBlock( utf8_decode($datos->nombre_suscriptor));
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode(' con direccion '));
			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->WriteFlowingBlock( utf8_decode($datos->domicilio_suscriptor));
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode(' con los siguientes datos de la obra:'));
			$pdf->finishFlowingBlock();
			$pdf->Ln(2);
			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->Cell(15, 8, utf8_decode('DATOS DE LA OBRA '),0,0,'L');
			$pdf->Ln(7);
			$pdf->newFlowingBlock( 80, 5, '', 'L' );
			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->WriteFlowingBlock( utf8_decode('- Cuenta Predial: '));
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode($datos->predial_obra));
			$pdf->finishFlowingBlock();
			$pdf->newFlowingBlock( 80, 5, '', 'L' );
			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->WriteFlowingBlock( utf8_decode('- Ubicacion de la Obra: '));
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode($datos->ubicacion_obra));
			$pdf->finishFlowingBlock();
			$pdf->newFlowingBlock( 180, 5, '', 'L' );
			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->WriteFlowingBlock( utf8_decode('- Destino de la Construcción: '));
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode($datos->destino_obra));
			$pdf->finishFlowingBlock();
			$pdf->newFlowingBlock( 80, 5, '', 'L' );
			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->WriteFlowingBlock( utf8_decode('- Superficie de la Construcción: '));
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode($datos->superficie_obra));
			$pdf->finishFlowingBlock();
			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->Cell(15, 5, utf8_decode('- Documentos Adjuntos:'),0,0,'L');
			$pdf->Ln(5);
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock(utf8_decode($datos->documentos_obra));
			$pdf->finishFlowingBlock();
			$pdf->SetFont( 'Arial', 'B', 10 );
			$pdf->Cell(15, 5, utf8_decode('- Observaciones:'),0,0,'L');
			$pdf->Ln(5);
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock(utf8_decode($datos->observaciones));
			$pdf->finishFlowingBlock();
			$pdf->Ln(5);
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock(utf8_decode('Cabe mencionar que se deberán cumplir los lineamientos que nos marca en el Reglamento de Construcción Municipal'));
			$pdf->finishFlowingBlock();
			$pdf->Ln(5);
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock(utf8_decode('- El material de contracción sobre la vía pública solo podrá permanecer 48 horas; si se requiere de mas tiempo, el ciudadano debera solicitar un permiso especial - Artículo 19.'));
			$pdf->finishFlowingBlock();
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock(utf8_decode('- Queda estrictamente prohibida la constrcción sobre la marquesina - Artículos 17 y 22.'));
			$pdf->finishFlowingBlock();
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock(utf8_decode('- Las demolicines que ocasionara la omisión anterior será por cuenta del solicitante - Artículos 208 y 210.'));
			$pdf->finishFlowingBlock();
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock(utf8_decode('- Responsabilidades - Artículos 218,219,220 y 221.'));
			$pdf->finishFlowingBlock();
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock(utf8_decode('- A efecto de inspección - Articulos 215, 216 y 217.'));
			$pdf->finishFlowingBlock();
 			$pdf->Ln(5);
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock(utf8_decode('Nota Importante: Este permiso quedara anulado si la propiedad no cumpliera con lo expuesto con lo anteriror o si ésta afectando a terceros.'));
			$pdf->finishFlowingBlock();
			$pdf->Ln(5);
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock(utf8_decode('Sin más por el momento me despido, no sin antes enviarle un cordial saludo de su mas atento y seguro servidor.'));
			$pdf->finishFlowingBlock();
			$pdf->SetXY(50,240);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(0,10,'Solicita',0,0,'L');
			$pdf->Line(25, 260 , 90, 260);
			$pdf->SetXY(32,260);
			$pdf->Cell(0,10,utf8_decode($datos->nombre_solicitante),0,0,'L');
			$pdf->SetXY(150,240);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(0,10,'Autoriza',0,0,'L');
			$pdf->Line(125, 260 , 190, 260);
			$pdf->SetXY(132,260);
			$pdf->Cell(0,10,utf8_decode('Arq. Abraham Martínez Castro'),0,0,'L');
			$pdf->SetXY(142,265);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(0,10,utf8_decode('Encargado de Despacho de Desarrollo Urbano'),0,0,'L');
			$filee="../storage/constrccion/$datos->numero_licencia.pdf";
			$pdf->Output($filee,'F');
			
			print "<script>window.location='../?view=construccion';</script>";
		}
		
	}
	//$pdf->Output();		
?>