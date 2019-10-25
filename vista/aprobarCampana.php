<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Astrid Tovar">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PROYECTO_RECURSOS_IMGS ?>favcir.ico">
  <title>Aprobar Campaña</title>
  <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap.min.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>bootstrap-extension.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_PLUGINS ?>sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>animate.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>style.css" rel="stylesheet">
  <link href="<?= PROYECTO_RECURSOS_CSS ?>dropzone.css" rel="stylesheet">
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

          <li> <a href="<?= INDEX_APROBAR_CAMPANA['url'] ?>" class="waves-effect active"><i class="fa fa-thumbs-up"></i> <span class="hide-menu"> Aprobar Campaña</span></a></li>

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
        if ($respuesta == "2") {
          echo '<br>
          <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡Lo sentimos!</strong> No fue posible aprobar la campaña.
          </div>';
        }
      } ?>

      <div class="container-fluid">

        <div class="row bg-title">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Aprobar Campaña</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li><a href="#">Menú</a></li>
              <li class="active">Aprobar Campaña</li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="white-box">
              <div class="help help-right">
                <img src="<?= PROYECTO_RECURSOS_IMGS ?>help-black.png" width="20px" data-toggle="tooltip" data-placement="left"
                title="Esta interfaz muestras solamente las campañas con estado 'Por aprobar'">
              </div>
              <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                  <thead>
                    <tr class="theme-blue">
                     <th>Fecha</th>
                     <th>Canal</th>
                     <th>PLU</th>
                     <th>Referencia</th>
                     <th>Precio</th>
                     <th>Campaña</th>
                     <th>Apoyo (USD)</th>
                     <th>Margen</th>
                     <th class="sin-plugin-table"></th>
                     <th class="sin-plugin-table"></th>
                    </tr>
                  </thead>	
                  <tbody>
                    <?php foreach ($listaCampanasAprobar as $campana) { 
                    $fechaI = new DateTime($campana->fecha_inicio);
                    $fechaF = new DateTime($campana->fecha_fin); ?>
                    <tr>
                     <td><?php echo $fechaI->format('d') . " al " . $fechaF->format('d') . " de " . $fechaF->format('M'); ?></td>
                     <td><?php echo $campana->canal;?></td>
                     <td><?php echo $campana->plu;?></td>
                     <td><?php echo $campana->referencia;?></td>
                     <td><?php echo $campana->precio;?></td>
                     <td><?php echo $campana->descripcion;?></td>
                     <td><center><?php echo $campana->apoyo;?></center></td>
                     <td><center><?php echo $campana->margen * 100 . '%'; ?></center></td>
                     <td><center><i data-toggle="modal" data-target="#modalEditarCam" class="fa fa-edit btn-editar" title="Editar" id="<?php echo $campana->id_campana; ?>"></i></center></td>
                     <td><center><i data-toggle="modal" data-target="#modalConfirmar" class="fa fa-check-square btn-aprobar" title="Aprobar" id="<?php echo $campana->id_campana; ?>"></i></center></td>
                    </tr>
                    <?php } ?>	
                  </tbody>	
                </table>
              </div>
            </div>
          </div>
        </div>

        <div id="modalEditarCam" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title">Editar Campaña</h3>
              </div>
              <form action="<?= EDITAR_APROBAR_CAMPANA['url'] ?>" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                <div class="modal-body col-lg-12 col-sm-12 col-md-12 col-xs-12">
                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="col-lg-3 col-md-6 col-xs-6 form-mobile"><b>PLU: </b><p id="edt_plu"></p></div>
                    <div class="col-lg-3 col-md-6 col-xs-6 form-mobile"><b>Referencia: </b><p id="edt_ref"></p></div>
                    <div class="col-lg-3 col-md-6 col-xs-6 form-mobile"><b>Campaña: </b><p id="edt_des"></p></div>
                    <div class="col-lg-3 col-md-6 col-xs-6 form-mobile"><b>Canal: </b><p id="edt_can"></p></div>
                  </div>
                  <p class="blockquote-reverse">Los campos marcados con <span><em id="requerido">* </em></span> son requeridos.</p>
                  <div class="form-group col-lg-6 col-sm-12 col-md-6 col-xs-12 form-mobile">
                    <label for="cam_fechaI" class="col-lg-3 col-md-12 col-xs-3" title="Fecha Inicio">Fecha Ini:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-8 col-sm-8 col-md-12 col-xs-8">
                      <input type="date" id="cam_fechaI" name="cam_fechaI" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group col-lg-6 col-sm-12 col-md-6 col-xs-12 form-mobile">
                    <label for="cam_fechaF" class="col-lg-3 col-md-12 col-xs-3" title="Fecha Fin">Fecha Fin:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-8 col-sm-8 col-md-12 col-xs-8">
                      <input type="date" id="cam_fechaF" name="cam_fechaF" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group col-lg-6 col-sm-12 col-md-6 col-xs-12 form-mobile">
                    <label for="cam_precio" class="col-lg-3 col-md-12 col-xs-3" title="Precio">Precio:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-8 col-sm-8 col-md-12 col-xs-8">
                      <input type="number" id="cam_precio" name="cam_precio" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group col-lg-6 col-sm-12 col-md-6 col-xs-12 form-mobile">
                    <label for="cam_apoyo" class="col-lg-3 col-md-12 col-xs-3" title="Apoyo">Apoyo:<span><em id="requerido" title="Campo Obligatorio">*</em></span></label>
                    <div class="col-lg-8 col-sm-8 col-md-12 col-xs-8">
                      <input type="number" id="cam_apoyo" name="cam_apoyo" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12 form-mobile-line">
                    <div class="col-lg-6 col-md-6 col-xs-6 form-mobile"><b>Subsidio: </b><p id="edt_sub"></p></div>
                    <input type="hidden" id="cam_subsidio" name="cam_subsidio">
                    <div class="col-lg-6 col-md-6 col-xs-6 form-mobile"><b>Margen: </b><p id="edt_mar"></p></div>
                    <input type="hidden" id="cam_margen" name="cam_margen">
                  </div>
                  <div class="form-group col-lg-12 col-sm-12 col-md-12 col-xs-12">
                      <center>
                        <label class="control-label">Seleccione el/los archivo(s) de aprobación:</label>
                        <input type="hidden" name="id_campana" id="env_id_cam2">
                        <input class="form-control-file" type="file" name="apro-files[]" id="file" multiple required/>
                      </center>
                  </div>
                </div>
                <div class="modal-footer">
                  <center>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-principal" id="btn-editar-guardar">Aprobar y Guardar</button>
                  </center>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div id="modalConfirmar" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title">Aprobar Campaña</h3>
              </div>
              <div class="modal-body">
                <p>Es necesario que adjunte al menos un archivo de aprobación (puede seleccionar varios si lo desea).</p><br>
                <form action="<?= ENVIAR_APROBACION_CAMPANA['url'] ?>" method="POST" id="form-adjuntos" enctype="multipart/form-data">
                  <center>
                    <label class="control-label">Seleccione el archivo:</label>
                    <input type="hidden" name="id_campana" id="env_id_cam">
                    <input class="form-control-file" type="file" name="apro-files[]" id="file" multiple required/><br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a id="a-aprobar">
                      <button type="submit" id="btn-enviar" class="btn btn-principal">Cargar y aprobar</button>
                    </a>
                  </center>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>    

    <footer class="footer text-center"> Copyright &copy; 2019 Stridcam. Todos los derechos reservados. </footer>
  </div>

  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>jquery/dist/jquery.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>tether.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>bootstrap.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>bootstrap-extension/js/bootstrap-extension.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>sidebar-nav/dist/sidebar-nav.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>jquery.slimscroll.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>waves.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>custom.min.js"></script>
  <script src="<?= PROYECTO_RECURSOS_JS ?>dropzone.js"></script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>datatables/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
  <script>
  // Mostrar modal editar y recalcular margen y subsidio
  $('.btn-editar').on('click', function (e){
    var id = $(this).attr('id');
    $('#env_id_cam2').val(id);
    $.ajax({
      url: "<?= INDEX_EDITAR_CAMPANA['url'] ?>",
      method: "POST",
      data: {'id_campana' : id},
      success: function (respuesta){
        var resp = respuesta[0];
        $('#id_campana').attr("value", id);
        $('#edt_plu').html(resp.plu);
        $('#edt_ref').html(resp.referencia);
        $('#edt_des').html(resp.descripcion);
        $('#edt_can').html(resp.canal);
        $('#cam_fechaI').val(resp.fecha_inicio);
        $('#cam_fechaF').val(resp.fecha_fin);
        $('#cam_precio').val(resp.precio);
        $('#cam_apoyo').val(resp.apoyo);
        $('#edt_sub').html(resp.subsidio);
        $('#cam_subsidio').val(resp.subsidio);
        $('#edt_mar').html(Math.round(resp.margen * 100) + '%');
        $(document).keyup(function (e){
          var precio = $('#cam_precio').val();
          var costo = resp.costo_equipo;
          var costoLog = resp.costo_logistico;
          var KitReg = resp.kitpre_regalo;
          var rangoIva = resp.uvt * 22;
          var ivaCover = '1.'+ resp.iva;
          var canal = resp.canal;
          var apoyo = $('#cam_apoyo').val();
          var trm = resp.trm;
          if (KitReg == 'No aplica') { KitReg = 0 };
          var costofinal = parseInt(costo) + parseInt(costoLog) + parseInt(KitReg);
          if (precio >= parseInt(rangoIva)) {
            var costoConIVA = costofinal * ivaCover;
            var precio = precio / ivaCover;
          }
          if (canal == "RETAIL") {
            costofinal = (costofinal + (precio * 0.12));
          }
          var apoyoPesos = apoyo * trm;
          var subsidio = Math.round(precio - costofinal + apoyoPesos);
          var margen = subsidio / precio;
          var margenPorc = Math.round(margen * 100);
          if (subsidio < 0) {
            $('#edt_sub').html(Math.abs(subsidio));
            $('#cam_subsidio').val(Math.abs(subsidio));
          }else{
            $('#edt_sub').html(0);
            $('#cam_subsidio').val(0);
          };
          $('#edt_mar').html(margenPorc + '%');
          $('#cam_margen').val(margen);
        });
      }
    });
  });

  // Enviar id de la campaña seleccionada a el modal de aprobación
  $('.btn-aprobar').on('click', function (e){
    var id = $(this).attr('id');
    $('#env_id_cam').val(id);
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