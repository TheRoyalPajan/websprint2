<?php

include "../models/Teploty.php";


$data = json_decode(file_get_contents("php://input"), true);


$teploty = new Teploty();
$teploty->vek = $data["vek"];


echo(json_encode($teploty->getTropicalDays()));
    
