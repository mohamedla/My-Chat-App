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
            <section class="chat-area">
                <header>
                    <?php
                        include_once "php/config.php";
                        $user_id = mysqli_real_escape_string($connection , $_GET['user_id']);
                        $sql = mysqli_query($connection, "SELECT * FROM users WHERE unique_id = '{$user_id}'");
                        if(mysqli_num_rows($sql)>0){
                            $row = mysqli_fetch_assoc($sql);
                        }
                    ?>
                    <a href="user.php" class="back-icon">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname'] . ' ' . $row['lname'] ?></span>
                        <p><?php echo $row['stutus'] ?></p>
                    </div>
                </header>
                <div class="chat-box">
                        
                </div>
                <form class="typing-area" method="post" autocomplete="off">
                    <input name="outgoing_id" type="text" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                    <input name="incoming_id" type="text" value="<?php echo $user_id; ?>" hidden>
                    <input class="massege" type="text" name="massege" placeholder="Type a massage here...">
                    <button type="submit"><i class="fab fa-telegram-plane"></i></button>
                </form>
            </section>
        </div>

        <script type="text/javascript" src="js/chat.js"></script>

    </body>
</html>
