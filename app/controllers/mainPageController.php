<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/app/mainController.php';
require_once ('config-crm/db/db-connection.php');
class mainPage extends Controller{
    private $connection;
	
    public function __construct(){
            global $conn;
            $this->connection = $conn;

    }
    public function index(){
            return $this->view('../views/mainPage');
            
    }
    public function login(){
        if ($this->checkSession()){
            header('Location: /');
        }
        if(isset($_POST['submit'])){
            $login = $this->connection->real_escape_string($_POST['login_crm']);
            $password = $this->connection->real_escape_string($_POST['password_crm']);
            echo $login;
            echo $password;
            $userauth = "SELECT * FROM users WHERE login_crm = ? and password_crm = ?";
            $stmt = $this->connection->prepare($userauth);
            $stmt->bind_param('ss', $login,$password);
            $stmt->execute();
            if (mysqli_num_rows($stmt->get_result()) === 1){
                $_SESSION['auth'] = 'successfull';
                $_SESSION['start'] = time();
                $_SESSION['end'] = time() + 60;
                $_SESSION['login_user'] = $login;
                $_SESSION['username'] = $login;
                header('Location: /');
            }
        }
        return $this->view('../views/login');
    }
    public function logout(){
        if(isset($_SESSION['auth']) && $_SESSION['auth'] === 'successfull'){
            session_unset();
            session_destroy();
            header('Location: /');
        }else{
            return $this->view('../views/login');
        }
    }
    public function register(){
        if ($this->checkSession()){
            header('Location: /');
        }
        if(isset($_POST['submit'])){
            $data = $_POST;
            unset($data['submit']);
            if(isset($data)? $data !=NULL : false){
                $login = $data['login_crm'];
                $email = $data['email'];
                $checkifexist = "SELECT * FROM users WHERE login_crm = ? OR email = ?";
                $stmt = $this->connection->prepare($checkifexist);
                $stmt->bind_param('ss', $login, $email);
                $stmt->execute();
                if($stmt->get_result()->num_rows > 0){
                    $data['message'] = "Login already taken";
                    return $this->view('../views/register', $data);
                }else{

                $type = array('');
                $check = $data;
                    foreach($check as $key){
                        if (is_numeric($key)){
                            $type[0] .= 'i';
                        }
                        elseif (is_string($key)){
                            $type[0] .= 's';

                        }
                    }
                $newUser = '';
                $columns = implode(", ", array_keys($data));
                $placeholders = array_fill(0, count($data), '?');
                $marks = implode(', ', $placeholders);
                $type[0] .= 's';
                $refs = array();
                $data['hash_activate'] = $hash_activate = md5(rand(0, 1000));
                foreach ($data as $key => $value) {
                    $refs[$key] = &$data[$key];
                }
                $columns .= ', hash_activate';
                $marks .= ', ?';
                $newUser = "INSERT INTO users ($columns) VALUES ($marks)";
                $stmt = $this->connection->prepare($newUser);
                call_user_func_array(array(
                    $stmt,
                    "bind_param"
                ), array_merge($type, $refs));
                if ($success = $stmt->execute()) {
                    echo 'You have been registered';
                    echo 'To register you have to activate your account. Link to activate has been sent to your mail';
                    $to      = $data['email'];
                    $subject = 'Account Activation Link';
                    $message = 'Below is your link to activate your email'
                            . ' http://'.$_SERVER['SERVER_NAME'].'/activate?hash='.$hash_activate;
                            
                            ;
                    $headers = 'From: no-reply@atomiqconsulting.com' . "\r\n";
                    mail($to, $subject, $message, $headers);
                } else {
                    echo 'Some error has happend';
                    return $this->view('../views/register');
                }
                }}
        }
        return $this->view('../views/register');
    }
    public function dbinstall(){
        if (isset($_POST['submitinstall'])){
            require($_SERVER['DOCUMENT_ROOT'].'/config-crm/db/db-install.php');
            if($this->connection->select_db(DB_NAME) === false OR ($this->connection->query('SHOW TABLES from '.DB_NAME)->num_rows != ($count = count($query)))){
                $sql = "CREATE DATABASE IF NOT EXISTS ".DB_NAME;
                if($this->connection->query($sql) === TRUE){
                    $this->connection->select_db(DB_NAME);
                    
                }          
            foreach($query as $key => $value){
                $this->connection->query($value);
            }
            $message['message'] = "Tables to database ".DB_NAME." added successfully";
            require($_SERVER['DOCUMENT_ROOT'].'/config-crm/db/db-inserts.php');
            foreach($inserts as $key => $value){
                $this->connection->query($value);
            }
            $message['message'] .= "<br> To login in use: Login: root; Password: pass1234";
            return $this->view('../views/mainPage',$message);
            }
        }elseif($this->connection->select_db(DB_NAME) === false OR $this->connection->query('SHOW TABLES from '.DB_NAME)->num_rows != ($count = count($this->connection->query('SHOW TABLES from '.DB_NAME)))){
            return $this->view('../views/dbinstall');
        }else{
            header('Location: /');
        }
    }
}
?>