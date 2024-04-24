
<?php
include './Helpers/DatabaseConfig.php';
include './Helpers/Authenication.php';

// isset($_POST['category_id']);

// global $CON;

// $category = $_POST['category_id'];


// $sql = "Select * from products join categories on categories.category_id=products.category_id where products.is_available = 1 AND products.is_thrift = 0  AND products.category_id = '$category'" ;
// $result = mysqli_query($CON, $sql);

// $categories = [];

// while ($row = mysqli_fetch_assoc($result)) {
//     $categories[] = $row;
// }

// if ($result) {
//     echo json_encode(
//         array(
//             "success" => true,
//             "message" => "Products fetched successfully!",
//             "data" => $categories
//         )
//     );
// } else {
//     echo json_encode(
//         array(
//             "success" => false,
//             "message" => "Something went wrong!"
//         )
//     );
// }


// Check if category_id is set in the POST request
if(isset($_POST['category_id'])) {
    // Assign category_id to a variable
    $category = $_POST['category_id'];

    // SQL query to select products based on the provided category_id
    $sql = "SELECT * FROM products 
            JOIN categories ON categories.category_id = products.category_id 
            WHERE products.is_available = 1 
            AND products.is_thrift = 0  
            AND products.category_id = '$category'";

    // Execute the query
    $result = mysqli_query($CON, $sql);

    // Array to store fetched products
    $products = [];

    // Fetch data from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    // Check if products were fetched successfully
    if ($result) {
        // Return success response with fetched products
        echo json_encode(
            array(
                "success" => true,
                "message" => "Products fetched successfully!",
                "data" => $products
            )
        );
    } else {
        // Return error response
        echo json_encode(
            array(
                "success" => false,
                "message" => "Something went wrong!"
            )
        );
    }
} else {
    // Return error response if category_id is not provided in the POST request
    echo json_encode(
        array(
            "success" => false,
            "message" => "Category ID is not provided!"
        )
    );
}
?>
