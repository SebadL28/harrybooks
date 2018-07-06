<!DOCTYPE html>
<html>
<head>
  <?php echo $head; ?>
</head>
<body class="hold-transition skin-blue  sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <?php echo $menu; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Bienvenido a la administración
        </h1>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-default">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <h4>Por favor seleccione una opción del menú de la izquierda</h4>
                </div>
              </div>
          <!-- /.box-body -->
            </div>
          </div>
        </div>

      </section>
  <!-- /.content -->
    </div>
<!-- /.content-wrapper -->

<?php echo $footer; ?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<?php echo $scripts; ?>
</body>
</html>
