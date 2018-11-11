<?php
	class Nivel extends Controller{
		public function __construct(){
			$this->articuloModelo = $this->modelo('Articulo');
		}
		public function index(){
			$this->vista('pages/inicio');
		}
		public function niveles($num_registro){
			$this->vista('levels/nivel'.$num_registro);
		}
		public function articulo(){
			$this->vista('pages/articulo');
		}
		public function actualizar($num_registro){
			echo $num_registro;
		}
	}
?>