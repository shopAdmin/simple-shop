<?php

Class Database {

    private static $db;

    public static function getInstance() {
        if (!self::$db) {
            self::$db = new PDO('mysql:host=localhost;dbname=ciucholand;charset=utf8', 'root', '');
            return new Database();
        }
    }

    //użytkownicy

    public static function addUser($user) {
        $stmt = self::$db->prepare("INSERT INTO uzytkownik(imie,nazwisko,adres,telefon,email,login,haslo) "
                . "VALUES(:imie,:nazwisko,:adres,:telefon,:email,:login,:haslo)");
        $stmt->execute(array(
            ':imie' => $user->getImie(), ':nazwisko' => $user->getNazwisko(), ':adres' => $user->getAdres(),
            ':telefon' => $user->getTelefon(), ':email' => $user->getEmail(),
            ':login' => $user->getLogin(), ':haslo' => sha1($user->getHaslo()))
        );
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function getUserByID($id) {
        $stmt = $db->prepare('SELECT * FROM uzytkownik WHERE id=?');
        $stmt->execute(array($id));
        if ($stmt->rowCount > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $user = new Uzytkownik;
            $user->setId($result['id']);
            $user->setImie($result['imie']);
            $user->setNazwisko($result['nazwisko']);
            $user->setAdres($result['adres']);
            $user->setTelefon($result['telefon']);
            $user->setEmail($result['email']);
            $user->setLogin($result['login']);
            $user->setHaslo($result['haslo']);
            $role = self::userRoles($result['login']);
            $user->setRole($role);
            return $user;
        }
    }

    public static function getUserByLoginAndPassword($login, $password) {
        $stmt = self::$db->prepare('SELECT * FROM uzytkownik WHERE login=? and haslo=?');
        $stmt->execute(array($login, sha1($password)));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $user = new Uzytkownik();
            $user->setId($result['id']);
            $user->setImie($result['imie']);
            $user->setNazwisko($result['nazwisko']);
            $user->setAdres($result['adres']);
            $user->setTelefon($result['telefon']);
            $user->setEmail($result['email']);
            $user->setLogin($result['login']);
            $user->setHaslo($result['haslo']);
            $role = self::userRoles($result['login']);
            $user->setRole($role);
            return $user;
        }
    }

    public static function getUserByLogin($login) {
        $stmt = self::$db->prepare('SELECT * FROM uzytkownik WHERE login=?');
        $stmt->execute(array($login));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $user = new Uzytkownik();
            $user->setId($result['id']);
            $user->setImie($result['imie']);
            $user->setNazwisko($result['nazwisko']);
            $user->setAdres($result['adres']);
            $user->setTelefon($result['telefon']);
            $user->setEmail($result['email']);
            $user->setLogin($result['login']);
            $user->setHaslo($result['haslo']);
            $role = self::userRoles($result['login']);
            $user->setRole($role);
            return $user;
        }
    }

    public static function getUserByEmail($email) {
        $stmt = self::$db->prepare('SELECT * FROM uzytkownik WHERE email=?');
        $stmt->execute(array($email));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $user = new Uzytkownik();
            $user->setId($result['id']);
            $user->setImie($result['imie']);
            $user->setNazwisko($result['nazwisko']);
            $user->setAdres($result['adres']);
            $user->setTelefon($result['telefon']);
            $user->setEmail($result['email']);
            $user->setLogin($result['login']);
            $user->setHaslo($result['haslo']);
            $role = self::userRoles($result['login']);
            $user->setRole($role);
            return $user;
        }
    }

    //role

    public static function isUserInRole($login, $role) {
        $userRoles = self::userRoles($login);
        return in_array($role, $userRoles);
    }

    public static function userRoles($login) {
        $stmt = self::$db->prepare("SELECT r.name FROM uzytkownik u 	
		INNER JOIN users_roles ur on(u.id = ur.user_id)
		INNER JOIN roles r on(ur.role_id = r.id)
		WHERE	u.login = ?");
        $stmt->execute(array($login));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $roles = array();
        for ($i = 0; $i < count($result); $i++) {
            $roles[] = $result[$i]['name'];
        }
        return $roles;
    }

    //kolory

    public static function getKolorById($id) {
        $stmt = self::$db->prepare('SELECT * FROM kolor WHERE id_koloru=?');
        $stmt->execute(array($id));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $kolor = new Kolor();
            $kolor->setIdKoloru($result['id_koloru']);
            $kolor->setNazwa($result['nazwa']);
            return $kolor;
        }
    }

    public static function addKolor($kolor) {
        $stmt = self::$db->prepare("INSERT INTO kolor(nazwa) "
                . "VALUES(:nazwa)");
        $stmt->execute(array(':nazwa' => $kolor->getNazwa()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function getKolorList() {
        $stmt = self::$db->query('SELECT * FROM kolor');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteKolor($kolor) {
        $stmt = self::$db->prepare('DELETE FROM kolor WHERE id_koloru=?');
        $stmt->execute(array($kolor->getIdKoloru()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function updateKolor($kolor) {
        $stmt = self::$db->prepare('UPDATE kolor set nazwa=? WHERE id_koloru=?');
        $stmt->execute(array($kolor->getNazwa(), $kolor->getIdKoloru()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function getKoloryProduktu($idProduktu) {
        $stmt = self::$db->prepare('SELECT * FROM kolor_produktu WHERE id_produktu=?');
        $stmt->execute(array($idProduktu));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $kolory = array();
        foreach ($results as $row) {
            $idKoloru = $row['id_koloru'];
            $kolor = self::getKolorById($idKoloru);
            $kolory[] = $kolor;
        }
        return $kolory;
    }

    //rozmiary

    public static function getRozmiarById($id) {
        $stmt = self::$db->prepare('SELECT * FROM rozmiar WHERE id_rozmiaru=?');
        $stmt->execute(array($id));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $rozmiar = new Rozmiar();
            $rozmiar->setIdRozmiaru($result['id_rozmiaru']);
            $rozmiar->setNazwa($result['nazwa']);
            return $rozmiar;
        }
    }

    public static function addRozmiar($rozmiar) {
        $stmt = self::$db->prepare("INSERT INTO rozmiar(nazwa) "
                . "VALUES(:nazwa )");
        $stmt->execute(array(':nazwa' => $rozmiar->getNazwa()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function getRozmiarList() {
        $stmt = self::$db->query('SELECT * FROM rozmiar');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteRozmiar($rozmiar) {
        $stmt = self::$db->prepare('DELETE FROM rozmiar WHERE id_rozmiaru=?');
        $stmt->execute(array($rozmiar->getIdRozmiaru()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function updateRozmiar($rozmiar) {
        $stmt = self::$db->prepare('UPDATE rozmiar set nazwa=? WHERE id_rozmiaru=?');
        $stmt->execute(array($rozmiar->getNazwa(), $rozmiar->getIdRozmiaru()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function getRozmiaryProduktu($idProduktu) {
        $stmt = self::$db->prepare('SELECT * FROM rozmiar_produktu WHERE id_produktu=?');
        $stmt->execute(array($idProduktu));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rozmiary = array();
        foreach ($results as $row) {
            $idRozmiaru = $row['id_rozmiaru'];
            $rozmiar = self::getRozmiarById($idRozmiaru);
            $rozmiary[] = $rozmiar;
        }
        return $rozmiary;
    }

    /*
     * kategorie
     */

    public static function getKategoriaById($id) {
        $stmt = self::$db->prepare('SELECT * FROM kategoria WHERE id_kategorii=?');
        $stmt->execute(array($id));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $kategoria = new Kategoria();
            $kategoria->setIdKategorii($result['id_kategorii']);
            $kategoria->setNazwa($result['nazwa']);
            $kategoria->setOpis($result['opis']);
            return $kategoria;
        }
    }

    public static function addKategoria($kategoria) {
        $stmt = self::$db->prepare("INSERT INTO kategoria(nazwa,opis) "
                . "VALUES(:nazwa , :opis)");
        $stmt->execute(array(':nazwa' => $kategoria->getNazwa(), ':opis' => $kategoria->getOpis()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function getKategoriaList() {
        $stmt = self::$db->query('SELECT * FROM kategoria');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteKategoria($kategoria) {
        $stmt = self::$db->prepare('DELETE FROM kategoria WHERE id_kategorii=?');
        $stmt->execute(array($kategoria->getIdKategorii()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function updateKategoria($kategoria) {
        $stmt = self::$db->prepare('UPDATE kategoria set nazwa=? , opis=? WHERE id_kategorii=?');
        $stmt->execute(array($kategoria->getNazwa(), $kategoria->getOpis(), $kategoria->getIdKategorii()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    /*
     * Marki
     */

    public static function getMarkaById($id) {
        $stmt = self::$db->prepare('SELECT * FROM marka WHERE id_marki=?');
        $stmt->execute(array($id));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $marka = new Marka();
            $marka->setIdMarki($result['id_marki']);
            $marka->setNazwa($result['nazwa']);
            $marka->setAdres($result['adres']);
            $marka->setEmail($result['email']);
            $marka->setOpis($result['opis']);
            $marka->setTelefon($result['telefon']);
            return $marka;
        }
    }

    public static function addMarka($marka) {
        $stmt = self::$db->prepare("INSERT INTO marka(nazwa,adres,email,opis,telefon) "
                . "VALUES(:nazwa , :adres, :email, :opis, :telefon)");
        $stmt->execute(array(
            ':nazwa' => $marka->getNazwa(),
            ':adres' => $marka->getAdres(),
            ':opis' => $marka->getOpis(),
            ':telefon' => $marka->getTelefon(),
            ':email' => $marka->getEmail()
        ));

        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function getMarkaList() {
        $stmt = self::$db->query('SELECT * FROM marka');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteMarka($marka) {
        $stmt = self::$db->prepare('DELETE FROM marka WHERE id_marki=?');
        $stmt->execute(array($marka->getIdMarki()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function updateMarka($marka) {
        $stmt = self::$db->prepare('UPDATE marka set nazwa=:nazwa, adres=:adres, email=:email, telefon=:telefon,'
                . 'opis=:opis WHERE id_marki=:id');
        $stmt->execute(array(
            ':id' => $marka->getIdMarki(),
            ':nazwa' => $marka->getNazwa(),
            ':adres' => $marka->getAdres(),
            ':opis' => $marka->getOpis(),
            ':telefon' => $marka->getTelefon(),
            ':email' => $marka->getEmail()
        ));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    /*
     * Produkty
     */

    public static function getProduktById($id) {
        $stmt = self::$db->prepare('SELECT * FROM produkt p WHERE id_produktu=?');
        $stmt->execute(array($id));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $produkt = new Produkt();
            $produkt->setIdProduktu($result['id_produktu']);
            $produkt->setNazwa($result['nazwa']);
            $produkt->setIdKategorii($result['id_kategorii']);
            $produkt->setKategoria(self::getKategoriaById($result['id_kategorii']));
            $produkt->setMarka(self::getMarkaById($result['id_marki']));
            $produkt->setIdMarki($result['id_marki']);
            $produkt->setCena($result['cena']);
            $produkt->setOpis($result['opis']);
            $produkt->setRozmiary(self::getRozmiaryProduktu($result['id_produktu']));
            $produkt->setKolory(self::getKoloryProduktu($result['id_produktu']));
            return $produkt;
        }
    }

    public static function addProdukt($produkt) {
        $stmt = self::$db->prepare("INSERT INTO produkt(nazwa,cena,id_kategorii,id_marki,opis) "
                . "VALUES(:nazwa , :cena, :id_kategorii, :id_marki, :opis)");
        $stmt->execute(array(
            ':nazwa' => $produkt->getNazwa(),
            ':id_kategorii' => $produkt->getIdKategorii(),
            ':id_marki' => $produkt->getIdMarki(),
            ':cena' => $produkt->getCena(),
            ':opis' => $produkt->getOpis()
        ));

        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            $idProduktu = self::$db->lastInsertId();
            if (!empty($idProduktu)) {
                foreach ($produkt->getKolory() as $kolor) {
                    $stmt = self::$db->prepare("INSERT INTO kolor_produktu(id_produktu, id_koloru) "
                            . "VALUES(:id_produktu , :id_koloru)");
                    $stmt->execute(array(
                        ':id_produktu' => $idProduktu,
                        ':id_koloru' => $kolor->getIdKoloru()
                    ));
                }
                foreach ($produkt->getRozmiary() as $rozmiar) {
                    $stmt = self::$db->prepare("INSERT INTO rozmiar_produktu(id_produktu, id_rozmiaru) "
                            . "VALUES(:id_produktu , :id_rozmiaru)");
                    $stmt->execute(array(
                        ':id_produktu' => $idProduktu,
                        ':id_rozmiaru' => $rozmiar->getIdRozmiaru()
                    ));
                }
                return TRUE;
            }
        }
        return FALSE;
    }

    public static function getProduktList() {
        $stmt = self::$db->query('SELECT * FROM produkt');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteProdukt($produkt) {
        $stmt = self::$db->prepare('DELETE FROM produkt WHERE id_produktu=?');
        $stmt->execute(array($produkt->getIdProduktu()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function updateProdukt($produkt) {
        try {
            self::$db->beginTransaction();
            $stmt = self::$db->prepare('UPDATE produkt set nazwa=:nazwa, cena=:cena, '
                    . 'id_kategorii=:id_kategorii, id_marki=:id_marki,'
                    . 'opis=:opis WHERE id_produktu=:id');
            $stmt->execute(array(
                ':id' => $produkt->getIdProduktu(),
                ':nazwa' => $produkt->getNazwa(),
                ':id_kategorii' => $produkt->getIdKategorii(),
                ':id_marki' => $produkt->getIdMarki(),
                ':opis' => $produkt->getOpis(),
                ':cena' => $produkt->getCena()
            ));

            $affected_rows = $stmt->rowCount();
            if ($affected_rows == 1) {
                $stmt = self::$db->prepare("DELETE FROM  kolor_produktu WHERE id_produktu=:id_produktu");
                $stmt->execute(array(
                    ':id_produktu' => $produkt->getIdProduktu()
                ));
                foreach ($produkt->getKolory() as $kolor) {
                    $stmt = self::$db->prepare("INSERT INTO kolor_produktu(id_produktu, id_koloru) "
                            . "VALUES(:id_produktu , :id_koloru)");
                    $stmt->execute(array(
                        ':id_produktu' => $produkt->getIdProduktu(),
                        ':id_koloru' => $kolor->getIdKoloru()
                    ));
                }
                $stmt = self::$db->prepare("DELETE FROM  rozmiar_produktu WHERE id_produktu=:id_produktu");
                $stmt->execute(array(
                    ':id_produktu' => $produkt->getIdProduktu()
                ));
                foreach ($produkt->getRozmiary() as $rozmiar) {
                    $stmt = self::$db->prepare("INSERT INTO rozmiar_produktu(id_produktu, id_rozmiaru) "
                            . "VALUES(:id_produktu , :id_rozmiaru)");
                    $stmt->execute(array(
                        ':id_produktu' => $produkt->getIdProduktu(),
                        ':id_rozmiaru' => $rozmiar->getIdRozmiaru()
                    ));
                }
            }
            self::$db->commit();
            return TRUE;
        } catch (Exception $ex) {
            echo $ex;
            self::$db->rollBack();
            return FALSE;
        }
    }

    /*
     * Zamówienia
     */

    public static function getZamowienieById($id) {
        $stmt = self::$db->prepare('SELECT * FROM zamowienie WHERE id_zamowienia=?');
        $stmt->execute(array($id));
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $results[0];
            $zamowienie = new Zamowienie();
            $zamowienie->setIdZamowienia($result['id_zamowienia']);

            $produktyZamowienia = self::getProduktyZamowienia($id);
            $zamowienie->setProdukty($produktyZamowienia);
            $kwota = 0.0;
            foreach ($produktyZamowienia as $p) {
                $kwota += $p->getProdukt()->getCena() * $p->getIlosc();
            }
            $zamowienie->setCena($kwota);
            $zamowienie->setAdres($result['adres']);
            $zamowienie->setDataRealizacji($result['data_realizacji']);
            $zamowienie->setDataZamowienia($result['data_zamowienia']);
            $zamowienie->setIdKlienta($result['id_klienta']);
            $zamowienie->setStatus($result['status']);
            $zamowienie->setUpust($result['upust']);
            $zamowienie->setUwagi($result['uwagi_dodatkowe']);
            return $zamowienie;
        }
    }

    public static function addZamowienie($zamowienie) {
        $stmt = self::$db->prepare("INSERT INTO zamowienie(id_klienta,upust,adres,uwagi_dodatkowe,status) "
                . "VALUES(:id_klienta , :upust,  :adres, :uwagi_dodatkowe, :status)");
        $stmt->execute(array(
            ':id_klienta' => $zamowienie->getIdKlienta(),
            ':upust' => $zamowienie->getUpust(),
            ':adres' => $zamowienie->getAdres(),
            ':uwagi_dodatkowe' => $zamowienie->getUwagi(),
            ':status' => $zamowienie->getStatus()
        ));

        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            $idZamowienia = self::$db->lastInsertId();
            if (!empty($idZamowienia)) {
                foreach ($zamowienie->getProdukty() as $produkt) {
                    $stmt = self::$db->prepare("INSERT INTO szczegoly_zamowienia(id_zamowienia, id_produktu,ilosc) "
                            . "VALUES(:id_zamowienia, :id_produktu , :ilosc)");
                    $stmt->execute(array(
                        ':id_produktu' => $produkt->getIdProduktu(),
                        ':id_zamowienia' => $idZamowienia,
                        ':ilosc' => $produkt->getIlosc()
                    ));
                }
                return TRUE;
            }
        }
        return FALSE;
    }

    public static function getZamowienieList() {
        $stmt = self::$db->query('SELECT * FROM zamowienie');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
     public static function getZamowienieUserList($idUser) {
        $stmt = self::$db->prepare('SELECT * FROM zamowienie WHERE id_klienta=?');
        $stmt->execute(array($idUser));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    public static function getProduktyZamowienia($idZamowienia) {
        $stmt = self::$db->prepare('SELECT * FROM szczegoly_zamowienia WHERE id_zamowienia=?');
        $stmt->execute(array($idZamowienia));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $produkty = array();
        foreach ($results as $row) {
            $idProduktu = $row['id_produktu'];
            $produkt = self::getProduktById($idProduktu);
            $produktZamowienia = new ProduktZamowienia();
            $produktZamowienia->setIdProduktu($idProduktu);
            $produktZamowienia->setIdZamowienia($idZamowienia);
            $produktZamowienia->setIlosc($row['ilosc']);
            $produktZamowienia->setProdukt($produkt);
            $produkty[] = $produktZamowienia;
        }
        return $produkty;
    }

    public static function deleteZamowienie($zamowienie) {
        $stmt = self::$db->prepare('DELETE FROM zamowienie WHERE id_zamowienia=?');
        $stmt->execute(array($zamowienie->getIdZamowienia()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function payZamowienie($zamowienie) {
        $stmt = self::$db->prepare('UPDATE zamowienie SET status=? , data_zamowienia=now() WHERE id_zamowienia=?');
        $stmt->execute(array($zamowienie->getStatus(),$zamowienie->getIdZamowienia()));
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }
    
      public static function realizeZamowienie($zamowienie) {
        $stmt = self::$db->prepare('UPDATE zamowienie SET data_realizacji=now() , status=? WHERE id_zamowienia=?');
        $stmt->execute(array($zamowienie->getStatus(),$zamowienie->getIdZamowienia()));
        
        $affected_rows = $stmt->rowCount();
        if ($affected_rows == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public static function updateZamowienie($zamowienie) {
        
    }
    
    
    

}

?>