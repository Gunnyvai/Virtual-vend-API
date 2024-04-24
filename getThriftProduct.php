<?php
include './Helpers/DatabaseConfig.php';
include './Helpers/Authenication.php';


global $CON;


$sql = "SELECT products.*, categories.category_title, users.user_id, users.full_name, users.email ,users.phone_number
        FROM products
        JOIN categories ON categories.category_id = products.category_id
        JOIN users ON users.user_id = products.user_id
        WHERE products.is_available = 1 AND products.is_thrift = 1";

$result = mysqli_query($CON, $sql);

$categories = [];

while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}

if ($result) {
    echo json_encode(
        array(
            "success" => true,
            "message" => "Products fetched successfully!",
            "data" => $categories
        )
    );
} else {
    echo json_encode(
        array(
            "success" => false,
            "message" => "Something went wrong!"
        )
    );
}