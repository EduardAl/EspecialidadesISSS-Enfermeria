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
					$this->vista('pages/users',$datos);
			    }
			    catch(Exception $exe)
			    {
			    	$datos = ['error_message' => $exe->message()];
    				$this->vista('pages/Users',$datos);
			    }
			}
		}
	}
?>