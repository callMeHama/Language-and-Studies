<?php
include "Functionals/Connection.php";
include "Functionals/Side_Notes.php";
include "Functionals/Functions.php";
session_start();
if(!isset($_SESSION['aid'])){//if no admin account is there
    die('<h1>You are not allowed to check this content</h1>');
}
if(!isset($_GET['context'])){//if no post information is shown
    die('<h1>The details of the post are missing</h1>');
}
$context= $_GET['context'];//Get post ID in the link
$post = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM materials WHERE ID = $context;"));//select the post that has the ID
if(!isset($post['ID'])){//if no post exists (or is deleted)
    echo '<script>window.location.assign("Categories.php")</script>';// go back
}
function RemovePost($link, $context){
    mysqli_query($link,"DELETE FROM materials WHERE ID = $context;");
}

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
    <a href="Categories.php"><h1>Go Back?</h1></a><br>
    
    <h1>Title: <?php echo $post['Title'];?></h1><br>
    <h2>Content: <?php echo $post['Description'];?></h2><br><br>
    <?php
    if(isset($post['link'])){
        echo"<h2>Link:<a href=".$post['link'].">".$post['link']."</a></h2><br><br>";
        }?>
    
    <form action="changepost.php?context=<?php echo $context?>" style='background:none;text-align:left;padding:5px;margin:0;' method='post'>
    <button type='Submit' name='delete' style='font-size:20px;padding:5px;margin-top:10px;'>Delete</button>
    <button type='Submit' name='change' style='font-size:20px;padding:5px;margin-top:10px;'>Edit</button>
    </form>
    <?php
        if(isset($_POST['delete'])){
            RemovePost($link,$context);
        }
        if(isset($_POST['change'])){//if edit button is clicked
            header("location: http://localhost/Language%20and%20Studies/changepost.php?context=".$_GET['context']."&edit=yes");//add edit information
        }
        if (isset($_GET['edit'])){//if edit information exists
            echo "<div class=\"form\">
            <h1 style=\"text-align:center\">Edit Post</h1>
            <form action=\"http://localhost/Language%20and%20Studies/changepost.php?context=".$_GET['context']."&edit=yes\" style=\"padding: 1%;\" method=\"post\">
                <label for=\"title\">Title</label><br>
                <input type=\"text\" value=\"".$post['Title']."\" name=\"title\" style=\"width: 84%;\" required><br><br>
                <label for=\"content\">Content</label><br>
                <textarea type=\"text\" name=\"content\" style=\"width: 84%;\" required>".$post['Description']."</textarea><br><br>
                <label for=\"link\">Link</label><br>
                <textarea type=\"text\" name=\"link\" style=\"width: 84%;\">".$post['link']."</textarea><br><br>
                <label for=\"reference\">Reference</label><br>
                <input type=\"text\" value=\"".$post['Reference']."\" name=\"reference\" style=\"width: 84%;\" required><br><br>
                <input type=\"submit\" name=\"edit\">
            </form>
        </div>";//add edit form

            if(isset($_POST['edit'])){//if edit submission button is clicked
                $ttl= $_POST['title'];
                $cnt= $_POST['content'];
                $lnk= $_POST['link'];
                $rnfc= $_POST['reference'];//define inputs
                $sql = "UPDATE materials SET Title=?,Description = ?, link = ?, Reference = ? where ID = ".$_GET['context'].";";//add syntax
                $check = curl_init($lnk);
                curl_setopt($check, CURLOPT_RETURNTRANSFER, TRUE);
                $exec = curl_exec($check);
                $errcode = curl_getinfo($check, CURLINFO_HTTP_CODE);
                if($errcode === 200 || $lnk === ''){ //if link is valid or is not existent
                    if($lnk ===''){
                        $lnk = null;//make link submission null
                    }
                    $stmt = mysqli_stmt_init($link); //start the update
                    if(!mysqli_stmt_prepare($stmt,$sql)){
                        echo '<script>window.alert("An error occurred preparing your request")</script>';
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt, "ssss", $ttl,$cnt,$lnk,$rnfc);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
                else{
                    echo '<script>window.alert("please put a valid link")</script>';
                }
            }
        }
    ?>
    <script>
        window.history.replaceState(null,null,window.location.href);//make no submission on reload
    </script>
</body>
</html>