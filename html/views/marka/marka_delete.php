<h1>Usuń Markę</h1>
<?php
if (!empty($error)) {
    echo $error;
}
$nazwa = "";
$id = "";
if (!empty($model)) {
    $nazwa = $model->getNazwa();
    $id = $model->getIdMarki();
}
?>
<h3>Czy na pewno chcesz usunąć markę: <b><?=$nazwa?></b>?</h3>
<form method="POST" action="/<?= APP_ROOT ?>/marka/delete">
    <input type="hidden" name="id" value="<?=$id?>"/>
    <input type="submit" name="cancel" value="Anuluj" /> <br />
    <input type="submit" name="delete" value="Usuń" /> <br />
</form>