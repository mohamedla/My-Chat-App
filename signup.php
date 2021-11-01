<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        header("location: user.php");
    }
?>
<?php
    include_once "header.php";
?>
    <body>
        <div class="wrapper">
            <section class="form signup">
                <header>Register</header>
                <form action="#" enctype="multipart/form-data">
                    <div class="error-txt">This is an error message</div>
                    <div class="name-details">
                        <div class="field input">
                            <label>First Name</label>
                            <input type="text" name="fname" placeholder="First Name" required>
                        </div>
                        <div class="field input">
                            <label>Last Name</label>
                            <input type="text" name="lname" placeholder="Last Name" required>
                        </div>
                    </div>
                        <div class="field input">
                            <label>Email Address</label>
                            <input type="text" name="email" placeholder="Enter Your Email" required>
                        </div>
                        <div class="field input">
                            <label>Pasword</label>
                            <input type="password" name="pass" placeholder="Enter Your Password" required>
                            <i class="fa fa-eye"></i>
                        </div>
                        <div class="field image">
                            <label>Select Image</label>
                            <input type="file" class="input-file" accept="image/jpg,image/png,image/jpeg" name="image" required>
                        </div>
                        <div class="field button">
                            <input type="submit" value="Register">
                        </div>
                </form>
                <div class="link">Already Signup? <a href="signin.php">Login Now</a> </div>
            </section>
        </div>
        <script type="text/javascript" src="js/show-hide-pass.js"></script>
        <script type="text/javascript" src="js/signup.js"></script>
    </body>
</html>
