<?php
$method= $_SERVER['REQUEST_METHOD'];

$showAlert=false;


if($method=='POST'){
    include '_dbConnect.php';
    $userName = $_POST['login_userName'];
    $pass = $_POST['login_password'];

    $checkUser ="SELECT * FROM `users123` WHERE user_name = '$userName' ";
    $checkUser_result = mysqli_query($conn,$checkUser);
    $noRows = mysqli_num_rows($checkUser_result);

    if($noRows==1){
        $row=mysqli_fetch_assoc($checkUser_result);
        if(password_verify($pass,$row['user_pass'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['userName'] = $userName;
                $_SESSION['user_id'] = $row['user_id'];
                header ("Location:/productivity/codeDiscuss/index.php?loginSuccess=true");
                exit();
        }
        else{
            $showError =" Passwords do not match.";
        }
        

    }
    else{
        $showError =" No account found. Please signup first.";

    }
    header ("Location:/productivity/codeDiscuss/index.php?loginSuccess=false &error=true&erName=$showError");

    
}
?>