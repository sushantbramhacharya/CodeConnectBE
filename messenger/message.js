let activeChatUid=0;
let msgData;
function areObjectsEqual(objA, objB) {
    return JSON.stringify(objA) === JSON.stringify(objB);
  }
setInterval(()=>{
    if(activeChatUid!==0&&msgData!==undefined)
    {
        fetch("message.php/?uid="+activeChatUid, 
        {method: 'GET'}
        )
        .then(response => {
            return response.json();
        })
        .then(data=>{
            if(!areObjectsEqual(data,msgData))
            {
                fetchMessage(activeChatUid);
            }
        })
        .catch(error => {
            console.log(error);
        }); 
    }
},500);
function fetchMessage(uid)
{
    if(uid!==0)
    {
        $("#chat-name").text("");
        $(".messages-chat").html("");
    fetch("message.php/?uid="+uid, 
    {method: 'GET'}
    )
        .then(response => {
            return response.json();
        })
        .then(data=>{
            msgData=data;
            activeChatUid=uid;
            let friendName;
            data.forEach(data => {
                displayMessage(data);
                if(data.sender!="me")
                {
                    friendName=data.sender;
                }
            }); 
            $("#chat-name").text($("#chat_"+uid+" div p").text());
        })
        .catch(error => {
            console.log(error);
        });  
    }
}

function displayMessage(data)
{
    let messageElem;
    let width=$(window).width();
    if(width<=747)
    {
        $(".discussions").fadeOut(0);
        $(".chat").fadeIn(1000);
        trigger=false;
    }
    if(data.sender=="me")
    {
        messageElem=`<div class="message ">
        <div class="response">
          <p class="text">${data.message}</p>
        </div>
      </div>`;
    }else{
        messageElem=`<div class="message ">
        <p class="text">
        ${data.message}
        </p>
      </div>`;
    }
    $(".messages-chat").append(messageElem);
    $(".messages-chat").scrollTop($(".messages-chat")[0].scrollHeight);
}
function sendMessage()
{

    if(activeChatUid!==0){
        let uid=activeChatUid;
        let message=$(".write-message").val();
        const formData = new FormData();
        formData.append('reciever', uid);
        formData.append('message', message);
        fetch("message.php", 
        {
        method: 'POST',
        body:formData
        }
        ).then(response => {
                $(".write-message").val("");
                fetchMessage(uid);
            })
            .catch(error => {
                console.log(error);
            });
              
    }
    
}




let trigger=false;
//Styles
function triggerMenu()
{
    if(!trigger)
    {
        $(".chat").fadeOut(0);
        $(".discussions").fadeIn(800);
        trigger=true;
    }
    else{
        $(".discussions").fadeOut(0);
        $(".chat").fadeIn(800);
        trigger=false;
    }
    
}