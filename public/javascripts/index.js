var conn = new WebSocket('ws://localhost:8080');
const form = document.getElementsByTagName('form')[0];

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const room_id = urlParams.get('room_id')
const username = urlParams.get('username')

conn.onopen = function(e) {
    console.log("Connection established!");
    conn.send(JSON.stringify({'initial_room_connection': room_id}));
};


conn.onmessage = function(e) {
    console.log(e.data);
    const chat = document.getElementById('chat');
    const li = document.createElement('li');
    li.innerText = e.data;
    chat.append(li);
};

// form set on submit event to send message to server via websocket connection
form.addEventListener('submit', (e) => {
    e.preventDefault();
    let message = document.getElementById('message').value;
    message = `${username}: ${message}`;
    
    console.log(message);
    conn.send(JSON.stringify({'room_id': room_id, 'message': message}));
    document.getElementById('message').value = '';
});

