<?php
require_once("usuario.php");
require_once("AbstractFactory.php");

class UsuarioFactory extends AbstractFactory {
	private $nometabela = "TB_Usuario";
	private $campos = "nome, cpf, tel, cidade, cep, end, numero, comp, email, senha";



	public function UsuarioFactory() {
		this->AbstractFactory();
	}


	public function salvar($obj) {
		$usuario = $obj;	

		try {
			$sql = "INSERT INTO" . $this->nometabela . "(" . $this->campos .
			") VALUES ('" . $usuario->getNome() . "'," $usuario->getCpf() . 
			"," . $usuario->getTel() . ", '" . $usuario->getCidade() . "'," . $usuario->getCep() .
			", '" . $usuario->getEnd() . "' , " $usuario->getNumEnderero() . ", '" .$usuario->getComplemento() .
			"', '" .  $usuario->getEmail() . "', '" $usuario->getSenha() . "' )"; 
		}

		if($this->db->exec($sql)) {
			return true;
      	}
      	else {
			return false;
      	} catch (PDOException $exc) {
      		echo $exc->getMessage();
      		$result = false;
    	}

	}

	public function buscar($cpf) {
		
		$sql = "SELECT * FROM " . $this->nometabela . "WHERE cpf=" . $cpf;
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

		$sql = "UPDATE" . $this->nometabela . "SET email =". $novoEmail ", WHERE" . $this->getCpf() " = " . $cpf;

		if($this->db->exec($sql)) {
			return true;
      	}
      	else {
			return false;
      	} catch (PDOException $exc) {
      		echo $exc->getMessage();
      		$result = false;
    	}
	}

	public function alterarSenha($cpf, $senha) {
		$novoSenha = $senha;

		$sql = "UPDATE" . $this->nometabela . "SET senha =". $novoSenha ", WHERE" . $this->getCpf() " = " . $cpf;

		if($this->db->exec($sql)) {
			return true;
      	}
      	else {
			return false;
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

		$sql = "UPDATE" . $this->nometabela . "SET cep=" . $novoCep . ", endereco=" . $novoEndereco .
				", numeroEndereco=" . $novoNumeroEndereco . ", complementoEndereco=" . $novoComplementoEndereco . 
				" WHERE cpf=" $cpf; 


		if($this->db->exec($sql)) {
			return true;
      	}
      	else {
			return false;
      	} catch (PDOException $exc) {
      		echo $exc->getMessage();
      		$result = false;
    	}

	}


}
?>