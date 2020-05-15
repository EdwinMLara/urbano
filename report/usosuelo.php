<?php
	require('../fpdf/fpdf.php');
	/***********Clases para la estraccion de los datos*************/
	include "../core/autoload.php";
	include "../core/app/model/SueloData.php";
	include "../core/app/model/ColoniaData.php";
	include "../core/app/model/VialidadData.php";
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
	if(isset($_GET["num"])){
		$datos = SueloData::getAllRecibo($_GET["num"]);
		if(count($datos)>0){
			$pdf->SetXY(143,33);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(15, 8, 'Exp: Desarrollo Urbano', 0,0, 'L');
			$pdf->SetXY(143,38);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(15, 8, utf8_decode('Oficio N°.'.$datos->id), 0,0, 'L');
			$pdf->SetXY(143,43);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(15, 8, 'Asunto: Uso de Suelo', 0,0, 'L');
			$pdf->SetXY(108,48);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(15, 8, utf8_decode('<<2016. Año del Nuevo Sistema Judicial Penal>>'), 0,0, 'L');
			$pdf->Ln(10);
			//posicionamiento de los datos del solicitante
			$pdf->SetFont( 'Arial', 'B', 12 );
			$pdf->Cell(15, 8, utf8_decode($datos->nombre_solicitante),0,0,'L');
			$pdf->Ln(5);
			$idv=($datos->domicilio_solicitante);
			$datosvialidad=VialidadData::getById($idv);
			$pdf->Cell(15, 8, utf8_decode($datosvialidad->nombre.' No. '.$datos->numero),0,0,'L');
			$pdf->Ln(5);
			$idc=($datos->colonia);
			$datoscolonia=ColoniaData::getById($idc);
			$pdf->Cell(15, 8, utf8_decode($datoscolonia->nombre),0,0,'L');
			$pdf->Ln(5);
			$pdf->Cell(15, 8, utf8_decode('URIANGATO, GTO.'),0,0,'L');
			$pdf->Ln(5);
			//posicionamiento de la fecha
			$pdf->SetXY(108,83);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(15, 8, 'Uriangato Guanajuato., a '.$dia.' de '.$mes.' de '.$anio, 0,0, 'L');
			//Cuerpo del contenido
			$pdf->Ln(10);
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode('El que suscribe el Arq. Arq. Abraham Martínez Castro, Encargado de Despacho de Desarrollo Urbano.'));
			$pdf->finishFlowingBlock();
			$pdf->Ln(5);
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode('					Con relación a su solicitud de fecha '));
			$fechasol=$datos->fecha_sol;
			list($años,$mess,$dias)= explode("-",$fechasol);;
			if($mess == '01'){$mess='Enero';}
			elseif($mess == '02'){$mess='Febrero';}
			elseif($mess == '03'){$mess='Marzo';}
			elseif($mess == '04'){$mess='Abril';}
			elseif($mess == '05'){$mess='Mayo';}
			elseif($mess == '06'){$mess='Junio';}
			elseif($mess == '07'){$mess='Julio';}
			elseif($mess == '08'){$mess='Agosto';}
			elseif($mess == '09'){$mess='Septiembre';}
			elseif($mess == '10'){$mess='Octubre';}
			elseif($mess == '11'){$mess='Noviembre';}
			else{$mess=='Diciembre';}	
			$pdf->WriteFlowingBlock( utf8_decode($dias.' de '.$mess.' del presente, en el cual requiere de permiso de USO DE SUELO de su predio o solar ejidal identificado en calle '));
			$idvp=($datos->domicilio_predio);
			$datosvialidadp=VialidadData::getById($idvp);
			$pdf->WriteFlowingBlock(utf8_decode($datosvialidadp->nombre.' '));
			if($datos->numero_predio!=NULL){
				$pdf->WriteFlowingBlock(utf8_decode($datos->numero_predio.' '));
			}else{
				$pdf->WriteFlowingBlock(utf8_decode('sin numero '));
			}
			$pdf->WriteFlowingBlock(utf8_decode('de la col. '));
			$idvc=($datos->domicilio_predio);
			$datosvialidadc=ColoniaData::getById($idvc);
			$pdf->WriteFlowingBlock(utf8_decode($datosvialidadc->nombre.' y ahora en el domicilio antes citado.'));
			$pdf->finishFlowingBlock();
			$pdf->Ln(5);
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', '', 10 );
			$pdf->WriteFlowingBlock( utf8_decode('					Con fundamento al Artículo 115 V de la Constitución Política de los Estados Unidos Mexicanos, Artículos 98 y 99 fracción I inciso a), 124 fracción X, 167 fracción VI de la Ley Orgánica Municipal para el Estado de Guanajuato y 35, 36 40, 41, 42, 43 y 46 del Código Territorial para el Estado de Guanajuato y sus Municipios. Al respecto le comento que de acuerdo al Plan Director de Desarrollo Urbano de la zona conurbada Uriangato vigente en nuestra ciudad, establece que la ubicación en cuestión esta destinada como USO DE SUELO HABITACIONAL.'));
			$pdf->finishFlowingBlock();
			$pdf->Ln(5);
			$pdf->newFlowingBlock( 190, 5, '', 'L' );	
			$pdf->SetFont( 'Arial', 'I', 10 );
			$pdf->WriteFlowingBlock( utf8_decode('					En cumplimiento con lo establecido en el Artículo 6 párrafo segundo, fracción II y artículo 16 párrafo segundo de la constitución política de los Estados Unidos Mexicanos; Artículo 16 fracción III, Articulo 20 fracción I,II,III, V y Articulo 21 de la ley de Transparencia y Acceso a la información pública para el Estado y los municipios de Guanajuato; Artículos 5,6,8 y 9 de la Ley de protección de Datos Personales para el Estado y los Municipios de Guanajuato, se hace del conocimiento al titular de dicha información, que los datos personales solicitados y contenidos en dicho formato y base de datos serán tratados por la DIRECCIÓN DE DESARROLLO URBANO  DE URIANGATO GUANAJUATO ubicado en calle Morelos No.1 solo para el ejercicio de sus funciones, con la principal finalidad de resguardar de acuerdo a las leyes antes mencionadas la información confidencial que se genere, así mismo se le informa que sus datos personales no podrán ser difundidos, salvo consentimiento expreso de parte del titular de los mismos.'));
			$pdf->finishFlowingBlock();
			$pdf->Ln(5);
			$pdf->newFlowingBlock( 190, 5, '', 'C' );	
			$pdf->SetFont( 'Arial', 'I', 10 );
			$pdf->WriteFlowingBlock( utf8_decode('Sin más por el momento me despido de Usted, no sin antes enviando un cordial saludo.'));
			$pdf->finishFlowingBlock();
			$pdf->SetY(230);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(0,10,'Atentamente',0,0,'C');
			$pdf->Ln(5);
			$pdf->Cell(0,10,'"Uriangato, El alma de Guanajuato"',0,0,'C');
			$pdf->Line(65, 260 , 145, 260);
			$pdf->SetY(260);
			$pdf->Cell(0,10,utf8_decode('Arq. Abraham Martínez Castro'),0,0,'C');
			$pdf->SetY(265);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(0,10,utf8_decode('Encargado de Despacho de Desarrollo Urbano'),0,0,'C');
			$filee="../storage/usosuelo/$datos->id.pdf";
			$pdf->Output($filee,'F');
			print "<script>window.location='../?view=suelo';</script>";
		}
	}
?>