<?php
/*
 * Classe que define o padrão para a fábrica de Torta.
 *
 * @author Flávio Augusto Muller Shinzato
 * @author Luiz Henrique Cavalcante da Silva
 * @author Yan Uehara de Moraes
 * @version 1.0
 */

require_once("torta.php");
require_once("AbstractFactory.php");

class TortaFactory extends AbstractFactory {

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
	     * Não necessário para implementação
	     * @param
	     * @return 
     */
	public function salvar($obj) {
	}

	 /**
	     * Busca no Banco de Dados todas as torta com o id especificado.
	     * @param $id - id da Torta
	     * @return $resultObject - Retorna o objeto Torta com todas as informações preenchidas.
     */
	public function buscar($id) {
		$sql = "SELECT * FROM paradisepies.Tb_Torta WHERE idTorta= '" . $id . "';";

		$resultObject = null;

		try {
			$resultPDOstmt = $this->db->query($sql);
			$resultObject = $this->queryRowsToListOfObjects($resultPDOstmt, "Torta");
    	} catch (Exception $exc) {
      		echo $exc->getMessage();
      		$result = null;
    	}

    	return $resultObject;
	}
}
?>