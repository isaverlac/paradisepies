<?php
class Usuario {

	private $nome;
	private $cpf;
	private $telefone;
	private $cidade;
	private $cep;
	private $end;
	private $numeroEndereco;
	private $complementoEndereco;
	private $email;
	private $senha;

	public function __construct($nome, $cpf, $telefone, $cidade, $cep, $end, $numEndereco, $complementoEndereco = "", $email, $senha)
	{
		$this->nome = $nome;
		$this->cpf = $cpf;
		$this->telefone = $telefone;
		$this->cidade = $cidade;
		$this->cep = $cep;
		$this->end = $end;
		$this->numEndereco = $numEndereco;
		$this->complementoEndereco = $complementoEndereco;
		$this->email = $email;
		$this->senha = $senha;

	}

	public function getNome() {
		return $this->nome;
	}

	public function getCpf() {
		return $this->cpf;
	}

	public function getTelefone() {
		return $this->telefone;
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
	
	public function getNumEndereco() {
		return $this->numEndereco;
	}

	public function getComplemento() {
		return $this->complementoEndereco;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getSenha() {
		return $this->senha;
	}
}

?>