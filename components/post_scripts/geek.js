function geekFetch(discussion_id){
  $.ajax({
  url: "../components/post_scripts/geek.php",
  method: "POST", // Or "GET" depending on your needs
  data: {
    discussion_id:discussion_id,
    geeking:"false"
  }, // You can pass data to the PHP script here if needed
  success: function(response) {
    document.getElementById(discussion_id).innerHTML="Geeked By";
    // Handle the response from the PHP script here (if required)
    const data = JSON.parse(response);
    data.map((geeker,index)=>{
          if(geeker.Name)
          {
            if(index<data.length-2)
            {
              document.getElementById(discussion_id).innerHTML+=" "+geeker.Name+",";
            }else{
              document.getElementById(discussion_id).innerHTML+=" "+geeker.Name;
            }
          }
          else if(parseInt(geeker.count)>0){
            document.getElementById(discussion_id).innerHTML+=" and "+geeker.count+" Others";
          }
    })
    
    ;
},
error: function(xhr, status, error) {
  // Handle errors, if any
  console.error(error);
}
});
}

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
        geekFetch(discussion_id);
      },
      error: function(xhr, status, error) {
        // Handle errors, if any
        console.error(error);
      }
    });
  }

