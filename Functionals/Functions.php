<?php
include "Connection.php";

function InvalidInput($p1){ //ensures special characters are not added within certain inputs
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $p1)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
function EmailUsed($link, $email){ //Checks if emails are new or not
    $code = "SELECT * FROM user WHERE Email LIKE ?;";
    $stmt = mysqli_stmt_init($link);
    
    if(!mysqli_stmt_prepare($stmt,$code)){
        header("location: ../Login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if(mysqli_fetch_assoc($resultData)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function Register($link, $name, $surname, $email, $pass){ //Add account data to the database
    $code = "INSERT INTO user (Name, Surname, Email, Password) VALUES(?,?,?,?);";
    $stmt = mysqli_stmt_init($link);

    if(!mysqli_stmt_prepare($stmt,$code)){
        header("location: ../Login.php?error=stmtfailed");
        exit();
    }
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $surname, $email, $hash);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: Login.php?error=none");
}

function NotSaved($link, $email, $pass){ //Check Login Submission validity

    if(EmailUsed($link, $email) === false){
        return true;
    }
    else{

        $code = "SELECT * FROM user WHERE Email LIKE ?;";
        $stmt = mysqli_stmt_init($link);
        if(!mysqli_stmt_prepare($stmt, $code)){
            header("Location: Login.php?error=zeft");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $distribution = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($distribution)){
            $passcheck = password_verify($pass, $row["Password"]);
            
            if($passcheck === false)
            {
                return true;
            }
            else{
                session_start();
                $_SESSION["uid"] = $row["ID"];
                return false;
            }
        }
        else{
            return true;
        }
    }// With the help of Dani Krossing at: https://www.youtube.com/watch?v=gCo6JqGMi30&t=3618s
}

function AdminNone($link, $name, $surname, $pass){ //Admin Login Authentication

    $code = "SELECT * FROM admin WHERE Name LIKE ? AND Surname LIKE ? AND PASSWORD LIKE ?;";
    $stmt = mysqli_stmt_init($link);
    
    if(!mysqli_stmt_prepare($stmt,$code)){
        header("location: ../Login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $name, $surname, $pass);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
        session_start();
        $_SESSION["aid"] = $row["ID"];
    }
    else{
        return false;
    }
    return $result;
}
function Feedback($link, $i){
  $select = "SELECT * from feedbacks where ID = $i";
  $query = mysqli_query($link, $select);
  $row = mysqli_fetch_assoc($query);
  return $row;
}

function Relate($link, $int){
  $select = "SELECT user.ID as uid, Name, Surname from user, feedbacks where user.ID = feedbacks.user_ID and user.ID = $int";
  $query = mysqli_query($link, $select);
  $row = mysqli_fetch_assoc($query);
  return $row;
}
function UpdateAccount($link,$name,$surname,$pass, $id){
    if(!isset($_SESSION["uid"])){
        echo "<script>window.alert('There is a problem detecting the user')</script>";
        header("location: ../Main%20Page.php");
        exit();
    }
    
    $update = "UPDATE user Set Name = ?, Surname = ?, Password = ? WHERE ID = $id;";
    $stmt = mysqli_stmt_init($link);

    if(!mysqli_stmt_prepare($stmt,$update)){
        echo "<script>window.alert('Apologies, an error occured in preparing your request.')</script>";
        header("location: ../Main%20Page.php");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $name, $surname, $pass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;

}
echo "<script>window.history.replaceState(null,null,window.location.href);</script>";//Prevent PHP submission on page reload