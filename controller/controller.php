<?php 

require_once("mode/usuario.php");
require_once("model/UsuarioFactory.php");
require_once("model/pedido.php");
require_once("model/PedidoFactory.php");
class Controller {
	private $usuarioFactory;
	private $pedidoFactory;

	public function Controller() 	{
		$this->usuarioFactory = new usuarioFactory();
		$this->pedidoFactory = new PedidoFactory();

		ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
	}

	public function init() 	{
		
		if (isset($_GET['op'])) {
		    $op = $_GET['op'];
		} else {
		    $op = "";
		}

		switch ($op) {
			case 'usuario':
				$this->usuario();
				break;

			case 'cadastra_usuario':
				$this->cadastro_usuario();
				break;
			
			case 'login_usuario':
				$this->login_usuario();
				break;	
			
			case 'acompanhar_pedido':
				$this->acompanhar_pedido();
				break;	

			case 'finalizar_pedido':
				$this->finalizar_pedido();
				break;

			default:
		        $this->index();
		        break;
		}	
	}

	public function index()	{
		require 'view/index.html';
	}

	public function usuario() {
		require 'view/'
	}

	public function casdastra_usuario() {
		if (isset($_POST['submit'])) {
			$nome = $_POST['nome'];
			$cpf = $_POST['cpf'];
			$telefone = $_POST['tel'];
			$cidade = $_POST['cidade'];
			$cep = $_POST['cep'];
			$endereco = $_POST['end'];
			$numeroEndereco = $_POST['numeroEnd'];
			$complementoEndereco = $_POST['comp'];
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			$sucesso = false;
			
			try {
				if ($nome == "" !! $cpf == "" !! $telefone == "" !! $cidade == "" !! $cep == "" !! $endereco == "" 
					!! $numeroEndereco == "" !! $email == "" !! $senha == "")
					trow new Exception('Erro');

				$usuario = new usuario($nome, $cpf, $telefone, $cidade, $cep, $endereco, $numeroEndereco, 
									   $complementoEndereco, $email, $senha);

				$result = $this->usuarioFactory->buscar($cpf);

				if(count($result) == 0) {
					$sucesso = $this->usuarioFactory->salvar($usuario);
				}
				echo sucesso;

				 if ($sucesso) {
                    $msg = "<p>O usu$acute;rio " . $nome . " (" . $email . ") foi cadastrado com sucesso!</p>";
                } else {
                    $msg = "<p>O usu$acute;rio n&atilde;o foi adicionado. Tente novamente mais tarde!</p>";
                }

                unset($nome);
                unset($cpf);
                unset($telefone);
               	unset($cidade);
               	unset($cep);
               	unset($endereco);
               	unset($numeroEndereco);
               	unset($complementoEndereco);
                unset($email);
                unset($senha);

                require 'view/mensagem.php';
            } catch (Exception $e) {
                if ($nome == "") {
                    $msg = "O campo <strong>Nome</strong> deve ser preenchido!";
                } else if ($cpf == "") {
                    $msg = "O campo <strong>Cpf</strong> deve ser preenchido!";
                } else if ($telefone == "") {
                    $msg = "O campo <strong>Telefone</strong> deve ser preenchido!";
                } else if ($cidade == "") {
                    $msg = "O campo <strong>Cidade</strong> deve ser preenchido!";
                } else if ($cep == "") {
                    $msg = "O campo <strong>Cep</strong> deve ser preenchido!";
                } else if ($endereco == "") {
                    $msg = "O campo <strong>Endereco</strong> deve ser preenchido!";
                } else if ($numeroEndereco == "") {
                    $msg = "O campo <strong>N$uacute;mero</strong> deve ser preenchido!";
                }  else if ($complementoEndereco == "") {
                    $msg = "O campo <strong>Complemento</strong> deve ser preenchido!";
                } else if ($email == "") {
                    $msg = "O campo <strong>E-mail</strong> deve ser preenchido!";
                } else if ($senha == "") {
                    $msg = "O campo <strong>Senha</strong> deve ser preenchido!";
                }
                require 'View/mensagem.php';
            }
		}
	}
	
	public function login_usuario() {
		if (isset($_POST['submit'])) {
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			$result = false;
			try {
				if($email = "" || $senha = "" )
					trow new Exception('Erro');

			$result = $this->usuarioFactory->login($email, $senha);

			if(!$result) {
				require'view/';
			}


			} catch (Exception $e) { 
				if ($email == "") {
                    $msg = "O campo <strong>E-mail</strong> deve ser preenchido!";
                } else if ($senha == "") {
                    $msg = "O campo <strong>Senha</strong> deve ser preenchido!";
                }
                require 'view/mensagem.pgp';
		}
	}

	public function acompanhar_pedido() {
		//TODO
	}

	public function finalizar_pedido() {
		//TODO
	}


}
?>