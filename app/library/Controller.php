<?php
	//Clase controlador principal
	//Se encarga de cargar los modelos y las vistas
	class Controller{
		//Carga modelo
		public function modelo($model){
			require_once '../app/models/'.$model.'.php';
			return new $model();
		}
		//Carga vista
		public function vista($view,$datos=[]){
			//Verificar si la vista existe
			if (file_exists('../app/views/'.$view.'.php')) {
			require_once '../app/views/'.$view.'.php';
			}
			else{
				require_once '../app/views/pages/errorNotFound.php';
			}
		}
		public function vistaPost($view,$datos=[]){
			//Verificar si la vista existe
			if (file_exists('../app/views/'.$view.'.php')) {
			header('Location:'.RUTA_URL.'/'.$view);
			}
			else{
				require_once '../app/views/pages/errorNotFound.php';
			}
		}
		public function exec(){
			
		}
	}
?>