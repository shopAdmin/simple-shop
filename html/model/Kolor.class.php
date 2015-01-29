<?php

class Kolor {

    private $idKoloru;
    private $nazwa;
    
    public function getIdKoloru() {
        return $this->idKoloru;
    }

    public function getNazwa() {
        return $this->nazwa;
    }

    public function setIdKoloru($idKoloru) {
        $this->idKoloru = $idKoloru;
    }

    public function setNazwa($nazwa) {
        $this->nazwa = $nazwa;
    }


}

?>