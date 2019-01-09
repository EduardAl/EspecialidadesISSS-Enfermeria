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
				$this->modelo('MantenimientosModel')->insertarCharla($nivel,$_POST['fname'],$_POST['tipo'],$_POST['fechaC']);
			$_SESSION['cambiado']=6;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		public function IngresoMetaCharla($nivel=''){
			$tiempo=(isset($_POST['fecha']))?$_POST['fecha']:0;
			unset($_POST['fecha']);
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				$this->modelo('MantenimientosModel')->insertarGoalCharla($data[$i],$_POST[$data[$i]],$tiempo);
			}
			$_SESSION['cambiado']=6;
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}

		public function ActualizarEducacion(){
			if(isset($_POST['id'])){
				$id=$_POST['id'];
				unset($_POST['id']);
			}
			if(isset($_POST['level'])){
				$level=$_POST['level'];
				unset($_POST['level']);
			}
			$datosRecibidos = count($_POST);
			$data = array_keys($_POST);
			for ($i=0; $i < $datosRecibidos; $i++) { 
				if($_POST[$data[$i]]>0)
					$data2[]=$_POST[$data[$i]];
				else
					$data2[]=0;
			}
			if(isset($data2)){
				$this->modelo('MantenimientosModel')->actualizarEducacion($id,$data2);
				$_SESSION['cambiado']=6;
				switch ($level) {
					case 'Cuarto nivel':
						$level=4;
						break;
					case 'Quinto nivel':
						$level=5;
						break;
					case 'Sexto nivel':
						$level=6;
						break;
					case 'Séptimo nivel':
						$level=7;
						break;
				}
				header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}
			else
				header('Location:'.RUTA_URL.'/Pages/index');
			}

		public function ActualizarCharla(){
			//Esto se divide entre la cantidad de columnas
			$nivel=(isset($_POST['level']))?$_POST['level']:'Cuarto nivel';
			$level = $nivel;
			switch ($level) {
				case 'Cuarto nivel':
					$nivel = 4;
					break;
				case 'Quinto nivel':
					$nivel = 5;
					break;
				case 'Sexto nivel':
					$nivel = 6;
					break;
				case 'Séptimo nivel':
					$nivel = 7;
					break;				
			}
			if(isset($_POST['fname'])&&isset($_POST['tipo'])){
				$this->modelo('MantenimientosModel')->actualizarCharla($level,$_POST);
					$_SESSION['cambiado']=6;
					header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
			}
			else{
				header('Location:'.RUTA_URL.'/Pages/index/');
			}
			}	

		public function ConfigurarAusentismo($nivel=''){
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
				if($_POST[$data[$i]]>0)
					$data2[]=$_POST[$data[$i]];
				else
					$data2[]=0;
			}
			if(isset($data2)){
				$this->modelo('MantenimientosModel')->configurarAusentismo($nivel,$data2,$fecha);
				$_SESSION['cambiado']=5;
				}
				header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$level);
			}

		/////////////////////////////////////////////////

		public function RecargarEducacion($nivel=''){
			$_SESSION['cambiado']=6;
			if(isset($_POST['fecha1'])&&isset($_POST['fecha2'])){
				$fecha['fecha1']=$_POST['fecha1'];
				$fecha['fecha2']=$_POST['fecha2'];
				$fecha['tipo']=$_POST['cbOrdenar'];
				$_SESSION['fecha']=$fecha;
			}
			header('Location:'.RUTA_URL.'/Mantenimiento/Nivel/'.$nivel);
		}

		public function ActualizarDatos(){
			if(isset($_POST['extra'])){
				$model = $this->modelo('MantenimientosModel');
				$charla = $model->education($_POST['extra']);
				$listener = $model->listeners();
				$health = $model->health_education($charla->nivel);
				$datos=[
					'Charla'=> $charla,
					'Listeners'=>$listener,
					'health'=>$health,
				];
				$this->vista('mantenimientos/charlas',$datos);
			}
			else
				header('Location:'.RUTA_URL.'/Pages/index/');
		}

		/////////////////////////////////////////////////

		private function mantenimientoRecarga($nivel=''){
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
				$absencesConfig=$model->absences_config();
				$health=$model->health_Education($nivel);
				$healthEducation=$model->health_Education_data($nivel);
				$admin=$model->administrative_management();
				$datos=[
					'levelThings' => $levelThings,
					'especialidades' => $especialidades,
					'specialty' => $specialty,
					'procedures' => $procedures,
					'absences' => $absences,
					'health' => $health,
					'education' => $healthEducation,
					'admin' => $admin,
					'absences_config' =>$absencesConfig,
				];

				if(isset($_SESSION['cambiado']))
				{
					$datos['cargado']=$_SESSION['cambiado'];
					unset($_SESSION['cambiado']);
				}
				$this->vista('mantenimientos/nivel'.$level,$datos);
			}
				$this->vista('mantenimientos/nivel/noDefinido');
			}
	}

?>
