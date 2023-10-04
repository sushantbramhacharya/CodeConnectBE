<?php

$uid=$_SESSION['uid'];

$notifications=array();

$query="SELECT * FROM connections WHERE reciever_uid = $uid AND status_accepted=0 ORDER BY cid DESC LIMIT 5;";
$result=mysqli_query($conn,$query);
while($row=$result->fetch_assoc())
{
  $sender_uid=$row["sender_uid"];
  $sender_query="SELECT Name FROM user WHERE uid=$sender_uid;";
  $sender_res=mysqli_query($conn,$sender_query);
  $sender_row=$sender_res->fetch_assoc();
  $sender_name=$sender_row["Name"];
  $notifications[]=array(
    "sender_uid"=>$row["sender_uid"],
    "sender_name"=>$sender_name,
    "id"=>$row["cid"]
  );
}

$query="SELECT * FROM geek g WHERE g.discussion_id IN (SELECT d.discussion_id FROM discussion d WHERE uid=$uid ) AND geekers_uid != $uid ORDER BY geekers_uid DESC LIMIT 5;";
$result=mysqli_query($conn,$query);
while($row=$result->fetch_assoc())
{
  $geekers_uid=$row["geekers_uid"];
  $geek_query="SELECT Name FROM user WHERE uid=$geekers_uid;";
  $geek_res=mysqli_query($conn,$geek_query);
  $geek_row=$geek_res->fetch_assoc();
  $geekers_name=$geek_row["Name"];
  
  $notifications[]=array(
    "geekers_name"=>$geekers_name,
    "discussion_id"=>$row["discussion_id"],
    "id"=>$row["gid"]
  );
}

$query="SELECT * FROM comments c WHERE c.discussion_id IN (SELECT d.discussion_id FROM discussion d WHERE uid=$uid ) AND uid != $uid ORDER BY comment_id DESC LIMIT 5;";
$result=mysqli_query($conn,$query);
while($row=$result->fetch_assoc())
{
  $commenter_uid=$row["uid"];
  $commenter_query="SELECT Name FROM user WHERE uid=$commenter_uid;";
  $commenter_res=mysqli_query($conn,$commenter_query);
  $commenter_row=$commenter_res->fetch_assoc();
  $commenter_name=$commenter_row["Name"];

  $notifications[]=array(
    "commenter_name"=>$commenter_name,
    "discussion_id"=>$row["discussion_id"],
    "id"=>$row["comment_id"]
  );
}
usort($notifications, function($a, $b) {
  return $b['id'] - $a['id'];
});

?>




<script>

const notificationBtn = document.getElementById('notification-btn');
const notificationDropdown = document.getElementById('notification-dropdown');

// Sample data for notifications (you can replace this with actual data from your backend)






const notifications = [
  <?php
    foreach($notifications as $notification)
    {
      if(!empty($notification["geekers_name"])){
  ?>
      { id: 1, message: '<?php echo $notification["geekers_name"]?> has Geeked.', link: '../profile/?did=<?php echo $notification["discussion_id"]?>' },
  <?php
      }
    ?>
    <?php
       if(!empty($notification["commenter_name"])){
      ?>
          { id: 1, message: '<?php echo $notification["commenter_name"]?> has Commented.', link: '../profile/?did=<?php echo $notification["discussion_id"]?>' },
      <?php
          }
      ?>
    <?php
    if(!empty($notification["sender_uid"])){
      ?>
          { id: 1, message: '<?php echo $notification["sender_name"]?> has Sent you Connection Request.', link: '../profile/?uid=<?php echo $notification["sender_uid"]?>' },
      <?php
          }
      }
  ?>
  
];

// Function to populate the notification dropdown with notifications
function showNotifications() {
  // Clear previous notifications
  notificationDropdown.innerHTML = '';

  // Add new notifications
  notifications.forEach((notification) => {
    const notificationItem = document.createElement('div');
    notificationItem.classList.add('notification-item');
    notificationItem.innerHTML = `<a href="${notification.link}">${notification.message}</a>`;
    notificationDropdown.appendChild(notificationItem);
  });

  // Show the notification dropdown
  notificationDropdown.style.display = 'block';
}

// Event listener for the notification button click
notificationBtn.addEventListener('click', () => {
  showNotifications();
});

// Hide the dropdown when clicking outside it
document.addEventListener('click', (event) => {
  if (!notificationDropdown.contains(event.target) && event.target !== notificationBtn) {
    notificationDropdown.style.display = 'none';
  }
});

let profileSearch=true;

function searchPost(event)
{
  keyword=$('#search-input').val();
  $(event.target).attr('href', '../home/?codeSearchKeyword='+keyword);
}

$(document).ready(function () {
  const searchInput = $('#search-input');
  const searchDropdown = $('#search-dropdown'); 


  searchInput.on('input', function () {
    const searchTerm = searchInput.val().trim();
    if (searchTerm !== '') {
      $.ajax({
        type: 'GET',
        url: '../components/search.php', 
        data: { searchTerm: searchTerm ,
              profileSearch:profileSearch
        },
        dataType: 'json',
        success: function (response) {
          if(profileSearch)
          {
            updateDropdown(response);
          }
          else{
            console.log("Other Search");
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX error:', status, error);
          console.log('XHR object:', xhr);
        }
      });
    } else {
      searchDropdown.html('');
    }
  });

  function updateDropdown(results) {
    searchDropdown.html('');
    if (results.length > 0) {
      results.forEach(result => {
        const option = $('<a>').attr('href', '../profile/index.php?uid='+result.uid).addClass('dropdown-option').text(result.name);
        searchDropdown.append(option);
        //Post Search Code
      });
      const postSearch=$('<a>').attr({onClick: 'searchPost(event)',href:''}).addClass('dropdown-option search-post').text("Search Discussion");
      searchDropdown.append(postSearch);
    } else {
      const noResults = $('<div>').addClass('no-results').text('No results found');
      searchDropdown.append(noResults);

      //Post Search Code
      const postSearch=$('<a>').attr({onClick: 'searchPost(event)',href:''}).addClass('dropdown-option search-post').text("Search Discussion");
      searchDropdown.append(postSearch);
    }
  }
});

</script>