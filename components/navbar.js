const notificationBtn = document.getElementById('notification-btn');
const notificationDropdown = document.getElementById('notification-dropdown');

// Sample data for notifications (you can replace this with actual data from your backend)
const notifications = [
  { id: 1, message: 'Notification 1', link: '../notifications' },
  { id: 2, message: 'Notification 2', link: '#' },
  { id: 3, message: 'Notification 3', link: '#' },
  { id: 2, message: 'Notification 2', link: '#' },
  { id: 2, message: 'Notification 2', link: '#' },
  { id: 2, message: 'Notification 2', link: '#' },
  
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

function togglePost(event)
{
  event.preventDefault();
  if(profileSearch)
  {
    profileSearch=false;
    event.target.style.color="red";
  }
  else
  {
    profileSearch=true;
    event.target.style.color="white";
  }
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
      });
    } else {
      const noResults = $('<div>').addClass('no-results').text('No results found');
      searchDropdown.append(noResults);
    }
  }
});