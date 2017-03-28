<?php
/*
 * Classe que define o padrão para a fábrica de Usuario.
 *
 * @author Flávio Augusto Muller Shinzato
 * @author Luiz Henrique Cavalcante da Silva
 * @author Yan Uehara de Moraes
 * @version 1.0
 */

require_once("usuario.php");
require_once("AbstractFactory.php");

class UsuarioFactory extends AbstractFactory {
	// Nome da tabela referente ao Objeto Pedido no Banco de Dados
	private $nometabela = "paradisepies.TB_Usuario";
	private $campos = "nome, cpf, telefone, cidade, cep, endereco, numeroEndereco, complementoEndereco, email, senha";

	/**
	     * Construtor Padrão do PedidoFactor.
	     * Chama o construtor da AbstactFactory
	     * @param
	     * @return 
     */
	public function __construct() {
		parent::__construct();
	}

	 /**
	     * Salva o usuário no Banco de Dados.
	     * @param $obj - Um objeto do tipo usuario
	     * @return  $retorno - um Boolean que indica, se conseguiu salvar no Banco de Dados
     */
	public function salvar($obj) {
		$usuario = $obj;

		try {
			$sql = "INSERT INTO " . $this->nometabela . "(" . $this->campos .
			") VALUES ('" . $usuario->getNome() .
			"', '". $usuario->getCpf() .
			"', '" . $usuario->getTelefone() .
			"', '" . $usuario->getCidade() .
			"', '" . $usuario->getCep() .
			"', '" . $usuario->getEnd() .
			"', ". $usuario->getNumEndereco() .
			", '" .$usuario->getComplemento() .
			"', '" .  $usuario->getEmail() .
			"', '". $usuario->getSenha() .
			"' );";

			if($this->db->exec($sql)) {
				return true;
	      	}
	      	else {
				return false;
		}

      	} catch (PDOException $exc) {
      		echo $exc->getMessage();
      		$result = false;
    	}

	}

	 /**
	     * Faz uma busca no Banco de Dados a partir do CPF do usuário.
	     * @param $cpf - Chave primaria do Banco.
	     * @return  $resultObject; - Retorna um Objeto do tipo Usuário com as informações preenchidas nele
     */
	public function buscar($cpf) {

		$sql = "SELECT * FROM " . $this->nometabela . " WHERE cpf= '" . $cpf . "'";

		$resultObject = null;

		try {
			$resultPDOstmt = $this->db->query($sql);
			$resultObject = $this->queryRowsToListOfObjects($resultPDOstmt, "Usuario");
    	} catch (Exception $exc) {
      		echo $exc->getMessage();
      		$result = null;
    	}

    	return $resultObject;
	}

	 /**
	     * Valida o login no Banco de Dados.
	     * @param $email - e-mail passado no campo de login
	     * @param $senha - senha passada no campo de senha
	     * @return  $resultObject; - Retorna um Objeto do tipo Usuário com as informações preenchidas nele.
     */

	public function login($email, $senha) {

		$sql = "SELECT * FROM " . $this->nometabela . " WHERE email='" . $email . "' AND senha= '" . $senha . "';";
		$resultObject = null;

		try {
			$resultPDOstmt = $this->db->query($sql);
			$resultObject = $this->queryRowsToListOfObjects($resultPDOstmt, "Usuario");
    	} catch (Exception $exc) {
      		echo $exc->getMessage();
      		$result = null;
    	}

    	return $resultObject;
	}


	 /**
	     * Altera o E-mail no Banco de Dados
	     * @param $cpf - Chave primira do Usuario no banco de Dados
	     * @param $e-mail - e-mail passada no campo de e-mail para ser alterada no Banco de Dados.
	     * @return  $result; - Retorna true ou false, caso consiga alterar o e-mail no Banco de Dados.
     */
	public function alterar_email($cpf, $email) {
		$novoEmail = $email;
		try{
			$sql = "UPDATE " . $this->nometabela . " SET email = '". $novoEmail . "' WHERE cpf = '" . $cpf . "';";

			if($this->db->exec($sql)) {
				return true;
	      	}
	      	else {
				return false;
		}
      	} catch (PDOException $exc) {
      		echo $exc->getMessage();
      		$result = false;
    	}
	}

	 /**
	     * Altera a senha no Banco de Dados
	     * @param $cpf - Chave primira do Usuario no banco de Dados
	     * @param $senha - senha passada no campo de senha para ser alterada no Banco de Dados.
	     * @return  $result; - Retorna true ou false, caso consiga alterar a senha o Banco de Dados.
     */

	public function alterar_senha($cpf, $senha) {
		$novoSenha = $senha;
		try{
			$sql = "UPDATE " . $this->nometabela . " SET senha ='". $novoSenha ."' WHERE cpf='" . $cpf . "';";

			if($this->db->exec($sql)) {
				return true;
	      	}
	      	else {
				return false;
		}
      	} catch (PDOException $exc) {
      		echo $exc->getMessage();
      		$result = false;
    	}
	}

	 /**
	     * Altera as informações referente ao endereço no Banco de Dados.
	     * @param $cpf - Chave primira do Usuario no Banco de Dados.
	     * @param $cep - cep passado no campo de cep para ser alterada no Banco de Dados.
	     * @param $endereco - endereco passado no campo de endereco para ser alterada no Banco de Dados.
	     * @param $numeroEndereco - Numero do Endereço passado no campo, para ser alterada no Banco de Dados.
	     * @param $complementoEndereco - Complemento de Endereço passado no campo, para ser alterada no Banco de Dados.
	     * @return  $result; - Retorna true ou false, caso consiga alterar as informações do endereço no Banco de Dados.
     */

	public function alterar_endereco($cpf, $cep, $endereco, $numeroEndereco, $complementoEndereco = '') {
		$novoCep = $cep;
		$novoEndereco = $endereco;
		$novoNumeroEndereco = $numeroEndereco;
		$novoComplementoEndereco = $complementoEndereco;

		try{
			$sql = "UPDATE " . $this->nometabela . " SET cep='" . $novoCep . "', endereco='" . $novoEndereco .
					"', numeroEndereco='" . $novoNumeroEndereco . "', complementoEndereco='" . $novoComplementoEndereco .
					"' WHERE cpf='". $cpf . "';";

			if($this->db->exec($sql)) {
				return true;
	      	}
	      	else {
				return false;
		}
      	} catch (PDOException $exc) {
      		echo $exc->getMessage();
      		$result = false;
    	}

	}


}
?>
