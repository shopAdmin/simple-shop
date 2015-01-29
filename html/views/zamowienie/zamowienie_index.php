<h1>Lista zamówień</h1>
<br />

<table border="1">
    <tr>
        <th>
            Id
        </th>
        <th>
            Produkty
        </th>
        <th>
            Cena
        </th>
        <th>
            Data zamówienia
        </th>
        <th>
            Data realizacji
        </th>
         <th>
            Adres
        </th>
        <th>
            Uwagi
        </th>
         <th>
            Status
        </th>
        <th>
            Zapłać
        </th>
        <th>
            Realizuj
        </th>
        <th>
            Usuń
        </th>
    </tr>
    <?php
    foreach ($zamowienia as $zamowienie) {
        echo '<tr>';
        echo '<td>' . $zamowienie->getIdZamowienia() . '</td>';
        echo '<td><table>'
        . '<tr><th>Nazwa</th><th>Cena</th><th>Ilość</th></tr>';
        foreach ($zamowienie->getProdukty() as $produktZamowienie) {
            echo '<tr>';
            echo '<td>' . $produktZamowienie->getProdukt()->getNazwa() . '</td>';
            echo '<td>' . $produktZamowienie->getProdukt()->getCena() . '</td>';
            echo '<td>' . $produktZamowienie->getIlosc() . '</td>';
            echo '</tr>';
        }
        echo '</table></td>';
        echo '<td>' . $zamowienie->getCena() . '</td>';
        echo '<td>' . $zamowienie->getDataZamowienia() . '</td>';
        echo '<td>' . $zamowienie->getDataRealizacji() . '</td>';
        echo '<td>' . $zamowienie->getAdres() . '</td>';
        echo '<td>' . $zamowienie->getUwagi() . '</td>';
         echo '<td>' . $zamowienie->getStatus() . '</td>';
        echo '<td><a href="zamowienie/pay/' . $zamowienie->getIdZamowienia() . '">Zapłać</a></td>';
        echo '<td><a href="zamowienie/realize/' . $zamowienie->getIdZamowienia() . '">Realizuj</a></td>';
        echo '<td><a href="zamowienie/delete/' . $zamowienie->getIdZamowienia() . '">Usuń</a></td>';
        echo '</tr>';
    }
    ?>
</table>

<br />

<a href="zamowienie/add">Złóż nowe zamówienie</a>