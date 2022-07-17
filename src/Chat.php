<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients; // array of connections
    protected $rooms; // array of room names => array of client ids

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->rooms = array();
        echo "Server started\n";
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    // Adds user to room. If room doesn't exist, create it.
    private function addUserToRoom($conn, $room_id) {
        if (!isset($this->rooms[$room_id])) {
            $this->rooms[$room_id] = array();
            echo 'Room created: ' . $room_id . "\n";
        }
        $this->rooms[$room_id][] = $conn;
        echo "Added user to room! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        $new_msg = json_decode($msg, true);

        if (isset($new_msg['initial_room_connection'])) {
            self::addUserToRoom($from, $new_msg['initial_room_connection']);
        } else {
            // send message to all clients in room
            foreach ($this->rooms[$new_msg['room_id']] as $client) {
                // broadcast message
                // if ($from !== $client) $client->send($new_msg['message']); 

                // send message to all clients in room
                $client->send($new_msg['message']);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        // Remove user from room
        foreach ($this->rooms as $room_id => $room) {
            if (($key = array_search($conn, $room)) !== false) {
                unset($this->rooms[$room_id][$key]);
                echo "Removed user from room! ({$conn->resourceId})\n";
            }
        }

        // if no more users in room, delete room
        foreach ($this->rooms as $room_id => $room) {
            if (empty($room)) {
                unset($this->rooms[$room_id]);
                echo "Deleted room! ({$room_id})\n";
            }
        }

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}