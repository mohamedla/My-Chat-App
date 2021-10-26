<?php
    while($row = mysqli_fetch_assoc($sql)){
        $sql2 = mysqli_query($connection, "SELECT outgoing_id,msg FROM  messages 
                                WHERE (outgoing_id ={$row['unique_id']} AND incomming_id ={$user_id})
                                OR (outgoing_id ={$user_id} AND incomming_id ={$row['unique_id']})
                                ORDER BY time DESC LIMIT 1");
        $sender = '';
        if(mysqli_num_rows($sql2) > 0){
            $row2 = mysqli_fetch_assoc($sql2);
            $result = $row2['msg'];
            if($row2['outgoing_id'] == $user_id){
                $sender = 'You: ';
            }
        }else{
            $result = "No Message Yet";
        }
        (strlen($result) > 28 ) ? $msg = substr($result, 0, 28). '...' : $msg = $result;
        ($row['stutus'] == "Offline Now") ? $offline = "offline" : $offline = "";
        $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'" >
                        <div class="content">
                            <img src="php/images/'.$row['img'].'" alt="">
                            <div class="details">
                                <span>'.$row['fname'] . ' ' . $row['lname'].'</span>
                                <p>'.$sender.$msg.'</p>
                            </div>
                        </div>
                        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                    </a>';
        
    }
?>