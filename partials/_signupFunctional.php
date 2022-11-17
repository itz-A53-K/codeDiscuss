<?php
$method= $_SERVER['REQUEST_METHOD'];

$showAlert=false;


if($method=='POST'){
    include '_dbConnect.php';
    
    $userName = $_POST['userName'];
    $userEmail = $_POST['signup_email'];
    $userPass = $_POST['signup_password'];
    $user_cPass = $_POST['signup_cPassword'];

    $userName = str_replace("<", "&lt;",$userName);
    $userName = str_replace(">", "&gt;",$userName);
    
    $checkUser ="SELECT * FROM `users123` WHERE user_name = '$userName' ";
    $checkUser_result = mysqli_query($conn,$checkUser);
    $noRows = mysqli_num_rows($checkUser_result);

    if($noRows>0){
        $showError = " Username already exists.";
    }
    else{
        if($userPass==$user_cPass){

            $hash = password_hash($userPass, PASSWORD_DEFAULT);

            $insert="INSERT INTO `users123` (`user_name`, `user_email`, `user_pass`, `signup_time`) VALUES ('$userName', '$userEmail', '$hash', current_timestamp())";
            $result=mysqli_query($conn,$insert);
            
            if($result){
                $showAlert = true;
                header ("Location:/productivity/codeDiscuss/index.php?signupSuccess=true");
                exit();
            }
            
        }
        else{
            $showError =" Passwords do not match.";
        }
        
    }
    header ("Location:/productivity/codeDiscuss/index.php?signupSuccess=false &error=true&erName=$showError");



}


?>