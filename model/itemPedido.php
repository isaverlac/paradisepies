<?php

class ItemPedido{
	private $idTorta;
	private $idPedido;
	private $tamanho;

	public function __construct($idTorta, $idPedido, $tamanho) {
		$this->idTorta = $idTorta;
		$this->idPedido = $idPedido;
		$this->tamanho = $tamanho;
	}

	public function getIdPedido() {
		return $this->idPedido;
	}

	public function getIdTorta() {
		return $this->idTorta;
	}

	public function getTamanho() {
		return $this->tamanho;
	}

}

?>