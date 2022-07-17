# php_chat_room
## Quick and dirty PHP chat room using WebSockets without WAMP.

If you're like me and learning PHP you may have decided to create a chat app as a first project. I found a library called Ratchet but soon realized it's not as noob friendly as Socket.io for Node.js. I couldn't figure out how to use WAMP with Ratchet because the website doesn't even load, so I modified the 'Hello, World' Tutorial to have chat rooms without WAMP (Prob not best practice). 

I didn't .gitignore anything, so there is no need download Composer.

Simply:
```
0. Start your server. I used XAMPP so I use Apache.
1. cd into the bin folder
2. run: php server.php 
3. in the browser goto: localhost/'project-folder-name'/index.php
```


