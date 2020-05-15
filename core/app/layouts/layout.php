<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Desarrollo Urbano</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<!-- Bootstrap 3.3.4 -->
		<link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- Font Awesome Icons -->
		<link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- Datepicker -->
		<link href="plugins/datepicker/datepicker.css" rel="stylesheet" />
		
		<!-- Theme style -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<link href="plugins/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
		<link href="plugins/dist/css/skins/skin-green.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
	
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="plugins/jquery/jquery-2.1.4.min.js"></script>
		<script src="plugins/jspdf/jspdf.min.js"></script>
		<script src="plugins/jspdf/jspdf.plugin.autotable.js"></script>
		<link href="plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			$(window).load(function () {
			// Una vez se cargue al completo la página desaparecerá el div "cargando"
				$('#cargando').hide();
				
			});
		</script>
	</head>
	
	<body class="<?php if(isset($_SESSION["user_id"])):?> hold-transition skin-green sidebar-mini <?php else:?>login-page<?php endif; ?>" >
		<div class="wrapper">
		<!-- Main Header -->
			<?php if(isset($_SESSION["user_id"])):?>
			<header class="main-header">
			<!-- Logo -->
			<a href="./" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>D</b>U</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg">Desarrollo Urbano</span>
			</a>
			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account Menu -->
						<li class="dropdown user user-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
								<span class="">
									<?php if(isset($_SESSION["user_id"]) ){
										UserData::getById($_SESSION["user_id"])->name;
									}?> <b class="caret"></b>
								</span>
							</a>
							<ul class="dropdown-menu">
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-right">
										<a href="./logout.php" class="btn btn-default btn-flat">Salir</a>
									</div>
								</li>
							</ul>
						</li>
						<!-- Control Sidebar Toggle Button -->
					</ul>
				</div>
			</nav>
			</header>
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- Sidebar user panel -->
					<div class="user-panel">
						<div class="pull-left image">
							<img src="plugins/dist/img/avatar5.png" class="img-circle" alt="User Image">
						</div>
						<div class="pull-left info">
							<p>
								<?php
									if(isset($_SESSION["user_id"]) ){
										echo UserData::getById($_SESSION["user_id"])->name; 
									}
								?>
							</p>
							<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						</div>
					</div>
					<!-- search form -->
				<!-- Sidebar Menu -->
				<ul class="sidebar-menu">
					<li class="header">ADMINISTRACION</li>
					<?php if(isset($_SESSION["user_id"])):?>
                    <li><a href="./index.php?view=home"><i class='fa fa-home'></i> <span>Inicio</span></a></li>
					<li><a href="./?view=construccion"><i class='fa fa-building-o'></i> <span>Licencias de Construcción</span></a></li>
					<li><a href="./?view=numeracion"><i class='fa fa-map-marker'></i> <span>Alineamiento y Numero Oficial</span></a></li>
					<li><a href="./?view=suelo"><i class="glyphicon glyphicon-list-alt"></i> <span>Uso de Suelo</span></a></li>
					<li class="treeview">
						<a href="#"><i class='fa fa-database'></i> <span>BD Old</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="./?view=oldnumeracion">Base de Datos Numeración</a></li>
							<li><a href="./?view=oldconstruccion">Base de Datos Construcción</a></li>
						</ul>
					</li>
					<li><a href="./?view=predioscatas"><i class="fa fa-book"></i> <span>Predios de Catastro</span></a></li>
					<li class="treeview">
						<a href="#"><i class='fa fa-newspaper-o'></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="./?view=repconstruccion">Reporte de Construcción</a></li>
							<li><a href="./?view=repnumeracion">Reporte de Numeor Oficial</a></li>
							<li><a href="./?view=repsuelo">Reporte de Uso de Suelo</a></li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#"><i class='fa fa-cog'></i> <span>Administracion</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li><a href="./?view=users">Usuarios</a></li>
							<li><a href="./?view=colonias">Colonias</a></li>
							<li><a href="./?view=vialidades">Vialidades</a></li>
						</ul>
					</li>
					<?php endif;?>
				</ul><!-- /.sidebar-menu -->
			</section>
			<!-- /.sidebar -->
			</aside>
			<?php endif;?>
			<!-- Content Wrapper. Contains page content -->
			<?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>
				<div class="content-wrapper">
					<div class="content">
						<?php View::load("index");?>
					</div>
				</div><!-- /.content-wrapper -->
				<footer class="main-footer">
					<div class="pull-right hidden-xs">
						<b>Administracion</b> 2015 - 2018
					</div>
					<strong>Desarrollo Urbano</strong>
				</footer>
			<?php else:?>
			<div class="login-box">
				<div class="login-logo">
					<a href="./">INICIO DE SESIÓN</a>
				</div><!-- /.login-logo -->
				<div class="login-box-body">
					<form action="./?action=processlogin" method="post">
						<div class="form-group has-feedback">
							<input type="text" name="username" required class="form-control" placeholder="Usuario"/>
							<span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback">
							<input type="password" name="password" required class="form-control" placeholder="Password"/>
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
							</div><!-- /.col -->
						</div>
					</form>
				</div><!-- /.login-box-body -->
			</div><!-- /.login-box -->  
			<?php endif;?>
		</div><!-- ./wrapper -->
		<!-- REQUIRED JS SCRIPTS -->
		<!-- jQuery 2.1.4 -->
		<!-- Bootstrap 3.3.2 JS -->
		<script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- AdminLTE App -->
		<script src="plugins/dist/js/app.min.js" type="text/javascript"></script>
		<!-- Datapicker -->
		<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
		<script type="text/javascript">
			// When the document is ready Datepicker
			$(document).ready(function () {
				$('#example1').datepicker({
					format: "yyyy-mm-dd"
				});
				$('#example2').datepicker({
					format: "yyyy-mm-dd"
				});
			});
		</script>
		
		<script src="plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".datatable").DataTable({
					"language": {
						"sProcessing":    "Procesando...",
						"sLengthMenu":    "Mostrar _MENU_ registros",
						"sZeroRecords":   "No se encontraron resultados",
						"sEmptyTable":    "Ningún dato disponible en esta tabla",
						"sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
						"sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
						"sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
						"sInfoPostFix":   "",
						"sSearch":        "Buscar:",
						"sUrl":           "",
						"sInfoThousands":  ",",
						"sLoadingRecords": "Cargando...",
						"oPaginate": {
							"sFirst":    "Primero",
							"sLast":    "Último",
							"sNext":    "Siguiente",
							"sPrevious": "Anterior"
						},
						"oAria": {
							"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
							"sSortDescending": ": Activar para ordenar la columna de manera descendente"
						}
					}
				});
			});
		</script>
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
		<script src="plugins/select2/js/select2.min.js"></script>
		<script>
			$('select').select2();
		</script>
	</body>
</html>

