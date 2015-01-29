<?php
$login = $_SESSION['user'];
if (!empty($login)) {
    $db = $registry->db;
    if ($db::isUserInRole($login, 'admin')) {
        ?>

        <ul>
            <li><a href="/<?= APP_ROOT ?>">Home</a></li>
            <li><a href="/<?= APP_ROOT ?>/produkt">Produkty</a></li>
            <li><a href="/<?= APP_ROOT ?>/kategoria">Kategorie</a></li>
            <li><a href="/<?= APP_ROOT ?>/marka">Marki</a></li>
            <li><a href="/<?= APP_ROOT ?>/kolor">Kolory</a></li>
            <li><a href="/<?= APP_ROOT ?>/rozmiar">Rozmiary</a></li>
            <li><a href="/<?= APP_ROOT ?>/zamowienie">Zamowienia</a></li>
        </ul>
        <?php
    } else {
        ?>
        <ul>
            <li><a href="/<?= APP_ROOT ?>">Home</a></li>
            <li><a href="/<?= APP_ROOT ?>/zamowienie/moje_zamowienia">Zamowienia</a></li>
        </ul>
        <?php
    }
    ?> 

    <?php
} else {
    ?>
    <ul>
        <li><a href="/<?= APP_ROOT ?>">Home</a></li>
        <li><a href="/<?= APP_ROOT ?>/zamowienie/moje_zamowienia">Zamowienia</a></li>
    </ul>
    <?php
}
?>

