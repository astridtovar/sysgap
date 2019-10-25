<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Astrid Tovar">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PROYECTO_RECURSOS_IMGS ?>favcir.ico">
  <title>Escenarios</title>
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

      <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Escenarios</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="#">Menú</a></li>
              <li><a href="<?= CONSULTAR_EQUIPOS['url'] ?>">Registrar campaña</a></li>
              <li>Formulario registro</li>
              <li class="active">Escenarios</li>
            </ol>
          </div>
        </div>

        <?php if ($restIvaCosto > 0) {
          echo '
          <br>
          <div class="alert alert-info alert-dismissable">
          Hemos detectado que tu PVP esta por debajo del IVA mientras el costo por encima, por lo que
          hemos calculado los excenarios de acuerdo a esto.
          </div>';
        } ?>

        <div class="row">
          <div class="col-sm-12">
            <form method="POST" action="<?= INSERTAR_CAMPANA['url'] ?>" class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
              
              <div class="white-box col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form">
                    <input type="hidden" name="descripcion" value="<?php echo $descripcion;?>">
                    <p><b>Campaña "<?php echo $descripcion;?>"</b></p>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 form">
                    <input type="hidden" name="precio" value="<?php echo $_POST['cam_precio'];?>">
                    <p><b>Precio: </b><i>$ </i> <span><?php echo $_POST['cam_precio'];?></span></p>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 form">
                    <input type="hidden" name="canal" value="<?php echo $canal;?>">
                    <p><b>Canal: </b><?php echo $canal;?></p>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 form">
                    <input type="hidden" name="producto" value="<?php echo $producto;?>">
                    <p><b>Producto: </b><?php echo $producto;?></p>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 form">
                    <input type="hidden" name="fecha_inicio" value="<?php echo $fechaI;?>">
                    <input type="hidden" name="fecha_fin" value="<?php echo $fechaF;?>">
                    <p><b>Fecha:</b> Del <?php echo $fechaI;?> a <?php echo $fechaF;?></p>
                  </div>
                  <p><b>Referencias:</b>
                    <?php foreach ($listaEquipos as $equipo) { ?>
                    <?php echo '<br> - ' . $equipo->referencia; ?>
                    <?php } ?>
                  </p>
                  <div>
                    <input type="hidden" name="costo_log" value="<?php echo $costo_log;?>">
                    <input type="hidden" name="iva" value="<?php echo $iva;?>">
                    <input type="hidden" name="uvt" value="<?php echo $uvt;?>">
                    <input type="hidden" name="trm" value="<?php echo $trm;?>">
                    <input type="hidden" name="kit_reg" value="<?php echo $kit_reg;?>">
                    <input type="hidden" name="pluHijo" value="<?php echo $pluHijo;?>">
                    <?php foreach ($arrayIDS as $id) { ?>
                    <input type="hidden" name="array_ids[]" value="<?php echo $id;?>">
                    <?php } ?>
                  </div>
                </div>

                <fieldset class="form-next form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                  <legend>Escenario sin perdida:</legend>
                  <center>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 form escenario">
                      <p class="superior"><b>Apoyo: </b><i>USD </i> <span id="apoyo"><?php echo $datosSimple['apoyoEstimado'];?></span></p>
                      <input type="hidden" name="apoyo1" value="<?php echo $datosSimple['apoyoEstimado'];?>">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 form escenario">
                      <p class="superior"><b>Subsidio: </b><i>$ </i> 0</p>
                      <input type="hidden" name="sub1" value="0">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 form escenario">
                      <p class="superior"><b>Margen: </b> <?php echo $datosSimple['porcMargen'];?></p>
                      <input type="hidden" name="mar1" value="<?php echo $datosSimple['porcentajeMargen'];?>">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 form btn-escenario">
                      <button type="submit" name="btn" value="esc1" class="btn btn-principal">Guardar</button>
                    </div>
                  </center>
                </fieldset>

              </div>

              <div class="white-box col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <fieldset class="form-next form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                  <legend>Escenario 10% margen:</legend>
                  <center>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 form escenario">
                      <p class="superior"><b>Apoyo: </b><i>USD </i> <?php echo $datosMargen10;?></p>
                      <input type="hidden" name="apoyo2" value="<?php echo $datosMargen10;?>">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 form escenario">
                      <p class="superior"><b>Subsidio: </b><i>$ </i> 0</p>
                      <input type="hidden" name="sub2" value="0">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 form escenario">
                      <p class="superior"><b>Margen: </b> 10%</p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 form btn-escenario">
                      <button type="submit" name="btn" value="esc2" class="btn btn-principal">Guardar</button>
                    </div>
                  </center>
                </fieldset>
              </div>

              <div class="white-box col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <fieldset class="form-next form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                  <legend>Escenario modificando apoyo:</legend>
                  <center>
                    <div class="col-xs-6 col-sm-2 col-md-2 col-lg-1 form escenario">
                      <p class="superior"><b>Apoyo: </b>
                    </div>
                    <div class="col-xs-6 col-sm-2 col-md-2 col-lg-2 form escenario">
                      <input type="number" class="form-control" name="apoyo_ing" id="apoyo_ingresado" value="0" required>
                      <input type="hidden" name="apoyo3" id="apoyo3" value="<?php echo $datosMargen10;?>">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 form escenario" id="contenedor-sub">
                      <p class="superior"><b>Subsidio: </b><i>$ </i><span id="res_subsudio">0</span></p>
                      <input type="hidden" id="res_subsudio3" name="sub3" value="0">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 form escenario" id="contenedor-mar">
                      <p class="superior"><b>Margen: </b> <span id="res_margen">0</span><i>%</i></p>
                      <input type="hidden" id="res_margen3" name="mar3" value="0">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 form btn-conjunto">
                      <button type="submit" name="btn" value="esc3" class="btn btn-principal">Guardar</button>
                    </div> 
                  </center>
                </fieldset>
              </div>

            </form>
          </div>
        </div>

      </div>

      <footer class="footer text-center"> Copyright &copy; 2019 Stridcam. Todos los derechos reservados. </footer>
    </div>

  </div>

  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery/dist/jquery.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>tether.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.js"></script>
  <script>
  $(document).keyup(function (e){
    var apoyo = $('#apoyo_ingresado').val();
    var kit_reg = <?php echo $kit_reg;?>;
    var precio = <?php echo $_POST['cam_precio']?>;
    var costo = <?php echo $costo;?>;
    var costo_log = <?php echo $costo_log;?>;
    var rangoIva = <?php echo $rangoIva;?>;
    var ivaCover = <?php echo $ivaCover;?>;
    var canal = '<?php echo $canal;?>';
    var trm = <?php echo $trm;?>;
    var costofinal = costo + costo_log + kit_reg;
    if (precio >= rangoIva) {
      var costoConIVA = costofinal * ivaCover;
      var precio = precio / ivaCover;
    }
    if (canal == "RETAIL") {
      costofinal = (costofinal + (precio * 0.12));
    }
    var apoyoPesos = apoyo * trm;
    var subsidio = precio - costofinal + apoyoPesos;
    var margen = subsidio / precio;
    var margenPorc = Math.round((subsidio / precio) *100);
    if (subsidio < 0) {
      subsidio = Math.abs(subsidio);
      $('#res_subsudio').html(Math.round(subsidio));
      $('#res_subsudio3').val(Math.round(subsidio));
    }else{
      $('#res_subsudio').html(0);
      $('#res_subsudio3').val(0);
    }
    $('#res_margen').html(margenPorc);
    $('#res_margen3').val(margen);
    $('#apoyo3').val(apoyo);
  });
  </script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>bootstrap.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-extension/js/bootstrap-extension.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>sidebar-nav/dist/sidebar-nav.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.slimscroll.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>waves.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>custom.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>jasny-bootstrap.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>