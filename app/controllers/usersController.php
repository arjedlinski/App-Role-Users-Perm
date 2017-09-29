<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/app/mainController.php';
require_once ('config-crm/db/db-connection.php');
class Users extends Controller{

    private $connection;
    public function __construct(){
            global $conn;
            $this->connection = $conn;

    }

    public function getUsers($id = null){
            if(!$this->checkSession()){
                    echo "You have to login first";
                    return $this->view('../views/login');
                    exit();
            }
            
            $user = $this->model('User');
            $user->name = $id;
            $stmt = $this->connection->stmt_init();

    if ($id != NULL) {
        $Usertemp = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connection->prepare($Usertemp);
        $stmt->bind_param('s', $id);
    } else {

        $Usertemp = "SELECT * FROM users WHERE 1";
        $stmt = $this->connection->prepare($Usertemp);

    }
            $stmt->execute();
            $result['userprofile'] = $stmt->get_result();
            
            if($result['userprofile']->num_rows > 0){
                    return $this->view('../views/userprofile',$result);
            }else{
                    echo "User not found";
            }

    }
    public function getUsersPage($page = 1){
        if(!$this->checkSession()){
                echo "You have to login first to view user profile";
                return $this->view('../views/login');
                exit();
        }
        $Role = new Roles();
        if ($Role->roles['role_name'] != 'MASTER_ADMIN' && !$Role->hasPerm('getUsers')){
            echo "You dont have access to that page";
            return $this->view('../views/mainPage');
            exit();
        }
        $Usertemp = "SELECT * FROM users order by id ASC";
        $stmt = $this->connection->prepare($Usertemp);

            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                    return $this->view('../views/userlist',$result);
            }else{
                    echo "User not found";
            }

    }
    public function editUser($id){
            if(!$this->checkSession()){
                    echo "You have to login first to edit user";
                    return $this->view('../views/login');
                    exit();
            }
        $update = '';
        $count = sizeof($_POST);
        $i = 1;
        if($_POST){	
        foreach ($_POST as $val => $value) {

        if ($count == $i) {
            $update .= $val . '="' . $value . '" ';
            break;
        }
        $update .= $val . '="' . $value . '", ';
                    $i ++;
        }
        $update .= "WHERE ID = " . $id;
        if ($this->connection->query("UPDATE users SET " . $update) === TRUE) {
            echo "User updated successfully";
        } else {
            echo "Error updating User: " . $this->connection->error;
        }}
        $stmt = $this->connection->stmt_init();

        if ($id != NULL) {
            $Usertemp = "SELECT * FROM users WHERE id = ?";
            $stmt = $this->connection->prepare($Usertemp);
            $stmt->bind_param('s', $id);
        } else {

            $Usertemp = "SELECT * FROM users WHERE 1";
            $stmt = $this->connection->prepare($Usertemp);

        }
            $stmt->execute();
            $data = $stmt->get_result();
            /*var_dump($data);
            $Role = new Roles();
            $query = "SELECT * FROM perm";
            $resultperm = $this->connection->query($query);
            while($row = $resultperm->fetch_assoc()){
                if($Role->hasPerm($row['perm_name'])){
                    $perm[$row['perm_name']] = true;
                }else{
                    $perm[$row['perm_name']] = false;
                }
            }
            $data['perms'] = $perm;*/
            if($data != NULL){
                    return $this->view('../views/useredit',$data);
            }else{
                    echo "User not found";
            }

    }

    public function newUser($data = null){	

        if(!$this->checkSession()){
            echo "You have to login first";
            return $this->view('../views/login');
            exit();
        }
        
        $data = $_POST;
        if($data !=NULL)
        {
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
            $refs = array();
            foreach ($data as $key => $value) {
                $refs[$key] = &$data[$key];
            }
            $newUser = "INSERT INTO users ($columns) VALUES ($marks)";
            $stmt = $this->connection->prepare($newUser);
            call_user_func_array(array(
                $stmt,
                "bind_param"
            ), array_merge($type, $refs));
            if ($success = $stmt->execute()) {
                echo 'User added';
            } else {
                echo 'Some error has happend';
            }
            return $this->view('../views/newuser',$data);
            }
                return $this->view('../views/newuser');
    }

    // Delete User
    public function deleteUser($id)
    {
                if(!$this->checkSession()){
                        echo "You have to login first";
                        return $this->view('../views/login');
                        exit();
                }
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('s', $id);
        if ($success = $stmt->execute()) {
            echo 'User deleted';
        } else {
            echo 'Error happend';
        }
                return $this->getUsers();
    }
}