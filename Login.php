<?php

        include "Functionals/Connection.php";
        
        if(isset($_POST["submitreg"])){ //Singup case
            $name=$_POST["name"];
            $surname=$_POST["surname"];
            $email=$_POST["email"];
            $pass=$_POST["pass"];
            $pass2=$_POST["pass2"];
        
            require_once "Functionals/Functions.php";

            if (InvalidInput($name) !== false || InvalidInput($surname) !== false){
                header("Location: Login.php?error=InvalidInput");                
                exit();
            }
            if (EmailUsed($link, $email) !== false){
                header("Location: Login.php?error=EmailUsed");
                exit();
            }
            if($pass !== $pass2){
                header("Location: Login.php?error=UnmatchingPasses");
                exit();
            }
            else{
                Register($link, $name, $surname, $email, $pass);
            }
        }

        if(isset($_POST["submitlog"])){ //Login Case
            $email = $_POST["Email"];
            $pass = $_POST["passlog"];

            require_once "Functionals/Functions.php"; //Taking Functions

            NotSaved($link, $email, $pass);

            if(NotSaved($link, $email, $pass) !== false){
                header("Location: Login.php?error=NoAccount");
                //bad
            }
            else {
                header("Location: Categories.php");
                //good
            }
            
        } // with the help of Dani Krossing at: https://www.youtube.com/watch?v=gCo6JqGMi30&t=3618s
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styling.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Login</title>
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
    
    <div class="form">
        <h1 style="text-align:center">Login</h1>
        <form action="Login.php" style="padding: 1%;" method="post">
            <label for="Email">Email</label><br>
            <input type="Email" name="Email" style="width: 84%;" required><br><br>
            <label for="passlog">Password</label><br>
            <input type="password" name="passlog" style="width: 84%;" required><br><br>
            <input type="submit" name="submitlog">
            <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "NoAccount"){
                    echo"<h2 style=\"text-align:center;\">Email or Password is not right</h2>";
                }
                else if($_GET["error"] == "none2"){
                    echo"<h2 style=\"text-align:center;\">It worked</h2>";
                }
            }
            ?>
        </form>
    </div>

    <div class="form">
        <h1 style="text-align:center">Signup</h1>
        <form action="Login.php" style="padding: 1%;" method="post">
            <label for="">First Name</label><br>
            <input type="text" name="name" style="width: 84%;" required><br><br>
            <label for="">Last Name</label><br>
            <input type="text" name="surname" style="width: 84%;" required><br><br>
            <label for="">Email/Username</label><br>
            <input type="email" name="email" style="width: 84%;" required><br><br>
            <label for="">Password</label><br>
            <input type="password" name="pass" style="width: 84%;" required><br><br>
            <label for="">Repeat Password</label><br>
            <input type="password" name="pass2" style="width: 84%;" required><br><br>
            <input type="submit" name="submitreg">
            <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "InvalidInput"){
                    echo"<h2 style=\"text-align:center;\">Name/Surname cannot include special characters</h2>";
                }
                else if($_GET["error"] == "EmailUsed"){
                    echo"<h2 style=\"text-align:center;\">Email is already used, did you want to login?</h2>";
                }
                else if($_GET["error"] == "UnmatchingPasses"){
                    echo"<h2 style=\"text-align:center;\">Repeated password does not match</h2>";
                }
            }
            ?>
        </form>
    </div>
    <br>
    <a href="Main Page.php"><h1>Main menu<h1></a>
    <a href="Categories.php"><h1>Categories<h1></a>
</body>
</html>