<h1>Lista kolorów</h1>
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
	foreach($kolory as $row){
		echo '<tr>';
		echo '<td>'. $row['id_koloru'].'</td>';
		echo '<td>'. $row['nazwa'].'</td>';
		echo '<td><a href="kolor/edit/'.$row['id_koloru'].'">Edytuj</a></td>';
		echo '<td><a href="kolor/delete/'.$row['id_koloru'].'">Usuń</a></td>';
		echo '</tr>';
	}
?>
</table>

<br />
<a href="kolor/add">Dodaj</a>
