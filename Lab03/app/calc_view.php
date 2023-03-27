<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Kalkulator</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>

<div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/app/inna_chroniona.php" class="pure-button">kolejna chroniona strona</a>
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>

<div style="width:90%; margin: 2em auto;">

<form action="<?php print(_APP_ROOT); ?>/app/calc.php" method="post" class="pure-form pure-form-stacked">
	<legend>Kalkulator Kredytowy</legend>
	<fieldset>
            <label for="id_amount">Kwota: </label>
            <input id="id_amount" type="text" name="ammonut" value="<?php out($ammonut); ?>" />
            <label for="id_years">Lata: </label>
            <input id="id_years" type="text" name="years" value="<?php out($years); ?>" />
            <label for="id_interest">Oprocentowanie: </label>
            <input id="id_interest" type="text" name="interest" value="<?php out($interest); ?>" />
	</fieldset>	
	<input type="submit" value="Oblicz" class="pure-button pure-button-primary" />
</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin-top: 1em; padding: 1em 1em 1em 2em; border-radius: 0.5em; background-color: #f88; width:25em;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>

<div style="margin-top: 2em">
<table class="pure-table pure-table-bordered">
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

</div>

</body>
</html>