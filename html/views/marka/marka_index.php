<h1>Lista marek</h1>
<br />

<table border="1">
<tr>
	<th>
	Id
	</th>
	<th>
		Nazwa
	</th>
        <th>
		Adres
	</th>
        <th>
		Telefon
	</th>
        <th>
		Email
	</th>
        <th>
		Opis
	</th>
	<th>
		Edytuj
	</th>
		<th>
		Usuń
	</th>
</tr>
<?php
	foreach($results as $row){
		echo '<tr>';
		echo '<td>'. $row['id_marki'].'</td>';
		echo '<td>'. $row['nazwa'].'</td>';
                echo '<td>'. $row['adres'].'</td>';
                echo '<td>'. $row['telefon'].'</td>';
                echo '<td>'. $row['email'].'</td>';
                echo '<td>'. $row['opis'].'</td>';
		echo '<td><a href="marka/edit/'.$row['id_marki'].'">Edytuj</a></td>';
		echo '<td><a href="marka/delete/'.$row['id_marki'].'">Usuń</a></td>';
		echo '</tr>';
	}
?>
</table>

<br />
<a href="marka/add">Dodaj</a>
