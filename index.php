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

    <div class="container-fluid px-0">
        <div id="carouselExampleInterval" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-inner " style="height:70vh;">
                <div class="carousel-item active" data-bs-interval="6000">
                    <img src="img/slideImg_2.jpg" style="height:70vh;" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="6000">
                    <img src="img/slideImg_3.jpg" style="height:70vh;" class="d-block w-100 " alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="6000">
                    <img src="img/slideImg_1.jpg" style="height:70vh;" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container  bg-secondary my-2 py-3 px-5 rounded text-dark " style="--bs-bg-opacity: .2;" id="categories">
        <h2 class=" text-center">codeDiscuss - Browse Categories </h2>
        <div class="categoryCard row px-2 justify-content-center">
            <?php
                    $sql = "SELECT * FROM `categories`";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        echo '
                        <div class="cardContainer col-md-3">
                            <div class="card my-4 p-2" >
                                <img src="img/img_'.$row['category_id'].'.jpg" width="250" height="185" class="card-img-top" alt="'.$row['category_title'].' image">
                                <div class="card-body">
                                    <h4 class="card-title"><a href="threadList.php?cat_id='.$row['category_id'].'" class=" linkTxt texot-dark text-decooration-none"  >'.$row['category_title'].'</a></h4>
                                    <p class="card-text">'.substr($row['category_description'],0,100).'...</p>
                                    <a href="threadList.php?cat_id='.$row['category_id'].'" class="btn btn-primary">View Threads</a>
                                </div>
                            </div>
                        </div>';
                    }
            ?>
        </div>
    </div>
    <?php include 'partials/_footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>

    <script>
        function cardViewFunction(x) {
            cardContainer = document.getElementsByClassName("cardContainer");
            if (x.matches) { // If media query matches
                Array.from(cardContainer).forEach((element) => {
                    console.log("done");
                    element.classList.remove("col-md-3");
                    element.classList.add("col-md-4", "mx-3");
                })
            }
            else {
                Array.from(cardContainer).forEach((element) => {
                    console.log("done2");
                    element.classList.remove("col-md-4", "mx-5");
                    element.classList.add("col-md-3");
                })
            }
        }

        var x = window.matchMedia("(max-width: 1400px)")
        cardViewFunction(x) // Call listener function at run time
        x.addListener(cardViewFunction) // Attach listener function on state changes
        
       
    </script>
</body>

</html>