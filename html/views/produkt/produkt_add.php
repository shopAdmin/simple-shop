<h1>Dodaj produkt</h1>
<?php
if (!empty($error)) {
    echo $error;
}
?>

<form method="POST" action="/<?= APP_ROOT ?>/produkt/add">
    <label>Nazwa </label>
    <input type="text" name="nazwa" /> <br />
    <label>Cena </label>
    <input type="text" name="cena" /> <br />
    <label>Kategoria</label>
    <select name="kategoria">
        <?php
        foreach ($kategorie as $kategoria) {
            echo '<option value="' . $kategoria['id_kategorii'] . '">' . $kategoria['nazwa'] . '</option>';
        }
        ?>
    </select>
    <br />
    <label>Marka</label>
    <select name="marka">
        <?php
        foreach ($marki as $marka) {
            echo '<option value="' . $marka['id_marki'] . '">' . $marka['nazwa'] . '</option>';
        }
        ?>
    </select>
    <br />
    <label>Kolory</label><br />
    <?php
    foreach ($kolory as $kolor) {

        echo $kolor['nazwa'] . ' <input type="checkbox" name="kolory[]" value="' . $kolor['id_koloru'] . '"/>&nbsp; &nbsp; &nbsp; &nbsp;';
    }
    ?>

    <br />
    <label>Rozmiary</label><br />
    <?php
    foreach ($rozmiary as $rozmiar) {

        echo $rozmiar['nazwa'] . ' <input type="checkbox" name="rozmiary[]" value="' . $rozmiar['id_rozmiaru'] . '"/>&nbsp; &nbsp; &nbsp; &nbsp;';
    }
    ?>
    <br />

    <label>Opis </label>
    <input type="text" name="opis" /> <br />
    <input type="submit" value="Dodaj" /> <br />
</form>