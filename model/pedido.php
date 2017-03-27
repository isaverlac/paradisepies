<?php
require_once("usuario.php");

Class Pedido {
	private $idPedido;
	private $dataEntrega;
	private $status;
	private $precoTotal;
	private $idUsuario;
	private $listaDeTortas;
	private $listaDeQuantidadeDeTortas;

	public function __construct($cpf) {
		$this->idUsuario = $cpf;
		$this->idPedido = $this->gerarId();
		$this->listaDeTortas = new ArrayObject();
		$this->status = "Em produção";
		$this->dataEntrega = "0000-00-00";
		$this->listaDeQuantidadeDeTortas = new ArrayObject();
	}

	private function gerarId() {
		return $idPedido = rand(0, 99999);
	}

	public function addTorta($torta, $quantidade) {
		$this->listaDeTortas->append($torta);
		$this->listaDeQuantidadeDeTortas->append($quantidade);
		$this->precoTotal += $torta->getPreco();
	}

	public function getIdPedido() {
		return $this->idPedido;
	}

	public function getIdUsuario() {
		return $this->idUsuario;
	}

	public function getDataEntrega() {
		return $this->dataEntrega;
	}

	public function setDataEntrega($data) {
		$this->dataEntrega = $data;
	}

	public function getStatus() {
		return $this->status;
	}

	public function setStatus($status) {
		$this->status = $status;
	}

	public function getPrecoTotal(){
		return $this->precoTotal;
	}

	public function getListaDeTortas(){
		return $this->listaDeTortas;
	}

	public function getListaDeQuantidadeDeTortas(){
		return $this->listaDeQuantidadeDeTortas;
	}
}

?>
