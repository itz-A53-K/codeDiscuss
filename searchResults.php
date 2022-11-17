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
     $search_query= $_GET['search_query'];
     $sql = "SELECT * FROM `threads` WHERE match (thread_ques,thread_desc) against ('$search_query')";
     $result = mysqli_query($conn, $sql);
     $question = false;
     

    ?>

    <div class="container pt-4" style="min-height:81vh;">
        <h2>Search results for : <em><?php echo $search_query?></em></h2>
       
        <ul class="text-bg-secondary px-0 my-3">
            <?php
                while($row = mysqli_fetch_assoc($result)){
                    $question = true;

                    $user_id= $row['thread_user_id'];
                    $sql2 = "SELECT user_name FROM `users123` WHERE user_id = '$user_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);

                    echo '
                        <li>
                            <div class="d-flex align-items-center">
                                <div class=" ms-3">
                                    <img src="img/chat-right.svg" alt="chat-right image" width="25">
                                </div>
                                <div class="flex-grow-1 mx-3">
                                    <div class="d-flex w-100 justify-content-between mt-1">
                                        <a href="thread.php?thread_id='.$row['thread_id'].'" class="linkTxt ">
                                            <p class="text-warning mb-0 fs-5">'.$row['thread_ques'].'</p>
                                        </a>
                                        <small class="d-flex"><img src="img/person.svg" width="17" height="22px"
                                                alt="person image"><em>&nbsp;'.$row2['user_name'].'</em> &nbsp;&diams; at:  '.substr($row['time'],0,16).'</small>
                                    </div>
                                    <a href="thread.php?thread_id='.$row['thread_id'].'" class="text-white text-decoration-none">
                                        <p class="mb-1"> '.substr($row['thread_desc'],0,200).' .... </p>
                                    </a>
                                </div>
                            </div>
                            <hr class=" m-0 mt-1">
                        </li>
                        ';
                }
                if(!$question){
                    echo '<div class="container mt-4 bg-secondary p-4" style="--bs-bg-opacity: .5;">
                    <h4> No results found for your search </h4>
                    <p>Suggestions:
                    <ul>
                    <li>Make sure that all words are spelled correctly.</li>
                    <li>Try different keywords.</li>
                    <li>Try more general keywords.</li>
                    </ul>
                    </p></div>';
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