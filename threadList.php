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
    <style>
        .linkTxt {
            color: black;
            text-decoration: none;
        }

        .linkTxt:hover {
            color: black;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include 'partials/_dbConnect.php';?>
    <?php include 'partials/_header.php';?>
    <?php
        $showAlert=false;
        $method= $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            $id= $_GET['cat_id'];
            $q_title =$_POST['q_title'];
            $q_desc =$_POST['q_desc'];
            $user_id =$_POST['user_id'];

            $q_title = str_replace("<", "&lt;",$q_title);
            $q_title = str_replace(">", "&gt;",$q_title);
            $q_desc = str_replace("<", "&lt;",$q_desc);
            $q_desc = str_replace(">", "&gt;",$q_desc);

            $insert = "INSERT INTO `threads` ( `thread_ques`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `time`) VALUES ( '$q_title', '$q_desc', '$id', '$user_id', current_timestamp())";
            $result = mysqli_query($conn, $insert);
            $showAlert=true;
            if($showAlert)
            {
                echo '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your thread has been added successfully . please wait for community to respond .
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
    
            }
            else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> Error!</strong> Your thread has not been added . Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
            }
        }

    ?>


    <div class="container ">
        <div class="card p-2 my-3 bg-warning rounded text-dark " style="--bs-bg-opacity: .6;">

            <div class="card-header">
                <?php
                    $id= $_GET['cat_id'];
                    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                        echo '
                            <h2 class="card-title">Welcome to '.$row['category_title'].' forums</h2>
                            <p class="card-text">'.$row['category_description'].'</p>
                        ';
                    
                ?>
            </div>
            <div class="card-body ms-4 ">

                <h3>Forum Rules</h3>
                <p>
                    No Spam / Advertising / Self-promote in the forums. Do not post copyright-infringing material. Do
                    not post “offensive” posts, links or images. Do not cross post questions.
                    Do not PM users asking for help. Remain respectful of other members at all times.<br>
                </p>

                <button class="btn btn-dark ms-1" data-bs-toggle="modal" data-bs-target="#ruleModal">Know
                    More</button>
            </div>
        </div>
    </div>

    <div class="container">
        <p>
            <button class="btn btn-dark" data-bs-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="false" aria-controls="collapseExample">
                Start a discussion
            </button>

        </p>

        <div class="collapse" id="collapseExample">
            <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=='true'){
                echo '
                <div class="card card-body border-dark">
                <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                    <div class="mb-3">
                        <label for="q_title" class="form-label"><b>Concern title</b></label>
                        <input type="text" class="form-control border-dark" id="q_title" name="q_title" maxlength="350" required>

                    </div>
                    <div class="mb-3">
                        <label for="q_description" class="form-label"><b>Concern description</b></label>

                        <textarea class="form-control border-dark" placeholder="Elaborate your concern here"
                            id="q_desc" name="q_desc"></textarea>
                            <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">

                    </div>


                    <button type="submit" id="post_ques" class="btn btn-primary">Post</button>
                </form>
            </div>

            ';}
                        
            else{
                echo '
                <h4 class="mx-3">Please login first to start a discussion.</h4>
                ';
            }
            ?>
        </div>

    </div>
    </div>

    <div class="container px-3" style="min-height:35vh;">
        <h2>Browse Questions</h2>
        <ul class="text-bg-secondary px-0">
            <?php
                $id= $_GET['cat_id'];
                $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
                $result = mysqli_query($conn, $sql);
                $question = false;
                while($row = mysqli_fetch_assoc($result)){
                    $question = true;

                    $user_id= $row['thread_user_id'];
                    $sql2 = "SELECT user_name FROM `users123` WHERE user_id = '$user_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);

                    echo '
                    <li >
                         <div class="d-flex align-items-center">
                                <div class=" ms-3">
                                    <img src="img/chat-right.svg" alt="chat-right image" width="25">
                                </div>
                                <div class="flex-grow-1 mx-3">
                                <div class="d-flex w-100 justify-content-between mt-1">
                                <a href="thread.php?thread_id='.$row['thread_id'].'" class="linkTxt">
                                    <!-- class="text-decoration-none"-->
                                    <p class="text-warning mb-0 fs-5"> '.$row['thread_ques'].'</p>
                                </a>
                                   <small class="d-flex flex-column">
                                        <div>
                                            <img src="img/person.svg" width="17" height="22px" alt="person image">
                                            <em>&nbsp;'.$row2['user_name'].'</em>
                                        </div>
                                     &diams; at:  '.substr($row['time'],0,16).'</small>
                                </div>
                                <a href="thread.php?thread_id='.$row['thread_id'].'" class="text-white text-decoration-none" ><p class="mb-1" > '.substr($row['thread_desc'],0,160).' .... </p>
                                </a>
                            </div>
                            </div>
                    <hr class=" m-0 mt-1">
                    </li>
                    ';
                }
                if(!$question){
                    echo '<div class="container mt-4 bg-secondary p-4" style="--bs-bg-opacity: .5;">
                    <p class="display-5"> No questions for this category yet . </p>
                    <p>Be the first persion to ask a question.</p></div>';
                }
                
            ?>
        </ul>

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