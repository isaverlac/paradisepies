<?php

require_once("model/usuario.php");
require_once("model/UsuarioFactory.php");
require_once("model/pedido.php");
require_once("model/PedidoFactory.php");
require_once("model/TortaFactory.php");

class Controller {
	private $usuarioFactory;
	private $pedidoFactory;
	private $tortaFactory;

	public function __construct() 	{
		$this->usuarioFactory = new UsuarioFactory();
		$this->pedidoFactory = new PedidoFactory();
		$this->tortaFactory = new TortaFactory();

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

			case 'perfil2':
				$this->perfil2();
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

			case 'acompanharPedido':
				$this->acompanharPedido();
				break;

			case 'encomende':
				$this->encomende();
				break;

			default:
		        $this->index();
		        break;
		}
	}

	public function encomende()	{
		require 'view/encomende.html';
	}
	/*
		Só tera acesso quando estiver logado no sistema.
		Verifica no banco de dados quais os Pedidos e mostra na pagina.
	*/
	public function acompanharPedido()	{
		session_start("paradisepies");
		// Retorna uma Matriz, de String, com informações de Pedidos x Informações.
		$result = $this->pedidoFactory->buscar($_SESSION["id_usuario"]);
		
		$nPedidos = count($result);
		for($i=0; $i<$nPedidos; $i++)
		{
			$dataPedido[$i] = $result[$i][1];
			$dataEntrega[$i] = $result[$i][2];
			$pedido[$i] = $result[$i][3];
			$quantidade[$i] = $result[$i][4];
			$status[$i] = $result[$i][5];
		}
	
		require 'view/acompanharPedido.php';
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
	/*
		Pagina do perfil principal após login. 
	*/
	public function perfil2() {
		session_start("paradisepies");
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
				/*
					Obriga as informações do formularia serem diferentes de nula.
					Verificação de formato é feita no proprio HTML.
				*/
				if ($nome == "" || $cpf == "" || $telefone == "" || $cidade == "" || $cep == "" || $endereco == ""
					|| $numeroEndereco == "" || $email == "" || $senha == "")
					throw new Exception('Erro');

				// Cria o objeto usuario.
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
                } else {
                    $msg = "<p>O usu&aacute;rio n&atilde;o foi adicionado. Tente novamente mais tarde!</p>";
                }

                // Limpar variaveis após o uso do formulario.
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
				//Campo e-mail e senha, não podem ser vazios
				if($email == "" || $senha == "" )
					throw new Exception('Erro');

				/*
					Executa a função login, que recebe e-mail e a senha,
					e retorna o usuario, caso o e-mail e senha estejam corretos.
				*/
				$result = $this->usuarioFactory->login($email, $senha);

				if($result == null) {
					$msg = "O login falhou, tente novamente!";
					require'view/mensagem.php';
				} else {
					session_start("paradisepies");
					// Caso o login tenha feito com sucesso, inicia a sessão com o usuario.
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
		session_start("paradisepies");

		if (isset($_POST['submit'])) {
			$cidade = $_POST['city'];
			$cep = $_POST['cep'];
			$endereco = $_POST['end'];
			$numeroEndereco = $_POST['n'];
			$complementoEndereco = $_POST['comp'];
			$result = false;

			try {
				// Caso algum dos campos do alterar endereço esteja vazio, erro
				if ($cep == "" || $endereco == "" || $numeroEndereco == "")
					throw new Exception('Erro');
				// Executa Função alterar endereço, no usuario, passando o usuario a ser alterado e os atributos novos.
				$sucesso = $this->usuarioFactory->alterar_endereco($_SESSION["id_usuario"], $cep, $endereco, $numeroEndereco, $complementoEndereco);

				if(!$sucesso) {
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
				// Caso o e-mail esteja vazio, error.
				if($email == "" )
					throw new Exception('Erro');

				//Executa a função alterar_email do usuario, passando o usuario e o e-mail novo.
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
				// Caso a senha esteja vazio, error.
				if($senha == "" )
					throw new Exception('Erro');
				//Executa a função alterar_senha do usuario, passando o usuario e a senha nova.
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
		session_start("paradisepies");

		if (isset($_POST['submit'])) {
			$idTorta = $_POST['torta'];
			$quantidade = $_POST['quantidade'];
			$entrega = $_POST['entrega'];
			$sucesso = false;

			try {
				if($idTorta == "")
					throw new Exception('Erro');

					// Cria um novo pedido, para o usuario da sessão
					$pedido = new Pedido($_SESSION["id_usuario"]);
					// Busca no banco de dados a torta que ele selecionou e insere na variavel torta
					$torta = $this->tortaFactory->buscar($idTorta);
					// Adiciona a torta ao pedido, junto com a quantidade do mesmo.
					$pedido->addTorta($torta[0], $quantidade);
					// Envia ao banco de Dados o pedido, e retorna true, caso tenha sucesso.
					$sucesso = $this->pedidoFactory->salvar($pedido);

					if(!$sucesso) {
						$msg = "Não foi possível salvar seu pedido";
						require'view/mensagem.php';
					}
					else {
						$msg = "Pedido gravado com sucesso!";
						require'view/mensagem.php';
					}

			} catch (Exception $e) {
				if ($torta == "" ) {
                    $msg = "O campo <strong>Torta</strong> deve ser preenchido!";
                }
                require 'view/mensagem.php';
			}
		}
	}
}
?>
