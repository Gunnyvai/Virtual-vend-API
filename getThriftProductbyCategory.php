
<?php
include './Helpers/DatabaseConfig.php';
include './Helpers/Authenication.php';


if(isset($_POST['category_id'])) {
    
    $category = $_POST['category_id'];


    $sql = "SELECT * FROM products 
            JOIN categories ON categories.category_id = products.category_id 
            WHERE products.is_available = 1 
            AND products.is_thrift = 1  
            AND products.category_id = '$category'";

    
    $result = mysqli_query($CON, $sql);

    
    $products = [];

    
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

   
    if ($result) {
     
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
    
    echo json_encode(
        array(
            "success" => false,
            "message" => "Category ID is not provided!"
        )
    );
}
?>
