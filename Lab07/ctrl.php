<?php
require_once 'init.php';
switch ($action) {
        default :
                
                include 'check.php';
		$ctrl = new app\controllers\CalcCtrl ();
		$ctrl->generateView ();
                break;
        case 'login':
                $ctrl = new app\controllers\LoginCtrl();
                $ctrl->doLogin();
        case 'logout' : // akcja NIEPUBLICZNA
		include 'check.php';  // KONTROLA
		$ctrl = new app\controllers\LoginCtrl();
		$ctrl->doLogout();
	break;       
        case 'calcLoan' :
                include 'check.php';
		$ctrl = new app\controllers\CalcCtrl();
		$ctrl->process ();
	break;
}