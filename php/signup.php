<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        include_once "config.php";
        $fname  = mysqli_real_escape_string($connection, $_POST['fname']);
    $lname  = mysqli_real_escape_string($connection, $_POST['lname']);
    $email  = mysqli_real_escape_string($connection, $_POST['email']);
    $password  = mysqli_real_escape_string($connection, $_POST['pass']);
    if(!empty($fname)&&!empty($lname)&&!empty($email)&&!empty($password)){
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($connection , "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql)>0){
                echo $email . 'This emailalready exist!';
            }else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $temp_name = $_FILES['image']['tmp_name'];

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);
                    $extentions = ['png','jpg','jpeg'];
                    if(in_array($img_ext,$extentions) == true){
                        $time = time();
                        $new_image_name = $time . $img_name;
                        if(move_uploaded_file($temp_name,'images/'. $new_image_name)){
                            $status = 'Active Now';
                            $random_id = rand(time(), 10000000);
                            $password = base64_encode($password);
                            $sql2 = mysqli_query($connection ,"INSERT INTO users (unique_id, fname, lname, email, password, img, stutus)
                                    VALUES ({$random_id},'{$fname}','{$lname}','{$email}','{$password}','{$new_image_name}','{$status}')");
                            if($sql2){
                                $sql3 = mysqli_query($connection , "SELECT * FROM users WHERE email ='{$email}'");
                                if(mysqli_num_rows($sql3)>0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    echo "seccess";
                                }
                            }else{  
                                echo "Something Went Wronge: {$sql2}";
                            }
                        }
                    }else{
                        echo 'Please Select an image with type png,jpg or jpeg ';
                    }
                }else{
                    echo 'Please Select an image';
                }
            }
        }else{
            echo $email . ' This is not a valid email!';
        }
    }else{
        echo 'All Fields Must Be Filled';
    }
    }else{
        header("location: ../chat.php");
    }
?> 