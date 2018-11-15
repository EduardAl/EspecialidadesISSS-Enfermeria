<?php
	class Mantenimiento extends Controller{
		public function __construct(){
		}
		public function index(){
			$this->vista('pages/inicio');
		}
		public function Nivel($numero){
			$this->vista('mantenimientos/nivel'.$numero);
		}
		public function Procedimiento($nombre){
			$this->vista('pages/configuracion');
		}
	}

?>
