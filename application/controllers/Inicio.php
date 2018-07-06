<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends Inicio_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->model('Libros_model');
		$libros = $this->Libros_model->cargarLibros();
		$datos = ["libros" => $libros];
		$this->cargarVista('inicio/inicio', $datos);
	}
}
