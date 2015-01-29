<h1>Dodaj rozmiar</h1>
<?php
	if(!empty($error))
	{
		echo $error;
	}
?>

<form method="POST" action="/<?=APP_ROOT?>/rozmiar/add">
	<label>Nazwa </label>
	<input type="text" name="nazwa" /> <br />
	<input type="submit" value="Dodaj" /> <br />
</form>