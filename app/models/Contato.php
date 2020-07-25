<?php

namespace app\models;
use app\core\Model;

class Contato extends Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function lista(){
        $sql = "SELECT * FROM  contato ";
        $qry = $this->db->query($sql);
        
        return $qry->fetchAll();
    }
	
	public function getContato($id_contato){
		$sql = "SELECT * FROM contato WHERE id_contato = :id_contato ";
		$qry = $this->db->prepare($sql);
		$qry->bindValue(":id_contato", $id_contato);
		$qry->execute();
		
		return $qry->fetch(\PDO::FETCH_OBJ);
	}
	public function inserir($valores){
		 $sql = "INSERT INTO contato SET		
					nome 			=:nome,
					email   		=:email,
					fone			=:fone,
					endereco		=:endereco,
					cidade			=:cidade,
					bairro			=:bairro,
					uf				=:uf,
					cep				=:cep,
					ddd				=:ddd,
					sexo			=:sexo,
					site			=:site,
					data_cadastro	=:data_cadastro,
					nascimento		=:nascimento ";		
					
		$qry = $this->db->prepare($sql);
		$qry->bindValue(":nome", $valores->nome);
		$qry->bindValue(":email",	$valores->email);
        $qry->bindValue(":fone", 	$valores->fone);
        $qry->bindValue(":endereco", $valores->endereco);
        $qry->bindValue(":cidade", 	$valores->cidade);
        $qry->bindValue(":bairro", 	$valores->bairro);
        $qry->bindValue(":uf", 		$valores->uf);
        $qry->bindValue(":cep", 	$valores->cep);
        $qry->bindValue(":ddd", 	$valores->ddd);
        $qry->bindValue(":sexo", 	$valores->sexo);
        $qry->bindValue(":site", 	$valores->site);
        $qry->bindValue(":data_cadastro", $valores->data_cadastro);
        $qry->bindValue(":nascimento", $valores->nascimento);
		$qry->execute();
		
		return $this->db->lastInsertId();	
		
	}
	
	public function alterar($valores){
		 $sql = " UPDATE  contato SET		
					nome 			=:nome,
					email   		=:email,
					fone			=:fone,
					endereco		=:endereco,
					cidade			=:cidade,
					bairro			=:bairro,
					uf				=:uf,
					cep				=:cep,
					ddd				=:ddd,
					sexo			=:sexo,
					site			=:site,
					data_cadastro	=:data_cadastro,
					nascimento		=:nascimento 
					
					WHERE id_contato =:id_contato";		
			
		$qry = $this->db->prepare($sql);
		$qry->bindValue(":nome", $valores->nome);
		$qry->bindValue(":email",	$valores->email);
        $qry->bindValue(":fone", 	$valores->fone);
        $qry->bindValue(":endereco", $valores->endereco);
        $qry->bindValue(":cidade", 	$valores->cidade);
        $qry->bindValue(":bairro", 	$valores->bairro);
        $qry->bindValue(":uf", 		$valores->uf);
        $qry->bindValue(":cep", 	$valores->cep);
        $qry->bindValue(":ddd", 	$valores->ddd);
        $qry->bindValue(":sexo", 	$valores->sexo);
        $qry->bindValue(":site", 	$valores->site);
        $qry->bindValue(":data_cadastro", $valores->data_cadastro);
        $qry->bindValue(":nascimento", $valores->nascimento);
        $qry->bindValue(":id_contato", $valores->id_contato);
		$qry->execute();	
		
	}
	
	public function excluir($id_contato){
		$sql = "DELETE FROM contato WHERE id_contato = :id_contato";
		$qry = $this->db->prepare($sql);
		$qry->bindValue(":id_contato", $id_contato);
		$qry->execute();
		
	}
	
	public function campos(){
		$sql = "SHOW COLUMNS FROM contato";
		$qry = $this->db->query($sql);
		$lista = $qry->fetchAll(\PDO::FETCH_OBJ);
		$campos= array();
		foreach($lista as $campo){
			$tipo = $campo->Type;
			
			if($tipo=="date"){
				$tipo = "data";
			}
			
			if(substr($tipo,0,3)=='int'){
				$tipo = "inteiro";
			}
			
			if(substr($tipo,0,7)=='varchar'){
				$tipo = "string";
			}
			
			$campos[] = (object) array(
				"campo" => $campo->Field ."--",
				"tipo" => $tipo
			);
		}
		
		return json_encode($campos);
	}
	
}
