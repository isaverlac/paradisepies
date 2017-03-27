<?php 
require_once("AbstractFactory.php");

class PedidoFactory extends Abstprivate {
	public function __construct() {
		$this->AbstractFactory();
	}

	public function salvar($obj) {
		$pedido = $obj;
	
		try {
			$sql = "INSERT INTO paradisepies.TB_Pedido (idPedido, dataEntrega, status, precoTotal) VALUES (" .
					$pedido->getIdPedido() . "," . $pedido->getDataEntrega() . ", '" . $pedido->getStatus() . "' ," . 
					$pedido->getPrecoTotal() . ";";

			$sql2 = "INSERT INTO paradisepies.TB_UsuarioFazPedido (cpfCliente, idPedidoFeito) VALUES ('" . $pedido->getIdUsuario() . "',"$pedido->getIdPedido() . ";"; 
			;

			$sql3 = "INSERT INTO paradisepies.TB_ItemPedido (idTorta , idPedido) VALUES (" .  . "," . $pedido->getIdPedido() . ";" 
			;

		} catch (PDOException $exc) {
      		echo $exc->getMessage();
      		$result = false;
    	}		
	}
}

?>