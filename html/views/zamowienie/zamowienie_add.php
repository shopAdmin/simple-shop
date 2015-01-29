<h1>Dodaj zamówienie</h1>
<?php
if (!empty($error)) {
    echo $error;
}
?>

<form method="POST" action="/<?= APP_ROOT ?>/zamowienie/add">
    <label>Adres </label>
    <input type="text" name="adres" /> <br />
    <label>Uwagi </label>
    <input type="text" name="uwagi" /> <br />
    <label>Produkty</label>

    <table border="1">
        <tr>
            <td>
                Kup
            </td>
            <td>
                Ilość
            </td>
            <td>
                Id
            </td>
            <td>
                Nazwa
            </td>
            <td>
                Cena
            </td>
            <td>
                Kategoria
            </td>
            <td>
                Marka
            </td>
            <td>
                Rozmiary
            </td>
            <td>
                Kolory
            </td>
        </tr>
        <?php
        foreach ($produkty as $produkt) {
            echo '<tr>';
            echo '<td><input type="checkbox" name="produkty[]" value="' . $produkt->getIdProduktu() . '"/></td>';
            echo '<td><input type="text" name="ilosci[]" value="1"/></td>';
            echo '<td>' . $produkt->getIdProduktu() . '</td>';
            echo '<td>' . $produkt->getNazwa() . '</td>';
            echo '<td>' . $produkt->getCena() . '</td>';
            echo '<td>' . $produkt->getKategoria()->getNazwa() . '</td>';
            echo '<td>' . $produkt->getMarka()->getNazwa() . '</td>';
            echo '<td>';
            foreach ($produkt->getRozmiary() as $rozmiar) {
                echo $rozmiar->getNazwa() . ' <br /> ';
            }
            echo '</td>';
            echo '<td>';
            foreach ($produkt->getKolory() as $kolor) {
                echo $kolor->getNazwa() . ' <br /> ';
            }
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </table>
    <!-- -->


    <input type="submit" value="Dodaj" /> <br />
</form>