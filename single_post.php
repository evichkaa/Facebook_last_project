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
if($_SERVER['REQUEST_METHOD'] == "POST"){



    $post=new Post();
    $id=$_SESSION['facebook_userid'];
    $result=$post->create_post($id, $_POST,$_FILES);




//    print_r($_POST);
    if($result == ""){
        header("Location: single_post.php?id=$_GET[$id] ");
        die;
    }else{
        echo "<div id='errors' style='text-align: center; font-size: 20px; color: white; background-color: grey; '>";
        echo "The following errors occurred<br>";
        echo $result;
        echo "</div>";
    }
}
        $post= new Post();
        $row=false;

        $error="";


        if(isset($_GET['id'])) {

            $row = $post->get_one_post($_GET['id']);

            } else {
                    $error = "No post was found!";

        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="facebook.css">
    <title> Single post | Facebook </title>
</head>

<body style=" font-family: Tahoma,serif; background-color: #d0d8e4">
<?php include ("header.php");?>


<div id="cover-photo" >
    <div style="width: 800px; margin: auto; min-height: 400px;">

        <div style=" min-height: 400px; padding: 20px 0 20px 20px;">

            <div style="border: solid thin #aaa; padding: 10px; background-color:white; ">
                <h2>Single Post</h2>

            </div>
            <?php
                $user= new User();
                $image_class= new Image();
                if(is_array($row)){


                    $row_user = $user->get_user($row[0]['userid']);
                include("post.php");

                }
            ?>
            <div style="border: solid thin #aaa; padding: 10px; background-color:white; ">

                <form method="post" enctype="multipart/form-data">
                    <label for="post-box"></label><input name="post" id="post-box" placeholder="Post a comment">
                    <input type="file" name="parent" value="<?php echo $row[0]['postid'] ?>">
                    <input id="button-post" type="submit" value="Post">
                </form>
            </div>
            <?php
            $comments = $post->get_comments($row[0]['postid']);
            if(is_array($comments)){
                foreach ($comments as $comment){
                    include ("comment.php");
                }
            }
            ?>
        </div>
    </div>
</div>


</body>
</html>