<?php
require_once("AbstractFactory.php");

class PedidoFactory extends AbstractFactory {
	private $nometabela = "paradisepies.TB_Pedido";


	public function __construct() {
		parent::__construct();
	}

	public function buscar($cpf)
	{

		$sql = "SELECT IP.idPedido, P.dataPedido, P.dataEntrega, T.nome, IP.quantidade, P.status FROM paradisepies.TB_Pedido as P JOIN paradisepies.Tb_itemPedido as IP ON P.idPedido = IP.idPedido  JOIN paradisepies.TB_UsuarioFazPedido as UP ON P.idPedido = UP.idPedidoFeito JOIN paradisepies.TB_Torta as T ON IP.idTorta = T.idTorta WHERE UP.cpfCliente= '". $cpf ."';";

		try {
			$resultPDOstmt = $this->db->query($sql);
			$resultObject = $this->queryListToRow($resultPDOstmt);
    	} catch (Exception $exc) {
      		echo $exc->getMessage();
      		$result = null;
    	}
    	return $resultObject;


	}

	public function salvar($obj) {
		$pedido = $obj;
		$retorno;
		$nextday = time()+(24*60*60*2);

		try {
			$sql = "INSERT INTO paradisepies.TB_Pedido (idPedido, dataPedido, dataEntrega, status, precoTotal) VALUES (" .
					$pedido->getIdPedido() . ", '" . date('Y-m-d') ."', '" . date('Y-m-d', $nextday) . "', '" . $pedido->getStatus() . "' ," . $pedido->getPrecoTotal() . ");";

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
