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
			$resultObject = $this->queryRowsToListOfObjects($resultPDOstmt, "Contato");
    	} catch (Exception $exc) {
      		echo $exc->getMessage();
      		$result = null;
    	}
    
    	return $resultObject;
	}
}
?>