<?php

/*
 * Classe que define o padrão para a fábrica de Pedido.
 *
 * @author Flávio Augusto Muller Shinzato
 * @author Luiz Henrique Cavalcante da Silva
 * @author Yan Uehara de Moraes
 * @version 1.0
 */

require_once("AbstractFactory.php");

class PedidoFactory extends AbstractFactory {
	// Nome da tabela referente ao Objeto Pedido no Banco de Dados
	private $nometabela = "paradisepies.TB_Pedido";


	 /**
	     * Construtor Padrão do PedidoFactory.
	     * Chama o construtor da AbstactFactory
	     * @param
	     * @return 
     */
	public function __construct() {
		parent::__construct();
	}


	 /**
	     * Faz uma busca no Banco de Dados a partir do CPF do usuário.
	     * @param $cpf - Chave primaria do Usuario no Banco de Dados.
	     * @return  $resultObject; - é Uma Matriz, de String, de Pedidos x Informações do Pedido
     */
	public function buscar($cpf)
	{
		// $sql Recebe a String a ser executada no banco. 
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

	 /**
	     * Salva o pedido no Banco de Dados.
	     * @param $obj - Um objeto do tipo Pedido
	     * @return  $retorno - um Boolean que indica, se conseguiu salvar no Banco de Dados
     */
	public function salvar($obj) {
		$pedido = $obj;
		$retorno;
		$nextday = time()+(24*60*60*2);

		// Insere no Banco de Dados, as informações do Pedido, na Tabela Pedido e Usuario Pedido.
		try {
			$sql = "INSERT INTO paradisepies.TB_Pedido (idPedido, dataPedido, dataEntrega, status, precoTotal) VALUES (" .
					$pedido->getIdPedido() . ", '" . date('Y-m-d') ."', '" . date('Y-m-d', $nextday) . "', '" . $pedido->getStatus() . "' ," . $pedido->getPrecoTotal() . ");";

			$sql2 = "INSERT INTO paradisepies.TB_UsuarioFazPedido (cpfCliente, idPedidoFeito) VALUES ('" . $pedido->getIdUsuario() . "',". $pedido->getIdPedido() . ");";

			// Caso não consiga inserir no Banco de Dados, retorno = false;
			if($this->db->exec($sql) && $this->db->exec($sql2)) {
				$retorno = true;
	    } else {
				$retorno = false;
			}

			$listaDeTortas = $pedido->getListaDeTortas();
			$listaDeQuantidadeDeTortas = $pedido->getListaDeQuantidadeDeTortas();

			//Para cada torta na lista de torta do pedido, coloque na tabela ItemPedido,  o IdTorta, IdPedido e quantidade
			for($i=0, $count = count( $listaDeTortas ); $i<$count ; $i++){
				$torta  = $listaDeTortas[$i];
 				$quantidade = $listaDeQuantidadeDeTortas[$i];

				$sql3 = "INSERT INTO paradisepies.TB_ItemPedido (idTorta , idPedido, quantidade) VALUES ('" . $torta->getIdTorta() . "'," . $pedido->getIdPedido() . ", " . $quantidade . ");";

				// Caso alguma das inserções falhe, retorno = false;
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
