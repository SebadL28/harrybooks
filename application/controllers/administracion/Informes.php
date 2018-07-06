<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informes extends Admin_Controller{

	function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->load->model('ResumenVenta_model');
		$informes = $this->ResumenVenta_model->cargarVentas();

		$datos = ["informes" => $informes];
		$this->cargarVista('administracion/informes.php', $datos);
	}

	public function cargarInformeId($id){
		$this->load->model('ResumenVenta_model');
		$resumen = $this->ResumenVenta_model->cargarVentas($id);
		$libros = $this->ResumenVenta_model->cargarLibrosResumen($id);

		$datos = ["resumen" => $resumen, "libros" => $libros];
		$this->cargarVista('administracion/informe_individual.php', $datos);

	}

}
