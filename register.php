<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/e32d5f4f68.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
<div class="container after_login">
    <h2 class="text-center pt-4">Hey, Welcome
        <?php
        echo $_POST['username'];
        ?>
    </h2><hr>
    <h3 class="pt-4 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h3>
    <div class="row mt-3 text-left">
    <div class="col-lg-4 col-md-6 pt-2">
<h2>Head</h2>
<h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam perferendis sed molestias fuga sint pariatur expedita nesciunt recusandae distinctio debitis, culpa natus quam, corporis, maiores labore atque. Voluptas, molestias ex?</h6>
    </div>
    <div class="col-lg-4 col-md-6 pt-2">
<h2>Neck</h2>
<h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam perferendis sed molestias fuga sint pariatur expedita nesciunt recusandae distinctio debitis, culpa natus quam, corporis, maiores labore atque. Voluptas, molestias ex?</h6>
    </div>
    <div class="col-lg-4 col-md-6 pt-2 mb-4">
<h2>Body</h2>
<h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam perferendis sed molestias fuga sint pariatur expedita nesciunt recusandae distinctio debitis, culpa natus quam, corporis, maiores labore atque. Voluptas, molestias ex?</h6>
    </div>
</div>
</div>
</body>
</html>

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
$stmt->close();
$conn->close();
}
?>

