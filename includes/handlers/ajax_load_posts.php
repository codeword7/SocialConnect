<?php

include("../../config/config.php");
include("../classes/User.php");
include("../classes/Post.php");
include("../classes/Message.php");

$limit = 10;  //Number of posts to be loaded in the scroll.

$posts = new Post($con, $_REQUEST['userLoggedIn']);
$posts->loadPostsFriends($_REQUEST, $limit);
?>