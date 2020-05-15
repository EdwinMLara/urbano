
<?php $vialidad = VialidadData::getById($_GET["id"]);?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Vialidad</h1>
	<br>
		<form class="form-horizontal" method="post" id="updatevialidad" action="index.php?view=updatevialidad" role="form">
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
				<div class="col-md-6">
					<input type="text" name="name" value="<?php echo $vialidad->nombre;?>" class="form-control" id="name">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<input type="hidden" name="colonia_id" value="<?php echo $vialidad->id;?>">
					<button type="submit" class="btn btn-primary">Actualizar Vialidad</button>
					<a href="./?view=vialidades" class="btn btn-danger"> Cancelar</a>
				</div>
			</div>
		</form>
	</div>
</div>