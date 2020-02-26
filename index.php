<?php       

//Zapnutí sessions
session_start();

//nastavíme PHP interní kódování na UTF8
mb_internal_encoding("UTF-8");

//Autoloader
function autoloadFunkce($trida) {

    //Končí třída *Kontroler?
    if (preg_match('/Controller$/', $trida))
        require("controllers/" . $trida . ".php");
    else
        require("models/" . $trida . ".php");

}

//Funkce se ještě musí zaregistrovat jako autoloader.
spl_autoload_register("autoloadFunkce");

///Připojení k databázi
Db::pripoj("localhost",  "root", "","websprint2");

//Směrovač.
$router = new RouterController();
$router->zpracuj(array($_SERVER["REQUEST_URI"]));

//Výpis pohledu
$router->returnView();

?>