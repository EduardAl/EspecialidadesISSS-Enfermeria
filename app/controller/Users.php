<?php
	class Users extends Controller{
		public function __construct(){
		}
		public function index(){
			if(isset($_SESSION['acceso'])&&$_SESSION['acceso']==1){
				$datos = $this->modelo("UsersModel")->cargarTabla();
				$this->vista('pages/users',$datos);
			}
			else{
				$_SESSION['error']='No tienes acceso a la página';
				$this->vista('pages/errorNotFound');
			}
		}
		public function newUser(){
			if(isset($_SESSION['acceso'])&&$_SESSION['acceso']==1){
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
			else{
				$_SESSION['error']='No tienes acceso a la página';
				$this->vista('pages/errorNotFound');
			}
		}
	}
?>