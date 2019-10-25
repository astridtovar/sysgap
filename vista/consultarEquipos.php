<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Astrid Tovar">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PROYECTO_RECURSOS_IMGS ?>favcir.ico">
  <title>Registrar Campaña</title>
  <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
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

          <li><a href="<?= REGISTRAR_EQUIPO['url'] ?>" class="waves-effect"><i class="fa fa-plus-circle"></i> <span class="hide-menu"> Registrar Equipo</span></a></li>

          <li><a href="<?= CARGAR_ARCHIVO['url'] ?>" class="waves-effect"><i class="fa fa-upload"></i> <span class="hide-menu"> Cargar Equipos</span></a></li>

          <li><a href="<?= CONSULTAR_EQUIPOS['url'] ?>" class="waves-effect active"><i class="fa fa-tasks"></i> <span class="hide-menu"> Registrar Campaña</span></a></li>

          <li><a href="<?= INDEX_APROBAR_CAMPANA['url'] ?>" class="waves-effect"><i class="fa fa-thumbs-up"></i> <span class="hide-menu"> Aprobar Campaña</span></a></li>

          <li><a href="<?= RESUMEN_CAMPANA['url'] ?>" class="waves-effect"><i class="fa fa-search"></i> <span class="hide-menu"> Consultar Campañas</span></a></li>

          <li><a href="<?= GENERAR_REPORTE_INDEX['url'] ?>" class="waves-effect"><i class="fa fa-chart-line"></i> <span class="hide-menu"> Generar Reportes</span></a></li>

          <li><a href="<?= TOTAL_APOYOS_CAMPANAS['url'] ?>" class="waves-effect"><i class="fa fa-hand-holding-usd"></i> <span class="hide-menu"> Liquidar Apoyos</span></a></li>

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
          <strong>¡Bien hecho!</strong> Los datos se registraron correctamente.
          </div>';
        } else if ($respuesta == "2") {
          echo '
          <br>
          <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Lo sentimos!</strong> No fue posible registrar los datos. Por favor intente nuevamente.
          </div>';
        } elseif ($respuesta == "3") {
          echo '
          <br>
          <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Bien hecho!</strong> Los datos se editaron correctamente.
          </div>';
        } elseif ($respuesta == "4") {
          echo '
          <br>
          <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Lo sentimos!</strong> No fue posible editar los datos. Por favor intente nuevamente.
          </div>';
        } elseif ($respuesta == "5") {
          echo '
          <br>
          <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Bien hecho!</strong> Los datos se eliminaron correctamente.
          </div>';
        } elseif ($respuesta == "6") {
          echo '
          <br>
          <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Lo sentimos!</strong> No fue posible eliminar los datos. Por favor intente nuevamente.
          </div>';
        } elseif ($respuesta == "7") {
          echo '
          <br>
          <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Ups!</strong> Debes seleccionar al menos un equipo para registrar una nueva campaña.
          </div>';
        } elseif ($respuesta == "8") {
          echo '
          <br>
          <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Ups!</strong> Debes seleccionar equipos con el mismo costo.
          </div>';
        }elseif ($respuesta == "9") {
          echo '
          <br>
          <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Bien hecho!</strong> Notamos que algunos de los PLU ingresados ya estaban registrados,
          por lo que actualizamos los costos de estos.
          </div>';
        }elseif ($respuesta == "10") {
          echo '
          <br>
          <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          El PLU ingresado como regalo de la promoción 2X1 no se encuentra registrado en la base de datos.
          </div>';
        }
      } ?>

      <div class="container-fluid">

        <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Registrar Campaña</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="#">Menú</a></li>
              <li class="active">Registrar Campaña</li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="white-box">
              <form action="<?= INDEX_REGISTRAR_CAMPANA['url'] ?>" method="POST">
                <div>
                  <button type="submit" class="btn btn-principal btn-cam">Nueva Campaña</button>
                </div>
                <br>
                <div class="table-responsive">
                  <table id="myTable" class="table table-striped">
                    <thead>
                      <tr class="theme-blue">
                        <th class="sin-plugin-table"></th>
                        <th>PLU</th>
                        <th>Referencia</th>
                        <th>Marca</th>
                        <th>Costo Equipo <i>($)</i></th>
                        <th class="sin-plugin-table"></th>
                        <th class="sin-plugin-table"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($listaEquipos as $consulta) { ?>
                      <tr>
                        <input type="hidden" id="id_smartphone" value="<?php echo $consulta->id_smartphone; ?>">
                        <td><input type="checkbox" id="id_selec" name="id_selec[]" value="<?php echo $consulta->id_smartphone;?>"></td>
                        <td><?php echo $consulta->plu; ?></td>
                        <td><?php echo $consulta->referencia; ?></td>
                        <td><?php echo $consulta->marca; ?></td>
                        <td><?php echo $consulta->costo_equipo; ?></td>
                        <td><center><a href="#modalEditar" data-toggle="modal" class="btn-editar" id="<?php echo $consulta->id_smartphone;?>"><span class="fa fa-edit" title="Editar"> </span></a></center></td>
                        <td><center><a href="#modalConfirmar" data-toggle="modal" class="btn-eliminar" id="<?php echo $consulta->id_smartphone;?>"><span class="fa fa-trash btn-icon" title="Eliminar"> </span></a></center></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div id="modalEditar" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title">Editar equipo</h3>
              </div>
              <form action="<?= EDITAR_EQUIPO['url'] ?>" method="POST" class="form-horizontal" role="form">
                <div class="modal-body col-lg-12 col-sm-12 col-md-12 col-xs-12">
                  <p class="blockquote-reverse">Los campos marcados con <span><em id="requerido">* </em></span> son requeridos.</p>
                  <br>
                  <input type="hidden" name="id_s" id="id_s">
                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <label for="sma_plu" class="col-lg-3 col-md-12 col-xs-3 " title="PLU">PLU:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-8 col-sm-8 col-md-12 col-xs-8">
                      <input type="number" id="sma_plu" name="sma_plu" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <label for="sma_referencia" class="col-lg-3 col-md-12 col-xs-3 " title="Referencia">Referencia:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-8 col-sm-8 col-md-12 col-xs-8">
                      <input type="text" id="sma_referencia" name="sma_referencia" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <label for="sma_marca" class="col-lg-3 col-md-12 col-xs-3 " title="Marca">Marca:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-8 col-md-12 col-xs-8">
                      <input type="text" id="sma_marca" name="sma_marca" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <label for="sma_costo" class="col-lg-3 col-md-12 col-xs-3" title="Costo Equipo">Costo Equipo:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-8 col-md-12 col-xs-8">
                      <input type="text" id="sma_costo" name="sma_costo" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <center>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-principal" id="btn-editar-guardar">Guardar</button>
                  </center>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div id="modalConfirmar" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <p>¿Esta seguro de eliminar este equipo?</p>
              </div>
              <div class="modal-footer">
                <center>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <a id="a-eliminar">
                    <button type="button" class="btn btn-principal">Si, quiero eliminarlo</button>
                  </a>
                </center>
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
  <script src="<?= PROYECTO_RECURSOS_JS ?>custom.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>datatables/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
  <script>
  // Mostrar modal editar
  $('.btn-editar').on('click', function(){
    var id = $(this).attr('id');
    $.ajax({
      url: "<?= CONSULTAR_EQUIPOS['url'] ?>",
      type: 'POST',
      data: {'id_smartphone' : id},
      success: function (respuesta) {
        $('#sma_plu').val(respuesta.plu); 
        $('#sma_referencia').val(respuesta.ref);
        $("#sma_marca").val(respuesta.marca);
        $('#sma_costo').val(respuesta.costo);
        $('#id_s').attr("value" , respuesta['id']);
      }
    });
  });

  // Mostrar modal confirmación para eliminar
  $('.btn-eliminar').on('click', function () {
    var id = $(this).attr('id');
    $('#a-eliminar').attr("href", "<?= ELIMINAR_EQUIPO['url'] ?>?id_s="+id);
  });

  // Data Table
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