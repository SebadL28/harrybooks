<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class My_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
}
 
class Admin_Controller extends My_Controller{
	function __construct(){
		parent::__construct();
		if (!$this->session->userdata('login')){
			redirect(base_url());
		}
		else if($this->session->userdata('rol') != 100001){
			redirect(base_url());
		}
	}

	protected function cargarVista($url, $data = array()){
		$menu = $this->load->view("administracion/menu.php", '', true);
		$footer = $this->load->view("administracion/footer.php", '', true);
		$head = $this->load->view("administracion/head.php", '', true);
		$scripts = $this->load->view("administracion/scripts.php", '', true);
		$datos = array("menu" => $menu, "footer" => $footer, "head" => $head, "scripts" => $scripts);

		if(count($data) > 0){
			foreach ($data as $key => $value){
				$datos[$key] = $value;
			}
		}
		$this->load->view($url, $datos);
	}
}

class Cliente_Controller extends My_Controller{
	function __construct(){
		parent::__construct();
		if (!$this->session->userdata('login')){
			redirect(site_url("login_clientes"));
		}
		else if($this->session->userdata('rol') != 'Cliente'){
			redirect(site_url("login_clientes"));
		}
	}

	protected function cargarVista($url, $data = array()){
		$menu = $this->load->view("inicio/menu.php", '', true);
		$menuClientes = $this->load->view("clientes/menu.php", '', true);
		$footer = $this->load->view("inicio/footer.php", '', true);
		$head = $this->load->view("inicio/head.php", '', true);
		$scripts = $this->load->view("inicio/scripts.php", '', true);
		$datos = array("menu" => $menu, "menu_clientes" => $menuClientes, "footer" => $footer, "head" => $head, "scripts" => $scripts);

		if(count($data) > 0){
			foreach ($data as $key => $value){
				$datos[$key] = $value;
			}
		}
		$this->load->view($url, $datos);
	}
}

class Empresas_Controller extends My_Controller{
	function __construct(){
		parent::__construct();
		if (!$this->session->userdata('login')){
			redirect(site_url("login_administracion"));
		}
		else if($this->session->userdata('rol') != 'Empresas'){
			redirect(site_url("login_administracion"));
		}
	}

	protected function cargarVista($url, $data = array()){
		$menu = $this->load->view("empresas/menu.php", '', true);
		$footer = $this->load->view("empresas/footer.php", '', true);
		$head = $this->load->view("empresas/head.php", '', true);
		$scripts = $this->load->view("empresas/scripts.php", '', true);
		$datos = array("menu" => $menu, "footer" => $footer, "head" => $head, "scripts" => $scripts);

		if(count($data) > 0){
			foreach ($data as $key => $value){
				$datos[$key] = $value;
			}
		}
		$this->load->view($url, $datos);
	}

}

class Sucursales_Controller extends My_Controller{

	function __construct(){
		parent::__construct();

		if(!$this->session->userdata('login')){
			redirect(site_url("login_administracion"));
		}
		else if($this->session->userdata('rol') != "Sucursales"){
			redirect(site_url("login_administracion"));
		}
	}

	protected function cargarVista($url, $data = array()){
		$menu = $this->load->view("sucursales/menu.php", '', true);
		$footer = $this->load->view("sucursales/footer.php", '', true);
		$head = $this->load->view("sucursales/head.php", '', true);
		$scripts = $this->load->view("sucursales/scripts.php", '', true);
		$datos = array("menu" => $menu, "footer" => $footer, "head" => $head, "scripts" => $scripts);

		if(count($data) > 0){
			foreach ($data as $key => $value){
				$datos[$key] = $value;
			}
		}
		$this->load->view($url, $datos);
	}
}

class Inicio_Controller extends My_Controller{

	function __construct(){
		parent::__construct();
		$librosAct = $this->session->userdata('libros_carrito');
		if(!is_array($librosAct)){
			if($librosAct == ''){
				$datosCarro = array("libros_carrito" => []);
				$this->session->set_userdata($datosCarro);
			}
		}
	}

	protected function cargarVista($url, $data = array()){
		$menu = $this->load->view("inicio/menu.php", '', true);
		$footer = $this->load->view("inicio/footer.php", '', true);
		$head = $this->load->view("inicio/head.php", '', true);
		$scripts = $this->load->view("inicio/scripts.php", '', true);

		$librosAct = $this->session->userdata('libros_carrito');
		$cantidadCarrito = count($librosAct);

		$datos = array("menu" => $menu, "footer" => $footer, "head" => $head, "scripts" => $scripts, "cantidad_carrito" => $cantidadCarrito);

		if(count($data) > 0){
			foreach ($data as $key => $value){
				$datos[$key] = $value;
			}
		}
		$this->load->view($url, $datos);
	}
}
 
class Public_Controller extends My_Controller{
	function __construct(){
		parent::__construct();
	}

}