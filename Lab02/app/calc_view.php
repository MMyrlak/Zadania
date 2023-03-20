<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator</title>
</head>
<body>
    <form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
        <label for="id_amount">Kwota: </label>
        <input id="id_amount" type="text" name="ammonut" value="<?php if(isset($ammonut)) print($ammonut); ?>" /><br />
        <label for="id_years">Lata: </label>
        <input id="id_years" type="text" name="years" value="<?php if(isset($years)) print($years); ?>" /><br />
        <label for="id_interest">Oprocentowanie: </label>
        <input id="id_interest" type="text" name="interest" value="<?php if(isset($interest)) print($interest); ?>" /><br />
        <input type="submit" value="Oblicz" />
    </form>
<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>

<div role="region" tabindex="0">
<table >
	<thead>
	<tr>
		<th>Kwota</th>
		<th>Lata</th>
		<th>Oprocentowanie</th>
		<th>Rata</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo $ammonut?></td>
		<td><?php echo $years?></td>
		<td><?php echo $interest."%"?></td>
		<td><?php echo $result?></td>
	</tr>
	</tbody>
</table>
</div>
<?php } ?>

</body>
</html>

