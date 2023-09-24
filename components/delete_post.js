function deletePost(event,discussion_id)
{
    event.preventDefault();
    if (confirm("Are you sure you want to delete?")) {
        $.ajax({
            type: "POST",
            url: '../components/delete_post.php',
            data: { discussion_id: discussion_id},
            success: function(response) {
                if (response === "success") {
                    window.location.href = './';
                } else {
                    alert("Error Occured");
                }
            },
            error: function() {
                alert("An error occurred while making the request.");
            }
        });
        } else {
            }
   
}