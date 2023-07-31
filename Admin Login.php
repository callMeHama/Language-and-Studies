<?php
include_once "Functionals /Connection.php";

if(isset($_POST["submit"])){// if button is clicked
    $name= $_POST["name"];
    $surname= $_POST["surname"];
    $pass= $_POST["password"];
    $skey = $_POST["skey"];//put inputs in variables
    
    require_once "Functionals /Functions.php";//prepare functions
    if(AdminNone($link, $name, $surname, $pass) !== false && $skey === "123"){//if admin exists and skey written is 123
        session_start();
        $_SESSION["aid"] = AdminNone($link, $name, $surname, $pass)["ID"];//create a session variable that authenticates admin access
        header("Location: Feedbacks.php");//redirect to feedback page
    }
    else{
        header("Location: Admin Login.php?error=AdminNone");//Add an error sign in the page
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
    <title>Admin Login</title>
</head>
<body class="body">
    <div class="form">
        <form action="Admin Login.php" method="post" style="padding: 1%;">
            <label for="name">Name</label><br><br>
            <input type="text" name="name" style="width: 84%;" required><br><br>
            <label for="surname">Surname</label><br><br>
            <input type="text" name="surname" style="width: 84%;" required><br><br>
            <label for="password">Password</label><br><br>
            <input type="password" name="password" style="width: 84%;" required><br><br>
            <label for="skey">Skey</label><br><br>
            <input type="password" name="skey" style="width: 84%;" required><br><br>
            <button type="submit" name="submit">Login</button>
            <?php
            if(isset($_GET["error"])){
                if($_GET["error"] === "AdminNone"){//if an error sign exists
                    echo"<h2 style=\"text-align:center;\">Some input is not correct</h2>";
                }
            }
            
            ?>
        </form>
    </div>
    <?php
    include_once "Functionals/Side_Notes.php";
    ?>
</body>
</html>