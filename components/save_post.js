<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

$(document).ready(function() {
    $(".saved-post").on("click", ".saved-post", function(e) {
        e.preventDefault();
        
        var discussionId = $(this).parent().data("discussion_id");
        var savepost = "save_post.php";
        
        $.ajax({
            type: "POST",
            url: savepost,
            data: { discussion_id: discussionId },
            dataType: "text",
            success: function(response) {
                if (response === "success") {
                   
                    alert("Post saved successfully!");
                } else if (response === "already_saved") {
                    alert("Post is already saved.");
                } else {
                    alert("An error occurred while saving the post.");
                }
            },
            error: function() {
                alert("An error occurred while making the request.");
            }
        });
    });
});

