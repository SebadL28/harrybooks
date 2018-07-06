<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function validarLogin($user, $password){
		$this->db->select("*");
		$this->db->from("usuarios u");
		$this->db->where("user_usuario", $user);
		$resultados = $this->db->get();

		$return = ["validar" => false];
		if($resultados->num_rows() > 0) {
			$contador = 0;
			$rowSelect = [];
			foreach ($resultados->result() as $value){
				$passAct = $value->password_usuario;
				if(password_verify($password, $passAct)){
					$contador++;
					$rowSelect = $value;
				}
			}
			if($contador == 1){
				$return["validar"] = true;
				$return["datos"] = $rowSelect;
			}
		}

		return $return;
	}

	public function crear_sesion($data){
		$this->session->set_userdata($data);
	}

	public function cerrar_sesion(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
