<h1>Usuń kolor</h1>
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
<h3>Czy na pewno chcesz usunąć kolor: <b><?=$nazwa?></b></h3>
<form method="POST" action="/<?= APP_ROOT ?>/kolor/delete">
    <input type="hidden" name="id" value="<?=$id?>"/>
    <input type="submit" name="cancel" value="Anuluj" /> <br />
    <input type="submit" name="delete" value="Usuń" /> <br />
</form>