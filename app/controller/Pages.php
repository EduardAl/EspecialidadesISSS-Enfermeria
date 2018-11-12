<?php
	class Pages extends Controller{
		public function __construct(){
			$this->articuloModelo = $this->modelo('Articulo');
		}
		public function index(){
			$this->vista('pages/inicio');
		}
	}
?>