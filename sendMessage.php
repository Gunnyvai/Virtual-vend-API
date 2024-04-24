<?php

include './Helpers/DatabaseConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input data
    if (!isset($_POST['sender_id']) || !isset($_POST['receiver_id']) || !isset($_POST['content'])) {
        echo json_encode(array("success" => false, "message" => "Invalid input data"));
        exit;
    }

    $senderID = mysqli_real_escape_string($CON, $_POST['sender_id']);
    $receiverID = mysqli_real_escape_string($CON, $_POST['receiver_id']);
    $content = mysqli_real_escape_string($CON, $_POST['content']);

    // Prepare and execute the SQL statement using prepared statements
    $sql = "INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($CON, $sql);
    mysqli_stmt_bind_param($stmt, "iis", $senderID, $receiverID, $content);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo json_encode(array("success" => true, "message" => "Message sent successfully"));
    } else {
        echo json_encode(array("success" => false, "message" => "Failed to send message"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}



