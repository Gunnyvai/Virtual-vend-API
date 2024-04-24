<?php

include './Helpers/DatabaseConfig.php';
include './Helpers/Authenication.php';

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
$userId = getUserId($token);

if (isset($_POST['full_name']) &&

  isset($_POST['phone_number'])) 
  
{
    $fullName = $_POST['full_name'];

    $phoneNumber = $_POST['phone_number'];

    $sql = "UPDATE users SET full_name='$fullName', phone_number='$phoneNumber' WHERE user_id='$userId'";
    $result = mysqli_query($CON, $sql);

    if ($result) {
        echo json_encode(
            array(
                "success" => true,
                "message" => "Profile updated successfully"
            )
        );
    } else {
        echo json_encode(
            array(
                "success" => false,
                "message" => "Failed to update profile"
            )
        );
    }
} else {
    echo json_encode(
        array(
            "success" => false,
            "message" => "Full name, email, and phone number are required fields"
        )
    );
}
?>
