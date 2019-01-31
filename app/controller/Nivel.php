<?php
	class Nivel extends Controller{
		/*
			*****************
				Públicas
			*****************
								*/
		public function __construct(){
			}
		// Función por defecto
		public function index(){
			$this->vista('pages/inicio');
			}
		public function Administracion(){		
			//$datos = (isset($_POST['cbInforme']))?$this->cargarNiveles($_POST):['Sin Datos'];	
			$this->vista('Pages/Administracion');
		}
		public function Graficas(){		
			$datos = (isset($_POST['cbInforme']))?$this->cargarNiveles($_POST):['Sin Datos'];	
			$this->vista('Pages/Niveles',$datos);
		}
		// Para cargar la vista de los niveles
		public function level ($num_registro=''){
			$fecha1 = (isset($_POST['fecha1']))?$_POST['fecha1']:date("Y/m/d");
			$fecha2 = (isset($_POST['fecha2']))?$_POST['fecha2']:date("Y/m/d");
			$tipo = (isset($_POST['cbOrdenar'])?$_POST['cbOrdenar']:'Month');
			$separador = (isset($_POST['cbSeparador'])?$_POST['cbSeparador']:'1');
			$tiempo = [
				'tipo'=>$tipo,
				'fecha1'=>$fecha1,
				'fecha2'=>$fecha2,
				'separador'=>$separador,
			];
			unset($_SESSION['temp']);
      		$_SESSION['temp'] = $tiempo;
			header('Location:'.RUTA_URL."/Nivel/Niveles/$num_registro");
		}
		public function niveles($num_registro=''){
			if(isset($_SESSION['temp'])){
				$tiempo = $_SESSION['temp'];
				$fechaT="Mes Actual";
				if($tiempo['tipo']=="Year"){
					$fechaT="Año Actual";
				}
				else if($tiempo['tipo']=="Per"){
					$tiempo['fecha1']=date("Y-m-d",strtotime($tiempo['fecha1']));
					if($tiempo['separador']!=1){
						$aux = new DateTime(date("Y-m-1",strtotime($tiempo['fecha1'])));
						$tiempo['fecha1']=date("Y-m-01",strtotime($tiempo['fecha1']));
						$diferencia = $aux->diff(new DateTime(date("Y-m-01",strtotime($tiempo['fecha2']))));
						$meses = ( $diferencia->y * 12 ) + $diferencia->m;
						if($meses>=12){
							$aux->add(new DateInterval('P11M'));
							$tiempo['fecha2']=$aux->format('Y-m-01');
						}
						$tiempo['fecha2']=date("Y-m-t",strtotime($tiempo['fecha2']));
					}
					$fechaT="Desde <em>".$tiempo['fecha1']."</em> hasta <em>".$tiempo['fecha2']."</em>";
				}
				setlocale(LC_ALL, "es_ES");
				$datos = $this->cargarDatosNivel($num_registro,$tiempo);
				$datos['fechaT'] =$fechaT;
				$datos['tiempo']=$tiempo;
			}
			else{
				$datos = $this->cargarDatosNivel($num_registro);
				$datos['fechaT'] ='Mes Actual';
			}
			unset($_SESSION['temp']);
			$num=(int)$num_registro;
			if($num>0)
				$num='nivel'.$num;
			else
				$num=$num_registro;
			$this->vista('levels/'.$num,$datos);
			}
		//Para cargar las especialidades
		public function especialidad($especialidad=''){

			$fecha1 = (isset($_POST['fecha1']))?$_POST['fecha1']:date("Y/m/d");
			$fecha2 = (isset($_POST['fecha2']))?$_POST['fecha2']:date("Y/m/d");
			$tipo = (isset($_POST['cbOrdenar'])?$_POST['cbOrdenar']:'Month');
			$separador = (isset($_POST['cbSeparador'])?$_POST['cbSeparador']:'1');
			$tiempo = [
				'tipo'=>$tipo,
				'fecha1'=>$fecha1,
				'fecha2'=>$fecha2,
				'separador'=>$separador
			];
      		$_SESSION['tiempo'] = $tiempo;
			unset($_SESSION['tiempo']);
      		$_SESSION['tiempo'] = $tiempo;
			header('Location:'.RUTA_URL."/Nivel/Especialidades/$especialidad");
			}
		public function especialidades($especialidad=''){
			//Buscar un modo de conseguir la especialidad
			$datos=null;
			$bool = false;
			if($especialidad!='')
			{
				if(isset($_SESSION['tiempo'])){
					$tiempo = $_SESSION['tiempo'];
					if($tiempo['tipo']=="Year"){
						$fechaT="Año Actual";
					}
					else if($tiempo['tipo']=="Per"){
						$tiempo['fecha1']=date("Y-m-d",strtotime($tiempo['fecha1']));
						if($tiempo['separador']!=1){
							$aux = new DateTime(date("Y-m-1",strtotime($tiempo['fecha1'])));
							$diferencia = $aux->diff(new DateTime(date("Y-m-01",strtotime($tiempo['fecha2']))));
							$meses = ( $diferencia->y * 12 ) + $diferencia->m;
							if($meses>=12){
								$aux->add(new DateInterval('P11M'));
								$tiempo['fecha2']=$aux->format('Y-m-01');
							}
							$tiempo['fecha2']=date("Y-m-t",strtotime($tiempo['fecha2']));
						}
						$fechaT="Desde <em>".$tiempo['fecha1']."</em> hasta <em>".$tiempo['fecha2']."</em>";
					}
					else{
						$fechaT="Mes Actual";
						$tiempo['separador']='1';
					}
					setlocale(LC_ALL, "es_ES");
					$special=$this->modelo('ProceduresDataModel')->nombreEspecialidad($especialidad);
					if(isset($special->name)){
						$special=$special->name;
						$datos = [
							'datos1'=>$this->cargarProcedimientos($special,$tiempo),
							'datos2'=>$this->cargarDatosEspecialidades($special,$tiempo),
							'fechaT'=>$fechaT,
							'tiempo'=>$tiempo,
							'name'=>$especialidad,
							'especialidad'=>$special,
							'recarga'=>$especialidad,
						];
						$bool=true;
					}
				}
				else{
					unset($_SESSION['tiempo']);
					$special=$this->modelo('ProceduresDataModel')->nombreEspecialidad($especialidad);
					if(isset($special->name)){
						$special=$special->name;
						$datos = [
							'datos1'=>$this->cargarProcedimientos($special),
							'datos2'=>$this->cargarDatosEspecialidades($special),
							'fechaT'=>'Mes Actual',
							'name'=>$especialidad,
							'especialidad'=>$special
						];
						$bool=true;
					}		
				}
			}
			if($bool){
				$this->vista('especialidades/especialidades',$datos);
			}
			else{
				header('Location:'.RUTA_URL."/Nivel/");
			}
		}
			
		/*
			*****************
				Privadas
			*****************
								*/
		//Carga la tabla y gráfico
		private function cargarProcedimientos($nombre,$tiempo=0){
			return $this->modelo('ProceduresDataModel')->procedimientos($nombre,$tiempo);
			}

		private function cargarDatosEspecialidades($nombre,$tiempo=0){
			//Modificar los títulos
			$param = $this->modelo('ProceduresDataModel')->datosEspecialidades($nombre,$tiempo);
			$datos=[
				'values' => $param,
				'titulo' => ['Actividad','Cantidad'],
			];
			return $datos;
			}

		private function cargarNiveles($params){
			setlocale(LC_ALL, "es_ES");
			$fecha1=date('Y-m-1');
			$fecha2=date('Y-m-t');
			if(isset($params['cbFecha'])){
				if($params['cbFecha']=='Per'){
					$fecha1=date("Y-m-d",strtotime($params['fecha1']));

					if(isset($params['cbSeparador'])&&$params['cbSeparador']!=1){
						$fecha1=date("Y-m-01",strtotime($params['fecha1']));
						$params['fecha2']=date("Y-m-t",strtotime($params['fecha2']));
						$aux = new DateTime(date("Y-m-1",strtotime($params['fecha1'])));
						$diferencia = $aux->diff(new DateTime(date("Y-m-01",strtotime($params['fecha2']))));
						$meses = ( $diferencia->y * 12 ) + $diferencia->m;
						if($meses>=12){
							$aux->add(new DateInterval('P11M'));
							$params['fecha2']=$aux->format('Y-m-t');
						}
					}
					$fecha2=date("Y-m-d",strtotime($params['fecha2']));
				}
				else if ($params['cbFecha']=='Year'){
					$fecha1=date("Y-01-01");
					$fecha2=date("Y-12-31");
					$datos['fecha']='Año Actual';
				}
			}
			if(isset($params['cbSeparador'])){
				$nuevo['separador']=$params['cbSeparador'];
				$datos['fecha']="Desde <em>".$fecha1."</em> hasta <em>".$fecha2."</em>";
			}
			else
				$nuevo['separador']=1;
			$nuevo['tipo']=$params['cbFecha'];
			$nuevo['fecha1']=$fecha1;
			$nuevo['fecha2']=$fecha2;
			switch ($params['cbInforme']) {
				case 'indicadores':
					$datos['indicadores']=$this->modelo('ProceduresDataModel')->indicadores($nuevo);
					$datos['cargado']=1;
					break;
				case 'pPacientes':
					$datos['pPacientes']=$this->modelo('ProceduresDataModel')->pPacientes($nuevo);
					$datos['cargado']=2;
					break;
				case 'ausentismo':
					$datos['ausentismo'] = $this->modelo('ProceduresDataModel')->ausentismo($nuevo);
					$datos['cargado']=3;
					break;
				case 'eduSalud':
					$datos['eduSalud']=$this->modelo('ProceduresDataModel')->salud($nuevo);
					$datos['cargado']=4;
					break;
				case 'eduCharlas':
					$datos['eduCharlas']=$this->modelo('ProceduresDataModel')->charlas($nuevo);
					$datos['cargado']=5;
					break;
				case 'eduContinua':
					$datos['eduContinua']=$this->modelo('ProceduresDataModel')->continua($nuevo);
					$datos['cargado']=6;
					break;
				case 'eduEpidemiologia':
					$datos['eduEpidemiologia']=$this->modelo('ProceduresDataModel')->continuaEpidemiologia($nuevo);
					$datos['cargado']=7;
					break;
				case 'eduOftalmologia':
					$datos['eduOftalmologia']=$this->modelo('ProceduresDataModel')->continuaOftalmologia($nuevo);
					$datos['cargado']=8;
					break;
				case 'administracion':
					$datos['administracion'] = $this->modelo('ProceduresDataModel')->administracion($nuevo);
					$datos['cargado']=9;
					break;
				case 'reuniones':
					$datos['reuniones'] = $this->modelo('ProceduresDataModel')->reuniones($nuevo);
					$datos['cargado']=10;
					break;
				default:
					$datos[]='';
					break;
			}
			return $datos;
		}
		private function cargarDatosNivel($nivel,$tiempo=0){
			if(($nivel>=4&&$nivel<=7)||strtolower($nivel)=='deptoenfermeria'){
				$level=($nivel==4)?'1':(($nivel==5)?'2':(($nivel==6)?'3':(($nivel==7)?'4':'5')));

				return $this->modelo('ProceduresDataModel')->cargarDatosNivel($level,$tiempo);
			}
			else if(strtolower($nivel)=='epidemiologia'){
				setlocale(LC_ALL, "es_ES");
				if(isset($_SESSION['acceso'])&&
						($_SESSION['acceso']==1||$_SESSION['acceso']==2||$_SESSION['acceso']==3))
				{
					$model = $this->modelo('MantenimientosModel');
					$datos['epidemiology']=$model->epidemiology();
				}
				$model = $this->modelo('ProceduresDataModel');
				$datos['epidemiologia']=$model->epidemiologia($tiempo);
				return $datos;
			}
			return null;
		}

	}
?>