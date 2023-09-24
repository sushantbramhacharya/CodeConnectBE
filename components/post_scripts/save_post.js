function onSaveClick(event,discussion_id)
{
    event.preventDefault();
    
    var savepost = "../api/save_posts/index.php";
    (function(event){
        $.ajax({
        type: "POST",
        url: savepost,
        data: { discussion_id: discussion_id ,post:true},
        success: function(response) {
            if (response === "success") {
                $(event.target).children().attr('fill', 'grey');
            } else if (response === "deleted") {

                $(event.target).children().attr('fill', 'none');
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
    });})(event);
}
function checkSaved(discussion_id)
{
    element=$("#saved_"+discussion_id);
    let savepost = "../api/save_posts/index.php";
    //Use of closures
    (function(element)
    {$.ajax({
        type: "POST",
        url: savepost,
        data: { discussion_id: discussion_id ,check_saved:true},
        success: function(response) {
            if (response === "already_saved") {
            element.children().attr('fill', 'grey');
            }
            else if (response === "error") {
                alert("Error");
            } else {
                console.log(response);
            }
        },
        error: function() {
            alert("An error occurred while making the request.");
        }
    });})(element);
}


   