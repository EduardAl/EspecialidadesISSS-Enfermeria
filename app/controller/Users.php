<?php
	class Users extends Controller{
		public function __construct(){
			}
		public function index(){
			if(isset($_SESSION['acceso'])&&$_SESSION['acceso']==1){
				$datos = $this->modelo("UsersModel")->cargarTabla();
				$this->vista('user/users',$datos);
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
	    				$this->vista('user/Users',$datos);
				    }
				}
			}
			else{
				$_SESSION['error']='No tienes acceso a la página';
				$this->vista('pages/errorNotFound');
			}
			}

		public function actualizar(){
			if(isset($_SESSION['acceso'])&&$_SESSION['acceso']==1){
				if(isset($_POST['extra'])){
					$datos['usuario'] = $this->modelo("UsersModel")->cargarUsuario($_POST['extra']);
					$datos['id']=$_POST['extra'];
					$this->vista('user/actualizarUsuario',$datos);
				}
				else if(isset($_POST['fname'])){
					try{
						$this->modelo("UsersModel")->updateUser($_POST);
						//header('Location:'.RUTA_URL.'/Users');
					}
					catch(Exception $exe){
						$datos['usuario'] = $this->modelo("UsersModel")->cargarUsuario($_POST['id']);
				    	$datos['error_message'] = $exe->getMessage();
						$datos['id']=$_POST['id'];
						$this->vista('user/actualizarUsuario',$datos);
					}
				}
				else if(isset($_POST['id'])){
					echo "<br>";
					echo "<br>";
					echo "Entra";
					try{
						$this->modelo("UsersModel")->deleteUser($_POST['id']);
						header('Location:'.RUTA_URL.'/Users');
					}
					catch(Exception $exe){
						$datos['id']=$_POST['id'];
				    	$datos['error_message'] = $exe->getMessage();
						$this->vista('user/actualizarUsuario',$datos);
					}
				}
				else
					header('Location:'.RUTA_URL.'/Users');
			}
			else{
				$_SESSION['error']='No tienes acceso a la página';
				$this->vista('pages/errorNotFound');
			}
			}

		public function actualizarPerfil(){
			if(isset($_POST['fname'])){
				try{
					$this->modelo("UsersModel")->updateUser($_POST);
					header('Location:'.RUTA_URL.'/Login/signout');
				}
				catch(Exception $exe){
					$datos['usuario'] = $this->modelo("UsersModel")->cargarUsuario($_POST['id']);
			    	$datos['error_message'] = $exe->getMessage();
					$datos['id']=$_POST['id'];
					$this->vista('user/miPerfil',$datos);
				}
			}
			else
				header('Location:'.RUTA_URL.'/Pages');
			}

		public function miPerfil(){
			if(isset($_SESSION['email'])){
				$datos['usuario'] = $this->modelo("UsersModel")->cargarUsuario($_SESSION['email'],1);
				$this->vista('user/miPerfil',$datos);
			}
			}
	}
?>