<?php

class Core{
    private $controller;
    private $metodo;
    private $parametros = array();
    
    public function __construct() {
        $this->verificaUri();
    }
    
    public function run(){
        $controllerCorrente = $this->getController();        
        
       $c = new $controllerCorrente;
       call_user_func_array(array($c, $this->getMetodo()), $this->getParametros());      
        
    }
    public function verificaUri(){
        $url =explode("index.php", $_SERVER["PHP_SELF"]);
        $url = end($url);
		
        if($url!=""){
			//Verifica se existe uma rotas válida
			$url=$this->verificaRota($url);
            $url = explode('/', $url);
            array_shift($url);
          
            //Pega o Controller
            $this->controller = ucfirst($url[0]) ."Controller";
            array_shift($url);
            
            //Pega o Método
            if(isset($url[0])){
                $this->metodo = $url[0];
                array_shift($url);
            }
            
            //Pegar os parâmetros
            if(isset($url[0])){
                $this->parametros= array_filter($url);
            }
        }else{
            $this->controller = ucfirst(CONTROLLER_PADRAO) ."Controller";
        }       
       
    }    
    public function getController() {
        if(class_exists(NAMESPACE_CONTROLLER .$this->controller)){
            return NAMESPACE_CONTROLLER .$this->controller;
        }
        return NAMESPACE_CONTROLLER .ucfirst(CONTROLLER_PADRAO) ."Controller";
    }

    public function getMetodo() {
        if(method_exists(NAMESPACE_CONTROLLER .$this->controller, $this->metodo)){
            return $this->metodo;            
        }
        
        return METODO_PADRAO;      
    }

    public function getParametros() {
        return $this->parametros;
    }
	
		public function verificaRota($url){
		global $rotas;
		foreach($rotas as $ch => $rota){
			
			$pattern = preg_replace('(\{[a-z0-9\-]{1,}\})','([a-z0-9\-]{1,})',$ch);			
			
			if(preg_match('#^(' .$pattern .')*$#i', $url, $matches)==1){
				array_shift($matches);
				array_shift($matches);
				
				$chaves = array();
				if(preg_match_all('(\{[a-z0-9]{1,}\})',$ch, $r)){
					$chaves = preg_replace('(\{|\})','', $r[0]);
				}				
				
				$argumentos = array();
				foreach($matches as $chave => $match){
					$argumentos[$chaves[$chave]] = $match;
				}
				
				foreach($argumentos as $chave =>$valor){
					$rota = str_replace(":".$chave, $valor, $rota); 
				}
				$url= $rota;
				break;
			}
			
		}
		return $url;
	}


}
