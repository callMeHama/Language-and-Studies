<?php
    if(isset($_SESSION["aid"]) ===true || isset($_SESSION["uid"]) ===true){//if a login is existent
        echo "<a href=\"Functionals/Logout.php\"><div style=\"
        background: linear-gradient(to left, #372d4c, #7c435e);
        position: fixed;
        width: 197px;
        top: 100px;
        float: right;
        border-radius: 15px;
        text-align: center;
        left: -17px;
        \"><h3 style=\"padding:6%\">Log Out?</h3>
        </div></a>"; //display logout option
    }
    