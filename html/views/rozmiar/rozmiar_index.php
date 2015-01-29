<h1>Lista rozmiarów</h1>
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
		Edytuj
	</th>
		<th>
		Usuń
	</th>
</tr>
<?php
	foreach($results as $row){
		echo '<tr>';
		echo '<td>'. $row['id_rozmiaru'].'</td>';
		echo '<td>'. $row['nazwa'].'</td>';
		echo '<td><a href="rozmiar/edit/'.$row['id_rozmiaru'].'">Edytuj</a></td>';
		echo '<td><a href="rozmiar/delete/'.$row['id_rozmiaru'].'">Usuń</a></td>';
		echo '</tr>';
	}
?>
</table>

<br />
<a href="rozmiar/add">Dodaj</a>
