<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/app/mainController.php';
require_once ('config-crm/db/db-connection.php');
class adminPage extends Controller{
    private $connection;
    public function __construct() {
        global $conn;
        $this->connection = $conn;
        
    }
    public function index(){
        $Role = new Roles();
        if ($Role->roles['role_name'] != 'MASTER_ADMIN'){
            echo "You dont have access to that page";
            return $this->view('../views/mainPage');
            exit();
        }
        echo 'hello master admin';

    }
}