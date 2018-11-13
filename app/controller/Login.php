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
      $this->vista('login/login');
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
      $this->vista('pages/inicio');
    }
    else{
      $this->vista('pages/inicio');
    }

  }

  public function signout()
  {
    //Primero requeriremos los parametros
    $this->session->close();
    $this->vista('login/login');
  }

  public function newUser(){
    $this->model->newUser();
  }

  private function verify($request_params)
  {
    return empty($request_params['email']) OR empty($request_params['password']);
  }

  private function renderErrorMessage($message)
  {
    $params = array('error_message' => $message);
   $this->vista('Login/login',$message);
  }

}