<?php
include "Functionals/Connection.php";
include "Functionals/Functions.php";
session_start();

if(isset($_SESSION["aid"]) === false){
  die("You are not allowed to go through this page");
}

function FinalFeed($link){//select the last ID in feedback table
  $select = "SELECT max(ID) from feedbacks";
  $query = mysqli_query($link, $select);
  $row = mysqli_fetch_assoc($query);
  return $row;
}



function Profile($link,$int){//Get sender's profile image
  $Folder = "Images/Profiles/";

    if (is_dir($Folder)){//check folder
      if(null !== Relate($link,$int)){//if the sender of feedback is found
        if ($check = opendir($Folder)){
          while (($filecheck = readdir($check)) !== false){
              $verifier = stripos($filecheck, Relate($link,$int)['uid']."-");//check if the name of the image has the appropriate user data
              if ($verifier === 0){//if name in file exists
                  $verifiedname = $Folder . $filecheck;//Make the source to the image
              }
          }
        }
      }
      if(!isset($verifiedname)){//if no image is found
        $verifiedname = $Folder."Default.jpg";//add default image source
      }
        return $verifiedname;//return image source
    }
}
?>
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
    <div>
        <a href="Feedbacks.php"><h1>Feedbacks</h1></a>
        <a href="AddResource.php"><h1>Add Resources</h1></a>
        <a href="Categories.php"><h1>Categories</h1></a>
    </div>
    
    <?php
    try{
      $i = 0;
      for($i === 0; $i <= FinalFeed($link)["max(ID)"]; $i++){
        if (is_null(Feedback($link, $i)) === true){

        }
        else{
          if (is_null(Relate($link, Feedback($link, $i)["user_ID"])) === true && null === Profile($link,$i)){

          }
          else{
            $row = Relate($link, Feedback($link, $i)["user_ID"]);
            echo"
              <a href='FeedResponse.php?context=".Feedback($link,$i)['ID']."'><div style='color:white' class=\"resource\" oncontextmenu=\"CustomMenu()\">
                <div class=\"resource-img\" style=\"background-image:url(".Profile($link,Feedback($link, $i)["user_ID"]).");\"></div>
                <div class=\"resource-ttl\"><h4 style=\"margin-left:1%; margin-top:0.25%;\">".Feedback($link, $i)["Title"]." - ". $row["Name"]." ". $row["Surname"]."</h4></div>
                <div class=\"resource-ct\"><h4 style=\"margin:1%;\">". Feedback($link, $i)["content"] ."</h4></div>
              </div>
            ";
          }
        }
      }
    }
    catch(Exception $e){
      echo"co-exception";
    }

    include_once "Functionals/Side_Notes.php";
    ?>
</body>
</html>