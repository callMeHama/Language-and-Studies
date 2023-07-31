<?php
include "Functionals/Connection.php";
include "Functionals/Side_Notes.php";
include "Functionals/Functions.php";
session_start();
if(!isset($_SESSION['aid'])){//if no admin account detected
    die('<h1>You are not allowed to check this content</h1>');//prevent access
}
if(!isset($_GET['context'])){//if no feedback data
    die('<h1>The details of the Feedback are missing</h1>');//notify
}
$context= $_GET['context'];//put feedback ID in a variable
$feed = Feedback($link,$_GET['context']);//call feedback selection function
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response to Feedback</title>
    <link rel="stylesheet" href="Styling.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body class='body'>
    <script>
        window.history.replaceState(null,null,window.location.href);
    </script>
    <a href="Feedbacks.php"><h1>Go Back?</h1></a><br>
    
    <h1>Title: <?php echo $feed['Title'];?></h1><br>
    <h2>Concern: <?php echo $feed['content'];?></h2><br><br>
    
    <form action="FeedResponse.php?context=<?php echo $context?>" style='text-align:left;padding:5px;' method='post'>
    <input type="text" name='title' placeholder="Title..." style="font-size:25px;width:90%;margin-top:10px;"><br>
    <input type="text" name='content' placeholder="Content..." style="font-size:20px;width:90%;margin-top:10px;"><br>
    <button type='Submit' name='submit' style='font-size:20px;padding:5px;margin-top:10px;'>Answer</button>
    </form>
    <?php
        if(isset($_POST['submit'])){
            $title=$_POST['title'];
            $content=$_POST['content'];
            if($title === "" || $content === ""){
                echo "<script>window.alert('Please do not leave the content or the title blank')</script>";
                exit();
            }
            $code = "INSERT INTO answers (title, content, admin_ID, feedback_ID) VALUES(?,?,?,?);";
            $stmt = mysqli_stmt_init($link);

            if(!mysqli_stmt_prepare($stmt,$code)){
                die('<h1>Something is not right</h1>');
                exit();
            }
            
            mysqli_stmt_bind_param($stmt, "ssss", $title, $content, $_SESSION['aid'], $context);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    ?>
</body>
</html>