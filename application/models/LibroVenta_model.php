<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LibroVenta_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function registrarVentaLibros($idVenta, $libros){
		$datos = [];

		foreach ($libros as $key => $value){
			$datosTemp = [
				"id_resumen_venta" => $idVenta,
				"id_libro" => $value["id"],
				"cantidad_libro" => $value["cantidad"],
				"precio_libro" => $value["precio"]
			];

			$datos[] = $datosTemp;
		}

		$this->db->insert_batch("libro_venta", $datos);
	}

}
