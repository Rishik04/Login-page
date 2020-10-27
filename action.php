<?php
// print_r($_POST['action']);
include 'db.php';
//login action
if(isset($_POST['action']) && $_POST['action']=='login'){
    // echo "Correct";
    if(isset($_POST['mail']) && $_POST['mail']!==''){
        $email=$_POST['mail'];
    }
    else{
        echo json_encode(["status"=>0,"msg"=>"Enter Your Email"]);
        $conn->close();
        exit;
    }
    if(isset($_POST['pwd']) && $_POST['pwd']!==''){
        $pwd=$_POST['pwd'];
        $pwdEnc=password_hash($pwd,PASSWORD_DEFAULT);
        // print_r($pwdEnc);
    }
    else{
        echo json_encode(["status"=>0,"msg"=>"Enter Your Password"]);
        $conn->close();
        exit;
    }
    $sql="SELECT * FROM users WHERE email='$email'";
    // print_r($sql);
    $result=$conn->query($sql);
    // print_r($result);
    $row=$result->fetch_assoc();
    // print_r($row);
    if($result->num_rows<1){
        echo json_encode(["status"=>0,"msg"=>"No User Found"]);
        $conn->close();
        exit;
        // print_r($result->num_rows);
    }
    else{
        // print_r($pwd);
        // print_r($row['password']);
        if(password_verify($pwd,$row['password'])==0)
        {
            echo json_encode(["status"=>0,"msg"=>"Incorrect Email or Password"]);
            $conn->close();
            exit;
        }
        else{
             echo json_encode(["status"=>1,"msg"=>"Welcome! {$row['username']}"]);
        }
    }
}
//register action
if(isset($_POST['action']) && $_POST['action']=='register'){
    if(isset($_POST['username']) && $_POST['username']!==''){
        $username=$_POST['username'];
    }
    else{
        echo json_encode(["status"=>0,"msg"=>"Enter Your Username"]);
        $conn->close();
        exit;
    }
    if(isset($_POST['email']) && $_POST['email']!==''){
        $email=$_POST['email'];
    }
    else{
        echo json_encode(["status"=>0,"msg"=>"Enter Your Email"]);
        $conn->close();
        exit;
    }
    if(isset($_POST['password']) && $_POST['password']!==''){
        $password=$_POST['password'];
}
    else{
        echo json_encode(["status"=>0,"msg"=>"Enter Your password"]);
        $conn->close();
        exit;
    }
    if(isset($_POST['cpassword']) && $_POST['cpassword']!==''){
        $cpassword=$_POST['cpassword'];
        $cpass=password_hash($cpassword,PASSWORD_DEFAULT);
    }
    else{
        echo json_encode(["status"=>0,"msg"=>"Re-Enter Your password"]);
        $conn->close();
        exit;
    }
    if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){
        echo json_encode(["status"=>0,"msg"=>"Enter a valid Email"]);
        $conn->close();
        exit;
    }
    
    else{
        if(strlen($password)<8){
            echo json_encode(["status"=>0,"msg"=>"Password must be min 8 character long"]);
            $conn->close();
            exit;
        }
        else{
        $pass=password_hash($password,PASSWORD_DEFAULT);
    }
        if(password_verify($cpassword,$pass)==0 ||password_verify($password,$cpass)==0){
            echo json_encode(["status"=>0,"msg"=>"Password didn't matched"]);
            $conn->close();
            exit;
        }
        else{
            $sql="SELECT * FROM users WHERE username='$username' or email='$email'";
            $result=$conn->query($sql);
            // print_r($result);
            $row=$result->fetch_assoc();
            if($result->num_rows>0)
            {
                echo json_encode(["status"=>0,"msg"=>"Username or Email already exist!"]);
            }
            else{
                $insert="INSERT INTO users(username,email,password) VALUES('$username','$email','$pass')";
                if($conn->query($insert)==TRUE){
                    echo json_encode(["status"=>1,"msg"=>"Registered Successfully Login To Continue.."]);
                }
            }
        }
}
}

?>