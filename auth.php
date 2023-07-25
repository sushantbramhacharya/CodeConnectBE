<?php

require_once("cors.php");
require_once("db_connect.php");
header("Access-Control-Allow-Credentials: true");

// Respond to the preflight request with a 200 OK status code
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
  $data = json_decode(file_get_contents("php://input"), true);

  $email = $data["email"];
  $password = $data["password"];

  $sql = "SELECT * FROM User Where Email='$email';";
    $result=mysqli_query($conn,$sql);
    if($user=mysqli_fetch_assoc($result))
    {
        if($user['password']==$password)
        {
            echo json_encode(array("Success"));
        }
        else
        {
            echo json_encode(array("Wrong Password"));
        }
    }
    else{
        echo json_encode(array("No User"));
    }
    if($password)
  $result = $conn->query($sql);
//   $response = array(
//     "status" => "success",
//     "message" => "Data received and processed successfully.",
//   );

  header("Content-Type: application/json");
//   echo json_encode(array($email,$password));

} else {
  header("HTTP/1.1 405 Method Not Allowed");
  echo "Invalid request method.";
}
?>
