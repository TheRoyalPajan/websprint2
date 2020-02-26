<?php

include "../models/Teploty.php";


$data = json_decode(file_get_contents("php://input"), true);


$teploty = new Teploty();
$teploty->den = $data["den"];
$teploty->mesic = $data["mesic"];


echo(json_encode($teploty->getDenByDate()));
    
