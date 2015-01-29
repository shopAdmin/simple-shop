<?php

class Marka {

    private $idMarki;
    private $nazwa;
    private $adres;
    private $telefon;
    private $email;
    private $opis;

    public function getIdMarki() {
        return $this->idMarki;
    }

    public function getNazwa() {
        return $this->nazwa;
    }

    public function getAdres() {
        return $this->adres;
    }

    public function getTelefon() {
        return $this->telefon;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getOpis() {
        return $this->opis;
    }

    public function setIdMarki($idMarki) {
        $this->idMarki = $idMarki;
    }

    public function setNazwa($nazwa) {
        $this->nazwa = $nazwa;
    }

    public function setAdres($adres) {
        $this->adres = $adres;
    }

    public function setTelefon($telefon) {
        $this->telefon = $telefon;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setOpis($opis) {
        $this->opis = $opis;
    }

}

?>