<?php
	class Users extends Controller{
		public function __construct(){
		}
		public function index(){
			$datos = $this->modelo("UsersModel")->cargarTabla();
			$this->vista('pages/users',$datos);
		}
		public function newUser(){
			if(isset($_POST)){
				try{
			    	$this->modelo('UsersModel')->newUser($_POST);
					header('Location:'.RUTA_URL.'/Users');
			    }
			    catch(Exception $exe)
			    {
					$datos = $this->modelo("UsersModel")->cargarTabla();
			    	$datos['error_message'] = $exe->getMessage();
    				$this->vista('pages/Users',$datos);
			    }
			}
		}
	}
?>