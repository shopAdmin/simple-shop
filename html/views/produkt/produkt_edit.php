<h1>Edytuj produkt</h1>
<?php
if (!empty($error)) {
    echo $error;
}

$nazwa = "";
$cena = "";
$opis = "";
$kategorie = array();
$kolory = array();
$id = "";

if (!empty($model)) {
    $id = $model->getIdProduktu();
    $nazwa = $model->getNazwa();
    $cena = $model->getCena();
    $opis = $model->getOpis();
    $kategoriaProduktu = $model->getKategoria();
    $markaProduktu = $model->getMarka();
    $rozmiaryProduktu = $model->getRozmiary();
    $koloryProduktu = $model->getKolory();
}
?>

<form method="POST" action="/<?= APP_ROOT ?>/produkt/edit">

    <label>Nazwa </label>
    <input type="text" name="nazwa" value="<?= $nazwa ?>" /> <br />
    <input type="hidden" name="id" value="<?= $id ?>" />
    <label>Cena </label>
    <input type="text" name="cena"  value="<?= $cena ?>"/> <br />
    <label>Kategoria</label>
    <select name="kategoria">
        <?php
        foreach ($kategorieAll as $kategoria) {
            if ($kategoria['id_kategorii'] == $kategoriaProduktu->getIdKategorii()) {
                echo '<option value="' . $kategoria['id_kategorii'] . '" selected>' . $kategoria['nazwa'] . '</option>';
            } else {
                echo '<option value="' . $kategoria['id_kategorii'] . '" >' . $kategoria['nazwa'] . '</option>';
            }
        }
        ?>
    </select>
    <br />
    <label>Marka</label>
    <select name="marka">
        <?php
        foreach ($markiAll as $marka) {
            if ($marka['id_marki'] == $markaProduktu->getIdMarki()) {
                echo '<option value="' . $marka['id_marki'] . '" selected>' . $marka['nazwa'] . '</option>';
            } else {
                echo '<option value="' . $marka['id_marki'] . '" >' . $marka['nazwa'] . '</option>';
            }
        }
        ?>
    </select>
    <br />
    <label>Kolory</label><br />
    <?php
    foreach ($koloryAll as $kolor) {
        if ($model->zawieraKolor($kolor['id_koloru'])) {
            echo $kolor['nazwa'] . ' <input type="checkbox" checked="checked" name="kolory[]" value="' . $kolor['id_koloru'] . '"/>&nbsp; &nbsp; &nbsp; &nbsp;';
        } else {
            echo $kolor['nazwa'] . ' <input type="checkbox" name="kolory[]" value="' . $kolor['id_koloru'] . '"/>&nbsp; &nbsp; &nbsp; &nbsp;';
        }
    }
    ?>

    <br />
    <label>Rozmiary</label><br />
    <?php
    foreach ($rozmiaryAll as $rozmiar) {
        if ($model->zawieraRozmiar($rozmiar['id_rozmiaru'])) {
            echo $rozmiar['nazwa'] . ' <input type="checkbox" checked="checked" name="rozmiary[]" value="' . $rozmiar['id_rozmiaru'] . '"/>&nbsp; &nbsp; &nbsp; &nbsp;';
        } else {
            echo $rozmiar['nazwa'] . ' <input type="checkbox" name="rozmiary[]" value="' . $rozmiar['id_rozmiaru'] . '"/>&nbsp; &nbsp; &nbsp; &nbsp;';
        }
    }
    ?>
    <br />

    <label>Opis </label>
    <input type="text" name="opis" value="<?= $opis ?>"/> <br />
    <input type="submit" value="Zapisz" /> <br />
</form>