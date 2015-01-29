<h1>Usuń zamówienie</h1>
<?php
if (!empty($error)) {
    echo $error;
}
$id = "";
if (!empty($model)) {
    $id = $model->getIdZamowienia();
}
?>
<h3>Czy na pewno chcesz usunąć zamówienie?</h3>
<form method="POST" action="/<?= APP_ROOT ?>/zamowienie/delete">
    <input type="hidden" name="id" value="<?=$id?>"/>
    <input type="submit" name="cancel" value="Anuluj" /> <br />
    <input type="submit" name="delete" value="Usuń" /> <br />
</form>