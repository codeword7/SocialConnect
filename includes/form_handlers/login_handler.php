<?php
if(isset($_POST['login_button'])){
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);//sanitize email.
    
    $_SESSEION['log_email'] = $email;//session of current email.
    $password = md5($_POST['log_password']);//takes the password and decrypts it.
    
    $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $check_login_query = mysqli_num_rows($check_database_query);
    
    if($check_login_query == 1){
        $row = mysqli_fetch_array($check_database_query);
        $username = $row['username'];
        
        $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
        if(mysqli_num_rows($user_closed_query) == 1){
            $reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
        }
        
        $_SESSION['username'] = $username;
        header("location:index.php");
        exit();
    }else{
        array_push($error_array, "Email or Password incorrect<br>");
    }
}
?>