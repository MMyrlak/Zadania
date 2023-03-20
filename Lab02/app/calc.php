<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';
// 1. pobranie parametr�w

$ammonut = $_REQUEST ['ammonut'];
$years = $_REQUEST ['years'];
$interest = $_REQUEST ['interest'];

// 2. walidacja

if ( ! (isset($ammonut) && isset($years) && isset($interest))) {
	$messages [] = 'Brak parametr�w!!!';
}

if ( $ammonut == "") {
	$messages [] = 'Nie podano kwoty';
}
if ( $years == "") {
	$messages [] = 'Nie podano na ile lat';
}
if ( $interest == "") {
	$messages [] = 'Nie podano oprocentowania';
}

if (empty( $messages )) {
	if (! is_numeric( $ammonut )) {
		$messages [] = 'B��dna kwota';
	}
	if (! is_numeric( $years )) {
		$messages [] = 'B��dna ilo�� lat';
	}
        if (! is_numeric( $interest )) {
		$messages [] = 'B��dne oprecentowanie';
	}

}
// 3. oblicz kredyt

if (empty ( $messages )) {
	$ammonut = intval($ammonut);
	$years = intval($years);
        $interest = intval($interest);
	
	//wykonanie operacji
        $result = ($ammonut/(12*$years))*(1+($interest/100));
}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';