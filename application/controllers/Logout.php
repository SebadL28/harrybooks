<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Login_model');
	}

	public function index(){
		$this->Login_model->cerrar_sesion();
		redirect(base_url());
	}
}
