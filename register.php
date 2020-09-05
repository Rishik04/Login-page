<?php 
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];


$conn=new mysqli('localhost','root','','logindb');
if($conn->connect_error){
    die('connection failed:' .$conn->connect_error);
}
else{
$stmt=$conn->prepare("insert into users(username,email,password) values(?,?,?)");
$stmt->bind_param("sss",$username,$email,$password);
$stmt->execute();
echo "Registration Successfull";
$stmt->close();
$conn->close();
}
?>

