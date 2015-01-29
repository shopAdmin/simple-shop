<?php

class Rozmiar {

    private $idRozmiaru;
    private $nazwa;

    public function getIdRozmiaru() {
        return $this->idRozmiaru;
    }

    public function getNazwa() {
        return $this->nazwa;
    }

    public function setIdRozmiaru($idRozmiaru) {
        $this->idRozmiaru = $idRozmiaru;
    }

    public function setNazwa($nazwa) {
        $this->nazwa = $nazwa;
    }

}

?>