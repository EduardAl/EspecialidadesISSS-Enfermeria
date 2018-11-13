<?php
	class Nivel extends Controller{
		public function __construct(){
		}
		public function index(){
			$this->vista('pages/inicio');
		}
		public function niveles($num_registro){
			$this->vista('levels/nivel'.$num_registro);
		}
		public function especialidad($num_registro,$especialidad){
			$this->vista('especialidades/nivel'.$num_registro.'/'.$especialidad);
		}
		public function mantenimiento($num_registro){
			$this->vista('mantenimientos/nivel'.$num_registro);
		}
		public function articulo(){
			$this->vista('pages/articulo');
		}
	}
?>