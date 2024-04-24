<?php

include './Helpers/DatabaseConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $receiverID = $_POST['receiver_id'];

    $sql = "SELECT * FROM messages WHERE receiver_id = '$receiverID'";
    $result = mysqli_query($CON, $sql);

    if ($result) {
        $messages = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
        echo json_encode(array("success" => true, "message" => "Messages fetched successfully", "data" => $messages));
    } else {
        echo json_encode(array("success" => false, "message" => "Failed to fetch messages"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
?>
