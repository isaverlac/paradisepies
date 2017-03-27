<?php

require_once("model/usuario.php");
require_once("model/UsuarioFactory.php");
#require_once("model/pedido.php");
#require_once("model/PedidoFactory.php");
class Controller {
	private $usuarioFactory;
	private $pedidoFactory;

	public function __construct() 	{
		$this->usuarioFactory = new usuarioFactory();
#		$this->pedidoFactory = new PedidoFactory();

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
			case 'cadastra_usuario':
				$this->cadastra_usuario();
				break;

			case 'login':
				$this->login();
				break;

			case 'perfil':
				$this->perfil();
				break;

			case 'alterar_dados':
				$this->alterar_dados();
				break;

			case 'login_usuario':
				$this->login_usuario();
				break;

			case 'alterar_endereco':
				$this->alterar_endereco();
				break;

			case 'alterar_email':
				$this->alterar_email();
				break;

			case 'alterar_senha':
				$this->alterar_senha();
				break;

			case 'fazer_pedido':
				$this->fazer_pedido();
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

	public function login() {
		require 'view/login.html';
	}

	public function alterar_dados() {
		require 'view/alterarDados.html';
	}

	public function perfil() {
		require 'view/perfil.html';
	}

	public function cadastra_usuario() {
		if (isset($_POST['submit'])) {
			$nome = $_POST['nome'];
			$cpf = $_POST['cpf'];
			$telefone = $_POST['tel'];
			$cidade = $_POST['city'];
			$cep = $_POST['cep'];
			$endereco = $_POST['end'];
			$numeroEndereco = $_POST['n'];
			$complementoEndereco = $_POST['comp'];
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			$sucesso = false;

			try {
				if ($nome == "" || $cpf == "" || $telefone == "" || $cidade == "" || $cep == "" || $endereco == ""
					|| $numeroEndereco == "" || $email == "" || $senha == "")
					throw new Exception('Erro');

				$usuario = new usuario($nome, $cpf, $telefone, $cidade, $cep, $endereco, $numeroEndereco,
									   $complementoEndereco, $email, $senha);

				//Consulta o cpf no banco para verificar se o usuário já não está cadastrado
				$result = $this->usuarioFactory->buscar($cpf);

				//Se o resultado for igual a 0 itens, então cadastra o usuário
				if(count($result) == 0) {
					$sucesso = $this->usuarioFactory->salvar($usuario);
				}
				echo $sucesso;

				if ($sucesso) {
                    $msg = "<p>O usu&aacute;rio " . $nome . " (" . $email . ") foi cadastrado com sucesso!</p>";
                    require 'view/mensagem.php';
                } else {
                    $msg = "<p>O usu&aacute;rio n&atilde;o foi adicionado. Tente novamente mais tarde!</p>";
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
                require 'view/mensagem.php';
            }
		}
	}

	public function login_usuario() {
		if (isset($_POST['submit'])) {
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			$result = false;
			try {
				if($email == "" || $senha == "" )
					throw new Exception('Erro');

				$result = $this->usuarioFactory->login($email, $senha);

				if($result == null) {
					$msg = "O login falhou, tente novamente!";
					require'view/mensagem.php';
				} else {
					session_start("paradisepies");
					$_SESSION["id_usuario"]=$result[0]->getCpf();

					$this->perfil();
				}

			} catch (Exception $e) {
				if ($email == "") {
                    $msg = "O campo <strong>E-mail</strong> deve ser preenchido!";
                } else if ($senha == "") {
                    $msg = "O campo <strong>Senha</strong> deve ser preenchido!";
                }
                require 'view/mensagem.php';
			}
		}
	}

	public function alterar_endereco() {
		if (isset($_POST['submit'])) {
			$cidade = $_POST['cidade'];
			$cep = $_POST['cep'];
			$endereco = $_POST['end'];
			$numeroEndereco = $_POST['n'];
			$complementoEndereco = $_POST['comp'];
			$result = false;

			try {
				if ($cep == "" || $endereco == "" || $numeroEndereco == "")
					throw new Exception('Erro');

				if ($complementoEndereco == "") {
					$result = $this->usuarioFactory->alterar_endereco($cpf, $cidade, $cep, $endereco, $numeroEndereco,
							null);
				} else {
					$result = $this->usuarioFactory->alterar_endereco($cpf, $cidade, $cep, $endereco, $numeroEndereco,
							$complementoEndereco);
				}


				if(!$result) {
					$msg = "Não foi possível alterar seu endereço, tente novamente!";
					require'view/mensagem.php';
				}
				else {
					$msg = "Endereco alterado com sucesso!";
					require'view/mensagem.php';
				}

				unset($cidade);
               	unset($cep);
               	unset($endereco);
               	unset($numeroEndereco);
               	unset($complementoEndereco);
			} catch (Exception $e) {
				if ($cep == "") {
                    $msg = "O campo <strong>Cep</strong> deve ser preenchido!";
                } else if ($endereco == "") {
                    $msg = "O campo <strong>Endereço</strong> deve ser preenchido!";
                } else if ($numeroEndereco == "") {
                    $msg = "O campo <strong>N$uacute;mero</strong> deve ser preenchido!";
                }
                require 'view/mensagem.php';
			}


		}
	}

	public function alterar_email() {
		session_start("paradisepies");

		if(isset($_POST['submit'])) {
			$email = $_POST['email'];
			$result = false;

			try {
				if($email == "" )
					throw new Exception('Erro');

				$sucesso = $this->usuarioFactory->alterar_email($_SESSION["id_usuario"], $email);

				if(!$sucesso) {
					$msg = "Não foi possível alterar seu e-mail, tente novamente!";
					require'view/mensagem.php';
				}
				else {
					$msg = "E-mail alterado com sucesso!";
					require'view/mensagem.php';
				}

				unset($email);
        unset($senha);

			} catch (Exception $e) {
				if ($email == "") {
                    $msg = "O campo <strong>Email</strong> deve ser preenchido!";
                }
                require 'view/mensagem.php';
			}
		}
	}

	public function alterar_senha() {
		session_start("paradisepies");

		if(isset($_POST['submit'])) {

			$senha = $_POST['senha'];
			$result = false;

			try {
				if($senha == "" )
					throw new Exception('Erro');

				$sucesso = $this->usuarioFactory->alterar_senha($_SESSION["id_usuario"], $senha);

				if(!$sucesso) {
					$msg = "Não foi possível alterar sua senha, tente novamente!";
					require'view/mensagem.php';
				}
				else {
					$msg = "Senha alterada com sucesso!";
					require'view/mensagem.php';
				}

				unset($email);
        unset($senha);

			} catch (Exception $e) {
				if ($senha == "") {
                    $msg = "O campo <strong>Senha</strong> deve ser preenchido!";
                }
                require 'view/mensagem.php';
			}
		}
	}

	public function fazer_pedido() {
		require'view/'; #pag de fazer o pedido
	}

	public function adicionar_torta() {
		if (isset($_POST['submit'])) {
			$torta = $_POST['torta'];
			$preco = $_POST['preco'];
			$sucerro = false;

			try {
				if($torta == "" || $preco == "")
					throw new Exception('Erro');


			} catch (Exception $e) {
				if ($torta == "" ) {
                    $msg = "O campo <strong>Torta</strong> deve ser preenchido!";
                } else if($preco == "") {
                	 $msg = "O campo <strong>Preço</strong> deve ser preenchido!";
                }
                require 'view/mensagem.php';
			}
		}
	}

	public function finalizar_pedido() {



	}


}
?>
