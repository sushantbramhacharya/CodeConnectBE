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


//toggleComments
let comments_toggled=false;
function toggleComments(event,discussion_id,fetch)
{
  event.preventDefault();

if(!comments_toggled)
{
  $("#comments_main_"+discussion_id).fadeIn(500);
  comments_toggled=true;
  $.ajax({
    url: "../components/comments.php", 
    method: "GET", 
    data:{discussion_id:discussion_id},
    dataType: "json", 
    success: function(data) {
      data.forEach(data => {
        $("#comment_input_"+discussion_id).val("");
      $("#comments_"+discussion_id).html("");
        let commentElem;
        if(data.commenter_name==userName)
        {
          commentElem=`<div class="comment" ><p><span class='username'>${data.commenter_name}</span> <span>${data.comment}</span></p><a href="" onclick="deleteComment(event,${data.comment_id},${discussion_id})" style="text-decoration:none;" ">
                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 30 30">
                      <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"></path>
                  </svg>
                  </a>
          </div>
          `
        }else{
          commentElem=`<div class="comment" ><p><span class='username'>${data.commenter_name}</span> <span>${data.comment}</span></p></div>
          `;
        }
      
      $("#comments_"+discussion_id).append(commentElem);
      });
    },
    error: function(xhr, status, error) {
        console.log("Error: " + error);
    }
  });
}
else
{
  $("#comments_main_"+discussion_id).fadeOut(500);
  comments_toggled=false;
}
}

console.log(userName);

function postComment(discussion_id)
{
 let comment=$("#comment_input_"+discussion_id).val();

  $.ajax({
    url: "../components/comments.php", 
    method: "POST",
    data:{comment:comment,discussion_id:discussion_id}, 
    dataType: "json", 
    success: function(data) {
    $("#comment_input_"+discussion_id).val("");
    $("#comments_"+discussion_id).html("");
    data.forEach(data => {
      let commentElem;
        if(data.commenter_name==userName)
        {
          commentElem=`<div class="comment" ><p><span class='username'>${data.commenter_name}</span> <span>${data.comment}</span></p><a href="" onclick="deleteComment(event,${data.comment_id},${discussion_id})" style="text-decoration:none;" ">
                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 30 30">
                      <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"></path>
                  </svg>
                  </a>
          </div>
          `
        }else{
          commentElem=`<div class="comment" ><p><span class='username'>${data.commenter_name}</span> <span>${data.comment}</span></p></div>
          `
        }
      
      $("#comments_"+discussion_id).append(commentElem);
    });
      
    },
    error: function(xhr, status, error) {
        console.log("Error: " + error);
    }
  });
}

function deleteComment(event,comment_id,discussion_id)
{
  event.preventDefault();
  $.ajax({
    url: "../components/comments.php", 
    method: "POST",
    data:{comment_id:comment_id,discussion_id:discussion_id}, 
    dataType: "json", 
    success: function(data) {
    $("#comment_input_"+discussion_id).val("");
    $("#comments_"+discussion_id).html("");
    data.forEach(data => {
      let commentElem;
        if(data.commenter_name==userName)
        {
          commentElem=`<div class="comment" ><p><span class='username'>${data.commenter_name}</span> <span>${data.comment}</span></p><a href="" onclick="deleteComment(event,${data.comment_id},${discussion_id})" style="text-decoration:none;" ">
                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 30 30">
                      <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"></path>
                  </svg>
                  </a>
          </div>
          `
        }else{
          commentElem=`<div class="comment" ><p><span class='username'>${data.commenter_name}</span> <span>${data.comment}</span></p></div>
          `
        }
      
      $("#comments_"+discussion_id).append(commentElem);
    });
      
    },
    error: function(xhr, status, error) {
        console.log("Error: " + error);
    }
  });
}