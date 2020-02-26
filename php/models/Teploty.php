<?php
include "Db.php";
Db::pripoj("localhost", "root", "", "websprint2");

class Teploty {

    public $teplota;
    public $rok;
    public $mesic;
    public $den;
    public $geostanice;
    public $vek;


    public function getTropicalDays() {
        return Db::dotazVsechny("SELECT rok, COUNT(*) as tropickyDny FROM `teploty` WHERE  rok BETWEEN YEAR(CURRENT_DATE) - ? -1 and YEAR(CURRENT_DATE)+1 AND teplota > 30 AND geostanice = ? GROUP BY rok", 
        array($this->vek, 1));
    }

    public function getDenByDate() {
        return Db::dotazVsechny("SELECT rok,teplota FROM `teploty` WHERE mesic = ? and den = ?", array($this->mesic, $this->den));
    }
}