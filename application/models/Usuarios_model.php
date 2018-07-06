<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function cargarUsuariosRol($rol){
		$this->db->where("rol_usuario", $rol);
		$result = $this->db->get("usuarios");
		return $result;
	}

}
