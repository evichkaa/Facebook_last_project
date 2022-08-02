<?php

if (!isset($_SESSION)) {
    session_start();
}

//session_start();

include ("classes/connect.php");
include ("classes/Login.php");
include ("classes/user.php");
include ("classes/post.php");
include ("classes/image.php");
include ("classes/profile.php");
include ("classes/settings.php");