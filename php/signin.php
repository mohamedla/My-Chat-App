<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        include_once "config.php";
        $email  = mysqli_real_escape_string($connection, $_POST['email']);
        $password  = mysqli_real_escape_string($connection, $_POST['pass']);
        if(!empty($email)&&!empty($password)){
            $password = base64_encode($password);
            $sql = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$email}'AND password = '{$password}'");
            if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
                $_SESSION['unique_id'] = $row['unique_id'];
                $sql = mysqli_query( $connection,"UPDATE users SET stutus= 'Active Now' WHERE unique_id= {$row['unique_id']}");
                echo "seccess";
            }else{
                echo 'Email and password is incorrect!';
            }
        }else{
            echo 'All Fields Must Be Filled';
        }
    }else{
        header("location: ../chat.php");
    }
?>