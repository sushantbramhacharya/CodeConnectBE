 function makeGeekAjaxRequest(event,geekers_uid,discussion_id) {
  // Prevent the default link behavior
  event.preventDefault();
    // Make an AJAX request to the PHP script
     $.ajax({
      url: "../components/post_scripts/geek.php",
      method: "POST", // Or "GET" depending on your needs
      data: {
        geekers_uid,
        discussion_id,
        geeking:"true"
      }, // You can pass data to the PHP script here if needed
      success: function(response) {
        // Handle the response from the PHP script here (if required)
        window.location.reload();
      },
      error: function(xhr, status, error) {
        // Handle errors, if any
        console.error(error);
      }
    });
  }

  