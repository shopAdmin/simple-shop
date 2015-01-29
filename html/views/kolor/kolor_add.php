<h1>Dodaj kolor</h1>
<?php
	if(!empty($error))
	{
		echo $error;
	}
?>

<form method="POST" action="/<?=APP_ROOT?>/kolor/add">
	<label>Nazwa </label>
	<input type="text" name="nazwa" /> <br />
	<input type="submit" value="Dodaj" /> <br />
</form>