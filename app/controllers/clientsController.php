<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/app/mainController.php';
require_once ('config-crm/db/db-connection.php');

class Clients extends Controller{
	
    private $connection;
    public function __construct(){
            global $conn;
            $this->connection = $conn;

    }
    public function getClients($id = null){

            $user = $this->model('Clients');
            $user->name = $id;

            $stmt = $this->connection->stmt_init();

    if ($id != NULL) {
        $Usertemp = "SELECT * FROM clients WHERE id = ?";
        $stmt = $this->connection->prepare($Usertemp);
        $stmt->bind_param('s', $id);
    } else {

        $Usertemp = "SELECT * FROM clients WHERE 1";
        $stmt = $this->connection->prepare($Usertemp);

    }
            $stmt->execute();
            $result = $stmt->get_result();
            return $this->view('../views/clientslist',$result);
    }
    public function editClient($id){
            $update = '';
    $count = sizeof($_POST);
    $i = 1;

            if($_POST)
            {	
    foreach ($_POST as $val => $value) {

        if ($count == $i) {
            $update .= $val . '="' . $value . '" ';
            break;
        }
        // $update .= ''.$val."='".$value."' ";
        $update .= $val . '="' . $value . '", ';
                    $i ++;
        // $update = 'firstname="test" and'
    }
    $update .= "WHERE ID = " . $id;
    if ($this->connection->query("UPDATE clients SET " . $update) === TRUE) {
        echo "User updated successfully";
    } else {
        print_r("UPDATE clients SET " . $update);
        echo "Error updating User: " . $this->connection->error;
    }}
    $stmt = $this->connection->stmt_init();

    if ($id != NULL) {
        $Usertemp = "SELECT * FROM clients WHERE id = ?";
        $stmt = $this->connection->prepare($Usertemp);
        $stmt->bind_param('s', $id);
    } else {

        $Usertemp = "SELECT * FROM clients WHERE 1";
        $stmt = $this->connection->prepare($Usertemp);

    }
            $stmt->execute();
            $data = $stmt->get_result();
    return $this->view('../views/clientsedit',$data);
    }
    public function activateAccount(){
        $hash = $_GET['hash'];
        $checkhash = "SELECT * from clients where hash_activate = ? and activate = ?";
   
        if($stmt = $this->connection->prepare($checkhash)){
        $zero = 0;
        $stmt->bind_param('si', $hash, $zero);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 1){
            $id = $result->fetch_assoc()['id'];
            $one = 1;
            $acivateaccount = "Update clients SET activate = ? WHERE id = ?";
            $stmt = $this->connection->prepare($acivateaccount);
            $stmt->bind_param('ii', $one, $id);
            if($success = $stmt->execute()){
                $data['message'] = "Your account has been activated now you can log in";
                return $this->view('../views/accountactivated',$data);
            }
        }else{
            $data['message'] = "Your account already activated";
                return $this->view('../views/accountactivated',$data);
        }
        }
    }
}