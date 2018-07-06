<!DOCTYPE html>
<html>
<head>
  <?php echo $head; ?>
</head>
<body class="hold-transition skin-blue  sidebar-mini">

  <?php echo $menu; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">

      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="text-center">Clientes</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body table-responsive">

          <table id="table-comercializadores" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nombres</th>
                <th class="text-center">Usuario</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $contador = 1;
                foreach ($clientes->result() as $key => $fila){
                  $id = $fila->id_usuario;
                  $nombre = $fila->nombre_usuario;
                  $user = $fila->user_usuario;

                  echo '
                  <tr>
                    <td class="text-center">'.$contador.'</td>
                    <td>'.$nombre.'</td>
                    <td>'.$user.'</td>
                  </tr>
                  ';

                  $contador++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php echo $footer; ?>

<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<?php echo $scripts; ?>

</body>
</html>
