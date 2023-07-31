<?php
include_once "Functionals/Connection.php";
include_once "Functionals/Functions.php";
session_start();
if(isset($_SESSION)){
    $logout = "display: block;";
}
function AddFeed($link, $title, $content){//function to call for later use
    $insert = "INSERT into feedbacks (Title, content, user_ID) Values(?, ?, ".$_SESSION["uid"].");";//prepare feedback insertion syntax
    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $insert)){//if statement cannot be prepared
        header("Location: Categories.php?error=stmtfail");
        exit();
    }
    if($title === '' || $content === ''){//if a necessary field is empty
        echo '<script>window.alert(\'Please add something into the form.\')</script>';
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "ss", $title, $content);//filling sql parameters with input as text
        mysqli_stmt_execute($stmt);//execute query
        mysqli_stmt_close($stmt);
        echo"<script>window.alert('Approved!')</script>";//notify approval
    }
}
if(isset($_POST["submit"])){
 $title = $_POST["title"];
 $content = $_POST["content"];
 
AddFeed($link, $title, $content);
}
function PostsMax($link){
    $select = "SELECT max(ID) from materials";
    $query = mysqli_query($link, $select);
    $row = mysqli_fetch_assoc($query);
    return $row["max(ID)"];
}
function Posts($link, $i){// Select Material Information
    $select = "SELECT *, materials.link from materials, sources, admin where
    materials.Admin_ID = admin.ID
    and materials.Source_ID = sources.ID
    and materials.ID = $i";
    $query = mysqli_query($link, $select);//Relating it to database
    $row = mysqli_fetch_assoc($query);//Returning associative array
    return $row;
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
    <title>Resources</title>
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
        <?php
        include_once "Functionals/Side_Notes.php";
        ?>
        
    
    <form action="Categories.php" class="categ">
        <select name="categ" id="">
            <option value="general">General</option>
            <option value="computer_sci">Computer Science</option>
            <option value="anthropology">Anthropology</option>
            <option value="sociology">Sociology</option>
        </select>
    </form>
    <h1>Posts</h1>
    <?php
    $i = 0;
    for($i ===1; $i <= PostsMax($link); $i++){ // until counter reaches the last ID
        if(is_null(Posts($link, $i)) === true){} //null value handler
        else{ //if database returns something
            $name = Posts($link, $i)["name"]; // take first name from database selection
            $addedby = "Added By: ". Posts($link, $i)["Name"]." ".Posts($link, $i)["Surname"];// used for display of author name
            if(Posts($link, $i)["name"] === "None"){
                $name = Posts($link, $i)["Name"]. " " . Posts($link, $i)["Surname"];
                $addedby = "";
            }
            
                if(!isset($_SESSION['aid'])){// if the user is not an admin
                    if(is_null(Posts($link, $i)["link"])!== true){// if link value is not null
                        echo"<a style=\"color:white;\" href=".Posts($link,$i)["link"].">";//add the link to the entire material
                    }
                }
                else{ //if the user is an admin
                    echo"<a style=\"color:white\"href=changepost.php?context=".$i.">";//make the material lead to the admin edit page
                }
            
            echo"
            <div class=\"resource\">
                <div class=\"resource-img\" style=\"
                background-image: url('Images/Posts/".Posts($link,$i)["image"]."');
                \"></div>
                <div class=\"resource-ttl\"><h4 style=\"padding-left:1%; padding-top:0.25%;\">".Posts($link,$i)["Title"]." - ".$name."
                </div>
                <div class=\"resource-ct\"><h4 style=\"margin-left:1%; padding-top:0.25%;\">".Posts($link,$i)["Description"]."</h4><br><br>
                <h5 style=\"margin:1%\">Reference: ".Posts($link,$i)["Reference"]."<br><br> $addedby</h5>
                </div>
            </div>
            ";//display the returned material in the given divs
            if(!isset($_SESSION['aid'])){ 
                if(is_null(Posts($link, $i)["link"])!== true){//if link value is not null
                    echo"</a>";
                }
            }
            else{
                echo "</a>"; //close link
            }
        }
    }
    ?>
    <br><br><br><br><br>
    <?php
    $feeddisplay = "\"\"";
    if(isset($_SESSION["uid"]) === false ){//if user is not logged in
        $feeddisplay = "\"display:none;\"";
    }
    else{
        $feeddisplay ="\"display:block;\"";
    }
    echo"<div class=\"form\" style=". $feeddisplay ."><form action=\"Categories.php\" style=\"padding: 2%;\" method=\"post\">
    <p style=\"margin-bottom: 20px;font-weight: bold;font-size: 33px;\">Want to add a feedback?</p>
    <input type=\"text\" name=\"title\" placeholder=\"Choose your title\" style=\"width: 90%;margin-top: 30px;\" required><br>
    <textarea style=\"margin-top: 20px; width: 90%; height: 58px;\" placeholder=\"Type your feedback\" name=\"content\" required></textarea><br>
    <button type=\"submit\" name=\"submit\" style=\"margin-top: 10px;padding: 10px;\">Submit</button>
    </form></div>";
    ?>
    <a href="Main Page.php"><h1>Main menu<h1></a>
    <?php
    include_once "Functionals/Side_Notes.php";
    ?>
</body>
</html>