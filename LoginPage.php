<?php

session_start();

include ("classes/connect.php");
include ("classes/Login.php");


$email = "";
$password = "";

if($_SERVER ['REQUEST_METHOD'] == 'POST'){

    $login= new Login();
    $result = $login->evaluate($_POST);

    if($result != "") {

        echo "<div id='errors' style='text-align: center; font-size: 20px; color: white; background-color: grey; '>";
        echo "The following errors occured<br>";
        echo $result;
        echo "</div>";
    }else {

        header("Location: profile.php");
        die;

    }


//    echo "<pre>";
//    print_r($_SERVER);
//    echo "</pre>";

        $email = $_POST['email'];
        $password = $_POST['password'];
}






?>
<html >
<head>
    <meta charset="utf-8">
     <title>Facebook Log in</title>
    <link rel="stylesheet" type="text/css" href="facebook.css">
</head>

<body style="font-family: Tahoma; background-color: #e9ebee;">
<div id="bar">
    <div style="font-size: 45px;"> EvaBook </div>
    <a href="Signup.php">
        <div id="signup_button"> Sign up </div></a>
    </div>
<div id="signup-box">
    <form method="post">Log in to EvaBook<br><br>
    <input name = "email" value= "<?php echo $email?>" type="text" id="text" placeholder="Email"><br><br>
    <input name = "password" value= "<?php echo $password?>" type="password" id="text" placeholder="Password"><br><br>
    <input type="submit" id="button" value="Log in"><br><br>
    </form>
</div>
</body>
</html>