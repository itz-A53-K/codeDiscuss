<?php
$method= $_SERVER['REQUEST_METHOD'];
if($method =='POST'){
    session_start();
    // echo '<b> loging you out ! Please wait ....</b>';
    session_destroy();
    header ("Location:/productivity/codeDiscuss?logoutSuccess=true");
    exit();
}
else{
       $showError ="Some error occurred .";
    }
        
header ("Location:/productivity/codeDiscuss?logoutSuccess=false &error=true&erName=$showError");

?>