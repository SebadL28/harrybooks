<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends Admin_Controller{

	function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->cargarVista('administracion/inicio.php');
	}

}
