<h1>Lista produktów</h1>
<br />

<table border="1">
    <tr>
        <th>
            Id
        </th>
        <th>
            Nazwa
        </th>
        <th>
            Cena
        </th>
        <th>
            Kategoria
        </th>
        <th>
            Marka
        </th>
        <th>
            Rozmiary
        </th>
        <th>
            Kolory
        </th>
        <th>
            Edytuj
        </th>
        <th>
            Usuń
        </th>
    </tr>
    <?php
    foreach ($produkty as $produkt) {
        echo '<tr>';
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
        echo '<td><a href="produkt/edit/' . $produkt->getIdProduktu() . '">Edytuj</a></td>';
        echo '<td><a href="produkt/delete/' . $produkt->getIdProduktu() . '">Usuń</a></td>';
        echo '</tr>';
    }
    ?>
</table>

<br />
<a href="produkt/add">Dodaj</a>
