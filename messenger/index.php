<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./Code Connect Messenger_files/css" />
  <script src="/code.jquery.com_jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Code Connect Messenger_files/style.css" />
    <title>Code Connect Messenger</title>
    </style>
  </head>
  <body >
    <?php
    session_start();
     $uid = $_SESSION["uid"];
     require_once("../db_connect.php");
    ?>
    <noscript>You need to enable JavaScript to run this app.</noscript>
      <div class="container">
        <div class="nav">
        <i onclick="triggerMenu()" class="fas fa-hamburger fa-2x"></i>
        <h1 class="header-text">
          WELCOME TO CODE CONNECT MESSENGER,
          <a href="../">BACK TO Code Connect</a>
        </h1>
        </div>
        <div class="row">
          <?php require_once("chats.php");?>
          <?php require_once("chat.php");?>
        </div>
      </div>
      <script src="message.js"></script>
  </body>
</html>