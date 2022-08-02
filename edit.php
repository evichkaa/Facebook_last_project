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
        $post = new Post();
        $error="";

        if(isset($_GET['id'])) {

            $row = $post->get_one_post($_GET['id']);

            if (!$row) {
                $error = "No such post found!";
            } else {
                if ($row[0]['userid'] != $_SESSION['facebook_userid']) {
                    $error = "Access denied - you can`t edit this post!";
                }
            }
        }else {
            $error = "No such post found!";

        }



        if (isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "edit.php") ) {

            $_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];

        }
        //if something was posted
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $Post = new Post();
            $data = array(
                "postid" => $row[0]['postid'],
                "post" => $_POST['post'],
            );
            $Post->edit_post($_SESSION['facebook_userid'], $data, $_POST['image_file']);
             header("Location:" . $_SESSION['return_to']);
                        die;
                    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="facebook.css">
    <title> Edit | Evabook </title>
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

                <form method="post">
                <?php
                    if($error!= ""){
                        echo $error;
                    }else {
                        $row_post=$row[0]['post'];
                        $row_postid=$row[0]['postid'];
                        echo "Edit Post <br><br>";
                        echo '<label for="post-box"></label>
                        <input name="post" id="post-box" name="post" value='.$row_post.'>';
                        echo '<input type="file" id="image_file" name="image_file" accept="image/jpeg">';
                        echo "<input id='button-post' type='submit' value='Save'>";

                        if(file_exists($row[0]['image'])){
                            $image_class = new Image();
                            $post_image = $image_class->get_thumb_post($row[0]['image']);


                            echo "<br><div style='text-align: center;'><img src='$post_image' style='width: 50%'/></div>";
                        }
                    }
                    ?>
                </form>

            </div>


                </div>


                </div>




            </div>


        </div>


</body>
</html>