<?php
    include_once "Functionals/Connection.php";
    include_once "Functionals/Functions.php";
    session_start();
    if(isset($_SESSION["aid"]) === false){
        die("You are not allowed to go through this page");
    }
    function SourceMax($link){
        $select = "SELECT max(ID) from sources;";
        $query = mysqli_query($link, $select);
        $row = mysqli_fetch_assoc($query);
        return $row["max(ID)"];
    }
    function Source($link, $i){
        $select = "SELECT * FROM sources WHERE ID=$i or name=$i;";
        $query = mysqli_query($link, $select);
        $row = mysqli_fetch_assoc($query);
        return $row;
    }
    function AddResource($link, $title, $description, $url, $reference, $image, $source){
        $SourceID = Source($link, $source)["ID"];
        $insert = "INSERT INTO materials (Title, Description, link, Reference, Admin_ID, image, Source_ID)
        Values (?, ?, ?, ?, ".$_SESSION["aid"].", ?, $SourceID);";//add syntax
        $stmt = mysqli_stmt_init($link);
        if(!mysqli_stmt_prepare($stmt, $insert)){//prepare statement
            echo"<script>window.alert('Insertion Failure')</script>";
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "sssss", $title, $description, $url, $reference, $image);//put input into parameters
            mysqli_stmt_execute($stmt);//execute query
            mysqli_stmt_close($stmt);
        }
    }
    function AddSource($link,$name,$url,$aid){
        $code= "INSERT INTO sources (name, link, admin_ID) values (?,?,?);";
        $stmt = mysqli_stmt_init($link);
        if(!mysqli_stmt_prepare($stmt,$code)){
            echo"<script>window.alert('Insertion Failure')</script>";
            exit();
        }
        mysqli_stmt_bind_param($stmt,"ssi",$name,$url,$aid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    if(isset($_POST["submit2"])){
        $url = $_POST['link'];
        if($_POST['link'] ===''){
            $url = null;
        }
        $name = $_POST['source'];
        AddSource($link, $name, $url, $_SESSION['aid']);
    }
    if(isset($_POST["submit"])){
        $title = $_POST["title"];
        $description = $_POST["description"];
        $source = $_POST["source"];
        $reference = $_POST["ref"];
        $url = $_POST["url"];
        if($_POST['url'] ===''){
            $url =null;
        }
        $image = $_POST["image"];
        AddResource($link, $title, $description, $url, $reference, $image, $source);
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
    </div>
    
    <div class="form">
        <form action="AddResource.php" style="padding: 2%;" method="post">
            <p style="margin-bottom: 20px;font-weight: bold;font-size: 33px;">What are we posting today?</p>
            <input type="text" name="title" placeholder="Write the title.." style="width: 90%;margin-top: 30px;" required><br>
            <textarea style="margin-top: 20px; width: 90%; height: 58px;" placeholder="Add description.." name="description" required></textarea><br>
            <input type="text" name="ref" placeholder="Reference.." style="width: 90%;margin-top: 30px;" required><br><br>
            <input type="text" name="url" placeholder="Add link.." style="width: 90%;margin-top: 30px;" required><br><br><br>
            <select name="source" title='choose a source'>
                <?php
                $i = 1;
                for($i === 0; $i <= SourceMax($link); $i++){//preparing loop
                    if(is_null(Source($link, $i))===true){}//if no source with such ID (do nothing)
                    else{
                        echo "<option value=$i>".Source($link, $i)["name"];"</option>";//display source
                    }
                }
                ?>
            </select><br><br>
            <label for="image"></label>
            <input type="file" name="image" required accept="image/png, image/jpeg, image/jfif" value='Choose an image' placeholder='Choose your image'><br><br>
            <button type="submit" name="submit" style="margin-top: 10px;padding: 10px;">Submit</button>
        </form>
    </div>

    <div class="form">
        <form action="AddResource.php" style="padding: 2%;" method="post">
            <p style="margin-bottom: 20px;font-weight: bold;font-size: 33px;">Add Source</p>
            <input type="text" name="source" placeholder="Source..." style="width: 90%;margin-top: 30px;" required><br>
            <input type="text" name="link" placeholder="Link..." style="width: 90%;margin-top: 30px;"><br><br>
            <button type="submit" name="submit2" style="margin-top: 10px;padding: 10px;">Submit</button>
        </form>
    </div>
    <?php
    include_once "Functionals/Side_Notes.php";
    ?>
</body>
</html>