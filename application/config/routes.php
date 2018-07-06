<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'inicio';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



/* --------------------------------------
	RUTAS INICIO
--------------------------------------- */


// Carro Compras
$route['carro_compras'] = 'Carro_compras';
$route['carro_compras/agregar_libro'] = 'Carro_compras/agregarLibro';
$route['carro_compras/actualizar_cantidad'] = 'Carro_compras/actualizarCantidadPedido';
$route['carro_compras/eliminar_pedido'] = 'Carro_compras/eliminarPedido';
$route['carro_compras/cancelar_compra'] = 'Carro_compras/cancelarCompra';
$route['carro_compras/finalizar_compra'] = 'Carro_compras/finalizarCompra';


/* --------------------------------------
	RUTAS LOGIN
--------------------------------------- */

$route['login'] = 'login';
$route['login/iniciar_sesion'] = 'login/iniciarSesion';
$route['logout'] = 'logout';


/* --------------------------------------
	RUTAS ADMINISTRACIÓN
--------------------------------------- */

$route['administracion/inicio'] = 'administracion/inicio';

$route['administracion/clientes'] = 'administracion/clientes';

$route['administracion/informes'] = 'administracion/informes';
$route['administracion/informes/i/(:num)'] = 'administracion/informes/cargarInformeId/$1';

