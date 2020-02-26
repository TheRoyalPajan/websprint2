<?php


class HomePageController extends Controller {

    public function zpracuj($parametry) {

        $this->header = array("title" => "Homepage", "keywords" => "homepage, domov", "description" => "Domovská stránka");

        
        $this->pohled = "homepage";
    }

}
