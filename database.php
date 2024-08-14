<?php
//for make the data-bs-target

$servername ="localhost";
$username = "root";
$password = "";

$conn =  mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("fail". mysqli_connect_error());
}
#make database
$sql="CREATE DATABASE Website";
if ($conn->query($sql) === TRUE) {
    echo "database  created ";
    # code...

}
else {
    echo"error".$conn->error;
}
?>
