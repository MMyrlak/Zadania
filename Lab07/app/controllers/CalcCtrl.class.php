<?php

namespace app\controllers;
use app\forms\CalcForm;
use app\transfer\CalcResult;

class CalcCtrl {
    private $forms;
    private $result;
    private $hide_intro;
    
   public function __construct(){
        $this->forms = new CalcForm();
        $this->result = new CalcResult();
        $this->hide_intro = false;
    }   
    public function getParams(){
        $this->forms->ammount = getFromRequest('ammount');
        $this->forms->years = getFromRequest('years');
        $this->forms->interest  = getFromRequest('interest');
    }
    public function validate(){
        if (!(isset($this->forms->ammount) && isset($this->forms->years) && isset($this->forms->interest))){
            return false;
	}  else { 
            $this->hide_intro = true;
	}
	if ( $this->forms->ammount == "") {
            getMessages()->addError('Nie podano kwoty'); 
        }
        if ( $this->forms->years == "") {
            getMessages()->addError('Nie podano na ile lat');
        }
        if ( $this->forms->interest == "") {
            getMessages()->addError('Nie podano oprocentowania');
        }
        if (!getMessages()->isError()){
	
            if (! is_numeric($this->forms->ammount)) {
                    getMessages()->addError('Bledna kwota');
            }
            if (! is_numeric($this->forms->years)) {
                    getMessages()->addError('Bledna ilosc lat');
            }
            if (! is_numeric($this->forms->interest)) {
                    getMessages()->addError('Bledne oprecentowanie');
            }	
        }
	return !getMessages()->isError();
    }
    
    public function process(){
        $this->getParams();
        
        if($this->validate()){
            $this->forms->ammount = intval($this->forms->ammount);
            $this->forms->years = intval($this->forms->years);
            $this->forms->interest = intval($this->forms->interest);
            $this->result->result = ($this->forms->ammount/(12*$this->forms->years))*(1+($this->forms->interest));
            
        }
        $this-> generateView();
    }
    
    public function generateView() {
        
        getSmarty()->assign('page_title','Kalkulator kredytowy');
        getSmarty()->assign('page_descripton','Prosty kalkulator wyliczajacy wysokosc kredytu');
        getSmarty()->assign('page_header','Lab07b - Ochrona dostepu');
        
        getSmarty()->assign('hide_intro',$this->hide_intro);
        
        getSmarty()->assign('forms', $this->forms);
        getSmarty()->assign('res', $this->result);

        getSmarty()-> display('CalcView.tpl');
    }
        

        
}
