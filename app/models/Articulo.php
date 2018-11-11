<?php
	class Articulo
	{
		//Propiedades
		private $db;	
		public function __construct()
		{
			$this->db = new Base;
		}

		public function obtenerArticulos(){
			$this->db->query("SELECT fname FROM users");
			return $this->db->registros();
		}
	}
?>