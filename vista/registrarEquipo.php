<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Astrid Tovar">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PROYECTO_RECURSOS_IMGS ?>favcir.ico">
  <title>Registrar Equipo</title>
  <link href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap.min.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap-extension.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>animate.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>style.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>colors/blue.css" id="theme" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>style-apoyos-devices.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
  <div class="preloader">
    <div class="cssload-speeding-wheel"></div>
  </div>
  <div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top m-b-0">
      <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
        <div class="top-left-part"><a class="logo" href="<?= INDEX['url'] ?>"><b><img src="<?= PROYECTO_RECURSOS_IMGS ?>logo_tigo.png" alt="TIGO" class="logo"/></b><span class="hidden-xs"></span></a></div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
          <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="fa fa-bars"></i></a></li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
          <li class="title">Sistema de Gestión de Apoyos y Precios</li>
        </ul>
      </div>
      <div class="navbar-header-fr"></div>
    </nav>

    <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
          <li class="nav-small-cap m-t-10">--- Menú</li>

          <li><a href="<?= REGISTRAR_EQUIPO['url'] ?>" class="waves-effect active"><i class="fa fa-plus-circle"></i> <span class="hide-menu">  Registrar Equipo</span></a></li>

          <li><a href="<?= CARGAR_ARCHIVO['url'] ?>" class="waves-effect"><i class="fa fa-upload"></i> <span class="hide-menu"> Cargar Equipos</span></a></li>

          <li><a href="<?= CONSULTAR_EQUIPOS['url'] ?>" class="waves-effect"><i class="fa fa-tasks"></i> <span class="hide-menu"> Registrar Campaña</span></a></li>

          <li><a href="<?= INDEX_APROBAR_CAMPANA['url'] ?>" class="waves-effect"><i class="fa fa-thumbs-up"></i> <span class="hide-menu"> Aprobar Campaña</span></a></li>

          <li><a href="<?= RESUMEN_CAMPANA['url'] ?>" class="waves-effect"><i class="fa fa-search"></i> <span class="hide-menu"> Consultar Campañas</span></a></li>

          <li><a href="<?= GENERAR_REPORTE_INDEX['url'] ?>" class="waves-effect"><i class="fa fa-chart-line"></i> <span class="hide-menu"> Generar Reportes</span></a></li>

          <li><a href="<?= TOTAL_APOYOS_CAMPANAS['url'] ?>" class="waves-effect"><i class="fa fa-hand-holding-usd"></i> <span class="hide-menu"> Liquidar Apoyos</span></a></li>

          <li class="help-menu"><a href="<?= MANUAL_DE_USUARIO_GAP ?>" target="_blank" class="waves-effect"><i class="fa fa-question-circle"></i> <span class="hide-menu"> Obtener Ayuda</span></a></li>

          <li class="help-menu"><a href="<?= MANUAL_DE_USUARIO_GAP ?>" target="_blank" class="waves-effect"><i class="fa fa-question-circle"></i> <span class="hide-menu"> Obtener Ayuda</span></a></li>
        </ul>
      </div>
    </div>

    <div id="page-wrapper">

      <?php
      if (isset($_GET["r"])) {
        $respuesta = $_GET["r"];
        if ($respuesta == "1") {
          echo '
          <br>
          <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Bien hecho!</strong> Se registro correctamente.
          </div>';
        } else if ($respuesta == "2") {
          echo '
          <br>
          <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Lo sentimos!</strong> No fue posible registrar.
          </div>';
        } else if ($respuesta == "3") {
          echo '
          <br>
          <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          El PLU ingresado ya se encontraba registrado, por lo que hemos actualizado el costo del equipo.
          </div>';
        } 
      }
      ?>

      <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Registrar Equipo</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="#">Menú</a></li>
              <li class="active">Registrar Equipo</li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="white-box">
              <fieldset>
                <legend>Formulario de registro</legend>
                <p class="blockquote-reverse">Los campos marcados con <span><em id="requerido">* </em></span> son requeridos.</p>
                <br>
                <form action="<?= GUARDAR_EQUIPO['url'] ?>" method="POST" class="form-horizontal col-lg-12 col-sm-12 col-md-12 col-xs-12" role="form" id="form-registrar">
                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <label for="sma_plu" class="col-lg-3 col-sm-3 col-md-3 col-xs-3 control-label" title="PLU">PLU:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-7 col-sm-12 col-md-12 col-xs-7">
                      <input type="number" id="sma_plu" name="sma_plu" class="form-control" required placeholder="3001010">
                    </div>
                    <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1 help">
                      <img src="<?= PROYECTO_RECURSOS_IMGS ?>help-black.png" width="22px" data-toggle="tooltip" data-placement="top" title="Debe contener 7 numeros">
                    </div>
                  </div>
                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <label for="sma_referencia" class="col-lg-3 col-sm-3 col-md-3 col-xs-3 control-label" title="Referencia">Referencia:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-7 col-sm-12 col-md-12 col-xs-7">
                      <input type="text" id="sma_referencia" name="sma_referencia" class="form-control" required placeholder="Smathphone X Plus">
                    </div>
                  </div>
                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <label for="sma_marca" class="col-lg-3 col-sm-3 col-md-3 col-xs-3 control-label" title="Marca">Marca:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-7 col-sm-12 col-md-12 col-xs-7">
                      <select id="select-marca"  name="sma_marca" class="form-control" required>
                        <option value="">Selecciona una opción</option>
                        <?php foreach ($listaMarcas as $consulta) { ?>
                        <option value="<?php echo $consulta->marca;?>"><?php echo $consulta->marca;?></option>
                        <?php }?>
                        <option value="OTRA">OTRA</option>
                      </select>
                    </div>
                  </div>
                  <div id="otra-marca" class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12 hidden">
                    <label for="sma_marca" class="col-lg-3 col-sm-3 col-md-3 col-xs-3 control-label" title="Costo Equipo">Cuál:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-7 col-sm-12 col-md-12 col-xs-7">
                      <input type="text" id="sma_marca" name="sma_marca" class="form-control" required>
                    </div>
                    <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1 help">
                      <img src="<?= PROYECTO_RECURSOS_IMGS ?>help-black.png" width="22px" data-toggle="tooltip" data-placement="top" title="Ingrese el nombre de la marca.">
                    </div>
                  </div>
                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <label for="sma_costo" class="col-lg-3 col-sm-3 col-md-3 col-xs-3 control-label" title="Costo Equipo">Costo Equipo:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-7 col-sm-12 col-md-12 col-xs-7">
                      <input type="text" id="sma_costo" name="sma_costo" class="form-control" required placeholder="100000">
                    </div>
                    <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1 help">
                      <img src="<?= PROYECTO_RECURSOS_IMGS ?>help-black.png" width="22px" data-toggle="tooltip" data-placement="top" title="Ingrese el costo en pesos ($), SIN signos de puntuación">
                    </div>
                  </div>
                  <center>
                    <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                      <button class="btn btn-secondary" type="reset" title="Cancelar">Cancelar</button>
                      <button id="btnGuardar" class="btn btn-principal" type="submit" title="Guardar">Guardar</button>
                    </div>
                  </center>
                </form>
              </fieldset>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer text-center"> Copyright &copy; 2019 Stridcam. Todos los derechos reservados. </footer>

    </div>

  </div>

  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery/dist/jquery.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.validate.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>tether.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>bootstrap.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-extension/js/bootstrap-extension.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>sidebar-nav/dist/sidebar-nav.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.slimscroll.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>waves.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>custom.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>jasny-bootstrap.js"></script>
  <script>
  $('select').change(function (e) {
    console.log("Dentro de select")
    if ($('select option:selected').val() == 'OTRA') {
      $('#otra-marca').removeClass('hidden');
      console.log(1)
    }else{
      $('#otra-marca').addClass('hidden');
      $('#sma_marca').attr("value", $('select option:selected').val());
    };
  });

  $(function(){
    $('#form-registrar').validate({
      rules: {
        sma_plu:{
          required: true,
          minlength: 7,
          maxlength: 7,
          number: true
        },
        sma_referencia:{
          required: true,
        },
        sma_marca:{
          required: true
        },
        sma_costo:{
          required: true,
          number: true,
          minlength: 3
        }
      },
      messages: {
        sma_plu: {
          required: "Por favor ingresa un PLU.",
          minlength: "El PLU debe contener 7 caracteres.",
          maxlength: "El PLU debe contener 7 caracteres." 
        },
        sma_referencia: {
          required: "Por favor ingresa la referencia."
        },
        sma_marca:{
          required: "Por favor selecciona una marca."
        },
        sma_costo:{
          required: "Por favor ingrese el costo del equipo en pesos ($).",
          minlength: "Por favor ingrese el costo del equipo en pesos ($)."
        }
      }
    })
  });
</script>
<script src="<?= PROYECTO_RECURSOS_PLUGINS ?>styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>