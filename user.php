<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: signin.php");
    }
?>
<?php
    include_once "header.php";
?>
    <body>
        <div class="wrapper">
            <section class="user">
                <header>
                    <?php
                        include_once "php/config.php";
                        $sql = mysqli_query($connection, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                        if(mysqli_num_rows($sql)>0){
                            $row = mysqli_fetch_assoc($sql);
                        }
                    ?>
                    <div class="content">
                        <img src="php/images/<?php echo $row['img']; ?>" alt="">
                        <div class="details">
                            <span><?php echo $row['fname'] . ' ' . $row['lname'] ?></span>
                            <p><?php echo $row['stutus'] ?></p>
                        </div>
                    </div>
                    <a href="php/logout.php" class="logout">Logout</a>
                </header>
                <div class="search">
                    <span class="text">Select user to chat with</span>
                    <input type="text" placeholder="Enter name to search ...">
                    <button><i class="fa fa-search"></i></button>
                </div>
                <div class="users-list">
                    
                </div>
            </section>
        </div>
        <script type="text/javascript" src="js/user.js"></script>
    </body>
</html>