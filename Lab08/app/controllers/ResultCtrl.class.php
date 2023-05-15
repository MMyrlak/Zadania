<?php

namespace app\controllers;
use Medoo;

class ResultCtrl{
    private $hide_intro;
    private $result = array ();
    function __construct() {
        $this->hide_intro = true;
    }
    public function action_results(){
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
                $this->result = $database->select("calc", "*");
        } catch (\PDOException $ex) {
            getMessages()->addError("DB Error: ".$ex->getMessage());
        }
        $this-> generateView();
    }
    public function generateView() {
        
        getSmarty()->assign('page_title','Kalkulator kredytowy');
        getSmarty()->assign('page_header','Lab0b - Baza Danych');
        
        getSmarty()->assign('hide_intro',$this->hide_intro);
        getSmarty()->assign('user',unserialize($_SESSION['user']));
        getSmarty()->assign('result', $this->result);

        getSmarty()-> display('ResultView.tpl');
    }
}