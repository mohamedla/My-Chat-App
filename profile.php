<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: signin.php");
    }
?>
<?php
    include_once "header.php";
    include_once "php/connected.php";
?>
    <body>
        <div class="wrapper">
            <section class="profile">
                <header>
                    <?php
                        include_once "php/config.php";
                        $sql = mysqli_query($connection, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                        if(mysqli_num_rows($sql)>0){
                            $row = mysqli_fetch_assoc($sql);
                        }
                    ?>
                    <div class="returnarrow">
                        <a href="user.php" class="back-icon">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </header>
                <div class="profileAtt">
                    <div class="form">
                        <form action="" enctype="multipart/form-data" method="post" autocomplete="off">
                        <div class="imgviewer"><center><img id="imgviewer" src="php/images/<?php echo $row['img']; ?>" alt=""></center></div>
                        <div class="name-details">
                            <div class="field image" id="imga">
                                <input id="imgfile" type="file" class="input-file" accept="image/jpg,image/png,image/jpeg" name="image" >
                                <!-- <label id="filelab">Select New Image</label> -->
                            </div>
                            <div class="button">
                                <button id="imgbutton"><i class="fas fa-pen"></i></button>
                            </div>
                        </div>
                        <div class="name-details">
                            <div class="field input rudius">
                                <label>First Name</label>
                                <input style="border-radius: 5px;" type="text" name="fname" value="<?php echo $row['fname']; ?>" >
                            </div>
                            <div class="field input">
                                <label>Last Name</label>
                                <input type="text" name="lname" value="<?php echo $row['lname']; ?>" >
                            </div>
                            <div class="button">
                                <button id="namebutton"><i class="fas fa-pen"></i></button>
                            </div>
                        </div>
                        <div class="name-details">
                            <div class="field input password" id="passw">
                                <label>Pasword</label>
                                <input type="password" name="pass" placeholder="Enter New Password" >
                                <i class="fa fa-eye"></i>
                            </div>
                            <div class="button">
                                <button id="passbutton"><i class="fas fa-pen"></i></button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <script type="text/javascript" src="js/show-hide-pass.js"></script>
        <script type="text/javascript" src="js/isconnect.js"></script>
        <script type="text/javascript" src="js/profile.js"></script>
    </body>
</html>