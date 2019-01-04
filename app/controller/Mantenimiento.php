<?php
	class Mantenimiento extends Controller{

		public function __construct(){}

		public function index(){
			$this->vista('pages/inicio');
			}

		public function Ingreso($nivel=''){
			if(isset($_POST['idCharla'])){
				$level = $nivel;
				switch ($level) {
					case 4:
						$nivel = 'cuarto';
						break;
					case 5:
						$nivel = 'quinto';
						break;
					case 6:
						$nivel = 'sexto';
						break;
					case 7:
						$nivel = 'septimo';
						break;				
				}
				$health=$this->modelo('MantenimientosModel')->health_Education($nivel);
				$datos=[
					'health' => $health
				];
				$this->vista('mantenimientos/charlas',$datos);
			}
			else{
				header('Location:'.RUTA_URL.'/Pages/index');
			}
			}

		public function Nivel($nivel=''){
			//Cargamos todo lo que debe tener
			$this->mantenimientoRecarga($nivel);
			}

		public function IngresoNivel($nivel=''){
			//Ingreso de los datos del nivel
			$level = $nivel;
			switch ($level) {
				case 4:
					$nivel = 'cuarto';
					break;
				case 5:
					$nivel = 'quinto';
					break;
				case 6:
					$nivel = 'sexto';
					break;
				case 7:
					$nivel = 'septimo';
					break;				
			}
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
			$this->modelo('MantenimientosModel')->insertarLevelThings($nivel,$data[$i],$_POST[$data[$i]],$tiempo);
			}
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		public function IngresoProcedimiento($nivel='',$especialidad=''){
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarProcedimiento($_POST[$data[$i]],$data[$i],$tiempo);
			}
			$_SESSION['cambiado']=3;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}

		public function IngresoEspecialidad($nivel='',$especialidad=''){
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarSpecialtyThings($especialidad,$data[$i],$_POST[$data[$i]],$tiempo);
			}
			$_SESSION['cambiado']=2;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}

		public function IngresoMeta($nivel='',$especialidad=''){			
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarGoal($especialidad,$data[$i],$_POST[$data[$i]],$tiempo);
			}
			$_SESSION['cambiado']=3;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}

		public function IngresoAusentismo($nivel=''){
			//Esto se divide entre la cantidad de columnas
			$level = $nivel;
			switch ($level) {
				case 4:
					$nivel = 'cuarto';
					break;
				case 5:
					$nivel = 'quinto';
					break;
				case 6:
					$nivel = 'sexto';
					break;
				case 7:
					$nivel = 'septimo';
					break;				
			}		
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarAusentismo($nivel,$data[$i],$_POST[$data[$i]],$tiempo);
			}
			$_SESSION['cambiado']=5;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		public function IngresoAdministrativo($nivel=''){
			//Esto se divide entre la cantidad de columnas
			$level = $nivel;
			switch ($level) {
				case 4:
					$nivel = 'cuarto';
					break;
				case 5:
					$nivel = 'quinto';
					break;
				case 6:
					$nivel = 'sexto';
					break;
				case 7:
					$nivel = 'septimo';
					break;				
			}			
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarAdministrativo($nivel,$data[$i],$_POST[$data[$i]],$tiempo);
			}
			$_SESSION['cambiado']=7;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		public function IngresoCharla($nivel=''){
			//Esto se divide entre la cantidad de columnas
			$level = $nivel;
			switch ($level) {
				case 4:
					$nivel = 'cuarto';
					break;
				case 5:
					$nivel = 'quinto';
					break;
				case 6:
					$nivel = 'sexto';
					break;
				case 7:
					$nivel = 'septimo';
					break;				
			}
			if(isset($_POST['fname'])&&isset($_POST['tipo']))
				$this->modelo('MantenimientosModel')->insertarCharla($nivel,$_POST['fname'],$_POST['tipo'],$_POST['fechaCh']);
			$_SESSION['cambiado']=6;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		public function ActualizarEducacion($nivel='',$id=''){
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				if($_POST[$data[$i]]>0)
					$data2[]=$_POST[$data[$i]];
				else
					$data2[]=0;
			}
			if(isset($data2))
				$this->modelo('MantenimientosModel')->actualizarEducacion($id,$data2);
			$_SESSION['cambiado']=6;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}


		/////////////////////////////////////////////////

		public function RecargarEducacion($nivel=''){
			$_SESSION['cambiado']=6;
			if(isset($_POST['fecha1'])&&isset($_POST['fecha2'])){
				$fecha[]=$_POST['fecha1'];
				$fecha[]=$_POST['fecha2'];
				$_SESSION['fecha']=$fecha;
			}
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
		}


		/////////////////////////////////////////////////

		private function mantenimientoRecarga($nivel=''){
			$datos=null;
			$level = $nivel;
			switch ($level) {
				case 4:
					$nivel = 'cuarto';
					break;
				case 5:
					$nivel = 'quinto';
					break;
				case 6:
					$nivel = 'sexto';
					break;
				case 7:
					$nivel = 'septimo';
					break;				
			}

			if(isset($_SESSION['acceso'])&&
					($_SESSION['acceso']==1||$_SESSION['acceso']==2||$_SESSION['acceso']==3))
			{
				$model = $this->modelo('MantenimientosModel');
				$levelThings = $model->levelThings();
				$especialidades = $model->specialities($nivel);
				$specialty = $model->specialtyThings();
				$procedures = $model->procedures($nivel,$especialidades);
				$absences=$model->absences();
				$health=$model->health_Education($nivel);
				$healthEducation=$model->health_Education_data($nivel);
				$listeners=$model->listeners($nivel);
				$admin=$model->administrative_management();
				$datos=[
					'levelThings' => $levelThings,
					'especialidades' => $especialidades,
					'specialty' => $specialty,
					'procedures' => $procedures,
					'absences' => $absences,
					'health' => $health,
					'education' => $healthEducation,
					'listeners' => $listeners,
					'admin' => $admin,
				];

				if(isset($_SESSION['cambiado']))
				{
					$datos['cargado']=$_SESSION['cambiado'];
					unset($_SESSION['cambiado']);
				}
			}
			$this->vista('mantenimientos/nivel'.$level,$datos);
			}
	}

?>
