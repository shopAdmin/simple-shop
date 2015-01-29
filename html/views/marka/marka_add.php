<h1>Dodaj markę</h1>
<?php
	if(!empty($error))
	{
		echo $error;
	}
?>

<form method="POST" action="/<?=APP_ROOT?>/marka/add">
	<label>Nazwa </label>
	<input type="text" name="nazwa" /> <br />
        <label>Adres </label>
	<input type="text" name="adres" /> <br />
        <label>Telefon </label>
	<input type="text" name="telefon" /> <br />
        <label>Email </label>
	<input type="text" name="email" /> <br />
        <label>Opis </label>
	<input type="text" name="opis" /> <br />
	<input type="submit" value="Dodaj" /> <br />
</form>