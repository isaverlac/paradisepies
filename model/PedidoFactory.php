<?php 
require_once("AbstractFactory.php");

class PedidoFactory extends Abstprivate {
	private $nometabela = "TB_Pedido";
	private $campos = "idPedido, dataEntrega, status, precoTotal"

	public function __construct() {
		$this->AbstractFactory();
	}

	public function salvar($obj) {
		$pedido = $obj;
	
		try {
			$sql = "INSERT INTO" . $this->$nometabela . "(" $this.campos . ") VALUES (" .
					$pedido.gerarId() . "," . $pedido.getDataEntrega() . "," . $pedido.getStatus() . "," .

		} catch (Exception $e) {
			
		}
		
	}
}

?>