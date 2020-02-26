<?php

class NotFoundController extends Controller {

    public function zpracuj($parametry) {

        // Hlavička requestu
        header("HTTP/1.0 404 Not Found");

        // Hlavička stránky
        $this->header["title"] = "Chyba 404";
        $this->header["keywords"] = "Chyba, 404";
        $this->header["description"] = "Chyba 404";

        $this->view = "notfound";
    }

}