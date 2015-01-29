<?php
	if(!empty($error))
	{
		echo $error;
	}
?>

<form method="POST" action="/<?=APP_ROOT?>/account/register">
	<label>Imię: </label>
	<input type="text" name="name" /> <br />
	<label>Nazwisko: </label>
	<input type="text" name="surname" /> <br />
        <label>Adres: </label>
	<input type="text" name="address" /> <br />
        <label>Telefon: </label>
	<input type="text" name="telephone" /> <br />
        <label>Email: </label>
	<input type="text" name="email" /> <br />
	<label>Login: </label>
	<input type="text" name="login" /> <br />
	<label>Hasło: </label>
	<input type="password" name="password" /> <br />
	<label>Powtórz hasło: </label>
	<input type="password" name="password2" /> <br />
	<input type="submit" value="Zarejestruj" /> <br />
</form>