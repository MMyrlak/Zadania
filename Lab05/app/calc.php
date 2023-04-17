<?php
require_once '/../config.php';

require_once $conf->root_patch.'/app/CalcCtrl.class.php';

$ctrl = new CalcCtrl();
$ctrl->process();