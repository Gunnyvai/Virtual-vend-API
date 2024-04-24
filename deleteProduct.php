<?php
include './Helpers/DatabaseConfig.php';
include './Helpers/Authenication.php';

if (isset($_POST['token'])) {
    $token = $_POST['token'];
    $isAdmin = isAdmin($token);

    if (!$isAdmin) {
        echo json_encode(array(
            "success" => false,
            "message" => "You are not authorized!"
        ));
        die();
    }

    if (!isset($_POST['product_id'])) {
        echo json_encode(array(
            "success" => false,
            "message" => "Product id is required!"
        ));
        die();
    }

    global $CON;
    $product_id = $_POST['product_id'];

    // Delete the product from the database
    $sql = "DELETE FROM products WHERE product_id = $product_id";
    $result = mysqli_query($CON, $sql);

    if ($result) {
        echo json_encode(array(
            "success" => true,
            "message" => "Product deleted successfully!"
        ));
    } else {
        echo json_encode(array(
            "success" => false,
            "message" => "Product deletion failed!"
        ));
    }
} else {
    echo json_encode(array(
        "success" => false,
        "message" => "Token is required!"
    ));
    die();
}
?>
