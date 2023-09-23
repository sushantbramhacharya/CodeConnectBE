function onSaveClick(event,discussion_id)
{
    event.preventDefault();
    
    var savepost = "../api/save_posts/index.php";
    console.log(discussion_id);
    $.ajax({
        type: "POST",
        url: savepost,
        data: { discussion_id: discussion_id },
        success: function(response) {
            if (response === "success") {
               
                alert("Post saved successfully!");
            } else if (response === "already_saved") {
                alert("Post is already saved.");
            }
            else if (response === "error") {
                alert("Error");
            } else {
                alert(response);
            }
        },
        error: function() {
            alert("An error occurred while making the request.");
        }
    });
}
        