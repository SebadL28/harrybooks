<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libros_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function cargarLibros(){
		$result = $this->db->get("libros");
		return $result;
	}

	public function cargarLibrosId($ids){
		$this->db->where_in("id_libro", $ids);
		$result = $this->db->get("libros");
		return $result;
	}

	public function actualizarCantidadLibro($id, $cantidadAct){
		$data = ["cantidad_libro" => $cantidadAct];
		$this->db->where('id_libro', $id);
		$this->db->update('libros', $data); 
	}

}
