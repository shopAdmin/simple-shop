<h1>Edytuj kolor</h1>
<?php
if (!empty($error)) {
    echo $error;
}
$nazwa = "";
$id = "";
if (!empty($kolor)) {
    $nazwa = $kolor->getNazwa();
    $id = $kolor->getIdKoloru();
}
?>

<form method="POST" action="/<?= APP_ROOT ?>/kolor/edit">
    <label>Nazwa </label>
    <input type="text" name="nazwa" value="<?= $nazwa ?>" /> <br />
    <input type="hidden" name="id" value="<?=$id?>" />
    <input type="submit" value="Zapisz" /> <br />
</form>