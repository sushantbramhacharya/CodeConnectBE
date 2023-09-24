<?php
$sid=$_SESSION["uid"];
if(isset($_GET["uid"]))
{
  $uid=$_GET["uid"];
  $user=queryUser($conn,$uid);
}
else{
  $user=queryUser($conn,$sid);
}
function queryUser($conn,$id)
{
  $query = "SELECT * FROM User Where uid ='$id';";
  $result=mysqli_query($conn,$query);
  return mysqli_fetch_assoc($result);
}
?>

<div class="sidebar">
      <img src="../img/guni.png" alt="guni">
      <div class="inner-sidebar">
        <h1 class="center">
          <?php echo $user['Name'] ?>
          <script>var userName="<?php echo $user['Name'] ?>";</script>
        </h1>
        <p class="center"><?php echo $user['bio'] ?></p>
        <hr>
        <h2 class="center">Connections</h2>
          <p class="center">
          <?php
          if(isset($_GET["uid"]))
          {
            $id=$_GET["uid"];
            $query = "SELECT * FROM connections WHERE (sender_uid =$id OR reciever_uid = $id) AND status_accepted = true;";
            $result=mysqli_query($conn,$query);
            echo $result->num_rows;
          }else{
            $id=$sid;
            $query = "SELECT * FROM connections WHERE (sender_uid =$id OR reciever_uid = $id) AND status_accepted = true;";
            $result=mysqli_query($conn,$query);
            echo $result->num_rows;
          }
          ?>
          </p>

        <hr>
        <?php
          if(!isset($_GET["uid"])||$_GET["uid"]===$sid)
          {
          ?>
        <div class="profile-section-buttons">
          <a href="http://localhost/codeconnect/home/?showSaved=true">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="25" viewBox="0 0 23 25" fill="none">
              <path
                d="M17.335 1H5.66499C3.09999 1 1 2.99694 1 5.43607V21.6399C1 23.7082 2.56 24.5926 4.465 23.5798L10.36 20.456C10.99 20.128 12.01 20.128 12.625 20.456L18.52 23.5798C20.425 24.5926 21.985 23.7082 21.985 21.6399V5.43607C22 2.99694 19.9 1 17.335 1Z"
                stroke="#7E7E7E" stroke-linecap="round" stroke-linejoin="round" />
              <path
                d="M22 5.43607V21.6399C22 23.7082 20.44 24.5783 18.535 23.5798L12.64 20.456C12.01 20.128 10.99 20.128 10.36 20.456L4.465 23.5798C2.56 24.5783 1 23.7082 1 21.6399V5.43607C1 2.99694 3.09999 1 5.66499 1H17.335C19.9 1 22 2.99694 22 5.43607Z"
                stroke="#7E7E7E" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p>Saved</p>
          </a>
          
          <a href="../profile">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
              <path
                d="M12.6399 14.2789C12.6166 14.2789 12.5817 14.2789 12.5585 14.2789C12.5236 14.2789 12.4771 14.2789 12.4422 14.2789C9.80266 14.1975 7.82593 12.1394 7.82593 9.60448C7.82593 7.0231 9.93057 4.91846 12.512 4.91846C15.0934 4.91846 17.198 7.0231 17.198 9.60448C17.1864 12.151 15.198 14.1975 12.6748 14.2789C12.6515 14.2789 12.6515 14.2789 12.6399 14.2789ZM12.5004 6.651C10.8725 6.651 9.55848 7.97658 9.55848 9.59285C9.55848 11.1859 10.8027 12.4766 12.3841 12.5347C12.419 12.5231 12.5352 12.5231 12.6515 12.5347C14.2096 12.4533 15.4306 11.1743 15.4422 9.59285C15.4422 7.97658 14.1282 6.651 12.5004 6.651Z"
                fill="#A0A0A0" />
              <path
                d="M12.5011 25C9.37318 25 6.38483 23.8372 4.07089 21.721C3.86159 21.5349 3.76856 21.2558 3.79182 20.9884C3.94298 19.6047 4.80344 18.314 6.23366 17.3605C9.69876 15.0582 15.315 15.0582 18.7685 17.3605C20.1987 18.3256 21.0591 19.6047 21.2103 20.9884C21.2452 21.2675 21.1405 21.5349 20.9312 21.721C18.6173 23.8372 15.6289 25 12.5011 25ZM5.61739 20.7558C7.54761 22.3721 9.97783 23.2558 12.5011 23.2558C15.0243 23.2558 17.4545 22.3721 19.3847 20.7558C19.1754 20.0466 18.6173 19.3605 17.7917 18.8024C14.9313 16.8954 10.0825 16.8954 7.19877 18.8024C6.3732 19.3605 5.82669 20.0466 5.61739 20.7558Z"
                fill="#A0A0A0" />
              <path
                d="M12.4999 24.9998C5.60462 24.9998 0 19.3952 0 12.4999C0 5.60462 5.60462 0 12.4999 0C19.3952 0 24.9998 5.60462 24.9998 12.4999C24.9998 19.3952 19.3952 24.9998 12.4999 24.9998ZM12.4999 1.74418C6.56973 1.74418 1.74418 6.56973 1.74418 12.4999C1.74418 18.4301 6.56973 23.2557 12.4999 23.2557C18.4301 23.2557 23.2557 18.4301 23.2557 12.4999C23.2557 6.56973 18.4301 1.74418 12.4999 1.74418Z"
                fill="#A0A0A0" />
            </svg>
            <p>Profile</p>
            </a>
        </div>
          <?php
          }else{
          ?>
          <!-- OTHER PROFILE COMPONENTS -->
          <div class="connection-req">
         <a href="#" onclick="checkingConnection(<?php echo $_GET['uid'];?>,true)" ><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 72 72" fill="none">
            <path d="M30.3794 40.19C35.0351 40.19 38.8094 36.4157 38.8094 31.76C38.8094 27.1042 35.0351 23.33 30.3794 23.33C25.7237 23.33 21.9495 27.1042 21.9495 31.76C21.9495 36.4157 25.7237 40.19 30.3794 40.19Z" stroke="black" stroke-width="2.044" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M45.9502 59.5999C45.9502 52.6099 38.9902 46.9099 30.3802 46.9099C21.7703 46.9099 14.8103 52.5799 14.8103 59.5999" stroke="black" stroke-width="2.044" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M59 36.4998C59 52.2498 46.25 64.9998 30.5 64.9998C14.75 64.9998 2 52.2498 2 36.4998C2 20.7498 14.75 7.99976 30.5 7.99976C34.43 7.99976 38.18 8.77973 41.6 10.2197C41.21 11.4197 41 12.6798 41 13.9998C41 16.2498 41.63 18.3798 42.74 20.1798C43.34 21.1998 44.12 22.1297 45.02 22.9097C47.12 24.8297 49.91 25.9998 53 25.9998C54.32 25.9998 55.58 25.7897 56.75 25.3697C58.19 28.7897 59 32.5698 59 36.4998Z" stroke="black" stroke-width="2.044" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M64.9998 14C64.9998 14.96 64.8798 15.89 64.6398 16.79C64.3698 17.99 63.8898 19.16 63.2598 20.18C61.8198 22.61 59.5098 24.4999 56.7498 25.3699C55.5798 25.7899 54.3198 26 52.9998 26C49.9098 26 47.1198 24.8299 45.0198 22.9099C44.1198 22.1299 43.3398 21.2 42.7398 20.18C41.6298 18.38 40.9998 16.25 40.9998 14C40.9998 12.68 41.2098 11.42 41.5998 10.22C42.1698 8.47997 43.1298 6.92006 44.3898 5.63006C46.5798 3.38006 49.6398 2 52.9998 2C56.5398 2 59.7498 3.53006 61.9098 5.99006C63.8298 8.12006 64.9998 10.94 64.9998 14Z" stroke="black" stroke-width="2.044" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M57.4698 13.9399H48.5298" stroke="black" stroke-width="2.044" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M53.0002 9.56006V18.53" stroke="black" stroke-width="2.044" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          </svg><p id="connections">Connect</p></a></div>
          <script>
            $(document).ready(function() {
                checkingConnection(<?php echo $_GET['uid'];?>,false);
            });
          </script>
          <?php
          }
          ?>
      </div>
    </div>
