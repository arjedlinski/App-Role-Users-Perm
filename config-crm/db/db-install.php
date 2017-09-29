<?php 
include_once('db-config.php');
$query = array(
	'role' => 'CREATE TABLE IF NOT EXISTS role (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
role_name VARCHAR(30) NOT NULL
)',
    'perm' => 'CREATE TABLE IF NOT EXISTS perm (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
perm_name VARCHAR(30) NOT NULL
)',
    'role_perm' => 'CREATE TABLE IF NOT EXISTS role_perm (
  role_id INTEGER UNSIGNED NOT NULL,
  perm_id INTEGER UNSIGNED NOT NULL,
   PRIMARY KEY (`role_id`, `perm_id`)
)',
        'users_roles' => 'CREATE TABLE IF NOT EXISTS users_role (
  role_id INTEGER UNSIGNED NOT NULL,
  user_id INTEGER UNSIGNED NOT NULL,
   PRIMARY KEY (`role_id`, `user_id`)
)',
	'users' => 'CREATE TABLE IF NOT EXISTS users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
login_mt4 VARCHAR(30),
password_mt4 VARCHAR(100),
login_crm VARCHAR(30) NOT NULL,
password_crm VARCHAR(100) NOT NULL,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
groupname VARCHAR(30),
email VARCHAR(50),
hash_activate VARCHAR(100),
activate INT(5) DEFAULT 0,
reg_date TIMESTAMP
)',
	
);



/*$conn =  mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	break;
	}else{
	foreach($query as $key => $value){
		$conn->query($value);
		
	}
	echo 'Tables for ' .DB_NAME. ' has been created';
} */
?>
