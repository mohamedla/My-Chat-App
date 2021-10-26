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
            <section class="form login">
                <header>Sign In</header>
                <form action="#">
                    <div class="error-txt"></div>
                        <div class="field input">
                            <label>Email Address</label>
                            <input type="text" name="email" placeholder="Enter Your Email">
                        </div>
                        <div class="field input">
                            <label>Pasword</label>
                            <input type="password" name="pass" placeholder="Enter Your Password">
                            <i class="fa fa-eye"></i>
                        </div>
                        <div class="field button">
                            <input type="submit" value="Login">
                        </div>
                </form>
                <div class="link">Not Register Yet? <a href="signup.php">Register Now</a> </div>
            </section>
        </div>
        <script type="text/javascript" src="js/show-hide-pass.js"></script>
        <script type="text/javascript" src="js/signin.js"></script>
    </body>
</html>