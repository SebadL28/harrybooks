<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends Admin_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");
	}
	
	public function index(){
		$rol = 100002;
		$clientes = $this->Usuarios_model->cargarUsuariosRol($rol);

		$datos = ["clientes" => $clientes];
		$this->cargarVista('administracion/clientes.php', $datos);
	}

}
