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

        <?php
        $filaResumen = $resumen->result()[0];
        $idResumen = $filaResumen->id_resumen;
        $fecha = $filaResumen->fecha_venta;
        $total = $filaResumen->total_venta;
        $usuario = $filaResumen->nombre_usuario;

        $fechaFormat = new DateTime($fecha);
        $fechaFormat = $fechaFormat->format("d-m-Y");

        $textTotal = number_format($total, 2, ",", ".");
        ?>

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4 col-xs-12">
                        <label>Cliente: </label>
                      </div>
                      <div class="col-md-8 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-user"></span></span>
                          <input style="background: #fff;" type="text" class="form-control input-valor" placeholder="Cliente" readonly value="<?php echo $usuario; ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 col-md-offset-2">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4 col-xs-12">
                        <label>Fecha: </label>
                      </div>
                      <div class="col-md-8 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                          <input type="text" style="background: #fff;" readonly class="form-control" value="<?php echo $fechaFormat; ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4 col-xs-12">
                        <label>Total: </label>
                      </div>
                      <div class="col-md-8 col-xs-12">
                        <div class="input-group">
                          <span class="input-group-addon"><span class="fa fa-dollar"></span></span>
                          <input style="background: #fff;" type="text" class="form-control input-valor" id="nombres-terceros" placeholder="Total" value="$<?php echo $textTotal; ?>" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div style="margin-top: 10px;" class="col-xs-12">
              <table class="table table-bordered table-dashed">
                <thead>
                  <tr>
                    <th>#</th>
                    <th colspan="2">Libro</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $contador = 1;
                  foreach ($libros->result() as $key => $fila){
                    $cantidadLibro = $fila->cantidad_libro;
                    $precioLibro = $fila->precio_libro;
                    $nombreLibro = $fila->nombre_libro;
                    $imagenLibro = $fila->imagen_libro;

                    $total = $precioLibro * $cantidadLibro;
                      $totalText = number_format($total, 0, ",", ".");
                    $precioLibroText = number_format($precioLibro, 0, ",", ".");
                    echo '
                          <tr>
                            <td class="text-center">'.$contador.'</td>
                            <td>
                              <img style="width:60px;" src="'.base_url().'public/img/libros/'.$imagenLibro.'" alt="IMG">
                            </td>
                            <td>'.$nombreLibro.'</td>
                            <td class="text-right">$'.$precioLibroText.'</td>
                            <td class="text-center">'.$cantidadLibro.'</td>
                            <td class="text-right">$'.$totalText.'</td>
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
