<?php

class ItemPedido{
	private $idTorta;
	private $tamanho;
	private $precoIndividual;

	public function ItemPedido($idTorta, $tamanho, $preco) {
		$this->idTorta = $idTorta;
		$this->tamanho = $tamanho;
		$this->precoIndividual = $preco;
	}

	public function getIdTorta() {
		return $this->idTorta;
	}

	public function getTamanho() {
		return $this->tamanho;
	}

	public function getPrecoIndividual() {
		return $this->precoIndividual;
	}

}

?>