<?php

class rozmiarController extends baseController {

    public function index() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $this->registry->template->results = $db::getRozmiarList();
        $this->registry->template->show('rozmiar/rozmiar_index');
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
                $rozmiar = new Rozmiar();
                $rozmiar->setNazwa($nazwa);
                if ($db::addRozmiar($rozmiar)) {
                    $error .= 'Dodano rozmiar <br />';
                } else {
                    $error .= 'Dodanie rozmiaru nie powiodło się <br />';
                }
            }
            $this->registry->template->error = $error;
        }
        $this->registry->template->show('rozmiar/rozmiar_add');
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
                $rozmiar = new Rozmiar();
                $id = trim($_POST['id']);
                $rozmiar->setIdRozmiaru($id);
                $rozmiar->setNazwa($nazwa);
                if ($db::updateRozmiar($rozmiar)) {
                    $error .= 'Edycja zakończona pomyślnie <br />';
                } else {
                    $error .= 'Edycja nie powiodła się <br />';
                }
            }
            $this->registry->template->error = $error;
        } else {
            $id = $this->registry->id;
            $rozmiar = $db::getRozmiarById($id);
            $this->registry->template->model = $rozmiar;
        }
        $this->registry->template->show('rozmiar/rozmiar_edit');
    }

    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $rozmiar = new Rozmiar();
                $id = trim($_POST['id']);
                $rozmiar->setIdRozmiaru($id);
                if ($db::deleteRozmiar($rozmiar)) {
                    $error .= 'Usunięto rozmiar <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się. Rozmiar może być aktualnie używany w ofercie. <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/rozmiar';
                header("Location: $location");
            }
            $this->registry->template->error = $error;
            $this->registry->template->show('rozmiar/rozmiar_action_result');
        } else {
            $id = $this->registry->id;
            $rozmiar = $db::getRozmiarById($id);
            $this->registry->template->model = $rozmiar;
            $this->registry->template->show('rozmiar/rozmiar_delete');
        }
    }

}

?>