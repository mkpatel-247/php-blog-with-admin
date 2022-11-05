<?php

$serverName = "localhost";
$dbUserName = "Scott";
$dbPassword = "tiger";
$dbName = "php_blog";

$conn = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);

if(!$conn){
    die("Connection Failed: ".mysqli_connect_error());
}
// else{
//     echo "Connected";
// }

?>