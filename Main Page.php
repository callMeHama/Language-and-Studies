<?php
session_start();
$location = 'Main%20Page.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styling.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Language And Studies - Ease of connection</title>
</head>

<body class="body" style='height:1350px;'>
        
        <?php
            
        include_once "Functionals/User Issues.php";
        ?>
        
        <div>
            <div class="container-fluid">
                <div class="row head menu-temp-height">
                    <div class="col-lg-3 col-md-3 col-sm-12 relative-temp"><div class="Ycenter absolute-temp"><a href="About Us.php"><p>About Us</p></a></div></div>
                    <div class="col-lg-3 col-md-3 col-sm-12 relative-temp"><div class="Ycenter absolute-temp"><a href="Categorization.php"><p>Why Categories</p></a></div></div>
                    <div class="col-lg-3 col-md-3 col-sm-12 relative-temp"><div class="Ycenter absolute-temp"><a href="Rights.php"><p>Authors' Rights</p></a></div></div>
                    <div class="col-lg-3 col-md-3 col-sm-12 relative-temp"><div class="Ycenter absolute-temp"><a href="Login.php"><p>Login/Signup</p></a></div></div>
                </div>
            </div>
            <div class="Menu-Preview"><div class="Preview-Filter relative">
                <div class="Ycenter absolute"><img src="Logo.png" alt="Project Logo" class="logo"></div>
                Image by <a href="https://pixabay.com/users/geralt-9301/?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=2167835">Gerd Altmann</a>  from 
                <a href="https://pixabay.com/?utm_source=link-attribution&utm_medium=referral&utm_campaign=image&utm_content=2167835">Pixabay</a>
            </div>
            </div>
        </div>
        
        <h1 style="text-align: center; padding: 20px;">Start Here</h1>
        <a href="Categories.php"><button style="color:white; background:tomato; border:none; padding: 2vw; margin:auto; display: grid; font-size: 3vw; border-radius: 2vw; margin-bottom:50px">Categories</button></a>
        
    <?php
    include_once "Functionals/Side_Notes.php";
    if(isset($_SESSION['uid'])){
        echo"<a href='profileupdate.php' style='text-align:center;padding-bottom:100px;'><h1>Update Account?</h1></a>";
        echo"<a href='answerlist.php' style='text-align:center;padding-bottom:100px;'><h1>Check Feedback Response</h1></a>";
    }
    ?>
    
</body>
</html>