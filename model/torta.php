<?php

class Torta {
	
	private $nome;
	private $precoP;
	private $precoM;
	private $precoG;
	private $desc;

	public function __construct($nome, $precoP, $precoM, $precoM, $desc) {
		$this->nome = $nome;
		$this->precoP = $precoP;
		$this->precoM = $precoM;
		$this->precoG = $precoG;
		$this->desc = $desc;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getNome() {
		return $this->precoP;
	}

	public function getPrecoM() {
		return $this->precoM;
	}

	public function getPrecoG() {
		return $this->precoG;
	}

	public function getDesc() {
		return $this->desc;
	}
}

?>