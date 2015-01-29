<h1>Edytuj rozmiar</h1>
<?php
if (!empty($error)) {
    echo $error;
}
$nazwa = "";
$id = "";
if (!empty($model)) {
    $nazwa = $model->getNazwa();
    $id = $model->getIdRozmiaru();
}
?>

<form method="POST" action="/<?= APP_ROOT ?>/rozmiar/edit">
    <label>Nazwa </label>
    <input type="text" name="nazwa" value="<?= $nazwa ?>" /> <br />
    <input type="hidden" name="id" value="<?=$id?>" />
    <input type="submit" value="Zapisz" /> <br />
</form>