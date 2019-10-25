<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Astrid Tovar">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PROYECTO_RECURSOS_IMGS ?>favcir.ico">
  <title>Generar Reportes</title>
  <link href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap.min.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap-extension.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>animate.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>style.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>colors/blue.css" id="theme" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>style-apoyos-devices.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
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

          <li> <a href="<?= CONSULTAR_EQUIPOS['url'] ?>" class="waves-effect"><i class="fa fa-tasks"></i> <span class="hide-menu"> Registrar Campaña</span></a></li>

          <li> <a href="<?= INDEX_APROBAR_CAMPANA['url'] ?>" class="waves-effect"><i class="fa fa-thumbs-up"></i> <span class="hide-menu"> Aprobar Campaña</span></a></li>

          <li> <a href="<?= RESUMEN_CAMPANA['url'] ?>" class="waves-effect"><i class="fa fa-search"></i> <span class="hide-menu"> Consultar Campañas</span></a></li>

          <li> <a href="<?= GENERAR_REPORTE_INDEX['url'] ?>" class="waves-effect active"><i class="fa fa-chart-line"></i> <span class="hide-menu"> Generar Reportes</span></a></li>

          <li> <a href="<?= TOTAL_APOYOS_CAMPANAS['url'] ?>" class="waves-effect"><i class="fa fa-hand-holding-usd"></i> <span class="hide-menu"> Liquidar Apoyos</span></a></li>

          <li class="help-menu"> <a href="<?= MANUAL_DE_USUARIO_GAP ?>" target="_blank" class="waves-effect"><i class="fa fa-question-circle"></i> <span class="hide-menu"> Obtener Ayuda</span></a></li>
        </ul>
      </div>
    </div>

    <div id="page-wrapper">

      <?php if (isset($_GET["r"])) {
        $respuesta = $_GET["r"];
        if ($respuesta == "1") {
          echo '
          <br>
          <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Bien hecho!</strong> Los datos se registraron correctamente.
          </div>' . 
          '<script>
            Push.create("Sistema de Gestión de Apoyos y Precios", {
            body: "Se ha completado la carga de Ventas. Ya puedes generar tus reportes.",
            timeout: 8000,
            vibrate: [100, 100, 100],
          });</script>';
        } else if ($respuesta == "2") {
          echo '
          <br>
          <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Lo sentimos!</strong> No fue posible registrar los datos. Por favor intente nuevamente.
          </div>';
        }
      } ?>

      <div class="container-fluid">

        <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Generar Reportes</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="#">Menú</a></li>
              <li><a href="<?= INDEX_CARGAR_VENTAS['url'] ?>">Cargar Ventas</a></li>
              <li class="active">Generar Reporte</li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="white-box graf">
              <p>Por favor seleccione el reporte que desea generar:</p>
              <br>
              <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 container-menu-graf">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <p><b>Margen Promedio: </b></p>
                  <a href="#" id="margen-marca" class="btn btn-principal graficos-menu col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <i class="fa fa-chart-bar"></i> <span>Por Marca</span>
                  </a>
                  <a href="#" id="margen-gama" class="btn btn-principal graficos-menu col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <i class="fa fa-chart-bar"></i> <span>Por Gama</span>
                  </a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 graficos-menu-tr">
                  <br>
                  <p><b>Historial: </b></p>
                  <a href="#"  id="apoyos-fab" class="btn btn-principal graficos-menu col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <i class="fa fa-chart-line"></i> <span>Apoyos por fabricante</span>
                  </a>
                </div>
              </div>
              <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 container-graf">
                <center>
                  <div id="chartContainer" class="grafica" style="height: 380px;">
                    <p class="txt-grafica">Aquí aparecerá la gráfica.</p>
                  </div>
                </center>
              </div>
            </div>
          </div>
        </div>

      </div>

      <footer class="footer text-center"> Copyright &copy; 2019 Stridcam. Todos los derechos reservados. </footer>

    </div>

  </div>

  <script src="<?= PROYECTO_RECURSOS_JS ?>canvasjs.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery/dist/jquery.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>tether.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>bootstrap.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-extension/js/bootstrap-extension.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>sidebar-nav/dist/sidebar-nav.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.slimscroll.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>waves.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>custom.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>jasny-bootstrap.js"></script>
  <script>
  $('#margen-marca').on('click', function (e) {
    $.ajax({
      url: "<?= MARGEN_PROMEDIO_MARCA['url'] ?>",
      success: function(respuesta) {
        console.log(respuesta);
        var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          exportEnabled: true,
          title: {
            text: "Margen Promedio Por Marca"
          },
          axisY: {
            maximum: 100,
            interval: 20,
            gridColor: "#fff"
          },
          data: [
          {
            legendText: "Fabricantes",
            yValueFormatString: "##0'%'",
            indexLabel: "{y}",
            dataPoints: respuesta,
          }
          ]
        });
        chart.render();
      }
    });
  });

  $('#margen-gama').on('click', function (e){
    $.ajax({
      url: "<?= MARGEN_PROMEDIO_GAMA['url'] ?>",
      success: function (respuesta) {
        console.log(respuesta);
        var chart = new CanvasJS.Chart("chartContainer",
        {
          animationEnabled: true,
          exportEnabled: true,
          title:{
            text: "Margen Promedio por Gama"
          },
          axisY: {
            maximum: 100,
            interval: 20,
            gridColor: '#fff',
          },
          data: [
          {
            legendText: "Gamas",
            yValueFormatString: "##0'%'",
            indexLabel: "{y}",
            dataPoints: respuesta,
          }
          ]
        });
        chart.render();
      }
    });
  });

  $('#apoyos-fab').on('click', function (e){
    $.ajax({
      url: "<?= TOTAL_APOYOS_MES['url'] ?>",
      success: function (respuesta) {
        console.log(respuesta);
        var chart = new CanvasJS.Chart("chartContainer", {
          animationEnabled: true,
          exportEnabled: true,
          title:{
            text: "Historial de Apoyos por Fabricante"             
          }, 
          axisY:{
            title: "Apoyos (USD)",
          },
          axisX:{
            interval: 1,
          },
          toolTip: {
            shared: true
          },
          legend:{
            cursor:"pointer",
            itemclick: toggleDataSeries
          },
          data: respuesta
        });

        chart.render();

        function toggleDataSeries(e) {
          if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
          }
          else {
            e.dataSeries.visible = true;            
          }
          chart.render();
        }
      }
    })
  });
</script>
<script src="<?= PROYECTO_RECURSOS_PLUGINS ?>styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>