<?php

class RouterController extends Controller {

    
    protected $controller;

  
    public function zpracuj($parametry)
    {
		$parsedURL = $this->parsujURL($parametry[0]);
				
		if (empty($parsedURL[0]))		
		    $this->redirect('homepage');		
        
        // controller je 1. parametr URL
		$tridaKontroleru = $this->camelNotation(array_shift($parsedURL)) . 'Controller';
		
		if (file_exists('controllers/' . $tridaKontroleru . '.php'))
		    $this->controller = new $tridaKontroleru;
		else
		    $this->redirect('NotFound');
		
		// Volání controlleru
        $this->controller->zpracuj($parsedURL);

		// Nastavení proměnných pro šablonu
		$this->data['title'] = $this->controller->header['title'];
		$this->data['description'] = $this->controller->header['description'];
		$this->data['keywords'] = $this->controller->header['keywords'];
        $this->data['messages'] = $this->returnMessages();
  
        // Nastavení hlavní šablony 
        if($this->currentUser("role") == 2) {
            $this->view = '/layouts/adminLayout';  
        }   else {
            $this->view = '/layouts/userLayout';  

        }
    
    }

    //Jelikož url[controller] bude jiný název než soubor musí se upravit název
    public function camelNotation($text) {
        return  str_replace("-", " ",ucwords(str_replace(" ", "",$text)));
    }

    //Rozdělování podle lomítek
    public function parsujURL($url) {
        
        //Funkce která je zabudováná přímo v PHPčku
        $parseURL = parse_url($url);

        //Odstranění lomítek a whitespaců
        $parseURL["path"] = ltrim($parseURL["path"], "/");
        $parseURL["path"] = trim($parseURL["path"]);

        //Rozbít string podle lomítek
        $explodedURL = explode("/", $parseURL["path"]);

        return $explodedURL;
    }


}