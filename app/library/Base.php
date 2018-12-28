<?php
	//Clase para conectarse a la base de datos y ejecutar consultas
	class Base{
		private $host=DB_HOST;
		private $user=DB_USER;
		private $password=DB_PASSWORD;
		private $nombre_base=DB_NAME;
		private $port = DB_PORT;

		private $dbh;
		private $st;
		private $error;

		public function __construct(){
			//Configuramos sí se puede modificar todo con sus permisos
			if(isset($_SESSION['email'])){
				$dsn = "mysql:host=".$this->host.';dbname='.$this->nombre_base.';port='.$this->port;
				$opciones = array(
					PDO::ATTR_PERSISTENT => true,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
				);
				//Creamos una instancia
				try {
					$this->dbh = new PDO($dsn,$this->user, $this->password,$opciones);
					//Para caracteres especiales
					$this->dbh->exec('set names utf8');
				} catch (PDOException $e) {
					$this->error = $e->getMessage();
					echo $this->error;
				}
			}
			else{
				header('Location:'.RUTA_URL."/Pages/Error");
			}
		}
		//Prepara la consulta
		public function query($sql){
			$this->st = $this->dbh->prepare($sql);
			}
		//Vincula la consulta con 'bind'
		public function bind($param,$value,$type=null){
			if(is_null($type)){
				switch (true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
					break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
					break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
					break;
					default:
						$type = PDO::PARAM_STR;
					break;
				}
			}
			$this ->st->bindValue($param,$value,$type);
			}
			//Ejecuta la consulta
		public function execute(){
			return $this->st->execute();
			}
		//Un solo registro
		public function registro(){
			$this->execute();
			return $this->st->fetch(PDO::FETCH_OBJ);
			}
		//Varios registros
		public function registros(){
			$this->execute();
			return $this->st->fetchAll(PDO::FETCH_OBJ);
			}
		//Obtiene la cantidad de filas
		public function rowCount(){
			return $this->st->rowCount();
			}
	}