<?php
	class Pages extends Controller{
		public function __construct(){
		}
		public function index(){
			$this->vista('pages/inicio');
		}
		public function Users(){
			$this->vista('pages/users');
		}
		public function Settings(){
			$this->vista('pages/configuracion');
		}
	}
?>