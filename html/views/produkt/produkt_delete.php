<h1>Usuń produkt</h1>
<?php
if (!empty($error)) {
    echo $error;
}
$nazwa = "";
$id = "";
if (!empty($model)) {
    $nazwa = $model->getNazwa();
    $id = $model->getIdProduktu();
}
?>
<h3>Czy na pewno chcesz usunąć produkt: <b><?=$nazwa?></b>?</h3>
<form method="POST" action="/<?= APP_ROOT ?>/produkt/delete">
    <input type="hidden" name="id" value="<?=$id?>"/>
    <input type="submit" name="cancel" value="Anuluj" /> <br />
    <input type="submit" name="delete" value="Usuń" /> <br />
</form>