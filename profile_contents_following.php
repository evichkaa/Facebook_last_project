<div style=" min-height: 400px; width:100%;  background-color:white; text-align: center ;">
    <div style="padding: 20px;">

<?php

//$DB= new Database();
//$sql="select image, postid  from posts where is_image = 1 && userid = $user_data[userid] order by id desc limit 30";
//$images = $DB->read($sql);

$image_class= new Image();
$post_class= new Post();
$user_class= new User();

$following= $user_class->get_following($user_data['userid'], "user");

if(is_array($following)){
    foreach ($followingas as  $follower) {
        $friend_row=$user_class->get_user($follower['userid']);
        include ("user.php");

    }
}else{
    echo "This user isn`t following anyone! ";
}

?>
    </div>
</div>