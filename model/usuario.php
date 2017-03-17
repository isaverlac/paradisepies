<?php
class Usuario {

	private $nome;
	private $cpf;
	private $tel;
	private $cidade;
	private $cep;
	private $end;
	private $numero;
	private $comp
	private $email;
	private $senha;

	public function Usuario($nome, $cpf, $tel, $cidade, $cep, $end, $numero, $comp $email, $senha) {
		$this->nome = $nome;
		$this->cpf = $cpf;
		$this->tel = $tel;
		$this->cidade = $cidade;
		$this->cep = $cep;
		$this->end = $end;
		$this->numero = $numero;
		$this->comp = $comp;
		$this->email = $email;
		$this->senha = $senha;

	}

	public function getNome() {
		return $this->nome;
	}

	public function getCpf() {
		return $this->cpf;
	}

	public function getTel() {
		return $this->tel;
	}

	public function getCidade() {
		return $this->cidade;
	}

	public function getCep() {
		return $this->cep; 
	}

	public function getEnd() {
		return $this->end;
	}
	
	public function getComp() {
		return $this->comp;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getSenha() {
		return $this->senha;
	}
}

?>