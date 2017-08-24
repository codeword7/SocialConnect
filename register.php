<?php
require "config/config.php";
require "includes/form_handlers/register_handler.php";
require "includes/form_handlers/login_handler.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
  
  <?php
    if(isset($_POST['register_button'])){
        echo'
        
            <script>
                $(document).ready(function(){
                    $("#first").hide();                    
                    $("#second").show();                    
                });
            </script>
        
        ';
    }  
  ?>
   
   <div class="wrapper">
      <div class="login_box">
      
        <div class="login_header">
            <h1>SocialConnect</h1>
            Login or sign up below!
        </div>  
       
        <div id="first">
            
            <form action="register.php" method="post">
                <input type="email" name="log_email" placeholder="Email address" value="<?php 
                                                                                    if(isset($_SESSION['log_email'])){
                                                                                        echo $_SESSION['log_email'];
                                                                                    }
                                                                                    ?>" required><br>
                <input type="password" name="log_password" placeholder="Password"><br>
                <input type="submit" name="login_button" value="Login"><br>

                <?php if(in_array("Email or Password incorrect<br>", $error_array)) echo "Email or Password was incorrect<br>"; ?>
                <a href="#" id="signup" class="signup">Need an account? Register here!</a>
           </form><br>
                                    
        </div>


         <div id="second">
                 <form action="register.php" method="post">
                    <input type="text" name="reg_fname" placeholder="First name" value="<?php 
                                                                                        if(isset($_SESSION['reg_fname'])){
                                                                                            echo $_SESSION['reg_fname'];
                                                                                        }
                                                                                        ?>" required>
                    <br>
                    <?php if(in_array("First name to be between 2 to 25 characters<br>", $error_array)) echo"First name to be between 2 to 25 characters"; ?>


                    <input type="text" name="reg_lname" placeholder="Last name" value="<?php 
                                                                                        if(isset($_SESSION['reg_lname'])){
                                                                                            echo $_SESSION['reg_lname'];
                                                                                        }
                                                                                        ?>" required>
                    <br>
                    <?php if(in_array("Last name to be between 2 to 25 characters<br>", $error_array)) echo"Last name to be between 2 to 25 characters"; ?>
                    <input type="email" name="reg_email" placeholder="Email" value="<?php 
                                                                                        if(isset($_SESSION['reg_email'])){
                                                                                            echo $_SESSION['reg_email'];
                                                                                        }
                                                                                        ?>" required>
                    <br>
                    <input type="email" name="reg_email2" placeholder="Confirm email" value="<?php 
                                                                                        if(isset($_SESSION['reg_email2'])){
                                                                                            echo $_SESSION['reg_email2'];
                                                                                        }
                                                                                        ?>" required>
                    <br>
                    <?php if(in_array("Email already taken<br>", $error_array)) echo"Email already taken<br>"; ?>
                    <?php if(in_array("Invalid email format<br>", $error_array)) echo"Invalid email format<br>"; ?>
                    <?php if(in_array("Email's do not match<br>", $error_array)) echo"Email's do not match<br>"; ?>

                    <input type="password" name="reg_password" placeholder="Password" required>
                    <br>
                    <input type="password" name="reg_password2" placeholder="Confirm password" required>
                    <br>
                    <?php if(in_array("Passwords do not match<br>", $error_array)) echo"Passwords do not match<br>"; ?>
                    <?php if(in_array("Your password should only contain english characters and numbers<br>", $error_array)) echo"Your password should only contain english characters and numbers<br>"; ?>
                    <?php if(in_array("Password length should be 5 to 30<br>", $error_array)) echo"Password length should be 5 to 30<br>"; ?>
                    <?php if(in_array("<span style='color:#14C800;'>You're all set! Go ahead and login!</span>", $error_array)) echo"<span style='color:#14C800;'>You're all set! Go ahead and login!</span>"; ?><br>
                    <input type="submit" name="register_button" value="Register"><br>

                   
                    <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
            </form><br>
        </div>
    </div>    
        
    </div>    
</body>
</html>
