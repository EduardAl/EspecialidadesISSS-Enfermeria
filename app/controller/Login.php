<?php
class Login extends Controller
{
  private $model;

  private $session;

  public function __construct()
  {
    $this->model = $this->modelo('LoginModel');
    $this->session = new Session;
  }

  public function index(){
    if(!isset($_SESSION))
      session_start();
    if(!isset($_SESSION['email']))
      $this->vista('login/login');
    else
      $this->vista('pages/inicio');

    }
  public function exec()
  {
    $this->render(__CLASS__);
  }

  public function signin()
  {
    if(!isset($_SESSION))
      session_start();
    if(!isset($_SESSION['email']))
    {
      //Primero requeriremos los parametros
      $request_params=[
        'email'=> $_POST['email'],
        'password' => $_POST['password']
      ];
      //Verificamos que no estén vacíos
      if($this->verify($request_params))
        return $this->renderErrorMessage('El email y password son obligatorios');

      //Verificamos que exista el correo
      $result = $this->model->signIn($request_params['email'],$request_params['password']);
      if($this->model->rowCount()!=1)
      {
        return $this->renderErrorMessage("Email o contraseña incorrectos");
      }
      $this->session->add('email', $result->email);
      $this->session->add('nombre', $result->nombre);
      $this->session->add('acceso', $result->tipo);
    }
      header('Location:'.RUTA_URL.'/Login/index');
  }

  public function signout()
  {
    //Primero requeriremos los parametros
    $this->session->close();
    $this->vista('login/login');
  }

  private function verify($request_params)
  {
    return empty($request_params['email']) OR empty($request_params['password']);
  }

  private function renderErrorMessage($message)
  {
    $datos = ['error_message' => $message];
    $this->vista('Login/login',$datos);
  }

}