<?php

class Post{
    private $user_obj;
    private $con;
    
    public function __construct($con, $user){
        $this->con = $con;
        $this->user_obj = new User($con, $user);
    }
    
    public function submitPost($body, $user_to){
        $body = strip_tags($body);  //remove all html tags.
        $body = mysqli_real_escape_string($this->con, $body);
        $check_empty = preg_replace('/\s+/', '', $body);  //deletes all spaces.
        
        
        if($check_empty != ""){
            
            
            $body_array = preg_split('/\s+/', $body);
            
            foreach($body_array as $key => $value){
                
                if(strpos($value, "www.youtube.com/watch?v=") !== false){
                    
                    $link = preg_split("!&!", $value);
                    $value = preg_replace("!watch\?v=!", "embed/", $link[0]);
                    $value = "<br><iframe width=\'420\' height=\'315\' src=\'" . $value . "\'></iframe><br>";
                    $body_array[$key] = $value;
                }
            }
            
            $body = implode(" ", $body_array);
            
            //current time and date.
            $date_added = date("Y-m-d H:i:s");
            
            //get username.
            $added_by = $this->user_obj->getUsername();
            
            //if user is in his own profile then user_to=''.
            if($user_to == $added_by){
                $user_to = "none";
            }
            
            $query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0')");
            
            $return_id = mysqli_insert_id($this->con);
            
            //Insert notification.
            if($user_to != 'none'){
                $notification = new Notification($this->con, $added_by);
                $notification->insertNotification($return_id, $user_to, 'profile_post');
            }
            
            //Update post count for user.
            
            $num_post = $this->user_obj->getNumPosts();
            $num_post++;
            
            $update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_post' WHERE username='$added_by'");
        }
    }
    
    public function loadPostsFriends($data, $limit){
        
        $page = $data['page'];
        $userLoggedIn = $this->user_obj->getUsername();
        
        if($page == 1)
            $start = 0;
        else
            $start = ($page - 1) * $limit;
        
        
        $str = "";  //return string.
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");
        
        if(mysqli_num_rows($data_query) > 0){
        
                while($row = mysqli_fetch_array($data_query)){
                    $num_iterations = 0;
                    $count = 1;
                    
                    $id = $row['id'];
                    $body = $row['body'];
                    $added_by = $row['added_by'];
                    $date_time = $row['date_added'];

                    //check if posted by SELF or by OTHERS.
                    if($row['user_to'] == "none"){
                        $user_to = "";
                    }else{
                        $user_to_obj = new User($this->con, $row['user_to']);
                        $user_to_name = $user_to_obj->getFirstAndLastName();
                        $user_to = "&nbsp;to&nbsp; <a href='" . $row['user_to'] . "'> " . $user_to_name . " </a>";
                    }

                    //check if the user has activated account.
                    $added_by_obj = new User($this->con, $added_by);
                    if($added_by_obj->isClosed()){
                        continue;
                    }
                    
                    $user_logged_obj = new User($this->con, $userLoggedIn);
                        if($user_logged_obj->isFriend($added_by)){
                    
                            if($num_iterations++ < $start){
                                continue;
                            }

                            if($count > $limit){
                                break;
                            }else{
                                $count++;
                            }
                            
                            if($userLoggedIn == $added_by)
                                $delete_button = "<button class='delete_button btn-danger' id='post$id'>x</button>";
                            else
                                $delete_button = "";

                            $user_detail_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");

                            $user_row = mysqli_fetch_array($user_detail_query);
                            $first_name = $user_row['first_name'];
                            $last_name = $user_row['last_name'];
                            $profile_pic = $user_row['profile_pic'];

                            
                            ?>
                            <script>
                                    function toggle<?php echo $id; ?>(){
                                        var target = $(event.target);
                                        if(!target.is("a")){
                                            
                                        var element = document.getElementById("toggleComment<?php echo $id; ?>");
                                        if(element.style.display == "block"){
                                            element.style.display = "none";
                                        }else{
                                            element.style.display = "block";
                                        }   
                                    }
                                }    
                            </script>
                            <?php
                            
                            $comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                            $comments_check_num = mysqli_num_rows($comments_check);
                            
                            //Time frame.
                            $date_time_now = date("Y-m-d H:i:s");  
                            $start_date = new DateTime($date_time);  //Time of post.
                            $end_date = new DateTime($date_time_now); //Current time.
                            $interval = $start_date->diff($end_date); //difference b/w both times.
                                if($interval->y >= 1){
                                    if($interval == 1)
                                        $time_message = $interval->y . " year ago";  //1 year ago.
                                    else
                                        $time_message = $interval->y . " years ago";  //1+ year ago.
                                }elseif($interval->m >= 1){
                                    if($interval->d == 0){
                                        $days = " ago";
                                    }elseif($interval->d == 1){
                                        $days = $interval->d . " day ago";
                                    }else{
                                        $days = $interval->d . " days ago";
                                    }


                                    if($interval->m == 1){
                                        $time_message = $interval->m . " month" . $days;
                                    }else{
                                        $time_message = $interval->m . " months" . $days;
                                    }
                                }elseif($interval->d >= 1){
                                    if($interval->d == 1){
                                        $time_message = "Yesterday";
                                    }else{
                                        $time_message = $interval->d . " days ago";
                                    }
                                }elseif($interval->h >= 1){
                                    if($interval->h == 1){
                                        $time_message = $interval->h . " hour ago";
                                    }else{
                                        $time_message = $interval->h . " hours ago";
                                    }
                                }elseif($interval->i >= 1){
                                    if($interval->i == 1){
                                        $time_message = $interval->i . " minute ago";
                                    }else{
                                        $time_message = $interval->i . " minutes ago";
                                    }
                                }else{
                                    if($interval->s < 30){
                                        $time_message = " Just now";
                                    }else{
                                        $time_message = $interval->s . " seconds ago";
                                    }
                                }

                            $str .= "<div class='status_post' onClick='javascript:toggle$id()'>
                                        <div class='post_profile_pic'>
                                            <img src='$profile_pic' width='50'>
                                        </div>

                                        <div class='posted_by' style='color:#ADADAD;'>
                                            <a href='$added_by'>$first_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time_message 
                                            $delete_button
                                        </div>
                                        <div id='post_body'>
                                            $body
                                            <br>
                                            <br>
                                            <br>
                                        </div>
                                        <div class='newsfeedPostOptions'>
                                            comments($comments_check_num)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <iframe src='like.php?post_id=$id' scrolling='no'></iframe>
                                        </div>
                                     </div>
                                     <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                        <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                                     </div>
                                     <hr>";
                        }
                    ?>
                <script>

					$(document).ready(function() {

						$('#post<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to delete this post?", function(result) {

								$.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {result:result});

								if(result)
									location.reload();

							});
						});


					});

				</script>
                    <?php
                }
            
                        if($count > $limit){
                            $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                                     <input type='hidden' class='noMorePosts' value='false'>";
                        }else{
                            $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: center;'>
                                    No more posts to show.</p>";
                        }
            
        }
        
        echo $str;
    }
    
    public function loadProfilePosts($data, $limit){
        
        $page = $data['page'];
        $profileUser = $data['profileUsername'];
        $userLoggedIn = $this->user_obj->getUsername();
        
        if($page == 1)
            $start = 0;
        else
            $start = ($page - 1) * $limit;
        
        
        $str = "";  //return string.
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' AND ((added_by='$profileUser' AND user_to='none') OR user_to='$profileUser') ORDER BY id DESC");
        
        if(mysqli_num_rows($data_query) > 0){
        
                while($row = mysqli_fetch_array($data_query)){
                    $num_iterations = 0;
                    $count = 1;
                    
                    $id = $row['id'];
                    $body = $row['body'];
                    $added_by = $row['added_by'];
                    $date_time = $row['date_added'];

                    
                            if($num_iterations++ < $start){
                                continue;
                            }

                            if($count > $limit){
                                break;
                            }else{
                                $count++;
                            }
                            
                            if($userLoggedIn == $added_by)
                                $delete_button = "<button class='delete_button btn-danger' id='post$id'>x</button>";
                            else
                                $delete_button = "";

                            $user_detail_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");

                            $user_row = mysqli_fetch_array($user_detail_query);
                            $first_name = $user_row['first_name'];
                            $last_name = $user_row['last_name'];
                            $profile_pic = $user_row['profile_pic'];

                            
                            ?>
                            <script>
                                    function toggle<?php echo $id; ?>(){
                                        var target = $(event.target);
                                        if(!target.is("a")){
                                            
                                        var element = document.getElementById("toggleComment<?php echo $id; ?>");
                                        if(element.style.display == "block"){
                                            element.style.display = "none";
                                        }else{
                                            element.style.display = "block";
                                        }   
                                    }
                                }    
                            </script>
                            <?php
                            
                            $comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                            $comments_check_num = mysqli_num_rows($comments_check);
                            
                            //Time frame.
                            $date_time_now = date("Y-m-d H:i:s");  
                            $start_date = new DateTime($date_time);  //Time of post.
                            $end_date = new DateTime($date_time_now); //Current time.
                            $interval = $start_date->diff($end_date); //difference b/w both times.
                                if($interval->y >= 1){
                                    if($interval == 1)
                                        $time_message = $interval->y . " year ago";  //1 year ago.
                                    else
                                        $time_message = $interval->y . " years ago";  //1+ year ago.
                                }elseif($interval->m >= 1){
                                    if($interval->d == 0){
                                        $days = " ago";
                                    }elseif($interval->d == 1){
                                        $days = $interval->d . " day ago";
                                    }else{
                                        $days = $interval->d . " days ago";
                                    }


                                    if($interval->m == 1){
                                        $time_message = $interval->m . " month" . $days;
                                    }else{
                                        $time_message = $interval->m . " months" . $days;
                                    }
                                }elseif($interval->d >= 1){
                                    if($interval->d == 1){
                                        $time_message = "Yesterday";
                                    }else{
                                        $time_message = $interval->d . " days ago";
                                    }
                                }elseif($interval->h >= 1){
                                    if($interval->h == 1){
                                        $time_message = $interval->h . " hour ago";
                                    }else{
                                        $time_message = $interval->h . " hours ago";
                                    }
                                }elseif($interval->i >= 1){
                                    if($interval->i == 1){
                                        $time_message = $interval->i . " minute ago";
                                    }else{
                                        $time_message = $interval->i . " minutes ago";
                                    }
                                }else{
                                    if($interval->s < 30){
                                        $time_message = " Just now";
                                    }else{
                                        $time_message = $interval->s . " seconds ago";
                                    }
                                }

                            $str .= "<div class='status_post' onClick='javascript:toggle$id()'>
                                        <div class='post_profile_pic'>
                                            <img src='$profile_pic' width='50'>
                                        </div>

                                        <div class='posted_by' style='color:#ADADAD;'>
                                            <a href='$added_by'>$first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time_message 
                                            $delete_button
                                        </div>
                                        <div id='post_body'>
                                            $body
                                            <br>
                                            <br>
                                            <br>
                                        </div>
                                        <div class='newsfeedPostOptions'>
                                            comments($comments_check_num)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <iframe src='like.php?post_id=$id' scrolling='no'></iframe>
                                        </div>
                                     </div>
                                     <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                        <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                                     </div>
                                     <hr>";
                    ?>
                <script>

					$(document).ready(function() {

						$('#post<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to delete this post?", function(result) {

								$.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {result:result});

								if(result)
									location.reload();

							});
						});


					});

				</script>
                    <?php
                }
            
                        if($count > $limit){
                            $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                                     <input type='hidden' class='noMorePosts' value='false'>";
                        }else{
                            $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: center;'>
                                    No more posts to show.</p>";
                        }
            
        }
        
        echo $str;
    }
    
    public function getSinglePost($post_id){
        
        $userLoggedIn = $this->user_obj->getUsername();
        
        
        $str = "";  //return string.
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' AND id='$post_id'");
        
        $opened_query = mysqli_query($this->con, "UPDATE notifications SET opened='yes' WHERE user_to='$userLoggedIn' AND link LIKE '%=$post_id'");
        
        if(mysqli_num_rows($data_query) > 0){
        
                $row = mysqli_fetch_array($data_query);
                    
                    $id = $row['id'];
                    $body = $row['body'];
                    $added_by = $row['added_by'];
                    $date_time = $row['date_added'];

                    //check if posted by SELF or by OTHERS.
                    if($row['user_to'] == "none"){
                        $user_to = "";
                    }else{
                        $user_to_obj = new User($this->con, $row['user_to']);
                        $user_to_name = $user_to_obj->getFirstAndLastName();
                        $user_to = "&nbsp;to&nbsp; <a href='" . $row['user_to'] . "'> " . $user_to_name . " </a>";
                    }

                    //check if the user has activated account.
                    $added_by_obj = new User($this->con, $added_by);
                    if($added_by_obj->isClosed()){
                        return;
                    }
                    
                    $user_logged_obj = new User($this->con, $userLoggedIn);
                        if($user_logged_obj->isFriend($added_by)){

                            if($userLoggedIn == $added_by)
                                $delete_button = "<button class='delete_button btn-danger' id='post$id'>x</button>";
                            else
                                $delete_button = "";

                            $user_detail_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");

                            $user_row = mysqli_fetch_array($user_detail_query);
                            $first_name = $user_row['first_name'];
                            $last_name = $user_row['last_name'];
                            $profile_pic = $user_row['profile_pic'];

                            
                            ?>
                            <script>
                                    function toggle<?php echo $id; ?>(){
                                        var target = $(event.target);
                                        if(!target.is("a")){
                                            
                                        var element = document.getElementById("toggleComment<?php echo $id; ?>");
                                        if(element.style.display == "block"){
                                            element.style.display = "none";
                                        }else{
                                            element.style.display = "block";
                                        }   
                                    }
                                }    
                            </script>
                            <?php
                            
                            $comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                            $comments_check_num = mysqli_num_rows($comments_check);
                            
                            //Time frame.
                            $date_time_now = date("Y-m-d H:i:s");  
                            $start_date = new DateTime($date_time);  //Time of post.
                            $end_date = new DateTime($date_time_now); //Current time.
                            $interval = $start_date->diff($end_date); //difference b/w both times.
                                if($interval->y >= 1){
                                    if($interval == 1)
                                        $time_message = $interval->y . " year ago";  //1 year ago.
                                    else
                                        $time_message = $interval->y . " years ago";  //1+ year ago.
                                }elseif($interval->m >= 1){
                                    if($interval->d == 0){
                                        $days = " ago";
                                    }elseif($interval->d == 1){
                                        $days = $interval->d . " day ago";
                                    }else{
                                        $days = $interval->d . " days ago";
                                    }


                                    if($interval->m == 1){
                                        $time_message = $interval->m . " month" . $days;
                                    }else{
                                        $time_message = $interval->m . " months" . $days;
                                    }
                                }elseif($interval->d >= 1){
                                    if($interval->d == 1){
                                        $time_message = "Yesterday";
                                    }else{
                                        $time_message = $interval->d . " days ago";
                                    }
                                }elseif($interval->h >= 1){
                                    if($interval->h == 1){
                                        $time_message = $interval->h . " hour ago";
                                    }else{
                                        $time_message = $interval->h . " hours ago";
                                    }
                                }elseif($interval->i >= 1){
                                    if($interval->i == 1){
                                        $time_message = $interval->i . " minute ago";
                                    }else{
                                        $time_message = $interval->i . " minutes ago";
                                    }
                                }else{
                                    if($interval->s < 30){
                                        $time_message = " Just now";
                                    }else{
                                        $time_message = $interval->s . " seconds ago";
                                    }
                                }

                            $str .= "<div class='status_post' onClick='javascript:toggle$id()'>
                                        <div class='post_profile_pic'>
                                            <img src='$profile_pic' width='50'>
                                        </div>

                                        <div class='posted_by' style='color:#ADADAD;'>
                                            <a href='$added_by'>$first_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time_message 
                                            $delete_button
                                        </div>
                                        <div id='post_body'>
                                            $body
                                            <br>
                                            <br>
                                            <br>
                                        </div>
                                        <div class='newsfeedPostOptions'>
                                            comments($comments_check_num)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <iframe src='like.php?post_id=$id' scrolling='no'></iframe>
                                        </div>
                                     </div>
                                     <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                        <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                                     </div>
                                     <hr>";

                    ?>
                <script>

					$(document).ready(function() {

						$('#post<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to delete this post?", function(result) {

								$.post("includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>", {result:result});

								if(result)
									location.reload();

							});
						});


					});

				</script>
                    <?php
                        }else{
                            echo"<p>You are not the friend of the user.</p>";
                            return;
                        }
            
        }else{
            echo"<p>No such post found.</p>";
            return;
        }
        
        echo $str;
    }
}
?>