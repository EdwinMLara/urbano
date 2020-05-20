<div class="row">
	<div class="col-md-12">
	<h1>Nueva Licencia de Construcción</h1>
	<br>
	<!-- action="index.php?view=addconstruccion"-->
	<form class="form-horizontal" method="post" enctype="multipart/form-data" id="addconstruccion" action="index.php?view=addconstruccion" role="form">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Datos de la licencia
					</div>
					<div class="panel-body">
						<div class="col-md-12 form-group">
							<?php
								$maxidd = ConstruccionData::maxid();
								if($maxidd==""){
									$astmaxid=0;
									$folionext = ((int)$astmaxid+1);
								}else{
									foreach ($maxidd as $astmaxid){
										$folionext = ((int)$astmaxid+1);
									}
								}
							?>
							<div class="col-md-6">
							<label class="control-label">No. Licencia</label>
							</div>
							<div class="col-md-6">
							<input type="text" name="no_licencia" size="10" class="form-control" value="<?php echo $folionext; ?>" readonly>
							</div>
						</div>
						<div class="col-md-12 form-group">
							<div class="col-md-6">
								<label class="control-label">No. Recibo</label>
							</div>
							<div class="col-md-6">
								<input id="no_recibo" type="text" name="numero_recibo" size="10" class="form-control" maxlength="4" required>
							</div>
						</div>
						<div class="col-md-12 form-group">
							<div class="col-md-6">
								<label class="control-label">Fecha Alta</label>
							</div>
							<div class="col-md-6">
								<input type="text" name="fecha_alta" value="<?php echo date('Y-m-d');?>" size="10" class="form-control" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Vijencia de la licencia
					</div>
					<div class="panel-body">
						<div class="col-md-12 form-group">
							<div class="col-md-3">
								<label class="control-label">Inicio</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="vigencia1" class="form-control" id="example1" required>
							</div>
						</div>
						<div class="col-md-12 form-group">
							<div class="col-md-3">
								<label class="control-label">Final</label>
							</div>
							<div class="col-md-9">
								<input type="text" name="vigencia2" class="form-control" id="example2" required>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Datos del solicitante propietario
					</div>
					<div class="panel-body">
						<div class="form-group label-floating">
							<div class="col-md-5">
								<label class="control-label">Nombre Completo</label>
							</div>
							<div class="col-md-7">
								<input type="text" name="nombre_solicitante" class="form-control" maxlength="100" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label class="control-label">Domicilio</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="domicilio_solicitante" class="form-control" maxlength="100" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label class="control-label">Ciudad</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="ciudad_solicitante" class="form-control" maxlength="50" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label class="control-label">Telefono</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="telefono_solicitante" class="form-control" maxlength="10" required>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Datos del responsable de la obra(Solicitante)
					</div>
					<div class="panel-body">
						<div class="form-group label-floating">
							<div class="col-md-5">
								<label class="control-label">Nombre Completo</label>
							</div>
							<div class="col-md-7">
								<input type="text" name="nombre_suscriptor" class="form-control" maxlength="100" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-4">
								<label class="control-label">Domicilio</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="domicilio_suscriptor" class="form-control" maxlength="100" required>
							</div>
						</div>
						<div class="form-group label-floating">
							<div class="col-md-5">
								<label class="control-label">Perito con registro numero</label>
							</div>
							<div class="col-md-7">
								<input type="text" name="numero_perito" id="numeropr" class="form-control" maxlength="15" required>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Datos de la obra
					</div>
					<div class="panel-body">
						<div class="col-md-6">
							<div class="form-group label-floating">
								<div class="col-md-5">
									<label for="inputEmail1" class="control-label">Cuenta Predial</label>
								</div>
								<div class="col-md-7">
									<input type="text" name="cta_catastral" class="form-control" maxlength="250" required>
								</div>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-4">
									<label for="inputEmail1" class="control-label">Ubicacion</label>
								</div>
								<div class="col-md-8">
									<input type="text" name="ubicacion_obra" class="form-control" maxlength="150" required>
								</div>
							</div>
							<div class="form-group label-floating">
								<label for="inputEmail1" class="control-label">Descripcion de la Construccion</label>
								<input type="text" name="destino_obra" class="form-control" maxlength="150" required>
							</div>
							<div class="form-group label-floating">
								<div class="col-md-6">
									<label for="inputEmail1" class="control-label">Superficie a Construir</label>
								</div>
								<div class="col-md-6">
									<input type="text" name="superficie_obra" class="form-control" maxlength="150" required>
								</div>
							</div>
							<div class="form-group label-floating">
								<label for="inputEmail1" class="control-label">Documentos Adjuntos</label>
								<input type="text" name="documentos_obra" class="form-control" maxlength="150" required>
							</div>
							<div class="form-group label-floating">
								<label for="inputEmail1" class="control-label">Observaciones</label>
								<input type="text" name="observaciones" class="form-control" maxlength="150">
							</div>
						</div>
						<div class="col-md-6">
							<center>
								<div class="form-group">
									<label for="inputEmail1" class="col-lg-2 control-label">Imagen</label>
									<br>
									<input type="file" name="image" id="image" placeholder="">
								</div>
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input id="photo" type="text" name="photo" hidden>		
		<input type="text" name="status" value="aceptado" hidden>
		<button type="submit" class="btn btn-primary">Guarda Nueva Licencia</button>
	</form>
	</div>
	 
	<div id="qrcode" style="display: none;"></div>
</div>
<script src="/urbano1.4/plugins/Qr/qrcode.min.js"></script>
<script>
	var qrcode = new QRCode("qrcode");

	function getBase64Image(img) {
        var canvas = img;
        var dataURL = canvas.toDataURL("image/png");
        return dataURL;

    }
    
    function tomar_imagen(){
        var div_aux = document.getElementById("qrcode");
        var nodes_div = div_aux.childNodes;
        console.log(nodes_div[0]);
        var img_data = getBase64Image(nodes_div[0]);
        var input_data_photo = document.getElementById("photo");
		input_data_photo.value = img_data; 
    } 

    function hash_datos(text){
        return $.ajax({
            type:'POST',
            url: "/urbano1.4/core/app/action/hash_data.php",
            dataType: "json",
            data:{data: text},
            async:false,
            success: function (response){
				console.log(response);
                if(response.status.localeCompare("Error") == 0){
                    alert("Error");
                }
            }
        });

    }   

    function makeCode () {      
        var elText = document.getElementById("no_recibo");
        
        if (!elText.value) {
            alert("Input a text");
            elText.focus();
            return;
        }
        var hash = hash_datos(elText.value);
        var datos = hash.responseJSON;
        console.log("Generador: ", datos);
        qrcode.makeCode(datos.hash);
    }
	 $("#no_recibo").
        on("blur", function () {
            makeCode();
            tomar_imagen();
        }).
        on("keydown", function (e) {
            if (e.keyCode == 13) {
                makeCode();
                tomar_imagen(); 
        }
    });
</script>