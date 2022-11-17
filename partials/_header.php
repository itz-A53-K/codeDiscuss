<?php
// if(session_status() != PHP_SESSION_ACTIVE)
// {
//     session_start();
// }

if(session_status() != PHP_SESSION_ACTIVE){
  try{
      session_start();
  }
  catch(Exception $e){
      echo $e;
  }
}
echo '
<nav class="navbar navbar-dark sticky-top navbar-expand-lg bg-dark w-100 p-1" >
  <div class="container-fluid">
    <a class="navbar-brand" href="/productivity/codeDiscuss">codeDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/productivity/codeDiscuss">Home</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">';

          $sql = "SELECT * FROM `categories` limit 5";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
              echo '
            <li><a class="dropdown-item" href="threadList.php?cat_id='.$row['category_id'].'" ">'.$row['category_title'].'</a></li>';
          }
            
            echo '
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/productivity/codeDiscuss/#categories">View All</a></li>
          </ul>
        </li>
        <!-- <li class="nav-item">
           <a class="nav-link disabled">Disabled</a>
         </li> -->
        
         <li class="nav-item">
          <a class="nav-link" href="/productivity/codeDiscuss/about.php">About</a>
        </li>
        
        <li class="nav-item">
        <a class="nav-link" href="/productivity/codeDiscuss/contact.php">Contact</a>
        </li>
      
        <li class="nav-item align-self-center">
             <button class="btn btn-sm btn-outline-light ms-2 " data-bs-toggle="modal" data-bs-target="#ruleModal" type="submit">Rules</button>
      
        </li>
      </ul>
      <form class="d-flex" role="search" method="get" action="/productivity/codeDiscuss/searchResults.php">
        <input class="form-control me-2" type="search" id="search" name ="search_query" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" id="srcBtn" type="submit">Search</button>
    </form>
    ';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=='true'){
       echo ' <div class="login d-flex text-white">
             <p class="m-2 mt-3 p-0">Welcome <span class="text-warning">'.$_SESSION['userName'].'</span></p> 
            <button class="btn btn-outline-info m-2"  data-bs-toggle="modal" data-bs-target="#logoutModal" type="submit">Log Out</button>
        </div>';
      }
      else{
        echo ' <div class="login d-flex ">
            <button class="btn btn-outline-info m-2" data-bs-toggle="modal" data-bs-target="#loginModal" type="submit">Login</button>
            <button class="btn btn-outline-info m-2" data-bs-toggle="modal" data-bs-target="#signupModal" type="submit">Signup</button>
        </div>';
      }
echo '
    </div>
  </div>
</nav>';
?>
<?php
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
include 'partials/_logoutModal.php';
include 'partials/_ruleModal.php';
if(isset($_GET['signupSuccess']) && $_GET['signupSuccess']=="true")
{
    echo '
        <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <strong>Success!</strong> Your account for codeDiscuss has been created successfully. You can login now. 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    ';

}
else {
  if( isset($_GET['error']) &&$_GET['error']=="true"){
    echo '
        <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
            <strong> Error!</strong>'.$_GET['erName'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    ';
}}


if(isset($_GET['loginSuccess']) && $_GET['loginSuccess']=="true")
{
    echo '
        <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <strong>Success!</strong> You have loggedin successfully. 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    ';

}
else{
if( isset($_GET['loginError']) &&$_GET['loginError']=="true"){
  echo '
      <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
          <strong> Error!</strong>'.$_GET['erName'].'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  ';
}
}
if(isset($_GET['logoutSuccess']) && $_GET['logoutSuccess']=="true")
{
    echo '
        <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <strong>Success!</strong> You have logged out successfully. 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    ';

}

?>