
<?php 
$friends_query = "SELECT * FROM user u WHERE u.uid IN (SELECT
               CASE
                 WHEN sender_uid = $uid 
                 THEN reciever_uid
                 ELSE sender_uid
               END AS uid
             FROM connections c
             WHERE
               ($uid = sender_uid OR $uid = reciever_uid) 
               AND status_accepted = 1
               ) ORDER BY Name ASC";
     $friends_query_result = mysqli_query($conn, $friends_query);
     $friends = array();
     if ($friends_query_result == true) {
         while ($row = $friends_query_result->fetch_assoc()) {
     
             $friends[] = array(
                "name"=>$row['Name'],
                "uid"=>$row['uid']
             );
         }
     } else {
         echo "Something went wrong!<BR>";
     }
?>
<section class="discussions">
<?php foreach ($friends as $friend_arr) {
?>
            <div onclick="fetchMessage(<?php echo $friend_arr['uid'];?>)" class="discussion" id="chat_<?php echo $friend_arr['uid'];?>">
              <div class="desc-contact">
                <p class="name"><?php echo $friend_arr['name'];?></p>
              </div>
            </div>
<?php }?>
</section>
