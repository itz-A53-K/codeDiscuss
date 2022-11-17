<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to codeDiscuss - best forum for coders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
    <?php include 'partials/_dbConnect.php';?>
    <?php include 'partials/_header.php';?>
    <?php
    // session_start();

        $showAlert=false;
        $method= $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            $id= $_GET['thread_id'];
            $comment =$_POST['comment'];
            $user_id =$_POST['user_id'];

            $comment = str_replace("<", "&lt;",$comment);
            $comment = str_replace(">", "&gt;",$comment);

            $insert = "INSERT INTO `answers` (`ans_desc`, `thread_id`, `comment_time`,`ans_user_id`) VALUES ('$comment', '$id', current_timestamp(),'$user_id')";
            $result = mysqli_query($conn, $insert);
            $showAlert=true;
            if($showAlert)
            {
                echo '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your comment has been added successfully .
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
            }
            else{
                echo '
                    <div class="alert alert-denger alert-dismissible fade show" role="alert">
                        <strong> Error!</strong> Your comment has not been added. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
            }

     
        }

    ?>

    <div class="container mt-5 mb-4 ">
        <?php
            $id= $_GET['thread_id'];
            $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

                echo ' <div class ="mx-0">
                    <h3>Q. '.$row['thread_ques'].'</br>
                    </h3>
                    <p> '.$row['thread_desc'].'</p>';

                    $user_id= $row['thread_user_id'];
                    $sql2 = "SELECT user_name FROM `users123` WHERE user_id = '$user_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);

                    echo '
                    <small class="d-flex"> <img src="img/person.svg" width="18" alt="person image"><em class="m-0">&nbsp'.$row2['user_name'].' &nbsp&nbsp</em> <img src="img/clock-fill.svg" width="18" alt="clock image"> &nbsp'.substr($row['time'],0,16).'</small>
                    </div>
                ';
                // &diams;
                
            ?>


    </div>


    <div class="container">
        <!-- <h4>Post a Comment</h4> -->
        <p>
            <button class="btn btn-dark" data-bs-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="false" aria-controls="collapseExample">
                Post a comment
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=='true'){
                echo '
                    
                        <form action="'. $_SERVER['REQUEST_URI'].'" method="post" class="mx-3">

                            <div class="mb-3">
                                <label for="q_description" class="form-label"><b>Type your comment</b></label>

                                <textarea class="form-control border-dark" placeholder="" id="comment" name="comment"></textarea>
                                <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">

                            </div>


                            <button type="submit" class="btn btn-primary ms-2">Post</button>
                        </form>

                        ';}
                        
                        else{
                            echo '
                            <h4 class="mx-3">Please login first to post a comment .</h4>
                            ';
                        }
                        ?>
        </div>
    </div>


    <div class="container pt-4" style="min-height:61.5vh;">
        <h2>Answers / Discussions</h2>
        <?php
                $id= $_GET['thread_id'];
                $sql = "SELECT * FROM `answers` WHERE thread_id = $id";
                $result = mysqli_query($conn, $sql);
                $question = false;
                
                while($row = mysqli_fetch_assoc($result)){
                    $user_id= $row['ans_user_id'];
                    $question = true;

                    $sql2 = "SELECT * FROM `users123` WHERE user_id = '$user_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);

                    echo '
                    <li class="border rounded text-bg-dark mt-3 m-2 p-2 " style="list-style:none;">
                    
                    <div class="container p-0 d-flex text-white" style="min-height: 17vh;">
                        <div class="container p-3 bg-secondary w-25 ">
                         <h4 class="d-flex justify-content-center"> '.$row2['user_name'].'</h4>
                         <div class="d-flex justify-content-between 
                         "><p>Joined : </p> <p>'.substr($row2['signup_time'],0,10).'</p></div>
                       
                        </div>
                        <div class="container p-3 bg-success d-flex justify-content-between">
                            <p class="text-warning mb-0 w-75">'.$row['ans_desc'].'
                            </p>
            
                            <small> at: '. $row['comment_time'].'</small>
                        </div>
                       
                    </div>
                
                    
                    </li>
                    ';

                }
                if(!$question){
                    echo '<div class="container mt-4 bg-secondary p-4" style="--bs-bg-opacity: .5;">
                    <p class="display-5"> No discussion yet .</p>
                    <p>Be the first persion to discuss .</p></div>';
                }
                   
                
            ?>
    </div>
    <?php include 'partials/_footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
include 'partials/_ruleModal.php';
?>