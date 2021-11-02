<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing = mysqli_real_escape_string($connection,$_POST['outgoing_id']);
        $incomming = mysqli_real_escape_string($connection,$_POST['incoming_id']);
        $output = "";
        $sql2 = mysqli_query( $connection,"UPDATE messages SET msg_status= 'seen' 
                                        WHERE (incomming_id= {$outgoing}) AND (outgoing_id ={$incomming}) ");
        $sql = mysqli_query($connection,"SELECT * FROM messages 
                                LEFT JOIN users ON users.unique_id = messages.outgoing_id
                                WHERE (outgoing_id ={$outgoing} AND incomming_id = {$incomming})
                                OR (outgoing_id ={$incomming} AND incomming_id = {$outgoing}) ORDER BY time ASC");
        $last_msg_id = 0;
        if(mysqli_num_rows($sql)>0){
            $row_num = 0;
            while($row = mysqli_fetch_assoc($sql)){
                $row_num +=1;
                if($row_num == mysqli_num_rows($sql)){
                    $last_msg_id = $row['msg_id'];
                }
                $msg = "<p>error in download the Message</p>";
                switch($row['msg_type']){
                    case "txt":
                        $msg = "<p>".$row['msg']."</p>";
                    break;
                    case "image":
                        $msg = "<img class='msg-img'  src='php/images/".$row['msg']."' alt='".$row['msg']."' title='".$row['msg']."'>";
                    break;
                    case "video":
                        $msg = "<video src='php/videos/".$row['msg']."' id='msg-ved' class='msg-ved' 
                        width='320' height='240' preload='metadata' controls></video>";
                    break;
                    case "audio":
                        $msg = "<audio src='php/audios/".$row['msg']."' id='msg-aud' class='msg-aud' 
                         preload='metadata' controls></audio>";
                    break;
                    default:
                        $msg = "<p><a href='php/files/".$row['msg']."' target='_blank'>".$row['msg']."</a></p>";
                    break;
                }
                switch($row['msg_status']){
                    case "seen":
                        $msg_status = "fas fa-check-double blue";
                    break;
                    case "receive":
                        $msg_status = "fas fa-check-double gray";
                    break;
                    default:
                        $msg_status = "fas fa-check gray";
                    break;
                }
                if($row['outgoing_id'] === $outgoing){
                    $output .= "<div class='chat outgoing'>
                                    <div class='details'>
                                        ".$msg."
                                    </div>
                                </div>
                                <div class='time outgoing-time'>
                                        <p>".$row['time']."</p>
                                        <i class='".$msg_status."'></i>
                                </div>";
                }else{
                    $output .= "<div class='chat ingoing'>
                                    <img class='user-img' src='php/images/".$row['img']."' alt=''>
                                    <div class='details'>
                                    ".$msg."
                                    </div>
                                </div>
                                <div class='time ingoing-time'>
                                        <p>".$row['time']."</p>
                                </div>";
                }
            }
        }else{
            $output = '<p align ="center">Start by saying Hi<p>';
        }
        echo $output .'^'. $last_msg_id;
    }else{
        header("location: ../signin.php");
    }
?>