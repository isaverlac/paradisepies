<?php
require_once("usuario.php");
require_once("AbstractFactory.php");

class UsuarioFactory extends AbstractFactory {
	private $nometabela = "paradisepies.TB_Usuario";
	private $campos = "nome, cpf, telefone, cidade, cep, endereco, numeroEndereco, complementoEndereco, email, senha";

	public function __construct() {
		parent::__construct();
	}

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

	public function buscar($cpf) {

		$sql = "SELECT * FROM " . $this->nometabela . "WHERE cpf= '" . $cpf . "'";

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

	public function login($email, $senha) {
		$sql = "SELECT * FROM " . $this->nometabela . "WHERE email=" . $email . "AND senha= " . $senha;
		try {
			$resultPDOstmt = $this->db->query($sql);
			$resultObject = $this->queryRowsToListOfObjects($resultPDOstmt, "Usuario");
    	} catch (Exception $exc) {
      		echo $exc->getMessage();
      		$result = null;
    	}

    	return $resultObject;
	}

	public function alterarEmail($cpf, $email) {
		$novoEmail = $email;
		try{
			$sql = "UPDATE" . $this->nometabela . "SET email =". $novoEmail . ", WHERE" . $this->getCpf() ." = " . $cpf;

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

	public function alterarSenha($cpf, $senha) {
		$novoSenha = $senha;
		try{
			$sql = "UPDATE" . $this->nometabela . "SET senha =". $novoSenha .", WHERE" . $this->getCpf() ." = " . $cpf;

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

	public function alterarEndereco($cpf, $cep, $endereco, $numeroEndereco, $complementoEndereco) {
		$novoCep = $cep;
		$novoEndereco = $endereco;
		$novoNumeroEndereco = $numeroEndereco;
		$novoComplementoEndereco = $complementoEndereco;
		try{
			$sql = "UPDATE" . $this->nometabela . "SET cep=" . $novoCep . ", endereco=" . $novoEndereco .
					", numeroEndereco=" . $novoNumeroEndereco . ", complementoEndereco=" . $novoComplementoEndereco .
					" WHERE cpf=". $cpf;


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
