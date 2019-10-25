<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Astrid Tovar">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PROYECTO_RECURSOS_IMGS ?>favcir.ico">
  <title>Registrar Campaña</title>
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
        <div class="top-left-part"><a class="logo" href="<?= INDEX['url'] ?>"><b><img src="<?= PROYECTO_RECURSOS_IMGS ?>logo_tigo.png" alt="" class="logo"/></b><span class="hidden-xs"></span></a></div>
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

          <li> <a href="<?= REGISTRAR_EQUIPO['url'] ?>" class="waves-effect"><i class="fa fa-plus-circle"></i> <span class="hide-menu"> Registrar Equipo</span></a></li>

          <li> <a href="<?= CARGAR_ARCHIVO['url'] ?>" class="waves-effect"><i class="fa fa-upload"></i> <span class="hide-menu"> Cargar Equipos</span></a></li>

          <li> <a href="<?= CONSULTAR_EQUIPOS['url'] ?>" class="waves-effect active"><i class="fa fa-tasks"></i> <span class="hide-menu"> Registrar Campaña</span></a></li>

          <li> <a href="<?= INDEX_APROBAR_CAMPANA['url'] ?>" class="waves-effect"><i class="fa fa-thumbs-up"></i> <span class="hide-menu"> Aprobar Campaña</span></a></li>

          <li> <a href="<?= RESUMEN_CAMPANA['url'] ?>" class="waves-effect"><i class="fa fa-search"></i> <span class="hide-menu"> Consultar Campañas</span></a></li>

          <li> <a href="<?= GENERAR_REPORTE_INDEX['url'] ?>" class="waves-effect"><i class="fa fa-chart-line"></i> <span class="hide-menu"> Generar Reportes</span></a></li>

          <li> <a href="<?= TOTAL_APOYOS_CAMPANAS['url'] ?>" class="waves-effect"><i class="fa fa-hand-holding-usd"></i> <span class="hide-menu"> Liquidar Apoyos</span></a></li>

          <li class="help-menu"> <a href="<?= MANUAL_DE_USUARIO_GAP ?>" target="_blank" class="waves-effect"><i class="fa fa-question-circle"></i> <span class="hide-menu"> Obtener Ayuda</span></a></li>
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
        } 
      }
      ?>

      <div class="container-fluid">

        <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Registrar Campaña</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="#">Menú</a></li>
              <li><a href="<?= CONSULTAR_EQUIPOS['url'] ?>">Registrar campaña</a></li>
              <li class="active">Formulario registro</li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="white-box">
              <p class="blockquote-reverse">Los campos marcados con <span><em id="requerido">*</em></span> son requeridos.</p> <br>
              <form action="<?= CALCULAR_CAMPANA['url'] ?>" method="POST" class="form-horizontal" role="form" id="form-registrar-cam">
                <?php foreach ($check as $id) { ?>
                <input type="hidden" name="array_id_cam[]" value="<?php echo $id; ?>">
                <?php } ?>

                <div id="tarifas" class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 form">
                    <label for="cam_costo_logistico" class="control-label tarifa" title="Costo Logistico">Costo Logístico: <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <input type="number" id="cam_costo_log" name="cam_costo_logistico" class="form-control" value="8000" required>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 form">
                    <label for="cam_iva" class="control-label" title="IVA">IVA<em class="porcentaje"> (%)</em>: <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <input type="number" id="cam_iva" name="cam_iva" class="form-control" value="19" required>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 form">
                    <label for="cam_trm" class="control-label" title="TRM">TRM: <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <input type="number" id="cam_trm" name="cam_trm" class="form-control" value="3300" required>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 form">
                    <label for="cam_uvt" class="control-label" title="UVT">UVT: <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <input type="number" id="cam_uvt" name="cam_uvt" class="form-control" value="34270" required>
                  </div>
                </div>

                <fieldset class="form-next">
                  <legend>Formulario de registro</legend> 
                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 form">
                      <label for="cam_fecha_inicio" class="control-label" title="Fecha Inicio">Fecha inicio: <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                      <input type="date" id="fecha_i" name="cam_fecha_inicio" class="form-control" required>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 form">
                      <label for="cam_fecha_fin" class="control-label" title="Fecha Fin">Fecha fin: <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                      <input type="date" id="fecha_f" name="cam_fecha_fin" class="form-control" required>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 form">
                      <label for="cam_descripcion" class="control-label" title="Campaña">Campaña: <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                      <select name="cam_descripcion" id="cam_descripcion" class="form-control" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Precio Especial">Precio Especial</option>
                        <option value="Precio Tiendas">Precio Tiendas</option>
                        <option value="Promoción 2x1">Promoción 2x1</option>
                        <option value="Kit Prepago">Kit Prepago</option>
                        <option value="Pospago Retail">Pospago Retail</option>
                        <option value="Nuevo Equipo">Nuevos Equipos</option>
                        <option value="Evacuación Inventario">Evacuación Inventario</option>
                      </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 form">
                      <label for="cam_canal" class="control-label" title="Canal">Canal: <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                      <select name="cam_canal" id="cam_canal" class="form-control" required>
                        <option value="">Seleccione una opción</option>
                        <option value="TIENDA PROPIA">Tiendas</option>
                        <option value="RETAIL">Retail</option>
                        <option value="Dealers">Dealers</option>
                        <option value="B2B">B2B</option>
                        <option value="Ecommerce">Ecommerce</option>
                      </select>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 form">
                      <label for="cam_producto" class="control-label" title="Producto">Producto: <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                      <select id="cam_producto" name="cam_producto" class="form-control" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Pre/Pos">Prepago/Pospago</option>
                        <option value="Prepago">Prepago</option>
                        <option value="Pospago">Pospago</option>
                      </select>
                    </div>
                    <div id="Promo2x1" class="col-xs-12 col-sm-6 col-md-6 col-lg-4 form hidden">
                      <label for="cam_plu_hijo" class="control-label" title="PLU Hijo">PLU Regalo: </label>
                      <div class="col-lg-11 col-sm-11 col-md-10 col-xs-11">
                        <input type="number" name="cam_plu_hijo" class="form-control">
                      </div>
                      <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1 help">
                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>help-black.png" width="20px" data-toggle="tooltip" data-placement="top" title="Ingrese el PLU del hijo de la promo.">
                      </div>
                    </div>
                    <div id="Promo" class="col-xs-12 col-sm-6 col-md-6 col-lg-4 form">
                      <label for="cam_kit_pre" class="control-label" title="Kit Prepago/Regalo">Kit Prepago / Regalo: </label>
                      <div class="col-lg-11 col-sm-11 col-md-10 col-xs-11">
                        <input type="number" name="cam_kit_pre" class="form-control">
                      </div>
                      <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1 help">
                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>help-black.png" width="20px" data-toggle="tooltip" data-placement="top" title="Llene este espacio si el equipo incluye una promoción o regalo.">
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 form-next">
                      <label for="cam_precio" class="control-label" title="Precio de venta">Precio de venta: <span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                      <div class="col-lg-11 col-sm-11 col-md-10 col-xs-10">
                        <input type="number" name="cam_precio" class="form-control" required>
                      </div>
                      <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1 help">
                        <img src="<?= PROYECTO_RECURSOS_IMGS ?>help-black.png" width="20px" data-toggle="tooltip" data-placement="top" title="Ingrese el costo en pesos ($), SIN signos de puntuación">
                      </div>
                    </div>
                  </div> 
                  <center>
                    <div class="form-group">
                      <a href="<?= CONSULTAR_EQUIPOS['url'] ?>"><button class="btn btn-secondary" type="button" title="Cancelar">Cancelar</button></a>
                      <button id="btn-calcular" type="submit" class="btn btn-principal" title="Calcular">Calcular</button>
                    </div>
                  </center>
                </fieldset>
              </form>
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
  /*$(document).ready(function (e){
    var url = "https://www.trmhoy.co/";
    $.get(url, function(data){
        console.log('Web: ' + data);
    });
  });*/

  $('select').change(function (e) {
    if ($('select option:selected').val() == 'Promoción 2x1') {
      $('#Promo2x1').removeClass('hidden');
      $('#Promo').addClass('hidden');
    }else{
      $('#Promo2x1').addClass('hidden');
      $('#Promo').removeClass('hidden');
    };
  });

  var form = $('#form-registrar-cam');
  $(function(){
    form.validate({
      rules: {
        cam_costo_logistico: {
          required: true,
          number: true
        },
        cam_iva: {
          required: true,
          number: true,
          minlength: 1,
          maxlength: 3
        },
        cam_trm: {
          required: true,
          number: true 
        },
        cam_uvt:{
          required: true,
          number: true 
        },
        cam_fecha_inicio: {
          required: true
        },
        cam_fecha_fin: {
          required: true
        },
        cam_descripcion: {
          required: true
        },
        cam_canal:{
          required: true
        },
        cam_producto:{
          required: true
        },
        cam_precio: {
          required: true,
          number: true
        }
      },
      messages: {
        cam_costo_logistico: {
          required: "Por favor ingrese el costo logistico",
          number: "Por favor ingrese el valor en pesos ($)"
        },
        cam_iva: {
          required: "Por favor ingrese porcentaje del IVA vigente",
          number: "Por favor ingrese el valor en porcentaje (%)",
          minlength: "Por favor ingrese el valor en porcentaje (%)",
          maxlength: "Por favor ingrese el valor en porcentaje (%)"
        },
        cam_trm: {
          required: "Por favor ingrese la TRM vigente",
          number: "Por favor ingrese el valor en pesos ($)" 
        },
        cam_uvt:{
          required: "Por favor ingrese la UVT vigente",
          number: "Por favor ingrese el valor en pesos ($)"
        },
        cam_fecha_inicio: {
          required: "Por favor seleccione la fecha de inicio"
        },
        cam_fecha_fin: {
          required: "Por favor seleccione la fecha de fin"
        },
        cam_descripcion: {
          required: "Por favor seleccione una campaña"
        },
        cam_canal:{
          required: "Por favor seleccione un canal"
        },
        cam_producto: {
          required: "Por favor seleccione un producto"
        },
        cam_precio: {
          required: "Por favor ingrese una precio de venta",
          number: "Por favor ingrese el valor en pesos ($)"
        }
      },
      submitHandler: function(form){
        var fecha_i = $('#fecha_i').val(), fecha_f = $('#fecha_f').val();
        if (fecha_f > fecha_i) {
          $('#res').html('');
          form.submit();
        }else{
          $('#res').html('<b>Por favor ingresa una fecha de fin valida</b>');
        };
      }
    });
  });
  </script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>styleswitcher/jQuery.style.switcher.js"></script>

</body>

</html>