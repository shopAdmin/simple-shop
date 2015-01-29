<h1>Dodaj kategorię</h1>
<?php
	if(!empty($error))
	{
		echo $error;
	}
?>

<form method="POST" action="/<?=APP_ROOT?>/kategoria/add">
	<label>Nazwa </label>
	<input type="text" name="nazwa" /> <br />
        <label>Opis </label>
        <input type="text" name="opis" /> <br />
	<input type="submit" value="Dodaj" /> <br />
</form>