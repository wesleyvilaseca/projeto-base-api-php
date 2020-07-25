<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Contato;

class ContatoController extends Controller{
    
   public function index(){
	   $contato = new Contato();
	   $verbo = $this->getVerbo();
	 
	   if ($verbo=="GET"){
		   $lista = $contato->lista();		   
		   $this->toJson($lista);
	   }else if($verbo=="POST"){
		   $dados = $this->getRequisicao();
		   $contato->inserir($dados);
	   }else if($verbo=="PUT"){
		   $dados = $this->getRequisicao();
		   $contato->alterar($dados);
	   }else {
		   echo "Operação inválida";
	   }
   }
   
   public function ver($id){
	   $contato = new Contato();
	   $verbo = $this->getVerbo();
	   if ($verbo=="GET"){
		   if($id =="campos"){
			  echo $contato->campos(); 
		   }else{
			   $dados = $contato->getContato($id);
			   $this->toJson($dados);
		   }
	   }else if ($verbo=="DELETE"){
		   $contato->excluir($id);
	   }
   }
   
   public function campos(){
	echo "veio aqui ";
   }
  
   
   

}
