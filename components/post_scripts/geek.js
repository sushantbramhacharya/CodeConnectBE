$(document).ready(
function() {
  // Attach a click event to the anchor tag with the ID "myLink"
  $("#geek").click(
    function(e) {
    e.preventDefault(); // Prevent the default link behavior

    // Make an AJAX request to the PHP script
    $.ajax({
      url: "../components/post_scripts/geek.php",
      method: "POST", // Or "GET" depending on your needs
      data: {}, // You can pass data to the PHP script here if needed
      success: function(response) {
        // Handle the response from the PHP script here (if required)
        document.getElementById("test").innerHTML=response.toString();
      },
      error: function(xhr, status, error) {
        // Handle errors, if any
        console.error(error);
      }
    });


  });
});
