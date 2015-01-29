<h1>Lista kategorii</h1>
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
		echo '<td>'. $row['id_kategorii'].'</td>';
		echo '<td>'. $row['nazwa'].'</td>';
                echo '<td>'. $row['opis'].'</td>';
		echo '<td><a href="kategoria/edit/'.$row['id_kategorii'].'">Edytuj</a></td>';
		echo '<td><a href="kategoria/delete/'.$row['id_kategorii'].'">Usuń</a></td>';
		echo '</tr>';
	}
?>
</table>

<br />
<a href="kategoria/add">Dodaj</a>
