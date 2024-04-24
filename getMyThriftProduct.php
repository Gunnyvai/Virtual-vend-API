<?php
include './Helpers/DatabaseConfig.php';
include './Helpers/Authenication.php';

function getMyThriftProduct($user_id) {
    global $CON;
    
    
    $sql = "SELECT * FROM products 
            JOIN categories ON categories.category_id = products.category_id 
            WHERE products.is_available = 1 
            AND products.is_thrift = 1
            AND products.user_id = $user_id"; // Assuming there's a user_id column in the products table
    
    // Execute the query
    $result = mysqli_query($CON, $sql);

    $products = [];

    // Fetch products and store them in an array
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

  
    if ($result) {
        echo json_encode(
            array(
                "success" => true,
                "message" => "Thrift products fetched successfully!",
                "data" => $products
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
}

// Example usage:
$user_id = 123; // Replace 123 with the actual user ID
getMyThriftProduct($user_id);
?>
