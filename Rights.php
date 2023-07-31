<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styling.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Document</title>
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

    <h1>Authors' Rights</h1>
    <img src="" alt="">
    <div class="info-cont">
        <div class="info-cell">
            <h2>
            The resources distributed in this site are originated from other primary sources. The owners' rights are essential in this context; There is an appropriate citation of 
            source given with each resource. If any violation, minor or major, is found within citations, please do not hesitate to provide a feedback if you are an account user.
            </h2>
        </div>
    </div>

    <div class="info-cont">
        <div class="info-cell">
            <h1>How citations should be?</h1>
            <h2>Citations should be Harvard Styled</h2>
        </div>
    </div>
    <br>
    <a href="Main Page.php"><h1>Main Page</h1></a>
    <?php
    session_start();
    include_once "Functionals/Side_Notes.php";
    ?>
</body>
</html>