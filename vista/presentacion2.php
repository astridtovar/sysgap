<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Astrid Tovar">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= PROYECTO_RECURSOS_IMGS ?>favcir.ico">
	<title>Sistema de Gestión de Apoyos y Precios</title>
	<link href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap.min.css" rel="stylesheet">
	<link href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap-extension.css" rel="stylesheet">
	<link href="<?= PROYECTO_RECURSOS_CSS ?>colors/blue.css" id="theme" rel="stylesheet">
	<link href="<?= PROYECTO_RECURSOS_CSS ?>style-presentacion.css" rel="stylesheet">
</head>
<body>

	<div class="ayuda">
		<a href="<?= MANUAL_DE_USUARIO_GAP ?>" target="_blank" title="Manual de Usuario">
			<img class="img-help" src="<?= PROYECTO_RECURSOS_IMGS ?>help.png" alt="Manual de Usuario">
		</a>
	</div>

	<div class="container">

		<div class="cont-logo">
			<img class="img-logo" src="<?= PROYECTO_RECURSOS_IMGS ?>tigo.gif" width="228px">
		</div>

		<div class="contenido">
			<div class="titulos">
				<h1 class="titulo-prin">SISTEMA DE GESTIÓN DE APOYOS Y PRECIOS</h1>
				<br>
				<h4 class="sub-titulo">Gerencia de Equipos y Financiación</h4>
			</div>

			<center>
				<div class="buttons">
					<a href="<?= CARGAR_ARCHIVO['url'] ?>">
						<button class="btn btn-menu"><span>Cargar Equipos</span></button>
					</a> 
					<a href="<?= CONSULTAR_EQUIPOS['url'] ?>">
						<button class="btn btn-menu"><span>Registrar Campaña</span></button>
					</a>
					<a href="<?= INDEX_APROBAR_CAMPANA['url'] ?>">
						<button class="btn btn-menu"><span>Aprobar Campaña</span></button>
					</a>
					<a href="<?= RESUMEN_CAMPANA['url'] ?>">
						<button class="btn btn-menu"><span>Consultar Campaña</span></button>
					</a> 
					<a href="<?= GENERAR_REPORTE_INDEX['url'] ?>">
						<button class="btn btn-menu"><span>Generar Reportes</span></button>
					</a> 
					<a href="<?= TOTAL_APOYOS_CAMPANAS['url'] ?>">
						<button class="btn btn-menu"><span>Liquidar Apoyos</span></button>
					</a>
				</div>
			</center>
		</div>	
	</div>

	<footer> Copyright &copy; 2019 Stridcam. Todos los derechos reservados.</footer>

</body>
</html>