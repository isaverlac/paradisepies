<?php
require_once("AbstractFactory.php");

class PedidoFactory extends AbstractFactory {
	public function __construct() {
		parent::__construct();
	}

	public function buscar($obj)
	{
	}

	public function salvar($obj) {
		$pedido = $obj;
		$retorno;
		$nextday = time()+(24*60*60*2);

		try {
			$sql = "INSERT INTO paradisepies.TB_Pedido (idPedido, dataEntrega, status, precoTotal) VALUES (" .
					$pedido->getIdPedido() . ", '" . date('Y-m-d', $nextday) . "', '" . $pedido->getStatus() . "' ," . $pedido->getPrecoTotal() . ");";

			$sql2 = "INSERT INTO paradisepies.TB_UsuarioFazPedido (cpfCliente, idPedidoFeito) VALUES ('" . $pedido->getIdUsuario() . "',". $pedido->getIdPedido() . ");";

			if($this->db->exec($sql) && $this->db->exec($sql2)) {
				$retorno = true;
	    } else {
				$retorno = false;
			}

			//foreach($pedido->getListaDeTortas() as $torta, $pedido->getListaDeQuantidadeDeTortas() as $quantidade){
			$listaDeTortas = $pedido->getListaDeTortas();
			$listaDeQuantidadeDeTortas = $pedido->getListaDeQuantidadeDeTortas();
			for($i=0, $count = count( $listaDeTortas ); $i<$count ; $i++){
				$torta  = $listaDeTortas[$i];
 				$quantidade = $listaDeQuantidadeDeTortas[$i];

				$sql3 = "INSERT INTO paradisepies.TB_ItemPedido (idTorta , idPedido, quantidade) VALUES ('" . $torta->getIdTorta() . "'," . $pedido->getIdPedido() . ", " . $quantidade . ");";

				if($this->db->exec($sql3)) {
					$retorno = $retorno && true;
		    } else {
					$retorno = $retorno && false;
				}
			}

			return $retorno;


		} catch (PDOException $exc) {
      		echo $exc->getMessage();
      		$result = false;
    }
	}
}

?>
