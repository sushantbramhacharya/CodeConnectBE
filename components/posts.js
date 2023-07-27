const postBtn = document.getElementById('postBtn');
const postPopup = document.getElementById('postPopup');
const submitPostBtn = document.getElementById('submitPostBtn');
const cancelPostBtn = document.getElementById('cancelPostBtn');

postBtn.addEventListener('click', function() {
  postPopup.style.display = 'block';
});

submitPostBtn.addEventListener('click', function() {
  // Here, you can handle the logic to submit the post
  // For this example, let's just close the popup
  postPopup.style.display = 'none';
});

cancelPostBtn.addEventListener('click', function() {
  // Close the popup without submitting the post
  postPopup.style.display = 'none';
});
