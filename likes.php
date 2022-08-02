<?php

include ("classes/auto.php");


$login = new Login();
$user_data=$login->check_login($_SESSION['facebook_userid']);
$USER= $user_data;

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['id']);

    if (is_array($profile_data)) {
        $user_data = $profile_data[0];
    }
}

        $post= new Post();
        $likes=false;
        $error="";


        if(isset($_GET['id'])&& isset($_GET['type'])) {

            $likes = $post->get_likes($_GET['id'], $_GET['type']);
            } else {
                    $error = "No information was found!";

        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="facebook.css">
    <title> People who like | Evabook </title>
</head>

<body style=" font-family: Tahoma,serif; background-color: #d0d8e4">
<?php include ("header.php");?>

<!--cover-->
<div id="cover-photo" >
    <div style="width: 800px; margin: auto; min-height: 400px;">


    <div style="display: flex;">

        <!--Delete-timeline-->
        <div style=" min-height: 400px; flex: 2.5; padding: 20px 0 20px 20px;">

            <div style="border: solid thin #aaa; padding: 10px; background-color:white; ">
                <h2>How many people like this post?</h2>

            </div>
            <?php
                $user= new User();
                $image_class= new Image();
                if(is_array($likes)){
                    foreach ($likes as $row){
                        $friend_row = $user->get_user($row['userid']);

                       include("user.php");
                    }
                }
            ?>
            <br style="clear: both;">

                </div>


                </div>




            </div>


        </div>


</body>
</html>