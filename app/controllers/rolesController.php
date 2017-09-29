<?php
require_once ('config-crm/db/db-connection.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Roles extends Controller{
    private $connection;
    public $roles;
    public function __construct() {
        global $conn;
        $this->connection = $conn;
        isset($_SESSION['username']) ? $this->getRole($_SESSION['username']) : false;
        
        
    }
    private function getRole($username){
        $query = "SELECT * FROM users where login_crm = '$username'" ;
        $result = $this->connection->query($query);
        $id = $result->fetch_assoc()['id'];
        $query = "SELECT t1.role_id, t2.role_name FROM users_role as t1 JOIN "
                . "role as t2 on t1.role_id = t2.id WHERE t1.user_id = '$id' ";
        $result = $this->connection->query($query);
        $this->roles = $result->fetch_assoc();
    }
    public function hasPerm($perm){
        $id = $this->roles['role_id'];
        $query =  "SELECT t2.perm_name FROM role_perm as t1
                JOIN perm as t2 ON t1.perm_id = t2.id
                WHERE t1.role_id = '$id' ";
        $result = $this->connection->query($query);
        $hasperm = $result->fetch_assoc();
            if($hasperm['perm_name'] === $perm){
                return true;
            }else{
                return false;
            }
    }
}

