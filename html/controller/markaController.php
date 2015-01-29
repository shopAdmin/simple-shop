<?php

class markaController extends baseController {

    public function index() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $this->registry->template->results = $db::getMarkaList();
        $this->registry->template->show('marka/marka_index');
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
            $adres = trim($_POST['adres']);
            if (empty($adres)) {
                $error .= 'Uzupełnij pole adres <br />';
            }
            $telefon = trim($_POST['telefon']);
            if (empty($telefon)) {
                $error .= 'Uzupełnij pole telefon <br />';
            }
            $email = trim($_POST['email']);
            if (empty($email)) {
                $error .= 'Uzupełnij pole email <br />';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error .= 'Nieprawidłowy email <br />';
            }
            $opis = trim($_POST['opis']);

            if (empty($error)) {
                $marka = new Marka();
                $marka->setNazwa($nazwa);
                $marka->setAdres($adres);
                $marka->setEmail($email);
                $marka->setOpis($opis);
                $marka->setTelefon($telefon);
                if ($db::addMarka($marka)) {
                    $error .= 'Dodano markę <br />';
                } else {
                    $error .= 'Dodanie marki nie powiodło się <br />';
                }
            }
            $this->registry->template->error = $error;
        }
        $this->registry->template->show('marka/marka_add');
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
            $adres = trim($_POST['adres']);
            if (empty($adres)) {
                $error .= 'Uzupełnij pole adres <br />';
            }
            $telefon = trim($_POST['telefon']);
            if (empty($telefon)) {
                $error .= 'Uzupełnij pole telefon <br />';
            }
            $email = trim($_POST['email']);
            if (empty($email)) {
                $error .= 'Uzupełnij pole email <br />';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error .= 'Nieprawidłowy email <br />';
            }
            $opis = trim($_POST['opis']);
            if (empty($error)) {
                $marka = new Marka();
                $id = trim($_POST['id']);
                $marka->setIdMarki($id);
                $marka->setNazwa($nazwa);
                $marka->setAdres($adres);
                $marka->setEmail($email);
                $marka->setOpis($opis);
                $marka->setTelefon($telefon);

                if ($db::updateMarka($marka)) {
                    $error .= 'Edycja zakończona pomyślnie <br />';
                } else {
                    $error .= 'Edycja nie powiodła się <br />';
                }
            }
            $this->registry->template->error = $error;
        } else {
            $id = $this->registry->id;
            $marka = $db::getMarkaById($id);
            $this->registry->template->model = $marka;
        }
        $this->registry->template->show('marka/marka_edit');
    }

    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $marka = new Marka();
                $id = trim($_POST['id']);
                $marka->setIdMarki($id);
                if ($db::deleteMarka($marka)) {
                    $error .= 'Usunięto markę <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się. Marka może być aktualnie używana w ofercie. <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/marka';
                header("Location: $location");
            }
            $this->registry->template->error = $error;
            $this->registry->template->show('marka/marka_action_result');
        } else {
            $id = $this->registry->id;
            $marka = $db::getMarkaById($id);
            $this->registry->template->model = $marka;
            $this->registry->template->show('marka/marka_delete');
        }
    }

}

?>