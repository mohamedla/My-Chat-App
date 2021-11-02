<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location:  signin.php");
    }
?>
<?php
    include_once "header.php";
    include_once "php/connected.php";
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
                        
                    </div>
                </header>
                <div class="chat-box">
                        
                </div>
                <form class="typing-area" method="post" autocomplete="off">
                    <input name="outgoing_id" type="text" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                    <input name="incoming_id" type="text" value="<?php echo $user_id; ?>" hidden>
                    <input class="massege" type="text" name="massege" placeholder="Type a massage here...">
                    <div class="file-snder-contaner">
                        <div class="file-sender" id="file-sender">
                            <ul class="attachfile" id="ul-file">
                                <li><label class="filebutton">
                                        <i class="far fa-image"></i>
                                        <span><input accept="image/*" type="file" id="myimg" name="img"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="filebutton">
                                        <i class="fas fa-video"></i>
                                        <span><input accept="video/*" type="file" id="myvideo" name="video"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="filebutton">
                                        <i class="fas fa-headphones"></i>
                                        <span><input accept="audio/*" type="file" id="myaudio" name="audio"></span>
                                    </label>
                                </li>
                                <li>
                                    <label class="filebutton">
                                        <i style="padding-left: 8px;" class="far fa-file-alt"></i>
                                        <span><input type="file" id="myfile" name="file"></span><a href="http://" target="_blank" rel="noopener noreferrer"></a>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="attachlink" id="attachlink"><a id="button-file"><i class="fas fa-paperclip"></i></a></div>
                    <input type="text" name="last-msg" id="lastmsg" hidden/>
                    <button type="submit"><i class="fab fa-telegram-plane"></i></button>
                </form>
            </section>
        </div>

        <script type="text/javascript" src="js/chate.js"></script>
        <script type="text/javascript" src="js/isconnect.js"></script>
    </body>
</html>
