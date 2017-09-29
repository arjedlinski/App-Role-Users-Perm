<?php


class Controller{
        
        public function checkSession(){	
            if (isset($_SESSION['auth']) and ($_SESSION['auth'] = 'successfull')){
                
		return true;
            }else return false;
	}
	public function model($model){
            require_once($_SERVER['DOCUMENT_ROOT'].'/app/model/' . $model . '.php');
            return new $model();
	}
	
	public function view($view, $data = []){
            require_once($_SERVER['DOCUMENT_ROOT'].'/app/views/' . $view . '.php');
		
	}
}