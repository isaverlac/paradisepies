<?php
class UsuarioFazPedido {
	private $cpfCliente;
	private $idPedidoFeito;


	public function __construct($cpfCliente, $idPedido) {
		$this->cpfCliente = $cpfCliente;
		$this->idPedidoFeito = $idPedido;
	}

	public function getCpfCliente() 	{
		return $this->cpfCliente;
	}

	public function getIdPedidoFeito() {
		return $this->idPedidoFeito;
	}


}


?>