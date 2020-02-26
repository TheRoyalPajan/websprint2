<?php

include "models/Db.php";

Db::pripoj("localhost", "root", "", "websprint2");


$data = Db::dotazVsechny("SELECT * FROM `teploty` GROUP BY rok");


echo(json_encode($data));
    