<?php
namespace app\core;

class Controller{
	
    public function getVerbo(){
		return $_SERVER["REQUEST_METHOD"];
	}
	
	public function getRequisicao(){
		$verbo = $this->getVerbo();
		
		switch($verbo){
			case "GET":
				return $_GET;
				break;
			case "POST":
			case "PUT":
				$dados = json_decode(file_get_contents("php://input"));
				return $dados;
				break;
			default:
				echo "Inválido";
				break;
		}
	}
	
	public function toJson($dados){
		header("content-type: application/json;");
		echo json_encode($dados);
		exit;
	}
	public function load($viewName, $viewDados=array()){
       extract($viewDados); 
       include "app/views/" . $viewName .".php";
	}
}
