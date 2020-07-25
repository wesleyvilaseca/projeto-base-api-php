<?php
namespace app\controllers;
use app\core\Controller;

class HomeController extends Controller{
    
   public function index(){
	   print_r($this->getRequisicao());
	   $dados = (object) array(
			"nome" => "Manoel Jailton",
			"Idade"=> 41
	   );
	   echo "<br>";
	   var_dump($dados);
	   echo "<br>";
	   $this->toJson($dados);
   }
   

}
