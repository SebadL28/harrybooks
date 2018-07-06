<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResumenVenta_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function insertarVenta($usuario, $total){
		$fecha = date("Y-m-d");
		$datos = [
			"id_usuario" => $usuario,
			"fecha_venta" => $fecha,
			"total_venta" => $total
		];
		$this->db->insert("resumen_venta", $datos);

		$id = $this->db->insert_id();
		return $id;
	}

	public function cargarVentas($id = -1){
		$sql = "SELECT rv.id_resumen, rv.fecha_venta, rv.total_venta, COUNT(lv.id_venta) as cantidad, u.nombre_usuario FROM resumen_venta rv JOIN libro_venta lv ON lv.id_resumen_venta = rv.id_resumen JOIN usuarios u ON u.id_usuario = rv.id_usuario ";
		if($id != -1){
			$sql .= " WHERE rv.id_resumen = '".$id."' ";
		}
		$sql .= " GROUP BY id_resumen";
		$result = $this->db->query($sql);
		return $result;
	}

	public function cargarLibrosResumen($id){
		$this->db->select("lv.cantidad_libro, lv.precio_libro, l.nombre_libro, l.imagen_libro");
		$this->db->from("libro_venta lv");
		$this->db->join("libros l", "l.id_libro = lv.id_libro");
		$this->db->where("lv.id_resumen_venta", $id);
		$result = $this->db->get();
		return $result;
	}

}
