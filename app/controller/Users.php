<?php
	class Users extends Controller{
		public function __construct(){
		}
		public function index(){
			$datos = $this->modelo("UsersModel")->cargarTabla();
			$this->vista('pages/users',$datos);
		}
	}
?>