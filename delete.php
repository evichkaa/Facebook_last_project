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
if (isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "delete.php") ) {

    $_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];

}

//if something was posted
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $Post = new Post();
    $Post->delete_post($_POST['postid']);
    header("Location:" . $_SESSION['return_to']);
    die;
}

$post = new Post();
$error="";

if(isset($_GET['id'])) {

    $row = $post->get_one_post($_GET['id']);

    if(!$row){
        $error = "No such post found!";
    }else {
        if($row[0]['userid'] != $_SESSION['facebook_userid']){
            $error = "Access denied - you can`t delete this post!";
        }
    }
}else {
    $error = "No such post found!";
}

//if something was posted
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $post->delete_post($_POST['postid']);
    header("Location: " . $_SESSION['return_to']);
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="facebook.css">
    <title> Delete | Evabook </title>
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
                <h2>Delete Post</h2>
                <form method="post">
                <?php

                    if($error!= ""){
                        echo $error;
                    }else {

                        echo"Are you sure you want to delete this post?";

                        $user = new User();
                        $row_user=$user->get_user($row[0]['userid']);
                        $row_post=$row[0]['postid'];
                        echo "<input type='hidden' name='postid' value='$row_post'>";
                        echo "<input id='button-post' type='submit' value='Delete'>";
                    }



                    ?>


                    <br>
                </form>

            </div>


                </div>


                </div>




            </div>


        </div>


</body>
</html>