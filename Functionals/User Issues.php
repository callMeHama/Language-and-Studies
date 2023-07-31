<?php

include_once "Functionals/Connection.php";
function User($link, $i){

 $query = mysqli_query($link,"SELECT * from user where ID = $i");
 return mysqli_fetch_assoc($query);
}


$display= "display:none;";
if(isset($_SESSION["uid"])){

    $Return = mysqli_fetch_assoc(mysqli_query($link,"SELECT * from user where ID = ".$_SESSION['uid'].";"));
    
    $Folder = "Images/Profiles/";

    if (is_dir($Folder)){
        if ($check = opendir($Folder)){
            while (($filecheck = readdir($check)) !== false){
                $verifier = stripos($filecheck, $_SESSION['uid']."-");
                if ($verifier === 0){
                    $verifiedname = $Folder . $filecheck;
                }
            }
        }
    }
    if(!isset($verifiedname)){
        $verifiedname = $Folder."Default.jpg";
    }
    echo"
    <form action=$location id=\"pfpcont\" enctype= multipart/form-data style=\"display:none;Position:fixed;z-index: 1000;bottom: 50%;right: 50%;transform:translate(50%,50%);background:none;margin:0;\" role='form' method=\"post\">
    <div style=\"box-shadow:0 0 10px black;overflow:hidden;height:150px;width:150px;border-radius:50%;background-image: url('$verifiedname');Background-position:center;background-size:cover;margin:auto;\">
        <label for=\"image\"></label>
        <input type=\"file\" accept=\"image/jpg,image/jpeg,image/png\" title='Click me to change your profile picture' name='image' style=\"z-index:1000;height:100%;width:100%;opacity:0;\">
    </div>
    <br>
    <button name=\"uploadimg\" type='submit'>Upload image</button>
    </form>";
    echo"<div style=\"Position:fixed;z-index: 1000;padding:1%;bottom:0;display:inline;vertical-align:top;left:0;height;100px\">
        
    <div style=\"height:90px;width:90px;border-radius:50px;float:left;background-image: url('$verifiedname');Background-position:center;background-size:cover;margin-right:10px;\"></div>
    <p style=\"font-size: 50px;float:left;margin:0;\">Welcome, ".$Return['Name']."</p>

</div>
<div style=\"Position:fixed;z-index: 1000;bottom:0;right:0;height:100px;padding:1%;\">
    <button id=\"showpfp\" style=\"top:-50%;transform:translateY(50%);\" onclick=\"displayPFP()\">Update Picture?</button>
</div>";

        if (isset($_POST['uploadimg'])){
            if(isset($_FILES['image'])){
                if($_FILES['image']['name']!=''){
                    $pic = $_FILES["image"];
                    $name = $_SESSION['uid'].'-';
                    
                    if (is_dir($Folder)){
                        if ($check = opendir($Folder)){
                            while (($filecheck = readdir($check)) !== false){
                                $verifier = stripos($filecheck, $name);
                                if ($verifier === 0){
                                    $verifiedname = $Folder . $filecheck;
                                    if(!unlink($verifiedname)){
                                        echo "<script>window.alert('Something went wrong')</script>";
                                    }
                                }
                            }
                        }
                    }
                    move_uploaded_file($pic["tmp_name"], "Images/Profiles/".$name.time().'.'.pathinfo($pic['name'], PATHINFO_EXTENSION));
                }
            }
        }
    echo'   
            <script>
                var x = 2;
                function displayPFP(){
                    
                    if(x % 2 === 0){
                        document.getElementById("pfpcont").style.display = "block";
                        document.getElementById("showpfp").innerHTML = "Hide Image Display";
                    }
                    else{
                        document.getElementById("pfpcont").style.display = "none";
                        document.getElementById("showpfp").innerHTML = "Update Picture";
                    }
                    x+=1;
                }
                window.history.replaceState(null,null,window.location.href);
            </script>';//shows and hides profile picture update option
    }
?>