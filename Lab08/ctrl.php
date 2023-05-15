<?php
require_once 'init.php';
getConf()->login_action = 'login';


getRouter()->setDefaultRoute('calcShow'); 
getRouter()->setLoginRoute('login');

getRouter()->addRoute('calcShow',    'CalcCtrl',  ['user','admin']);
getRouter()->addRoute('calcLoan',    'CalcCtrl',  ['user','admin']);
getRouter()->addRoute('login',       'LoginCtrl');
getRouter()->addRoute('logout',      'LoginCtrl', ['user','admin']);
getRouter()->addRoute('results',     'ResultCtrl', ['admin']);
getRouter()->go();