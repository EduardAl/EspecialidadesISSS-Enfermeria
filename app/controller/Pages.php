<?php
	class Pages extends Controller{
		public function __construct(){
		}
		public function index(){
			$this->vista('pages/inicio');
		}
        public function report(){
			$this->vista('pages/urologia_view');
		}
		public function Settings(){
			$this->vista('pages/configuracion');
		}
		public function Error(){
			if(isset($_SESSION['error']))
				$this->vista('pages/errorNotFound');
			else
				header('Location:'.RUTA_URL."/Pages/index");
		}
	}
?>