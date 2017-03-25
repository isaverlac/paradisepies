<?php

class Torta {
	
	private $nome;
	private $preco;

	public function __construct($nome, $preco) {
		$this->nome = $nome;
		$this->preco = $preco;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getNome() {
		return $this->precoP;
	}

	public function getPreco() {
		return $this->preco;
	}
}

?>