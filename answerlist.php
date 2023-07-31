<?php
include "Functionals/Connection.php";
include "Functionals/Functions.php";
echo"<script>window.history.replaceState(null,null,window.location.href);</script>";
session_start();
if(!isset($_SESSION)){
    die('<h1>We did not find any account to update</h1>');
}
$User = mysqli_fetch_assoc(mysqli_query($link,"SELECT * from user where ID = ".$_SESSION['uid'].";"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update your profile</title>
    <link rel="stylesheet" href="Styling.css">
</head>
<body class='body'>
    <h1 style="margin-top:20px;margin-left:10px;">Hi, <?php echo $User['Name']?>, find your responses below...</h1>
    <?php
    $sql = "SELECT feedbacks.Title as ft, feedbacks.content as fc, answers.title as `at`, answers.content as ac from feedbacks,answers where
    feedback_ID = feedbacks.ID AND
    user_ID = ".$_SESSION['uid'].";";//prepare syntax
    $query = mysqli_query($link,$sql);//prepare query
    while($row = mysqli_fetch_assoc($query)){//while a row is unused
        echo"
            <div style=\"margin-top:10px;\"><div style=\"width:98%;background:#101010;padding-top:5px; padding-bottom:5px;padding-right:2%;\"><h1>".$row['at']."</h1></div>
            <div style=\"width:98%;background:#101010;padding-top:5px; padding-bottom:5px;padding-right:2%;\"><h2>".$row['ac']."</h2><br>
            <h4>Responding To: ".$row['ft']."</h4><br>
            <h4>With Content: ".$row['fc']."</h4></div></div>";//display that row
    }
    ?>
    <a href="Main Page.php"><h1>Go Back?</h1></a>
</body>
</html>