<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Astrid Tovar">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PROYECTO_RECURSOS_IMGS ?>favcir.ico">
  <title>Liquidar Apoyos</title>
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

          <li><a href="<?= REGISTRAR_EQUIPO['url'] ?>" class="waves-effect"><i class="fa fa-plus-circle"></i> <span class="hide-menu"> Registrar Equipo</span></a></li>

          <li><a href="<?= CARGAR_ARCHIVO['url'] ?>" class="waves-effect"><i class="fa fa-upload"></i> <span class="hide-menu"> Cargar Equipos</span></a></li>

          <li><a href="<?= CONSULTAR_EQUIPOS['url'] ?>" class="waves-effect"><i class="fa fa-tasks"></i> <span class="hide-menu"> Registrar Campaña</span></a></li>

          <li><a href="<?= INDEX_APROBAR_CAMPANA['url'] ?>" class="waves-effect"><i class="fa fa-thumbs-up"></i> <span class="hide-menu"> Aprobar Campaña</span></a></li>

          <li><a href="<?= RESUMEN_CAMPANA['url'] ?>" class="waves-effect"><i class="fa fa-search"></i> <span class="hide-menu"> Consultar Campañas</span></a></li>

          <li><a href="<?= GENERAR_REPORTE_INDEX['url'] ?>" class="waves-effect"><i class="fa fa-chart-line"></i> <span class="hide-menu"> Generar Reportes</span></a></li>

          <li><a href="<?= TOTAL_APOYOS_CAMPANAS['url'] ?>" class="waves-effect active"><i class="fa fa-hand-holding-usd"></i> <span class="hide-menu"> Liquidar Apoyos</span></a></li>

          <li class="help-menu"><a href="<?= MANUAL_DE_USUARIO_GAP ?>" target="_blank" class="waves-effect"><i class="fa fa-question-circle"></i> <span class="hide-menu"> Obtener Ayuda</span></a></li>
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
        }else if($respuesta == 2){
          echo '
          <br>
          <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Ups!</strong> No fue posible registrar. Por favor intentalo nuevamente.
          </div>';
        }else if($respuesta == 3){
          echo '
          <br>
          <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Lo sentimos!</strong> No se registran campañas en los criterios seleccionados.
          </div>';
        }
      }
      ?>

      <div class="container-fluid">
        <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Liquidar Apoyos</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="#">Menú</a></li>
              <li class="active">Liquidar Apoyos</li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="white-box">

              <div class="modal fade" id="modalExport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Exportar Liquidación</h5>
                    </div>
                    <form action="<?= EXPORTAR_LIQUIDACION['url'] ?>" method="POST" id="formularioExportar">
                      <div class="modal-body">
                        <p>Por favor seleccione los criterios para exportar la liquidación: </p><br>
                        <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                          <label for="exp_mes" class="control-label col-lg-3 col-sm-3 col-md-3 col-xs-3">Mes: </label>
                          <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8">
                            <select class="form-control" name="exp_mes">
                              <option value="all">TODOS LOS MESES</option>
                              <?php for ($i=1; $i <= $mesActual; $i++) { ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                          <label for="exp_marca" class="control-label col-lg-3 col-sm-3 col-md-3 col-xs-3">Marca: </label>
                          <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8">
                            <select class="form-control" name="exp_marca">
                              <option value="all">TODAS LAS MARCAS</option>
                              <?php foreach ($listaMarcas as $marca) { ?>
                              <option value="<?php echo $marca->marca; ?>"><?php echo $marca->marca; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-principal">Exportar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div>
                <button type="button" name="exportarData" id="exportarData" class="btn btn-principal btn-cam" data-toggle="modal" data-target="#modalExport">Exportar Excel</button>
              </div>

              <div class="table-responsive">
                <table id="myTable" class="table table-striped table-detalle">
                  <thead>
                    <tr class="theme-blue">
                      <th>Fecha Inicio</th>
                      <th>Fecha Fin</th>
                      <th>Canal</th>
                      <th>Marca</th>
                      <th>PLU</th>
                      <th>Referencia</th>
                      <th>Campaña</th>
                      <th>Apoyo<i> (USD)</i></th>
                      <th>Unds. Vendidas</th>
                      <th>Apoyo Total <i>(USD)</i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($listaCampanas as $campana) { 
                      $id_campana = $campana->id_campana;
                      $fechaI = $campana->fecha_inicio;
                      $fechaF = $campana->fecha_fin;
                      $plu = $campana->plu;
                      $canal = $campana->canal;
                      $apoyo = $campana->apoyo;
                      $listaCantidades = $this->ventasDAO->consultarApoyoTotalCam($fechaI, $fechaF, $plu, $canal); ?>
                      <tr>
                        <td><?php echo $fechaI;?></td>
                        <td><?php echo $fechaF;?></td>
                        <td><?php echo $canal;?></td>
                        <td><?php echo $campana->marca;?></td>
                        <td><?php echo $plu;?></td>
                        <td><?php echo $campana->referencia;?></td>
                        <td><?php echo $campana->descripcion;?></td>
                        <?php foreach ($listaCantidades as $cantidad) { 
                        $totalApoyoCampana = $apoyo * $cantidad; ?>
                        <td><center><?php echo $apoyo;?></center></td>
                        <td><center><?php echo $cantidad;?></center></td>
                        <td><center><?php echo $totalApoyoCampana;?></center></td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
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