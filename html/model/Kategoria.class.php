<?php

class Kategoria {

    private $idKategorii;
    private $nazwa;
    private $opis; 
    
    public function getIdKategorii() {
        return $this->idKategorii;
    }

    public function getNazwa() {
        return $this->nazwa;
    }

    public function getOpis() {
        return $this->opis;
    }

    public function setIdKategorii($idKategorii) {
        $this->idKategorii = $idKategorii;
    }

    public function setNazwa($nazwa) {
        $this->nazwa = $nazwa;
    }

    public function setOpis($opis) {
        $this->opis = $opis;
    }


}

?>