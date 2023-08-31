<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "conect.php";
require_once "AdminAuthenticationHandler.php";
require_once 'LogSingleton.php';
require_once "cadastrosStrategy.php";
require_once "editarUsuario.php";
require_once "login.php";
require_once "excluirUsuario.php";
class Facade
{   
    public $excluirUsuario;
    public $loginUsuario;
    public $editarUsuario;
    public $cadastroStrategy2;
    public $cadastroStrategy;
    public $adminHandler;
    public $userHandler;

    public function __construct()
    {
        $this->adminHandler = new AdminAuthenticationHandler();
        $this->userHandler = new UserAuthenticationHandler();
        $this->adminHandler->setSuccessor($this->userHandler);
        $this->cadastroStrategy = new CadastroPadrao();
        $this->cadastroStrategy2 = new CadastroAdm();
        $this->editarUsuario = new editarUsuario();
        $this->loginUsuario = new Login();
        $this->excluirUsuario = new excluirUsuario();
    }

    public function login($email, $senha)
    {
        $this->loginUsuario->login($email, $senha);
    }
    public  function excluirUsuario($id)
    {
        $this->excluirUsuario->excluir($id);
    }

    public function editarUser($nomeAtualizado, $emailAtualizado, $dataNascimentoAtualizado, $senhaAtualizado)
    {
        $this->editarUsuario->editar($nomeAtualizado, $emailAtualizado, $dataNascimentoAtualizado, $senhaAtualizado);
    }
    public function cadastrarUsuario($nome, $senha, $email, $data, $cpf)
    {
        return $this->cadastroStrategy->cadastrar($nome, $senha, $email, $data, $cpf);
    }
    public function cadastrarAdm($nome, $senha, $email, $data, $cpf)
    {
        return $this->cadastroStrategy2->cadastrar($nome, $senha, $email, $data, $cpf);
    }


}


?>