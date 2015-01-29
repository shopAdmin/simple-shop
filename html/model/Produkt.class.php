<?php

class Produkt {

    private $idProduktu;
    private $nazwa;
    private $idMarki;
    private $idKategorii;
    private $cena;
    private $opis;
    private $kategoria;
    private $marka;
    private $rozmiary;
    private $kolory;

    function zawieraKolor($kolorId) {
        foreach ($this->kolory as $kolor) {
            if ($kolor->getIdKoloru() == $kolorId) {
                return TRUE;
            }
        }
        return FALSE;
    }

    function zawieraRozmiar($rozmiarId) {
        foreach ($this->rozmiary as $rozmiar) {
            if ($rozmiar->getIdRozmiaru() == $rozmiarId) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public function getKategoria() {
        return $this->kategoria;
    }

    public function getMarka() {
        return $this->marka;
    }

    public function getRozmiary() {
        return $this->rozmiary;
    }

    public function getKolory() {
        return $this->kolory;
    }

    public function setKategoria($kategoria) {
        $this->kategoria = $kategoria;
    }

    public function setMarka($marka) {
        $this->marka = $marka;
    }

    public function setRozmiary($rozmiary) {
        $this->rozmiary = $rozmiary;
    }

    public function setKolory($kolory) {
        $this->kolory = $kolory;
    }

    public function getIdProduktu() {
        return $this->idProduktu;
    }

    public function getNazwa() {
        return $this->nazwa;
    }

    public function getIdMarki() {
        return $this->idMarki;
    }

    public function getIdKategorii() {
        return $this->idKategorii;
    }

    public function getCena() {
        return $this->cena;
    }

    public function getOpis() {
        return $this->opis;
    }

    public function setIdProduktu($idProduktu) {
        $this->idProduktu = $idProduktu;
    }

    public function setNazwa($nazwa) {
        $this->nazwa = $nazwa;
    }

    public function setIdMarki($idMarki) {
        $this->idMarki = $idMarki;
    }

    public function setIdKategorii($idKategorii) {
        $this->idKategorii = $idKategorii;
    }

    public function setCena($cena) {
        $this->cena = $cena;
    }

    public function setOpis($opis) {
        $this->opis = $opis;
    }

}

?>