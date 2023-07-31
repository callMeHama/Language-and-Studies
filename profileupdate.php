<?php
include "Functionals/Connection.php";
include "Functionals/Functions.php";
echo"<script>window.history.replaceState(null,null,window.location.href);</script>";
session_start();
if(!isset($_SESSION)){
    die('<h1>We did not find any account to update</h1>');
}
$Return = mysqli_fetch_assoc(mysqli_query($link,"SELECT * from user where ID = ".$_SESSION['uid'].";"));
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
    <div class="form">
        <h1 style="text-align:center">Update</h1>
        <form action="profileupdate.php" style="padding: 1%;" method="post">
            <label for="name">First Name</label><br>
            <input type="text" name="name" style="width: 84%;" value=<?php echo $Return['Name'];?> required><br><br>
            <label for="surname">Last Name</label><br>
            <input type="text" name="surname" style="width: 84%;" value=<?php echo $Return['Surname'];?> required><br><br>
            <label for="pass">Old Password</label><br>
            <input type="password" name="pass" style="width: 84%;"><br><br>
            <label for="newpass">New Password</label><br>
            <input type="password" name="newpass" style="width: 84%;"><br><br>
            <label for="newpass2">Repeat New Password</label><br>
            <input type="password" name="newpass2" style="width: 84%;" title="final password submission"><br><br>
            <input type="submit" name="update">
            <?php
                if(isset($_POST['update'])){// if button is clicked
                    $name = $_POST['name'];
                    $surname=$_POST['surname'];
                    $oldpass = $_POST['pass'];
                    $newpass = $_POST['newpass'];
                    $newpass2 = $_POST['newpass2']; // adding variables with information written
                    $finalpass = password_hash($newpass2, PASSWORD_DEFAULT);// password to update is the new one by default
                    if(!preg_match("/^[a-zA-Z0-9]*$/", $name)){// if unwanted characters
                        echo"<script>window.alert('Please add a valid name')</script>"; //notify
                        exit(); // stop the code
                    }
                    if($newpass !== $newpass2){ //if new passwords do not match
                        echo"<script>window.alert('New passwords need to match to be submitted')</script>";
                        exit();
                    }
                    if($newpass === "" && $newpass2 === ""){//if new passwords are empty
                        $finalpass = $Return['Password'];//make the updated password the same as old one
                    }
                    $passcheck = password_verify($oldpass, $Return["Password"]);//verify that submitted old password matches the saved one (matching hashes)
                    if($oldpass !== "" && $passcheck === false){//if 
                        echo"<script>window.alert('The old password is incorrect.')</script>";
                        exit();
                    }
                    if($name===""||$surname===""){//if name and surname fields are empty
                        echo"<script>window.alert('Please add something to fields you are willing to change')</script>";
                        exit();
                    }
                    if(UpdateAccount($link,$name,$surname,$finalpass,$_SESSION['uid']) === true){
                        echo"<script>window.alert('Update Successful!');</script>";
                    }
                }
            ?>
        </form>
        <a href="Main Page.php"><h1>Go Back?</h1></a>
    </div>
</body>
</html>