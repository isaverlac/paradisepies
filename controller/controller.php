<?php 

class Controller {

	public function init() 	{
		
		if (isset($_GET['op'])) {
		    $op = $_GET['op'];
		} else {
		    $op = "";
		}

		switch ($op) {
			case 'cadastro_usuario':
				$this->cadastro_usuario();
				break;
			
			case 'perfil_usuario':
				$this->perfil_usuario();
				break;	
			
			case 'cadastro_torta':
				$this->cadastro_torta();
				break;

			case 'acompanhar_pedido':
				$this->acompanhar_pedido();
				break;

			case 'finalizar_pedido':
				$this->finalizar_pedido();
				break;

			default:
		        include('../view/index.html');
		        break;
		}	
	}

	public function index()	{
		require 'View/index.html';
	}

	public function casdastro_usuario() {
		//TODO
	}
	
	public function perfil_usuario() {
		//TODO
	}

	public function cadastro_torta() {
		//TODO
	}

	public function acompanhar_pedido() {
		//TODO
	}

	public function finalizar_pedido() {
		//TODO
	}


}
?>