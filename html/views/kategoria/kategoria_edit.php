<h1>Edytuj kategorię</h1>
<?php
if (!empty($error)) {
    echo $error;
}
$nazwa = "";
$opis = "";
$id = "";
if (!empty($model)) {
    $nazwa = $model->getNazwa();
    $opis = $model->getOpis();
    $id = $model->getIdKategorii();
}
?>

<form method="POST" action="/<?= APP_ROOT ?>/kategoria/edit">
    <label>Nazwa </label>
    <input type="text" name="nazwa" value="<?= $nazwa ?>" /> <br />
    <label>Opis </label>
    <input type="text" name="opis" value="<?= $opis ?>" /> <br />
    <input type="hidden" name="id" value="<?=$id?>" />
    <input type="submit" value="Zapisz" /> <br />
</form>