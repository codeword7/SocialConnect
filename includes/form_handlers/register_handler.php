<?php
//declaring variables.
$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = array();

if(isset($_POST['register_button'])){
    
    //Registration form details.
    
    //first name
    $fname = strip_tags($_POST['reg_fname']);//remove HTML tags.
    $fname = str_replace(' ', '', $fname);//remove in between spaces.
    $fname = ucfirst(strtolower($fname));//convert all to lower case exp the first one.
    $_SESSION['reg_fname'] = $fname;
    
    
    //last name
    $lname = strip_tags($_POST['reg_lname']);//remove HTML tags.
    $lname = str_replace(' ', '', $lname);//remove in between spaces.
    $lname = ucfirst(strtolower($lname));//convert all to lower case exp the first one.
    $_SESSION['reg_lname'] = $lname;
    
    
    //email
    $em = strip_tags($_POST['reg_email']);//remove HTML tags.
    $em = str_replace(' ', '', $em);//remove in between spaces.
    $em = ucfirst(strtolower($em));//convert all to lower case exp the first one.
    $_SESSION['reg_email'] = $em;
    
    
     //confirm email
    $em2 = strip_tags($_POST['reg_email2']);//remove HTML tags.
    $em2 = str_replace(' ', '', $em2);//remove in between spaces.
    $em2 = ucfirst(strtolower($em2));//convert all to lower case exp the first one.
    $_SESSION['reg_email2'] = $em2;
    
    //password
    $password = strip_tags($_POST['reg_password']);
    $password2 = strip_tags($_POST['reg_password2']);
    
    $date = date("Y-m-d");//date function to take date.
    
    if($em == $em2){
        //checking a valid e-mail.
        if(filter_var($em, FILTER_VALIDATE_EMAIL)){
            
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);
            //check if email exixts already.
            
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");
            
            //counting the query.
            
            $num_rows = mysqli_num_rows($e_check);
            if($num_rows > 0){
                array_push($error_array, "Email already taken<br>");
            }
        }else{
            array_push($error_array, "Invalid email format<br>");
        }
    }else{
            array_push($error_array, "Email's do not match<br>");
    }
    
    if(strlen($fname) > 25 || strlen($fname) < 2){
       array_push($error_array, "First name to be between 2 to 25 characters<br>");
    }
    
        if(strlen($lname) > 25 || strlen($lname) < 2){
       array_push($error_array, "Last name to be between 2 to 25 characters<br>");
    }
    
    if($password != $password2){
        array_push($error_array, "Passwords do not match<br>");
    }else{
        if(preg_match('/[^A-Za-z0-9]/', $password)){
            array_push($error_array, "Your password should only contain english characters and numbers<br>");
        }
    }
    
    if(strlen($password) > 30 || strlen($password) < 5){
        array_push($error_array, "Password length should be 5 to 30<br>");
    }
    if(empty($error_array)){
        $password = md5($password);//encrypting password
        
        //creating unique username.
        $username = strtolower($fname ."_". $lname);
        $check_user_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        
        $i = 0;
        while(mysqli_num_rows($check_user_query) != 0){
            $i++;
            $username = $username . "_" . $i;
            $check_user_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");    
        }
        
                $rand = rand(1, 2);
            if($rand == 1){
        $profile_pic = "assets/images/profile_pics/defaults/user.jpg";
            }elseif($rand == 2){
        $profile_pic = "assets/images/profile_pics/defaults/user2.jpg";        
            }
            
        $query = mysqli_query($con, "INSERT INTO users VALUES('','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no','.')");
        
        array_push($error_array, "<span style='color:#14C800;'>You're all set! Go ahead and login!</span>");
        
        //clearing SESSIONS variables.
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
    }
}
?>