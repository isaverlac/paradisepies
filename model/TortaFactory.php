<?php
require_once("torta.php");
require_once("AbstractFactory.php");

class TortaFactory extends AbstractFactory {

	public function __construct() {
		parent::__construct();
	}

	public function salvar($obj) {
	}

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