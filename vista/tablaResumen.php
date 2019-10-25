<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Astrid Tovar">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PROYECTO_RECURSOS_IMGS ?>favcir.ico">
  <title>Consultar Campañas</title>
  <link href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap.min.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap-extension.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
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

          <li> <a href="<?= CONSULTAR_EQUIPOS['url'] ?>" class="waves-effect"><i class="fa fa-tasks"></i> <span class="hide-menu"> Registrar Campaña</span></a></li>

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
      if (isset($_GET['r'])) {
        $respuesta = $_GET['r'];
        if ($respuesta == "1") {
          echo '
          <br>
          <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Bien hecho!</strong> La campaña se registro correctamente.
          </div>';
        }else if ($respuesta == "2"){
          echo '
          <br>
          <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Ups!</strong> No fue posible registrar. Por favor intentalo nuevamente.
          </div>';
        }else if ($respuesta == "3"){
          echo '
          <br>
          <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          No fue posible exportar las campañas porque no se encontraron registros.
          </div>';
        }else if ($respuesta == "5"){
          echo '
          <br>
          <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          No fue posible aprobar la campaña.
          </div>';
        }else if ($respuesta == "4"){
          echo '
          <br>
          <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Bien hecho!</strong> La campaña se aprobo correctamente.
          </div>';
        }
      }
      ?>

      <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Consultar Campañas</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="#">Menú</a></li>
              <li class="active">Consultar Campañas</li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="white-box">
              <form action="<?= EXPORTAR_CAMPANA['url'] ?>" method="POST" id="formularioExportar">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                  <button type="submit" name="exportarData" id="exportarData" class="btn btn-principal btn-cam">Exportar Excel</button>
                </div>
              </form>
              <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                  <thead>
                    <tr class="theme-blue">
                      <th>Fecha</th>
                      <th>Canal</th>
                      <th>Marca</th>
                      <th>Referencia</th>
                      <th>Precio<i>($)</i></th>
                      <th>Campaña</th>
                      <th>Apoyo<i>(USD)</i></th>
                      <th>Subsidio<i>($)</i></th>
                      <th>Margen</th>
                      <th class="sin-plugin-table"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($listaCampanas as $consulta) { 
                      $fechaI = new DateTime($consulta->fecha_inicio);
                      $fechaF = new DateTime($consulta->fecha_fin); 
                      $styleFormat = new NumberFormatter('en_US', NumberFormatter::PERCENT);
                      $margen = $styleFormat->format($consulta->margen); ?>
                    <tr>
                      <td><?php echo $fechaI->format('d') . " al " . $fechaF->format('d') . " de " . $fechaF->format('M'); ?></td>
                      <td><?php echo $consulta->canal; ?></td>
                      <td><?php echo $consulta->marca; ?></td>
                      <td><?php echo $consulta->referencia; ?></td>
                      <td><?php echo $consulta->precio; ?></td>
                      <td><?php echo $consulta->descripcion; ?></td>
                      <td><center><?php echo $consulta->apoyo; ?></center></td>
                      <td><center><?php echo $consulta->subsidio; ?></center></td>
                      <td><center><?php echo $margen; ?></center></td>
                      <td><center><span data-toggle="modal" data-target="#modalAprobaciones" class="fa fa-search" title="Ver aprobaciones" id="<?php echo $consulta->id_campana; ?>"></span></center></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div id="modalAprobaciones" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button id="btn-close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">Archivos de Aprobación</h3>
              </div>
              <div class="modal-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr class="theme-blue">
                        <th>Fecha Aprobación</th>
                        <th>Nombre</th>
                        <th>Ver detalles</th>
                      </tr>
                    </thead>
                    <tbody id="aprobacion">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <footer class="footer text-center"> Copyright &copy; 2019 Stridcam. Todos los derechos reservados. </footer>
    </div>

  </div>

  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery/dist/jquery.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>tether.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>bootstrap.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-extension/js/bootstrap-extension.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>sidebar-nav/dist/sidebar-nav.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.slimscroll.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>waves.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>peity/jquery.peity.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>peity/jquery.peity.init.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>custom.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery-sparkline/jquery.sparkline.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery-sparkline/jquery.charts-sparkline.js"></script> 
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>datatables/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
  <script>
  $('.fa-search').on('click', function (e){
    var idCam = $(this).attr('id');
    $.ajax({
      url: "<?= INDEX_CONSULTAR_APROBACIONES['url'] ?>",
      type: "POST",
      data: {'id_campana' : idCam},
      success: function(respuesta){
        for (var i = respuesta.length - 1; i >= 0; i--) {
          var nombre = respuesta[i].url_aprobacion;
          nombre = nombre.split("_");
          var ruta = "<?= CARPETA_APROBACIONES ?>"
          $('#aprobacion').append('<tr id="fila' + [i] + '"></tr>');
          $('#fila' + [i]).append('<td>' + respuesta[i].fecha_aprobacion + '</td>');
          $('#fila' + [i]).append('<td>' + nombre[1] + '</td>');
          $('#fila' + [i]).append('<td><a href="'+ ruta + respuesta[i].url_aprobacion +'" target="_blank" class="fa fa-external-link-alt detalles"></a></td>');
        };
      }
    });
  });

  $('#btn-close').on('click', function (e){
    $('#aprobacion').empty();
  });

  $(document).ready(function () {
    $('#myTable').DataTable();
    $(document).ready(function () {
      var table = $('#example').DataTable({
        "columnDefs": [{
          "visible": false,
          "targets": 2
        }],
        "order": [
        [2, 'asc']
        ],
        "displayLength": 25,
        "drawCallback": function (settings) {
          var api = this.api();
          var rows = api.rows({
            page: 'current'
          }).nodes();
          var last = null;

          api.column(2, {
            page: 'current'
          }).data().each(function (group, i) {
            if (last !== group) {
              $(rows).eq(i).before(
                '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                );

              last = group;
            }
          });
        }
      });

      $('#example tbody').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
          table.order([2, 'desc']).draw();
        } else {
          table.order([2, 'asc']).draw();
        }
      });
    });
  });
  </script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>styleswitcher/jQuery.style.switcher.js"></script>
  
</body>

</html>