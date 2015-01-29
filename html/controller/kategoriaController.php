<?php

class kategoriaController extends baseController {

    public function index() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $this->registry->template->results = $db::getKategoriaList();
        $this->registry->template->show('kategoria/kategoria_index');
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
            $opis = trim($_POST['opis']);
            if (empty($error)) {
                $kategoria = new Kategoria();
                $kategoria->setNazwa($nazwa);
                $kategoria->setOpis($opis);
                if ($db::addKategoria($kategoria)) {
                    $error .= 'Dodano kategorię <br />';
                } else {
                    $error .= 'Dodanie kategorii nie powiodło się <br />';
                }
            }
            $this->registry->template->error = $error;
        }
        $this->registry->template->show('kategoria/kategoria_add');
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
            $opis = trim($_POST['opis']);
            if (empty($error)) {
                $kategoria = new Kategoria();
                $id = trim($_POST['id']);
                $kategoria->setIdKategorii($id);
                $kategoria->setNazwa($nazwa);
                $kategoria->setOpis($opis);
                if ($db::updateKategoria($kategoria)) {
                    $error .= 'Edycja zakończona pomyślnie <br />';
                } else {
                    $error .= 'Edycja nie powiodła się <br />';
                }
            }
            $this->registry->template->error = $error;
        } else {
            $id = $this->registry->id;

            $kategoria = $db::getKategoriaById($id);
            var_dump($kategoria);
            $this->registry->template->model = $kategoria;
        }
        $this->registry->template->show('kategoria/kategoria_edit');
    }

    public function delete() {
        $this->ograniczDostepTylkoDlaAdmina();
        $db = $this->registry->db;
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $kategoria = new Kategoria();
                $id = trim($_POST['id']);
                $kategoria->setIdKategorii($id);
                if ($db::deleteKategoria($kategoria)) {
                    $error .= 'Usunięto kategorię <br />';
                } else {
                    $error .= 'Usuwanie nie powiodło się. Kategoria może być aktualnie używana przez produkty. <br />';
                }
            } else {
                $location = '/' . APP_ROOT . '/kategoria';
                header("Location: $location");
            }
            $this->registry->template->error = $error;
            $this->registry->template->show('kategoria/kategoria_action_result');
        } else {
            $id = $this->registry->id;
            $kategoria = $db::getKategoriaById($id);
            $this->registry->template->model = $kategoria;
            $this->registry->template->show('kategoria/kategoria_delete');
        }
    }
}

?>