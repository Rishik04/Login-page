<?php
$server ='localhost';
$username='root';
$password='';
$db='logindb';
$conn=mysqli_connect("$server","$username","$password","$db");
if(!$conn){
    echo "Server Error: ". mysqli_connect_error();
}