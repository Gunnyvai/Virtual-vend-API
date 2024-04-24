<?php
include './Helpers/DatabaseConfig.php';
include './Helpers/Authenication.php';

// if (
//     isset($_POST['title']) &&
//     isset($_POST['token'])

// ) {
//     global $CON;
//     $title = $_POST['title'];
//     $token = $_POST['token'];

//     $checkAdmin = isAdmin($token);

//     if (!$checkAdmin) {
//         echo json_encode(
//             array(
//                 "success" => false,
//                 "message" => "You are not authorized!"
//             )
//         );
//         die();
//     }



//     $sql = "Select * from categories where category_title ='$title'";
//     $result = mysqli_query($CON, $sql);
//     $num = mysqli_num_rows($result);
//     if ($num > 0) {
//         echo json_encode(
//             array(
//                 "success" => false,
//                 "message" => "Categogry title already exists!"
//             )
//         );
//         return;
//     } else {
//         $sql = "INSERT INTO categories (category_title) VALUES ('$title')";
//         $result = mysqli_query($CON, $sql);

//         if ($result) {
//             echo json_encode(
//                 array(
//                     "success" => true,
//                     "message" => "Category added successfully!"
//                 )
//             );
//         } else {
//             echo json_encode(
//                 array(
//                     "success" => false,
//                     "message" => "Something went wrong!"
//                 )
//             );
//         }
//     }
// } else {
//     echo json_encode(
//         array(
//             "success" => false,
//             "message" => "Please fill all the fields!",
//             "required fields" => "token, title"
//         )
//     );
// }

if (
    isset($_POST['title']) &&
    isset($_POST['token'])&&
    isset($_FILES['image']) 

) {
    global $CON;
    $title = $_POST['title'];
    $token = $_POST['token'];


    
    $checkAdmin = isAdmin($token);

    if (!$checkAdmin) {
        echo json_encode(
            array(
                "success" => false,
                "message" => "You are not authorized!"
            )
        );
        die();
    }

    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];

    if ($image_size > 5000000) {
        echo json_encode(
            array(
                "success" => false,
                "message" => "Image size must be less than 5MB!"
            )
        );
        die();
    }

    $image_new_name = time() . '_' . $image_name;

    $upload_path = 'images/' . $image_new_name;

    if (!move_uploaded_file($image_tmp_name, $upload_path)) {
        echo json_encode(
            array(
                "success" => false,
                "message" => "Image upload failed!"
            )
        );
        die();
    }

    $sql = "Select * from categories where category_title ='$title'";
    $result = mysqli_query($CON, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        echo json_encode(
            array(
                "success" => false,
                "message" => "Categogry title already exists!"
            )
        );
        return;
    } else {
        $sql = "INSERT INTO categories (category_title,category_image_url) VALUES ('$title','$upload_path')";
        $result = mysqli_query($CON, $sql);

        if ($result) {
            echo json_encode(
                array(
                    "success" => true,
                    "message" => "Category added successfully!"
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
} else {
    echo json_encode(
        array(
            "success" => false,
            "message" => "Please fill all the fields!",
            "required fields" => "token, title,image"
        )
    );
}
