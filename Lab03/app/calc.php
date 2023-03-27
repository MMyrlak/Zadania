<?php
require_once dirname(__FILE__).'/../config.php';

include _ROOT_PATH.'/app/security/check.php';

function getParams(&$ammonut,&$years,&$interest){
		
        $ammonut = isset($_REQUEST ['ammonut'])? $_REQUEST ['ammonut'] : null;
        $years = isset($_REQUEST ['years'])?$_REQUEST ['years'] : null ;
        $interest = isset($_REQUEST ['interest'])? $_REQUEST ['interest'] : null;
}
function validate(&$ammonut,&$years,&$interest,&$messages){
	if ( ! (isset($ammonut) && isset($years) && isset($interest))) {
		return false;
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
	if (count ( $messages ) != 0) return false;
	
	if (! is_numeric( $ammonut )) {
		$messages [] = 'B³êdna kwota';
	}
	if (! is_numeric( $years )) {
		$messages [] = 'B³êdna iloœæ lat';
	}
        if (! is_numeric( $interest )) {
		$messages [] = 'B³êdne oprecentowanie';
	}	

	if (count ( $messages ) != 0) return false;
	else return true;
}

function process(&$ammonut,&$years,&$interest,&$messages,&$result){
	global $role;
        
	$ammonut = intval($ammonut);
	$years = intval($years);
        $interest = intval($interest);
	
        if ($role == 'admin'){
            $result = ($ammonut/(12*$years))*(1+($interest/100));
        } else {
            $messages [] = 'Tylko administrator moze obliczyc rate kredytu!';
        }
}

$ammonut = null;
$years = null;
$interest = null;
$result = null;
$messages = array();

getParams($ammonut,$years,$interest);
if ( validate($ammonut,$years,$interest,$messages) ) {
	process($ammonut,$years,$interest,$messages,$result);
}

include 'calc_view.php';