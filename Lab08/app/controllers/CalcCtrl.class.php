<?php

namespace app\controllers;
use app\forms\CalcForm;
use app\transfer\CalcResult;
use app\transfer\User;
use Medoo;

class CalcCtrl {
    private $forms;
    private $result;
    private $hide_intro;
    
   public function __construct(){
        $this->forms = new CalcForm();
        $this->result = new CalcResult();
        $this->hide_intro = true;
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
    
    public function action_calcLoan(){
        $this->getParams();
        
        if($this->validate()){
            $this->forms->ammount = intval($this->forms->ammount);
            $this->forms->years = intval($this->forms->years);
            $this->forms->interest = intval($this->forms->interest);
            if (inRole('admin')) {
                $this->result->result = ($this->forms->ammount/(12*$this->forms->years))*(1+($this->forms->interest));
            } else {
		getMessages()->addError('Tylko administrator mo¿e to obliczyæ');
            }
        }
        try{
            $database = new Medoo\Medoo([
                'type' => 'mysql',
                'host' => 'localhost',
                'database' => 'calc',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'collation' => 'utf8_polish_ci',
                'port' => 3306,
                'option' => [
                    \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION        
                    ],
                ]);
            $database->insert("calc",[
                "ammount" => $this->forms->ammount,
                "years" => $this->forms->years,
                "interest" => $this->forms->interest,
                "date" => date("Y-m-d M:i:s"),
                "loan" => $this->result->result
            ]);
        } catch (\PDOException $ex) {
            getMessages()->addError("DB Error: ".$ex->getMessage());
        }
        $this-> generateView();
    }
    public function action_calcShow(){
		$this->generateView();
	}
    public function generateView() {
        
        getSmarty()->assign('page_title','Kalkulator kredytowy');
        getSmarty()->assign('page_descripton','Prosty kalkulator wyliczajacy wysokosc kredytu');
        getSmarty()->assign('page_header','Lab0b - Baza Danych');
        
        getSmarty()->assign('hide_intro',$this->hide_intro);
        getSmarty()->assign('user',unserialize($_SESSION['user']));
        getSmarty()->assign('forms', $this->forms);
        getSmarty()->assign('res', $this->result);

        getSmarty()-> display('CalcView.tpl');
    }
        

        
}
