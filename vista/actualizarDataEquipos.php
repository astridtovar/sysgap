<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Astrid Tovar">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= PROYECTO_RECURSOS_IMGS ?>favcir.ico">
  <title>Actualizar Equipos</title>
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
      <div class="navbar-header">
        <div class="top-left-part"><a class="logo" href="<?= INDEX['url'] ?>"><b><img src="<?= PROYECTO_RECURSOS_IMGS ?>logo_tigo.png" alt="" class="logo"/></b><span class="hidden-xs"></span></a></div>
        <ul class="nav navbar-top-links navbar-right pull-right">
          <li class="title">Sistema de Gestión de Apoyos y Precios</li>
        </ul>
      </div>
      <div class="navbar-header-fr"></div>
    </nav>

    <div class="container-fluid">

      <div class="white-box col-xs-12 col-sm-12 col-md-12 col-lg-12">

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
          } else if ($respuesta == "3") {
            echo '
            <br>
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Lo sentimos!</strong> No fue posible registrar. Asegurate de que todos los campos de la
            columna "Costo" sean formato "General" e intenta nuevamente.
            </div>';
          } else if ($respuesta == "4") {
            echo '
            <br>
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Lo sentimos!</strong> No fue posible registrar. Asegurate de no tener campos vacios en tu tabla y
            que todos los campos de la columna "Costo" sean formato "General" e intenta nuevamente.
            </div>';
          } 
        }
        ?>

        <center>
          <br>
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
          <div id="res" class="col-xs-8 col-sm-8 col-md-8 col-lg-8 alert alert-info">
            <p>Hemos detectado que tu información en la base de datos no se encuentra actualizada.</p><br>
            <p><b>Ultima fecha de actualización:  </b> <?php echo $fechaRegistro; ?> </p>
          </div>
        </center>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <br><br>
          <div class="col-xs-0 col-sm-0 col-md-0 col-lg-12 form-next"></div>
          <fieldset class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form">
            <p><b>Para continuar con los procesos normales del sistema por favor cargue los nuevos costos que aplican para este mes:</b></p>
            <p>Recuerde llenar el siguiente <a href="<?= FORMATO_CARGA_MASIVA ?>"><b>formato</b></a> con todos los equipos que desea cargar
            a la base de datos. Una vez este COMPLETAMENTE DILIGENCIADO guardelo en formato <b>CSV UTF-8(delimitado por comas)</b>, este archivo es el que debe ser cargado.<br>
            <i><b>Nota: </b>El campo "Costo" debe tener formato "General", de lo contrario no podra cargarse la informacion.</i></p>
            <br>
            <form action="<?= ACTUALIZAR_DATA['url'] ?>" method="POST" enctype="multipart/form-data" id="form-cargar" class="form-horizontal" role="form">
              <center>
                <div class="form-group">
                  <div class="col-xs-12 col-md-12 col-lg-12">
                    <label for="sma_archivo">Seleccione un archivo:</label>
                    <input type="file" id="sma_archivo" name="sma_archivo" accept=".csv" required/>
                    <input type="hidden" id="fechaUltimo" name="fechaUltimo" value="<?php echo $fechaRegistro; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <button id="btnCargarDatos" class="btn btn-principal" type="submit" title="Guardar">Cargar Datos</button>
                </div>
              </center>
            </form>
          </fieldset>
        </div>

      </div>

    </div>

    <footer class="footer footer-principal"> Copyright &copy; 2019 Stridcam. Todos los derechos reservados. </footer>

  </div>

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
  $('#btnCargarDatos').on('click', function (e) {
    var form = $('#form-cargar');
    if (form.submit) { $('#res').html("En este momento estamos cargando tu información... por favor espera."); };
  })
  </script>
  <script src="<?= PROYECTO_RECURSOS_PLUGINS ?>styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>