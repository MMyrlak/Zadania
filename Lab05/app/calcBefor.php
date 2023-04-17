<?php
require_once dirname(__FILE__).'/../config.php';
require_once _ROOT_PATH.'/lib/smarty/Smarty.class.php';

function getParams(&$forms){
        $forms['ammount'] = isset($_REQUEST ['ammonut'])? $_REQUEST ['ammonut'] : null;
        $forms['years'] = isset($_REQUEST ['years'])?$_REQUEST ['years'] : null ;
        $forms['interest'] = isset($_REQUEST ['interest'])? $_REQUEST ['interest'] : null;
}
function validate(&$forms,&$messages,&$hide_intro){
	if ( ! (isset($forms['ammount']) && isset($forms['years']) && isset($forms['interest']))) {
		return false;
	}
        $hide_intro = true;
	if ( $forms['ammount'] == "") {
            $messages [] = 'Nie podano kwoty'; 
        }
        if ( $forms['years'] == "") {
            $messages [] = 'Nie podano na ile lat';
        }
        if ( $forms['interest'] == "") {
                $messages [] = 'Nie podano oprocentowania';
        }
	if (count ( $messages ) != 0) return false;
	
	if (! is_numeric( $forms['ammount'] )) {
		$messages [] = 'Bledna kwota';
	}
	if (! is_numeric( $forms['years'] )) {
		$messages [] = 'Bledna ilosc lat';
	}
        if (! is_numeric( $forms['interest'] )) {
		$messages [] = 'Bledne oprecentowanie';
	}	
	if (count ( $messages ) != 0) return false;
	else return true;
}

function process(&$forms,&$result){
        
	$forms['ammount'] = intval($forms['ammount']);
	$forms['years'] = intval($forms['years']);
        $forms['interest'] = intval($forms['interest']);
        $result = ($forms['ammount']/(12*$forms['years']))*(1+($forms['interest']/100));
}

$forms = null;
$result = null;
$messages = array();
$hide_intro = false;

getParams($forms);
if ( validate($forms,$messages,$hide_intro)) {
	process($forms,$result);
}
$smarty = new Smarty();
$smarty ->assign('app_url',_APP_URL);
$smarty ->assign('root_path',_ROOT_PATH);
$smarty ->assign('page_title','Kalkulator kredytowy');
$smarty ->assign('page_descripton','Prosty kalkulator wyliczajacy wysokosc kreydtu');
$smarty ->assign('page_header','Lab04 - Szablon SMARTY');
$smarty->assign('hide_intro',$hide_intro);
$smarty ->assign('forms',$forms);
$smarty ->assign('result',$result);
$smarty ->assign('messages',$messages);

$smarty -> display('../app/calc.tpl');
