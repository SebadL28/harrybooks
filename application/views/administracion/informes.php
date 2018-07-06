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
          <h3 class="text-center">Informes de ventas</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body table-responsive">

          <table id="table-comercializadores" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Tipos libros</th>
                <th class="text-center">Total</th>
                <th class="text-center">Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $contador = 1;
              foreach ($informes->result() as $key => $fila){
                $idResumen = $fila->id_resumen;
                $fecha = $fila->fecha_venta;
                $total = $fila->total_venta;
                $cantidad = $fila->cantidad;
                $usuario = $fila->nombre_usuario;

                $fechaFormat = new DateTime($fecha);
                $fechaFormat = $fechaFormat->format("d-m-Y");

                $textTotal = number_format($total, 2, ",", ".");

                echo '
                <tr>
                  <td class="text-center">'.$contador.'</td>
                  <td class="text-center">'.$fechaFormat.'</td>
                  <td>'.$usuario.'</td>
                  <td class="text-center">'.$cantidad.'</td>
                  <td class="text-right">$'.$textTotal.'</td>
                  <td class="text-center">
                    <a href="'.base_url().'administracion/informes/i/'.$idResumen.'" class="btn btn-xs btn-info"><span class="fa fa-eye"></span></a>
                  </td>
                </tr>';

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
