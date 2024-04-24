<?php

include './Helpers/Authenication.php';
include './Helpers/DatabaseConfig.php';

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

$isAdmin = isAdmin($token);
$userId = getUserId($token);

if (!isset($_POST['order_id'])) {
    echo json_encode(
        array(
            "success" => false,
            "message" => "Order ID is required!"
        )
    );
    die();
}

$order_id = $_POST['order_id'];

$sql = '';
if ($isAdmin) {
    $sql = "DELETE FROM orders WHERE order_id='$order_id'";
} else {
    $sql = "DELETE FROM orders WHERE order_id='$order_id' AND user_id='$userId'";
}

$result = mysqli_query($CON, $sql);

if ($result) {
    echo json_encode(
        array(
            "success" => true,
            "message" => "Order deleted successfully!"
        )
    );
} else {
    echo json_encode(
        array(
            "success" => false,
            "message" => "Failed to delete order!"
        )
    );
}
