<?php

require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/CalcForm.class.php';
require_once $conf->root_path.'/app/CalcResult.class.php';
class CalcCtrl {
    private $forms;
    private $messages;
    private $result;
    
    public function __construct(){
        $this->forms = new CalcForm();
        $this->messages = new Messages();
        $this->result = new CalcResult();
    }   
    public function getParams(){
        $this->forms->ammount = isset($_REQUEST ['ammonut'])? $_REQUEST ['ammonut'] : null;
        $this->forms->years = isset($_REQUEST ['years'])?$_REQUEST ['years'] : null ;
        $this->forms->interes  = isset($_REQUEST ['interest'])? $_REQUEST ['interest'] : null;
    }
    
    public function validate(){
	if (!isset($this->forms->ammount) && isset($this->forms->years) && isset($this->forms->interes)) {
		return false;
	}
	if ( $this->forms->ammount == "") {
            $this->messages->addError('Nie podano kwoty'); 
        }
        if ( $this->forms->years == "") {
            $this->messages->addError('Nie podano na ile lat');
        }
        if ( $this->forms->interest == "") {
            $this->messages->addError('Nie podano oprocentowania');
        }
        if (!$this->messages->isError()){
	
            if (! is_numeric($this->forms->ammount)) {
                    $this->messages->addError('Bledna kwota');
            }
            if (! is_numeric($this->forms->years)) {
                    $this->messages->addError('Bledna ilosc lat');
            }
            if (! is_numeric($this->forms->interes)) {
                    $this->messages->addError('Bledne oprecentowanie');
            }	
        }
	return !$this->messages->isError();
    }
    
    public function process(){
        $this->getParams();
        
        if($this->getParams()){
            $this->forms->ammount = intval($this->forms->ammount);
            $this->forms->years = intval($this->forms->years);
            $this->forms->interes = intval($this->forms->interes);
            
            $this->result->result = ($this->forms->ammount/(12*$this->forms->years))*(1+($this->forms->interes));
        }
        $this-> generateView();
    }
    
    public function generateView() {
        global $conf;
        
        $smarty = new Smarty();
        $smarty ->assign('conf',$conf);
        
        $smarty ->assign('page_title','Kalkulator kredytowy');
        $smarty ->assign('page_descripton','Prosty kalkulator wyliczajacy wysokosc kreydtu');
        $smarty ->assign('page_header','Lab05 - Obiektowoœæ');
        
        $smarty ->assign('forms', $this->forms);
        $smarty ->assign('result', $this->result);
        $smarty ->assign('messages', $this->messages);

        $smarty -> display($conf->root_path.'\app\calc.tpl');
    }
        

        
}
