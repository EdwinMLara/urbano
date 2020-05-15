<?php $colonia = ColoniaData::getById($_GET["id"]);?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Colonia</h1>
	<br>
		<form class="form-horizontal" method="post" id="updatecolonia" action="index.php?view=updatecolonia" role="form">
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
				<div class="col-md-6">
					<input type="text" name="name" value="<?php echo $colonia->nombre;?>" class="form-control" id="name">
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<input type="hidden" name="colonia_id" value="<?php echo $colonia->id;?>">
					<button type="submit" class="btn btn-primary">Actualizar Colonia</button>
					<a href="./?view=colonias" class="btn btn-danger"> Cancelar</a>
				</div>
			</div>
		</form>
	</div>
</div>