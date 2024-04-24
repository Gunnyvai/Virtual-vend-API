<?php

include './Helpers/DatabaseConfig.php';
include './Helpers/Authenication.php';

// Check if token is provided
if (!isset($_POST['token'])) {
    echo json_encode(
        array(
            "success" => false,
            "message" => "You are not authorized!"
        )
    );
    die();
}

global $CON;

$token = $_POST['token'];
$orderId = $_POST['order_id'];
$OrderStatus = $_POST['OrderStatus'];

// Check if the user is authorized to perform this action
if (!isAdmin($token)) {
    echo json_encode(
        array(
            "success" => false,
            "message" => "You are not authorized to perform this action!"
        )
    );
    die();
}

// Update the order status
$sql = "UPDATE orders SET OrderStatus = '$OrderStatus' WHERE order_id = '$orderId'";

if (mysqli_query($CON, $sql)) {
    echo json_encode(
        array(
            "success" => true,
            "message" => "Order status updated successfully!"
        )
    );
} else {
    echo json_encode(
        array(
            "success" => false,
            "message" => "Failed to update order status!"
        )
    );
}
