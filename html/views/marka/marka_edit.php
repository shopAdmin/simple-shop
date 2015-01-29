<h1>Edytuj markę</h1>
<?php
if (!empty($error)) {
    echo $error;
}
$nazwa = "";
$adres = "";
$telefon = "";
$email = "";
$opis = "";
$id = "";
if (!empty($model)) {
    $nazwa = $model->getNazwa();
    $adres = $model->getAdres();
    $telefon = $model->getTelefon();
    $email = $model->getEmail();
    $opis = $model->getOpis();
    $id = $model->getIdMarki();
}
?>

<form method="POST" action="/<?= APP_ROOT ?>/marka/edit">
    <label>Nazwa </label>
    <input type="text" name="nazwa" value="<?= $nazwa ?>" /> <br />
    <label>Adres </label>
    <input type="text" name="adres" value="<?= $adres ?>" /> <br />
    <label>Telefon </label>
    <input type="text" name="telefon" value="<?= $telefon ?>" /> <br />
    <label>Email </label>
    <input type="text" name="email" value="<?= $email ?>" /> <br />
    <label>Opis </label>
    <input type="text" name="opis" value="<?= $opis ?>" /> <br />
    <input type="hidden" name="id" value="<?= $id ?>" />
    <input type="submit" value="Zapisz" /> <br />
</form>