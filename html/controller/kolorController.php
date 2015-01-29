<?php

class kolorController extends baseController {

    public function index() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $this->registry->template->kolory = $db::getKolorList();
        $this->registry->template->show('kolor/kolor_index');
    }

    public function add() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $db = $this->registry->db;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nazwa = trim($_POST['nazwa']);
            if (empty($nazwa)) {
                $error .= 'Uzupełnij pole nazwa <br />';
            }
            if (empty($error)) {
                $kolor = new Kolor();
                $kolor->setNazwa($nazwa);
                if ($db::addKolor($kolor)) {
                    $error .= 'Dodano kolor <br />';
                } else {
                    $error .= 'Dodanie koloru nie powidło się <br />';
                }
            }
            $this->registry->template->error = $error;
        }
        $this->registry->template->show('kolor/kolor_add');
    }

    public function edit() {
        $this->ograniczDostepTylkoDlaAdmina();
        $error = "";
        $db = $this->registry->db;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nazwa = trim($_POST['nazwa']);
            if (empty($nazwa)) {
                $error .= 'Uzupełnij pole nazwa <br />';
            }
            if (empty($error)) {
                $kolor = new Kolor();
                $id = trim($_POST['id']);
                $kolor->setIdKoloru($id);
                $kolor->setNazwa($nazwa);
                if ($db::updateKolor($kolor)) {
                    $error .= 'Edycja zakończona pomyślnie <br />';
                } else {
                    $error .= 'Edycja nie powiodła się <br />';
                }
            }
            $this->registry->template->error = $error;
            $this->registry->template->show('kolor/kolor_edit');
        } else {
            $id = $this->registry->id;
            $kolor = $db::getKolorById($id);
            $this->registry->template->kolor = $kolor;
            $this->registry->template->show('kolor/kolor_edit');
        }
    }

    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $kolor = new Kolor();
                $id = trim($_POST['id']);
                $kolor->setIdKoloru($id);
                if ($db::deleteKolor($kolor)) {
                    $error .= 'Usunięto kolor <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się. Kolor może być aktualne wykorzystywany w ofercie.  <br />';
                }
            } else {
                $location ='/'. APP_ROOT . '/kolor';
                header("Location: $location");
            }
            $this->registry->template->error = $error;
             $this->registry->template->show('kolor/kolor_action_result');
        } else {
            $id = $this->registry->id;
            $kolor = $db::getKolorById($id);
            $this->registry->template->kolor = $kolor;
            $this->registry->template->show('kolor/kolor_delete');
        }
    }

}

?>