<?php
$password=$_POST['password'];
$email=$_POST['email'];


$conn=new mysqli('localhost','root','','logindb');

if(isset($login)){
$result=mysqli_query($conn,"SELECT * FROM users WHERE username='$username' and password='$password' ");
if(mysqli_num_rows($rs)<1)
{
    $found="N";
}
else{
    $_SESSION["login"]=$username;
}
}
if(isset($_SESSION["login"]))
{
    echo "Successfully Logged In";
}
exit;
?>