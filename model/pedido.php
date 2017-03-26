<?php 
require_once("usuario.php");

Class Pedido {
	private $idPedido;
	private $dataEntrega;
	private $status;
	private $precoTotal;
	private $usuario;
	private $listaDeTortas;
	
	public function __construct($obj) {
		$this->usuario = $obj;
		$this->$idPedido = this->gerarId();
		$this->$listaDeTortas = new ArrayObject();
	}

	private function gerarId() {
		return $idPedido = random_int(0, 99999);
	}

	public function addTorta($torta) {
		$listaDeTortas->append($torta);
		$precoTotal +=$torta->getPreco();
	}

	public function getIdPedido() {
		return $this->$idPedido;
	}

	public function getDataEntrega() {
		return $this->$dataEntrega;
	}

	public function setDataEntrega($data) {
		$this->$dataEntrega = $data;
	}

	public function getStatus() {
		return $this->$status;
	}

	public function setStatus($status) {
		$this->$status = $status;
	}

}

?>