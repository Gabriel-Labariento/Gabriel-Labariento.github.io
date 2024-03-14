<?php


$product_name = $_POST['product_name'];
$description = $_POST['description'];

$target_dir = '../uploads/products/';
$file_data = $_FILES['img'];

if($file_data['tmp_name'] !== ''){
    
    $file_name= $file_data['name'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = 'product-' . time() . '.' . $file_ext;
    $check = getimagesize($file_data['tmp_name']);
    
    if($check){
        $file_name_value = NULL;
        //upload if image
        if(move_uploaded_file($file_data['tmp_name'], $target_dir . $file_name)){
            //save file name to database
            $file_name_value = $file_name;
        };
    }else {
        //do not move file
    }
    
}


// save the database


try{
    $sql = "UPDATE products 
    SET 
    product_name=?, description=?, img=?
    WHERE id=?";

include('connection.php');

$stmt = $conn->prepare($sql);
$stmt->execute([$product_name, $description, $file_name_value, $pid]);

$response = [
    'success' => true,
    'message' => "<strong>$product_name</strong>Successfully updated the system."
];
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => "Error processing your request."
    ];
}


    echo json_encode($response);