<?php
	//Mapea la url ingresada en el navegador cmp
	class Core{
		//Propiedades
		protected $controladorActual = 'Login';
		protected $metodoActual = 'index';
		protected $parametros = [];
		//Constructor
		public function __construct(){
			try{
			session_start();
			$url = $this->getUrl();
			if(isset($_SESSION['email']))
			{
				//Buscar si el controlador existe
				if(file_exists("../app/controller/".ucwords($url[0]).'.php')){
					//Si existe se configura como controlador por defecto
					$this->controladorActual = ucwords($url[0]);
					//Desmontamos el controlador actual
					unset($url[0]);
				}
				//Requerimos el controlador
				require_once '../app/controller/'.$this->controladorActual.'.php';
				$this->controladorActual = new $this->controladorActual;
				//Verificamos que exista el método en la url
				if(isset($url[1]))
				{
				//Verificamos la segunda parte de la url (el método)
					if (method_exists($this->controladorActual, $url[1])) {
						//Se configura el método
						$this->metodoActual = $url[1];
						//Desmontamos el método actual
						unset($url[1]);
					}
				}
				//Obtenemos los parámetros
				$this->parametros = $url ? array_values($url):[];
				//Llamar con parametros array
				$response = call_user_func_array([$this->controladorActual,$this->metodoActual],$this->parametros);
			}
			else
			{
				if(ucwords($url[0])=='Recuperacion'){
					unset($url[0]);
					require_once '../app/controller/'.$this->controladorActual.'.php';
					$this->controladorActual='Recuperacion';
				}
				require_once '../app/controller/'.$this->controladorActual.'.php';
				$this->controladorActual = new $this->controladorActual;
				if(isset($url[1]))
				{
					if($url[1]=='signin')
					{
						$this->metodoActual = $url[1];
						unset($url[1]);
					}
					else{
						if (method_exists($this->controladorActual, $url[1])) {
							//Se configura el método
							$this->metodoActual = $url[1];
							//Desmontamos el método actual
							unset($url[1]);
						}
					}
				}
				$this->parametros = ('signin'==$url) ? 'signin':[];
				call_user_func_array([$this->controladorActual,$this->metodoActual],$this->parametros);
			}
			}
			catch(Exception $exe){
				
			}
		}
		//Funciones
		public function getUrl(){
			if (isset($_GET['url'])) {
				//rtrim corta los espacios hacia la derecha
				$url = rtrim($_GET['url'],"/");
				$url = filter_var($url,FILTER_SANITIZE_URL);
				$url = explode("/",$url);
				return $url;
			}
		}
	}
?>