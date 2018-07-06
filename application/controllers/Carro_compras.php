<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carro_compras extends Inicio_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$librosAct = $this->session->userdata('libros_carrito');
		$ids = [];

		$datos = [];
		if(count($librosAct) > 0){
			$this->load->model('Libros_model');

			foreach ($librosAct as $key => $value){
				$ids[] = $value["id"];
			}

			$libros = $this->Libros_model->cargarLibrosId($ids);
			$datosLibros = [];
			foreach ($libros->result() as $key => $fila){
				$idLibro = $fila->id_libro;
				$datosLibros[$idLibro] = $fila;
			}
			$datos["libros"] = $datosLibros;
		}

		$this->cargarVista('inicio/carro_compras', $datos);
	}

	public function agregarLibro(){
		$idLibro = $this->input->post("id");
		$cantidadLibro = $this->input->post("cantidad");

		if($idLibro != '' && $idLibro > 0 && $cantidadLibro != '' && $cantidadLibro > 0){
			$librosAct = $this->session->userdata('libros_carrito');
			$librosAct[] = ["id" => $idLibro, "cantidad" => $cantidadLibro];

			$datosCarro = array("libros_carrito" => $librosAct);
			$this->session->set_userdata($datosCarro);
		}
	}

	public function actualizarCantidadPedido(){
		$idPedido = $this->input->post("id");
		$cantidadAct = $this->input->post("cantidad");

		$librosAct = $this->session->userdata('libros_carrito');
		$librosAct[$idPedido]["cantidad"] = $cantidadAct;

		$datosCarro = array("libros_carrito" => $librosAct);
		$this->session->set_userdata($datosCarro);
	}

	public function eliminarPedido(){
		$idPedido = $this->input->post("id");

		$librosAct = $this->session->userdata('libros_carrito');

		array_splice($librosAct, $idPedido, 1);

		$datosCarro = array("libros_carrito" => $librosAct);
		$this->session->set_userdata($datosCarro);
	}

	public function cancelarCompra(){
		$datosCarro = array("libros_carrito" => []);
		$this->session->set_userdata($datosCarro);
	}

	public function finalizarCompra(){

		if($this->session->userdata('login')){
			$this->load->model('ResumenVenta_model');
			$this->load->model('LibroVenta_model');
			$this->load->model('Libros_model');

			$usuario = $this->session->userdata('id');

			$librosAct = $this->session->userdata('libros_carrito');


			$ids = [];
			foreach ($librosAct as $key => $value){
				$ids[] = $value["id"];
			}
			
			$libros = $this->Libros_model->cargarLibrosId($ids);

			$datosLibros = [];
			foreach ($libros->result() as $key => $fila){
				$idLibro = $fila->id_libro;
				$datosLibros[$idLibro] = $fila;
			}

			$datosRegistro = [];
			$totalVenta = 0;
			foreach ($librosAct as $key => $value){
				$idAct = $value["id"];
				$cantidadAct = $value["cantidad"];
				$precioAct = $datosLibros[$idAct]->precio_libro;
				$datosLibros[$idAct]->cantidad_libro -= $cantidadAct;

				if($datosLibros[$idAct]->cantidad_libro >= 0){
					$datosRegistro[] = ["id" => $idAct, "cantidad" => $cantidadAct, "precio" => $precioAct, "cantidad_final" => $datosLibros[$idAct]->cantidad_libro];
					$totalVenta += $cantidadAct * $precioAct;
				}
			}

			$idVenta = $this->ResumenVenta_model->insertarVenta($usuario, $totalVenta);
			$this->LibroVenta_model->registrarVentaLibros($idVenta, $datosRegistro);
			foreach ($datosRegistro as $key => $value){
				$idAct = $value["id"];
				$cantidadAct = $value["cantidad_final"];
				$this->Libros_model->actualizarCantidadLibro($idAct, $cantidadAct);
			}

			$this->cancelarCompra();

			$msjCreacion = array("msj_function" => "1");
			$this->session->set_userdata($msjCreacion);
			redirect(base_url());
		}
		else{
			redirect(site_url("carro_compras"));
		}
	}
}
