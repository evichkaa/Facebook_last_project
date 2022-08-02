<?php


include ("classes/auto.php");



//        $login = new Login();
//        $user_data=$login->check_login($_SESSION['facebook_userid']);



        if(isset($_GET['find'])){
            $find = addslashes($_GET['find']);
            $sql = "select * from users where first_name like '%$find%' || last_name like '%$find%' limit 30 ";
            $DB = new Database();
            $result = $DB->read($sql);
        }
//        else{
//
//        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="facebook.css">
    <title> People who like | Facebook </title>
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
                    <h2>Search Post</h2>

                </div>
                <?php
                $user= new User();
                $image_class= new Image();
                if(is_array($result)){
                    foreach ($result as $row){
                        $friend_row = $user->get_user($row['userid']);

                        include("user.php");
                    }
                }else{
                    echo "No results were found!";
                }
                ?>
                <br style="clear: both;">

            </div>


        </div>




    </div>


</div>


</body>
</html>