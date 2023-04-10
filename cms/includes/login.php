<?php 
    include "db.php";
    include "function.php";
    
    // Send a variable across the pages
    session_start();
    
    if(isset($_POST['login_submit'])){
        // Prevent SQL Injection
        $username =  mysqli_real_escape_string ($connect, $_POST['username']);
        $password =  mysqli_real_escape_string ($connect, $_POST['password']);

        $sql = "SELECT * FROM ".USERS_TABLE." WHERE username = '{$username}';";
        
        $q = mysqli_query($connect, $sql);
        if($q){
            if(mysqli_num_rows($q) > 0){
                if($row = mysqli_fetch_assoc($q)){
                    if(password_verify($password, $row['user_randSalt'])){
                        
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['user_password'] = $row['user_password'];
                        $_SESSION['user_firstname'] = $row['user_firstname'];
                        $_SESSION['user_lastname'] = $row['user_lastname'];
                        $_SESSION['user_role'] = $row['user_role'];
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['user_email'] = $row['user_email'];
                        $_SESSION['user_image'] = $row['user_image'];
    
                        $msg = "Welcome back here";
                        header("Location: ../admin/index.php?confirm_msg={$msg}", true, 301);
                    }
                    else{
                        echo "Error";
                        $msg = "Wrong Password!";
                        header("Location: ../index.php?confirm_msg={$msg}", true, 301);
                    }
                }
            }
            else{
                $msg = "Wrong Username";
                header("Location: ../index.php?confirm_msg={$msg}", true, 301);
            }
        }
        
    }
?>
