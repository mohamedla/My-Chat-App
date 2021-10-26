<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing = mysqli_real_escape_string($connection,$_POST['outgoing_id']);
        $incomming = mysqli_real_escape_string($connection,$_POST['incoming_id']);
        $output = "";
        
        $sql = mysqli_query($connection,"SELECT * FROM messages 
                                LEFT JOIN users ON users.unique_id = messages.outgoing_id
                                WHERE (outgoing_id ={$outgoing} AND incomming_id = {$incomming})
                                OR (outgoing_id ={$incomming} AND incomming_id = {$outgoing}) ORDER BY time ASC");
        if(mysqli_num_rows($sql)>0){
            while($row = mysqli_fetch_assoc($sql)){
                if($row['outgoing_id'] === $outgoing){
                    $output .= "<div class='chat outgoing'>
                                    <div class='details'>
                                        <p>".$row['msg']."</p>
                                    </div>
                                </div>
                                <div class='time outgoing-time'>
                                        <p>".$row['time']."</p>
                                </div>";
                }else{
                    $output .= "<div class='chat ingoing'>
                                    <img src='php/images/".$row['img']."' alt=''>
                                    <div class='details'>
                                    <p>".$row['msg']."</p>
                                    </div>
                                </div>
                                <div class='time ingoing-time'>
                                        <p>".$row['time']."</p>
                                </div>";
                }
            }
        }else{
            $output = 'Start by saying Hi';
        }
        echo $output;
    }else{
        header("location: ../signin.php");
    }
?>