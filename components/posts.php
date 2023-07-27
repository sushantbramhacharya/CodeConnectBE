<?php
$sid=$_SESSION["uid"];
$query = "SELECT Name FROM User Where uid ='$sid';";
$result=mysqli_query($conn,$query);
$user=mysqli_fetch_assoc($result);
//Query Posts
$sid = $_SESSION["uid"];
$query = "SELECT * FROM discussion Where uid ='$sid';";
$result = mysqli_query($conn, $query);
$posts = array();
if ($result == true) {
    while ($row = $result->fetch_assoc()) {

        $posts[] = $row;
    }
} else {
    echo "Something went wrong!<BR>";
}

?>

<div class="posts">
    <div class="post-header"> <h1>Posts</h1> <button id="postBtn">Post</button> </div>
    <div id="postPopup">
    <div class="popupContent">
      <h3 style="background-color: #232F66; 
                  margin:5px;
                  padding:20px;
                  border-radius:10px;
                  box-sizing: border-box;
                  color:white;
                  font-family: Poppins;
                  ">Create a Post</h3>
      <textarea id="postContent" name="description" placeholder="Write your post here..."></textarea>
      <textarea id="postContent" name="code" placeholder="Write your code here if you want..."></textarea>
      <button id="submitPostBtn">Submit</button>
      <button id="cancelPostBtn">Cancel</button>
    </div>
  </div>
    <div class="post-content">
        <div class="newsfeed">
            <?php
            foreach ($posts as $row) {
                $post_description = $row['post_description'];
                $post_code = $row['code_text'];
                $time_stamp=$row['posted_date'];
?>
        <div class="post">
            <div class="post-header">
              <div class="profile-section">
                <a href="">
                  <img src="../img/Profile-Picture.png" alt="Profile Picture">
                </a>
                <div class="profile-info-posts">
                  <a href="">
                    <h3><?php echo $user["Name"];?></h3>
                  </a>
                  <p>Loves Lolipop</p>
                  <p><?php echo $time_stamp; ?></p>
                </div>

              </div>
              <a class="saved-posts" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="25"
                  viewBox="0 0 17 25" fill="none">
                  <path
                    d="M12.7126 1H4.34491C2.50574 1 1 2.99185 1 5.42477V21.5874C1 23.6504 2.11856 24.5325 3.48449 23.5223L7.71135 20.4065C8.16308 20.0792 8.89445 20.0792 9.33542 20.4065L13.5623 23.5223C14.9282 24.5325 16.0468 23.6504 16.0468 21.5874V5.42477C16.0575 2.99185 14.5518 1 12.7126 1Z"
                    stroke="#7E7E7E" stroke-linecap="round" stroke-linejoin="round" />
                  <path
                    d="M16.0575 5.42477V21.5874C16.0575 23.6504 14.939 24.5182 13.573 23.5223L9.34619 20.4065C8.89446 20.0792 8.16307 20.0792 7.71135 20.4065L3.48449 23.5223C2.11856 24.5182 1 23.6504 1 21.5874V5.42477C1 2.99185 2.50574 1 4.34491 1H12.7126C14.5518 1 16.0575 2.99185 16.0575 5.42477Z"
                    stroke="#7E7E7E" stroke-linecap="round" stroke-linejoin="round" />
                </svg></a>
            </div>
            <div class="post-content">
              <p class="post-description">
              <?php echo $post_description?>
              </p>
              <?php if($post_code){?>
              <p class="code">
               <?php echo $post_code?>
              </p>
              <?php };?>
            </div>
            <hr>
            <div class="post-footer">
              <a href="#"> <img src="../img/geek.png" alt="geek"> Geek</a>
              <a href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="41" height="35" viewBox="0 0 41 35"
                  fill="none">
                  <path
                    d="M31.3066 33.2008C30.7223 33.2008 30.1381 33.0719 29.6103 32.7981L22.0522 28.964C21.2606 28.9479 20.4689 28.8997 19.715 28.803C19.2061 28.7386 18.7726 28.4485 18.5841 28.0296C18.3956 27.6108 18.4899 27.1598 18.8291 26.8215C20.0731 25.5811 20.714 24.099 20.714 22.5203C20.714 18.622 16.6993 15.4485 11.761 15.4485C9.91392 15.4485 8.14218 15.8836 6.65317 16.7212C6.23851 16.9468 5.72961 16.979 5.27725 16.8018C4.84374 16.6246 4.52334 16.27 4.4668 15.8512C4.41025 15.4001 4.37256 14.9492 4.37256 14.4821C4.37256 6.49193 12.4773 0 22.4291 0C32.381 0 40.4857 6.49193 40.4857 14.4821C40.4857 18.8638 38.1108 22.8909 33.9265 25.6455L34.5674 30.0273C34.7182 31.1227 34.1527 32.1537 33.0784 32.7498C32.5506 33.0397 31.9286 33.2008 31.3066 33.2008ZM22.4103 26.5315C22.6742 26.5154 22.9381 26.58 23.1642 26.7089L31.0616 30.72C31.2689 30.8328 31.4386 30.7845 31.5517 30.72C31.6459 30.6717 31.7967 30.5428 31.759 30.3173L31.0239 25.2267C30.9674 24.7756 31.1936 24.3408 31.6082 24.0831C35.4532 21.7795 37.6585 18.2676 37.6585 14.4497C37.6585 7.79673 30.8354 2.38411 22.4291 2.38411C14.3432 2.38411 7.70867 7.4102 7.21861 13.7249C8.63223 13.2578 10.1589 13 11.7422 13C18.2449 13 23.5223 17.2527 23.5223 22.4881C23.5412 23.9057 23.1454 25.275 22.4103 26.5315Z"
                    fill="#828282" />
                  <path
                    d="M6.2576 34.6183C5.76754 34.6183 5.29634 34.5055 4.86283 34.2639C4.01466 33.7967 3.56232 32.9913 3.67541 32.1375L4.05236 29.6567C1.50785 27.8847 0 25.2589 0 22.5043C0 19.363 1.92253 16.4312 5.14557 14.6753C7.08693 13.596 9.38639 13.0161 11.7801 13.0161C18.2828 13.0161 23.5603 17.2688 23.5603 22.5043C23.5603 24.6307 22.6556 26.7249 20.9969 28.3841C18.8671 30.591 15.6817 31.8797 12.1759 31.9764L7.57697 34.3122C7.16231 34.5216 6.70995 34.6183 6.2576 34.6183ZM11.7613 15.4324C9.91414 15.4324 8.1424 15.8674 6.65339 16.705C4.24082 18.026 2.80838 20.1846 2.80838 22.5043C2.80838 24.7434 4.09007 26.7893 6.35186 28.1102C6.78536 28.368 7.01152 28.8029 6.95498 29.254L6.54032 32.0086L11.045 29.7211C11.2712 29.6084 11.5162 29.5439 11.7613 29.5439C14.5319 29.5439 17.1519 28.5291 18.8105 26.8054C20.0545 25.5489 20.7142 24.0669 20.7142 22.4882C20.7142 18.6059 16.6995 15.4324 11.7613 15.4324Z"
                    fill="#828282" />
                </svg> Comment</a>
              <a href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="41" height="39" viewBox="0 0 41 39"
                  fill="none">
                  <path d="M30.2207 8.53149C34.1403 11.1291 36.8448 15.2591 37.3936 20.0245" stroke="#292D32"
                    stroke-opacity="0.62" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M3.82227 20.1179C4.33181 15.3711 6.99714 11.2411 10.8775 8.62476" stroke="#292D32"
                    stroke-opacity="0.62" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path
                    d="M13.0332 36.1333C15.3066 37.2359 17.8935 37.8526 20.6176 37.8526C23.2438 37.8526 25.7131 37.292 27.9277 36.2641"
                    stroke="#292D32" stroke-opacity="0.62" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                  <path
                    d="M20.6176 11.3905C23.6267 11.3905 26.0659 9.06451 26.0659 6.19524C26.0659 3.32599 23.6267 1 20.6176 1C17.6087 1 15.1694 3.32599 15.1694 6.19524C15.1694 9.06451 17.6087 11.3905 20.6176 11.3905Z"
                    stroke="#292D32" stroke-opacity="0.62" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                  <path
                    d="M6.44824 34.2274C9.45721 34.2274 11.8965 31.9013 11.8965 29.0322C11.8965 26.1628 9.45721 23.8369 6.44824 23.8369C3.43926 23.8369 1 26.1628 1 29.0322C1 31.9013 3.43926 34.2274 6.44824 34.2274Z"
                    stroke="#292D32" stroke-opacity="0.62" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                  <path
                    d="M34.5518 34.2274C37.5608 34.2274 40 31.9013 40 29.0322C40 26.1628 37.5608 23.8369 34.5518 23.8369C31.5429 23.8369 29.1035 26.1628 29.1035 29.0322C29.1035 31.9013 31.5429 34.2274 34.5518 34.2274Z"
                    stroke="#292D32" stroke-opacity="0.62" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>Share</a>
            </div>
          </div>
          <?php
            }
            ?>
        </div>
    </div>
</div>
<script src="../components/posts.js"></script>