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
