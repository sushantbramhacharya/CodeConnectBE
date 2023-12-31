<!-- Preload Scripts -->

<script src="../components/post_scripts/save_post.js"></script>


<?php
if(isset($_POST["description"]))
{
  $uid=$_SESSION["uid"];
  $description=$_POST["description"];
  $post_code_send=$_POST["code"];

  $post_query = "INSERT INTO discussion (uid,post_description,code_text,posted_date)
  VALUES ($uid, '$description', '$post_code_send',".time().");";
  mysqli_query($conn, $post_query);
  echo "<script>window.location.href = '../home'</script>;";
  exit();
}
$sid=$_SESSION["uid"];
$query = "SELECT Name FROM user Where uid ='$sid';";
$result=mysqli_query($conn,$query);
$user=mysqli_fetch_assoc($result);


//Query Posts
 if(isset($_GET["codeSearchKeyword"]))
{
  $keyword=$_GET["codeSearchKeyword"];
  $sid = $_SESSION["uid"];
  $query = 'SELECT * FROM discussion WHERE post_description LIKE "%'.$keyword.'%" OR code_text LIKE "%'.$keyword.'%" ORDER BY posted_date DESC; ';
  $result = mysqli_query($conn, $query);
  $posts = array();
  if ($result == true) {
      while ($row = $result->fetch_assoc()) {
  
          $posts[] = $row;
      }
  } else {
      echo "Something went wrong!<BR>";
  }
}
else if(isset($_GET["friendsOnly"])&&$_GET["friendsOnly"]=="true")
{
  $sid = $_SESSION["uid"];
  $query = "SELECT * FROM discussion d WHERE d.uid IN (SELECT
            CASE
              WHEN sender_uid = $sid 
              THEN reciever_uid
              ELSE sender_uid
            END AS uid
          FROM connections c
          WHERE
            ($sid = sender_uid OR $sid = reciever_uid) 
            AND status_accepted = 1
            )
            ORDER BY posted_date DESC;";
  $result = mysqli_query($conn, $query);
  $posts = array();
  if ($result == true) {
      while ($row = $result->fetch_assoc()) {
  
          $posts[] = $row;
      }
  } else {
      echo "Something went wrong!<BR>";
  }
}
else if(isset($_GET["showSaved"])&&$_GET["showSaved"]=="true")
{
  $sid = $_SESSION["uid"];
  $query = "SELECT * FROM discussion d WHERE d.discussion_id IN (SELECT discussion_id FROM saved WHERE uid='$sid') ORDER BY posted_date DESC;";
  $result = mysqli_query($conn, $query);
  $posts = array();
  if ($result == true) {
      while ($row = $result->fetch_assoc()) {
  
          $posts[] = $row;
      }
  } else {
      echo "Something went wrong!<BR>";
  }
}
else
{
  
  $sid = $_SESSION["uid"];
  $query = "SELECT * FROM discussion ORDER BY posted_date DESC;";
  $result = mysqli_query($conn, $query);
  $posts = array();
  if ($result == true) {
      while ($row = $result->fetch_assoc()) {
  
          $posts[] = $row;
      }
  } else {
      echo "Something went wrong!<BR>";
  }
}


function formatRelativeTime($timestamp) {
  $currentTime = time();
  $targetTime = $timestamp;
  $timeDifference =  abs($currentTime-$targetTime);

  if ($timeDifference < 20) {
      return "Just Now";
  } elseif ($timeDifference < 60) {
      return $timeDifference . "s ago";
  } elseif ($timeDifference < 3600) {
      $minutesAgo = floor($timeDifference / 60);
      return $minutesAgo . "m ago";
  } elseif ($timeDifference < 86400) {
      $hoursAgo = floor($timeDifference / 3600);
      return $hoursAgo . "h ago";
  } else {
      $daysAgo = floor($timeDifference / 86400);
      return $daysAgo . "d ago";
  }
}

?>
<script src="../components/post_scripts/geek.js"></script>
<div class="posts">
    <div class="post-header"> <h1>Discussions 
    <?php
    if(!isset($_GET["friendsOnly"]))
    {
      echo '<a 
              style="font-size:15px; 
              text-decoration: none;
              color:blue;" 
              href="../home/?friendsOnly=true"
              >Friends Only</a>';
    }
    else{
      echo '<a 
              style="font-size:15px; 
              text-decoration: none;
              color:blue;" 
              href="../home/"
              >Public</a>';
    }
    ?>    
  </h1> <button id="postBtn">Post</button> </div>
    
    <form action="index.php" method="post">
    <div id="postPopup">
    <div class="popupContent">
      <h3 style="background-color: #232F66; 
                  margin:5px;
                  padding:20px;
                  border-radius:10px;
                  box-sizing: border-box;
                  color:white;
                  font-family: Poppins;
                  ">Create a Discussion</h3>
      <textarea id="postContent" name="description" placeholder="Write your post here..."></textarea>
      <textarea id="postContent" name="code" placeholder="Write your code here if you want..."></textarea>
      <button id="submitPostBtn" type="submit" >Submit</button>
      <button id="cancelPostBtn" type="button">Cancel</button>
    </div>
  </div>
  </form>
    <div class="post-content">
        <div class="newsfeed">
            <?php
            if(empty($posts))
            {
              echo "<h2 style='color:grey;text-align:center;'>No Posts Found</h2>";
            }
            foreach ($posts as $post) {
                $post_description = $post['post_description'];
                $post_code = $post['code_text'];
                $time_stamp=$post['posted_date'];
                $poster_uid=$post['uid'];

                $query="SELECT Name,bio FROM user WHERE uid = '$poster_uid';";
                $result_name= mysqli_query($conn,$query);
                $poster_name = $result_name->fetch_assoc(); 
            ?>
        <div class="post">
            <div class="post-header">
              <div class="profile-section">
                <a href="">
                  <img src="../uploads/<?php 
                      if(file_exists("../uploads/".$poster_uid.".png"))
                      {
                        echo $poster_uid;
                      }
                      else{
                        echo "default";
                      }
                      ?>.png" alt="Profile Picture">
                </a>
                <div class="profile-info-posts">
                  <a href="../profile/index.php?uid=<?php echo $poster_uid;?>">
                    <h3><?php echo $poster_name['Name'];?></h3>
                  </a>
                  <p><?php echo $poster_name['bio'];?></p>
                  <p><?php echo formatRelativeTime($time_stamp); ?></p>
                </div>

              </div>
              <script>
                
                geekFetch(<?php echo $post['discussion_id']?>);
                </script>

              <a class="saved-posts"
              id="<?php echo "saved_".$post['discussion_id']?>"
              href="" 
              onclick="onSaveClick(event,<?php echo $post['discussion_id']?>)"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="25"
                  viewBox="0 0 17 25" fill="none">
                  <path
                    d="M12.7126 1H4.34491C2.50574 1 1 2.99185 1 5.42477V21.5874C1 23.6504 2.11856 24.5325 3.48449 23.5223L7.71135 20.4065C8.16308 20.0792 8.89445 20.0792 9.33542 20.4065L13.5623 23.5223C14.9282 24.5325 16.0468 23.6504 16.0468 21.5874V5.42477C16.0575 2.99185 14.5518 1 12.7126 1Z"
                    stroke="#7E7E7E" stroke-linecap="round" stroke-linejoin="round" />
                  <path
                    d="M16.0575 5.42477V21.5874C16.0575 23.6504 14.939 24.5182 13.573 23.5223L9.34619 20.4065C8.89446 20.0792 8.16307 20.0792 7.71135 20.4065L3.48449 23.5223C2.11856 24.5182 1 23.6504 1 21.5874V5.42477C1 2.99185 2.50574 1 4.34491 1H12.7126C14.5518 1 16.0575 2.99185 16.0575 5.42477Z"
                    stroke="#7E7E7E" stroke-linecap="round" stroke-linejoin="round" />
                </svg></a>
                <script>
                  checkSaved(<?php echo $post['discussion_id']?>);
                </script>
            </div>
            
            <div class="post-content" style="max-height: 100%;">
              <p class="post-description" id="test">
              <?php echo $post_description?>
              </p>
              <?php if($post_code){?>

               <pre class="code" ><?php echo htmlspecialchars($post_code, ENT_QUOTES, 'UTF-8');?></pre>

              <?php };?>
            </div>
            <p class="geeked" id="<?php echo $post['discussion_id']?>">Geeked By</p>
            <hr>
            <div class="post-footer">
              <a href="#" onclick="makeGeekAjaxRequest(event,<?php echo $sid;?>,<?php echo $post['discussion_id'];?>)"> <img src="../img/geek.png" alt="geek"> Geek</a>
              <a href="#" onclick="toggleComments(event,<?php echo $post['discussion_id']?>)"> <svg xmlns="http://www.w3.org/2000/svg" width="41" height="35" viewBox="0 0 41 35"
                  fill="none">
                  <path
                    d="M31.3066 33.2008C30.7223 33.2008 30.1381 33.0719 29.6103 32.7981L22.0522 28.964C21.2606 28.9479 20.4689 28.8997 19.715 28.803C19.2061 28.7386 18.7726 28.4485 18.5841 28.0296C18.3956 27.6108 18.4899 27.1598 18.8291 26.8215C20.0731 25.5811 20.714 24.099 20.714 22.5203C20.714 18.622 16.6993 15.4485 11.761 15.4485C9.91392 15.4485 8.14218 15.8836 6.65317 16.7212C6.23851 16.9468 5.72961 16.979 5.27725 16.8018C4.84374 16.6246 4.52334 16.27 4.4668 15.8512C4.41025 15.4001 4.37256 14.9492 4.37256 14.4821C4.37256 6.49193 12.4773 0 22.4291 0C32.381 0 40.4857 6.49193 40.4857 14.4821C40.4857 18.8638 38.1108 22.8909 33.9265 25.6455L34.5674 30.0273C34.7182 31.1227 34.1527 32.1537 33.0784 32.7498C32.5506 33.0397 31.9286 33.2008 31.3066 33.2008ZM22.4103 26.5315C22.6742 26.5154 22.9381 26.58 23.1642 26.7089L31.0616 30.72C31.2689 30.8328 31.4386 30.7845 31.5517 30.72C31.6459 30.6717 31.7967 30.5428 31.759 30.3173L31.0239 25.2267C30.9674 24.7756 31.1936 24.3408 31.6082 24.0831C35.4532 21.7795 37.6585 18.2676 37.6585 14.4497C37.6585 7.79673 30.8354 2.38411 22.4291 2.38411C14.3432 2.38411 7.70867 7.4102 7.21861 13.7249C8.63223 13.2578 10.1589 13 11.7422 13C18.2449 13 23.5223 17.2527 23.5223 22.4881C23.5412 23.9057 23.1454 25.275 22.4103 26.5315Z"
                    fill="#828282" />
                  <path
                    d="M6.2576 34.6183C5.76754 34.6183 5.29634 34.5055 4.86283 34.2639C4.01466 33.7967 3.56232 32.9913 3.67541 32.1375L4.05236 29.6567C1.50785 27.8847 0 25.2589 0 22.5043C0 19.363 1.92253 16.4312 5.14557 14.6753C7.08693 13.596 9.38639 13.0161 11.7801 13.0161C18.2828 13.0161 23.5603 17.2688 23.5603 22.5043C23.5603 24.6307 22.6556 26.7249 20.9969 28.3841C18.8671 30.591 15.6817 31.8797 12.1759 31.9764L7.57697 34.3122C7.16231 34.5216 6.70995 34.6183 6.2576 34.6183ZM11.7613 15.4324C9.91414 15.4324 8.1424 15.8674 6.65339 16.705C4.24082 18.026 2.80838 20.1846 2.80838 22.5043C2.80838 24.7434 4.09007 26.7893 6.35186 28.1102C6.78536 28.368 7.01152 28.8029 6.95498 29.254L6.54032 32.0086L11.045 29.7211C11.2712 29.6084 11.5162 29.5439 11.7613 29.5439C14.5319 29.5439 17.1519 28.5291 18.8105 26.8054C20.0545 25.5489 20.7142 24.0669 20.7142 22.4882C20.7142 18.6059 16.6995 15.4324 11.7613 15.4324Z"
                    fill="#828282" />
                </svg> Comment</a>
            </div>
            <div id="comments_main_<?php echo $post['discussion_id']?>" class="comment-container">
                <div class="comments" id="comments_<?php echo $post['discussion_id']?>">
                </div>

                <textarea class="comment-input" rows="4" placeholder="Add your comment..." id="comment_input_<?php echo $post['discussion_id']?>"></textarea>
                <button class="comment-button" onclick="postComment(<?php echo $post['discussion_id']?>)">Post Comment</button>
        
            </div>
          </div>
          <?php
            }
            ?>
        </div>
    </div>
</div>

<script src="../components/posts.js"></script>
