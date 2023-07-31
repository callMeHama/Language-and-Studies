<?php
session_start();
$location="About%20Us.php";
include_once("Functionals/User Issues.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styling.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>About Us</title>
</head>
<body class="body">
    <header>
        <div class="container-fluid">
            <div class="row head menu-temp-height">
                <div class="col-lg-3 col-md-3 col-sm-12 relative-temp"><div class="Ycenter absolute-temp"><a href="About Us.php"><p>About Us</p></a></div></div>
                <div class="col-lg-3 col-md-3 col-sm-12 relative-temp"><div class="Ycenter absolute-temp"><a href="Categorization.php"><p>Why Categories</p></a></div></div>
                <div class="col-lg-3 col-md-3 col-sm-12 relative-temp"><div class="Ycenter absolute-temp"><a href="Rights.php"><p>Authors' Rights</p></a></div></div>
                <div class="col-lg-3 col-md-3 col-sm-12 relative-temp"><div class="Ycenter absolute-temp"><a href="Login.php"><p>Login/Signup</p></a></div></div>
            </div>
        </div>
    </header>
    <div class="info-cont">
        <div class="info-cell">
            <h1>Who are we?</h1>
            <img src="" alt="">
            <h2>
                We are a team of developers interested in human sciences trying to research the influence of human languages on the various studies of the world. The idea has started 
                with continuous looking through materials of philosophy of science, that usually state a certain effect or difference of results being caused by the language difference.
                Another aim of content we serve is to show how a mix of fields can work well when they seem to be far from each other, considering that the linking of different studies 
                usually creates an interesting result.
            </h2>
        </div>
    </div>
    <br>
    <a href="Main Page.php"><h1>Main menu<h1></a>
    <a href="Categories.php"><h1>Categories<h1></a>
    <?php
    include_once "Functionals/Side_Notes.php";
    ?>
</body>
</html>