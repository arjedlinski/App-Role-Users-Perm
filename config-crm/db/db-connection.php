<?php
require_once('db-config.php');
include('db-install.php');
global $conn;
try {
    $conn =  new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
} catch (\Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}
$count = count($query);
$ask = $conn->query('SHOW TABLES from '.DB_NAME);
if ($conn->select_db(DB_NAME) === false && $_GET['url'] != 'db-install' OR ( $ask->num_rows != $count && $_GET['url'] != 'db-install') ) {

    header('Location: /db-install');
    
}

?>
