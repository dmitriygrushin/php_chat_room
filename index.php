<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
</head>
<body>
    <h1>Chat App</h1> 
    <br>
    <form action="./chat_room.php" method="GET">
        <label for="username"></label>
        <input type="text" id="username" name="username" placeholder="Type your username here">

        <label for="room_id"></label>
        <input type="text" id="room_id" name="room_id" placeholder="Type your room id here">

        <input type="submit" value="Send">
    </form>
</body>
</html>