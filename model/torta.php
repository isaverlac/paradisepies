<?php

class Torta {
	private $idTorta;
	private $nome;
	private $preco;
	private $descricao;

	public function __construct($idTorta, $nome, $preco, $descricao) {
		$this->idTorta = $idTorta;
		$this->nome = $nome;
		$this->preco = $preco;
		$this->descricao = $descricao;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getPreco() {
		return $this->preco;
	}

	public function getIdTorta(){
		return $this->idTorta;
	}
}

?>
