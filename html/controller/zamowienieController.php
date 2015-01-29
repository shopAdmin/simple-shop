<?php

class zamowienieController extends baseController {

    public function index() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $results = $db::getZamowienieList();
        $zamowienia = array();
        foreach ($results as $row) {
            $zamowienie = new Zamowienie();
            $zamowienie->setIdZamowienia($row['id_zamowienia']);
            $zamowienie->setIdKlienta($row['id_klienta']);
            $zamowienie->setUpust($row['upust']);
            $zamowienie->setAdres($row['adres']);
            $zamowienie->setUwagi($row['uwagi_dodatkowe']);
            $produkty = $db::getProduktyZamowienia($row['id_zamowienia']);
            $zamowienie->setProdukty($produkty);
            $cena = 0.0;
            foreach ($produkty as $produkt) {
                $cena += $produkt->getIlosc() * $produkt->getProdukt()->getCena();
            }
            $zamowienie->setCena($cena);
            $zamowienie->setDataZamowienia($row['data_zamowienia']);
            $zamowienie->setDataRealizacji($row['data_realizacji']);
            $zamowienie->setStatus($row['status']);
            $zamowienia[] = $zamowienie;
        }
        $this->registry->template->zamowienia = $zamowienia;
        $this->registry->template->show('zamowienie/zamowienie_index');
    }

    public function moje_zamowienia() {
        $this->ograniczDostepTylkoDlaZalogowanegoUzytkownika();
        $db = $this->registry->db;
        $login = $_SESSION['user'];
        $user = $db::getUserByLogin($login);
        $results = $db::getZamowienieUserList($user->getId());
        $zamowienia = array();
        foreach ($results as $row) {
            $zamowienie = new Zamowienie();
            $zamowienie->setIdZamowienia($row['id_zamowienia']);
            $zamowienie->setIdKlienta($row['id_klienta']);
            $zamowienie->setUpust($row['upust']);
            $zamowienie->setAdres($row['adres']);
            $zamowienie->setUwagi($row['uwagi_dodatkowe']);
            $produkty = $db::getProduktyZamowienia($row['id_zamowienia']);
            $zamowienie->setProdukty($produkty);
            $cena = 0.0;
            foreach ($produkty as $produkt) {
                $cena += $produkt->getIlosc() * $produkt->getProdukt()->getCena();
            }
            $zamowienie->setCena($cena);
            $zamowienie->setDataZamowienia($row['data_zamowienia']);
            $zamowienie->setDataRealizacji($row['data_realizacji']);
            $zamowienie->setStatus($row['status']);
            $zamowienia[] = $zamowienie;
        }
        $this->registry->template->zamowienia = $zamowienia;
        $this->registry->template->show('zamowienie/zamowienie_indexUser');
    }

    public function add() {
        $this->ograniczDostepTylkoDlaZalogowanegoUzytkownika();
        $error = "";
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $adres = trim($_POST['adres']);
            if (empty($adres)) {
                $error .= 'Uzupełnij pole adres <br />';
            }
            $uwagi = trim($_POST['uwagi']);
            if (empty($uwagi)) {
                $error .= 'Uzupełnij pole uwagi <br />';
            }


            if (!isset($_POST['produkty']) && !isset($_POST['ilosci']) &&
                    (count($_POST['produkty']) == count($_POST['ilosci']) )) {
                $error .= 'Wybierz Produkty <br />';
            } else {
                $produktyPost = $_POST['produkty'];
                $ilosciPost = $_POST['ilosci'];
                $produkty = array();
                for ($i = 0; $i < count($produktyPost); $i++) {
                    $p = $produktyPost[$i];

                    $ilosc = $ilosciPost[$i];
                    //  echo $p.' '.$ilosc.'<br />';
                    $produkt = $db::getProduktById($p);

                    $produktZamowienia = new ProduktZamowienia();
                    $produktZamowienia->setIlosc($ilosc);
                    $produktZamowienia->setProdukt($produkt);
                    $produktZamowienia->setIdProduktu($produkt->getIdProduktu());
                    $produkty[] = $produktZamowienia;
                }
            }


            if (empty($error)) {
                $zamowienie = new Zamowienie();
                $zamowienie->setProdukty($produkty);
                $kwota = 0.0;
                foreach ($produkty as $p) {
                    $kwota += $p->getProdukt()->getCena() * $p->getIlosc();
                }
                $zamowienie->setCena($kwota);
                $zamowienie->setStatus("nowe");
                $zamowienie->setUwagi($uwagi);
                $zamowienie->setAdres($adres);
                $user = $db::getUserByLogin($_SESSION['user']);
                $userId = $user->getId();
                $zamowienie->setIdKlienta($userId);
                $zamowienie->setUpust(0.0);
                if ($db::addZamowienie($zamowienie)) {
                    $error .= 'Dodano zamowienie <br />';
                } else {
                    $error .= 'Dodanie zamowienia nie powiodło się <br />';
                }
            }

            $this->registry->template->error = $error;
        }

        $this->registry->template->show('zamowienie/zamowienie_add');
    }

    public function edit() {
        
    }

    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $id = trim($_POST['id']);
                $zamowienie = $db::getZamowienieById($id);
                if ($db::deleteZamowienie($zamowienie)) {
                    $error .= 'Usunięto zamówienie <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/zamowienie';
                header("Location: $location");
            }
            $this->registry->template->error = $error;
            $this->registry->template->show('zamowienie/zamowienie_action_result');
        } else {
            $id = $this->registry->id;
            $zamowienie = $db::getZamowienieById($id);
            $this->registry->template->model = $zamowienie;
            $this->registry->template->show('zamowienie/zamowienie_delete');
        }
    }

    public function pay() {
        $this->ograniczDostepTylkoDlaZalogowanegoUzytkownika();
        $db = $this->registry->db;
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['pay'])) {
                $id = trim($_POST['id']);
                $zamowienie = $db::getZamowienieById($id);
                $zamowienie->setStatus("Zapłacone");
                if ($db::payZamowienie($zamowienie)) {
                    $error .= 'Zapłacono za zamówienie <br />';
                } else {
                    $error .= 'Operacja zapłaty nie powiodła się <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/zamowienie';
                header("Location: $location");
            }
            $this->registry->template->error = $error;
            $this->registry->template->show('zamowienie/zamowienie_action_result');
        } else {
            $id = $this->registry->id;
            $zamowienie = $db::getZamowienieById($id);
            $this->registry->template->model = $zamowienie;
            $this->registry->template->show('zamowienie/zamowienie_pay');
        }
    }

    public function realize() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['realize'])) {
                $id = trim($_POST['id']);
                $zamowienie = $db::getZamowienieById($id);
                $zamowienie->setStatus("Zrealizowane");
                if ($db::realizeZamowienie($zamowienie)) {
                    $error .= 'Wysłano zamówienie <br />';
                } else {
                    $error .= 'Realizacja nie powiodła się <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/zamowienie';
                header("Location: $location");
            }
            $this->registry->template->error = $error;
            $this->registry->template->show('zamowienie/zamowienie_action_result');
        } else {
            $id = $this->registry->id;
            $zamowienie = $db::getZamowienieById($id);
            $this->registry->template->model = $zamowienie;
            $this->registry->template->show('zamowienie/zamowienie_realize');
        }
    }
    
    
    private function wyslijMaila($email, $tresc){
        //todo
    }

}

?>