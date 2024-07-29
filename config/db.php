<?php 
$HOST = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DATABASE = 'tailwebs';

$conn = mysqli_connect($HOST, $USERNAME, $PASSWORD, $DATABASE);
global $conn;
if(!$conn){
    echo "Please check the DB connection";
}else{
    // echo "Student database connected!"; 
}

?>