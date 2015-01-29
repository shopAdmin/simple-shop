<?php

class produktController extends baseController {

    public function index() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $results = $db::getProduktList();
        $produkty = array();
        foreach ($results as $row) {
            $produkt = new Produkt();
            $produkt->setIdProduktu($row['id_produktu']);
            $produkt->setNazwa($row['nazwa']);
            $produkt->setCena($row['cena']);
            $produkt->setIdKategorii($row['id_kategorii']);
            $produkt->setIdKategorii($row['id_marki']);
            $marka = $db::getMarkaById($row['id_marki']);
            $produkt->setMarka($marka);
            $kategoria = $db::getKategoriaById($row['id_kategorii']);
            $produkt->setKategoria($kategoria);
            $kolory = $db::getKoloryProduktu($row['id_produktu']);
            $rozmiary = $db::getRozmiaryProduktu($row['id_produktu']);
            $produkt->setKolory($kolory);
            $produkt->setRozmiary($rozmiary);
            $produkty[] = $produkt;
        }
        $this->registry->template->produkty = $produkty;
        $this->registry->template->show('produkt/produkt_index');
    }

    public function add() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $db = $this->registry->db;
        $markiList = $db::getMarkaList();
        $kategorieList = $db::getKategoriaList();
        $koloryList = $db::getKolorList();
        $rozmiaryList = $db::getRozmiarList();
        $this->registry->template->marki = $markiList;
        $this->registry->template->kategorie = $kategorieList;
        $this->registry->template->kolory = $koloryList;
        $this->registry->template->rozmiary = $rozmiaryList;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nazwa = trim($_POST['nazwa']);
            if (empty($nazwa)) {
                $error .= 'Uzupełnij pole nazwa <br />';
            }
            $cena = trim($_POST['cena']);
            if (empty($cena)) {
                $error .= 'Uzupełnij pole cena <br />';
            }
            $idKategorii = $_POST['kategoria'];
            if (empty($idKategorii)) {
                $error .= 'Wybierz pole kategoria <br />';
            }
            $idMarki = $_POST['marka'];
            if (empty($idMarki)) {
                $error .= 'Wybierz pole marka <br />';
            }
            if (!isset($_POST['kolory'])) {
                $error .= 'Wybierz kolory <br />';
            } else {
                $koloryPost = $_POST['kolory'];
                $kolory = array();
                foreach ($koloryPost as $k) {
                    $kolor = $db::getKolorById($k);
                    $kolory[] = $kolor;
                }
            }
            if (!isset($_POST['rozmiary'])) {
                $error .= 'Wybierz rozmiary <br />';
            } else {
                $rozmiaryPost = $_POST['rozmiary'];
                $rozmiary = array();
                foreach ($rozmiaryPost as $r) {
                    $rozmiar = $db::getRozmiarById($r);
                    $rozmiary[] = $rozmiar;
                }
            }
            $opis = trim($_POST['opis']);
            if (empty($error)) {
                $produkt = new Produkt();
                $produkt->setNazwa($nazwa);
                $produkt->setCena($cena);
                $produkt->setIdKategorii($idKategorii);
                $produkt->setIdMarki($idMarki);
                $produkt->setRozmiary($rozmiary);
                $produkt->setKolory($kolory);
                $produkt->setOpis($opis);
                if ($db::addProdukt($produkt)) {
                    $error .= 'Dodano produkt <br />';
                } else {
                    $error .= 'Dodanie produktu nie powiodło się <br />';
                }
            }

            $this->registry->template->error = $error;
        }

        $this->registry->template->show('produkt/produkt_add');
    }

    public function edit() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $db = $this->registry->db;
        $markiList = $db::getMarkaList();
        $kategorieList = $db::getKategoriaList();
        $koloryList = $db::getKolorList();
        $rozmiaryList = $db::getRozmiarList();
        $this->registry->template->markiAll = $markiList;
        $this->registry->template->kategorieAll = $kategorieList;
        $this->registry->template->koloryAll = $koloryList;
        $this->registry->template->rozmiaryAll = $rozmiaryList;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = trim($_POST['id']);
            if (empty($id)) {
                $error .= 'Błąd <br />';
            }
            $nazwa = trim($_POST['nazwa']);
            if (empty($nazwa)) {
                $error .= 'Uzupełnij pole nazwa <br />';
            }
            $cena = trim($_POST['cena']);
            if (empty($cena)) {
                $error .= 'Uzupełnij pole cena <br />';
            }
            $idKategorii = $_POST['kategoria'];
            if (empty($idKategorii)) {
                $error .= 'Wybierz pole kategoria <br />';
            }
            $idMarki = $_POST['marka'];
            if (empty($idMarki)) {
                $error .= 'Wybierz pole marka <br />';
            }
            if (!isset($_POST['kolory'])) {
                $error .= 'Wybierz kolory <br />';
            } else {
                $koloryPost = $_POST['kolory'];
                $kolory = array();
                foreach ($koloryPost as $k) {
                    $kolor = $db::getKolorById($k);
                    $kolory[] = $kolor;
                }
            }
            if (!isset($_POST['rozmiary'])) {
                $error .= 'Wybierz rozmiary <br />';
            } else {
                $rozmiaryPost = $_POST['rozmiary'];
                $rozmiary = array();
                foreach ($rozmiaryPost as $r) {
                    $rozmiar = $db::getRozmiarById($r);
                    $rozmiary[] = $rozmiar;
                }
            }
            $opis = trim($_POST['opis']);
            if (empty($error)) {
                $produkt = new Produkt();

                $produkt = new Produkt();
                $produkt->setIdProduktu($id);
                $produkt->setNazwa($nazwa);
                $produkt->setCena($cena);
                $produkt->setIdKategorii($idKategorii);
                $produkt->setIdMarki($idMarki);
                $produkt->setRozmiary($rozmiary);
                $produkt->setKolory($kolory);
                $produkt->setOpis($opis);
                if ($db::updateProdukt($produkt)) {
                    $error .= 'Edycja zakończona pomyślnie <br />';
                } else {
                    $error .= 'Edycja nie powiodła się <br />';
                }
            }
            $this->registry->template->error = $error;
             $this->registry->template->show('produkt/produkt_action_result');
        } else {
            $id = $this->registry->id;
            $produkt = $db::getProduktById($id);
            $this->registry->template->model = $produkt;
            $this->registry->template->show('produkt/produkt_edit');
        }
    }

    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $id = trim($_POST['id']);
                $produkt = $db::getProduktById($id);
                if ($db::deleteProdukt($produkt)) {
                    $error .= 'Usunięto produkt <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/produkt';
                header("Location: $location");
            }
            $this->registry->template->error = $error;
            $this->registry->template->show('produkt/produkt_action_result');
        } else {
            $id = $this->registry->id;
            $produkt = $db::getProduktById($id);
            $this->registry->template->model = $produkt;
            $this->registry->template->show('produkt/produkt_delete');
        }
    }

}

?>