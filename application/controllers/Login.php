<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends My_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		if ($this->session->userdata('login')){
			if($this->session->userdata('rol') == 100001){
				redirect(site_url("administracion/inicio"));
			}
			elseif($this->session->userdata('rol') == 100002){
				redirect(base_url());
			}
			else{
				$this->load->view("inicio/login");
			}
		}
		else{
			$this->load->view("inicio/login");
		}
	}

	public function iniciarSesion(){
		$this->load->model('Login_model');

		$usuario = $this->input->post('usuario');
		$password = $this->input->post('password');

		$resp = $this->Login_model->validarLogin($usuario, $password);
		if($resp["validar"]){
			$datos = $resp["datos"];
			$data = [
				"id" => $datos->id_usuario,
				"name" => $datos->nombre_usuario,
				"user" => $datos->user_usuario,
				"rol" => $datos->rol_usuario,
				"login" => TRUE
			];
			$this->Login_model->crear_sesion($data);
			echo 1;
		}
		else{
			echo 0;
		}
	}
}
