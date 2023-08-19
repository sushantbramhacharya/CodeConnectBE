function checkingConnection(reciever_uid,btn_clicked)
{
    $.ajax({
        url: "../components/connections.php",
        method: "GET", 
        data: {
          reciever_uid,
          method:"CHECK"
        }, // You can pass data to the PHP script here if needed
        success: function(response) {
            const resp= JSON.parse(response);
            switch(resp)
                {
                    case "Accepted":
                        $("#connections").html("Connected");
                        break;
                    case "Requested":
                        checkingConnectionRequested(reciever_uid,btn_clicked);
                        break;
                    default:
                        if(btn_clicked)
                        {
                            sendConnection(reciever_uid);
                            $("#connections").html("Connection Requested");
                        }
                }
        },
        error: function(xhr, status, error) {
          // Handle errors, if any
          console.error(error);
        }
      });
}
function checkingConnectionRequested(reciever_uid,btn_clicked)
{
    $.ajax({
        url: "../components/connections.php",
        method: "GET", 
        data: {
          reciever_uid,
          method:"CHECK-REQUEST"
        }, // You can pass data to the PHP script here if needed
        success: function(response) {
            const resp= JSON.parse(response);
            switch(resp)
                {
                    case "requested_by":
                        $("#connections").html("Connection Requested").css("font-size","15px");
                        break;
                    case "requested_to":
                        $("#connections").html("Accept Request").css("font-size","15px");
                        if(btn_clicked)
                        {
                          acceptConnection(reciever_uid);
                          $("#connections").html("Connected");
                        }
                        break;
                }
        },
        error: function(xhr, status, error) {
          // Handle errors, if any
          console.error(error);
        }
      });
}
function acceptConnection(reciever_uid)
{
    $.ajax({
        url: "../components/connections.php",
        method: "POST", // Or "GET" depending on your needs
        data: {
          reciever_uid,
          method:"ACCEPT"
        }, // You can pass data to the PHP script here if needed
        success: function(response) {
          location.reload();
        },
        error: function(xhr, status, error) {
          // Handle errors, if any
          console.error(error);
        }
      });
}
function sendConnection(reciever_uid)
{
    $.ajax({
        url: "../components/connections.php",
        method: "POST", // Or "GET" depending on your needs
        data: {
          reciever_uid,
          method:"SEND"
        }, // You can pass data to the PHP script here if needed
        success: function(response) {
          console.log("Sent");
        },
        error: function(xhr, status, error) {
          // Handle errors, if any
          console.error(error);
        }
      });
}