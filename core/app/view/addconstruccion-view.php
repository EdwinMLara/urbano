<center>
	<div id='cargando'>
		<img src='plugins/imagenes/2.gif'>
	</div>
</center>
<?php
	if(count($_POST)>0){
		$no_recibo=$_POST["numero_recibo"];
		$doc=$no_recibo.'.pdf';
		$licence = new ConstruccionData();
		
		$licence->numero_recibo = $_POST["numero_recibo"];
		$licence->vigencia1 = $_POST["vigencia1"];
		$licence->vigencia2 = $_POST["vigencia2"];
		$licence->nombre_solicitante = $_POST["nombre_solicitante"];
		$licence->domicilio_solicitante = $_POST["domicilio_solicitante"];
		$licence->ciudad_solicitante = $_POST["ciudad_solicitante"];
		$licence->telefono_solicitante = $_POST["telefono_solicitante"];
		$licence->predial_obra = $_POST["cta_catastral"];
		$licence->ubicacion_obra = $_POST["ubicacion_obra"];
		$licence->destino_obra = $_POST["destino_obra"];
		$licence->superficie_obra = $_POST["superficie_obra"];
		$licence->documentos_obra = $_POST["documentos_obra"];
		$licence->fecha = $_POST["fecha_alta"];
		$licence->status = $_POST["status"];
		$licence->nombre_suscriptor= $_POST["nombre_suscriptor"];
		$licence->numero_perito = $_POST["numero_perito"];
		$licence->domicilio_suscriptor = $_POST["domicilio_suscriptor"];
		$licence->observaciones = $_POST["observaciones"];
		$licence->pdf=$doc;
		
		if(isset($_FILES["image"])){
			$image = new Upload($_FILES["image"]);
			if($image->uploaded){
				$image->Process("storage/constrccion/");
				if($image->processed){
					$licence->image = $image->file_dst_name;
					$prod = $licence->add_with_image();
				}
			}else{
				$prod= $licence->add();
			}
		}else{
			$prod= $licence->add();	
		}
		Core::redir("report/construccion.php?var=$no_recibo");
	}
?>