<?php
	class Pages extends Controller{
		public function __construct(){
			$this->articuloModelo = $this->modelo('Articulo');
		}
		public function index(){
			$articulos = $this-> articuloModelo->obtenerArticulos();
			/* Para pasar parámetros*/
			$datos = [
				'titulo' => 'Bienvenidos a MVC',
				'articulos' => $articulos
			];
			$this->vista('pages/inicio',$datos);
		}
		public function articulo(){
			$this->vista('pages/articulo');
		}
		public function actualizar($num_registro){
			echo $num_registro;
		}
	}
?>