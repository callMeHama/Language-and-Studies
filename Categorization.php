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
<body class="body" style>
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
    <h1>Why such categories?</h1>

    <div class="info-cont">
        <div class="info-cell">
            <h2>General</h2>
            <h3>The "General" category exists for two reasons. Some researches speak generally about the influence of languege. Also, some materials may not have a clear categorization.</h3>
        </div>
    </div>
    <div class="info-cont">
        <div class="info-cell">
            <h2>Computer Science</h2>
            <h3>Not only does Computer Science relate to what we work on but also it has a positive relationship with human language. A major part in computer scienece is programming, 
                which makes use of a variety of language.
            </h3>
        </div>
    </div>
    <div class="info-cont">
        <div class="info-cell">
            <h2>Anthropology</h2>
            <h3>Anthropology tends to study a variety of aspects of human nature, which makes it easier to find resources relating to it</h3>
        </div>
    </div>
    <br><br>
    <a href="Main Page.php"><h1>Main menu<h1></a>
    <a href="Categories.php"><h1>Categories<h1></a>
    <?php
    session_start();
    include_once "Functionals/Side_Notes.php";
    ?>
</body>
</html>