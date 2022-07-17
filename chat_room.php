<?php 
define("GREETING", $_GET['room_id']);

echo "room_id:" . constant("GREETING");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/autobahn/20.9.2/autobahn.min.js" integrity="sha512-wLzEpAfAcoLHwRhaD+wEMEMSdqzjyl62fEsVoEjjJh7+uoLtUykY4eEYHaoQW3yHBOSnYEy3aziXeQ72rUBa9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
</head>
<body>
    <h1>Chat App</h1> 
    <br>
    <form action="" method="POST">
        <label for="message"></label>
        <input type="text" id="message" name="message" placeholder="Type your message here">
        <input type="submit" value="Send">
    </form>
    <div>
        <ul id="chat">

        </ul>
    </div>
</body>
    <script src="public/javascripts/index.js"></script>
</html>