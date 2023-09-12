<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData);

    if ($data && isset($data->selectedSupermarketIDs) && isset($data->subcategoryId)) {
        // Handle saving selected supermarket IDs and category
        $_SESSION['selectedSupermarketIDs'] = $data->selectedSupermarketIDs;
        // Additional processing if needed
        $response = ['message' => 'Supermarket IDs and product category saved to session'];
    } elseif ($data && isset($data->productId) && isset($data->quantity)) {
        $productId = $data->productId;
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][$productId] = isset($_SESSION['cart'][$productId]) ? $_SESSION['cart'][$productId] + $data->quantity : $data->quantity;
        
        // Calculate the total sum of products in the cart
        $totalSum = array_sum($_SESSION['cart']);
        $_SESSION['totalSumCart'] = $totalSum;
        $response = ['message' => 'Product added to the cart.', 'totalSum' => $totalSum];
    } elseif ($data && isset($data->to_delete_id)) {
        $to_delete = $data->to_delete_id;
        $_SESSION['totalSumCart'] -= $_SESSION['cart'][$to_delete];
        unset($_SESSION['cart'][$to_delete]);
        $response = ['message' => 'Product added to the cart.', 'totalSum' => $_SESSION['totalSumCart']];

    }    
    else {
        $response = ['error' => 'Invalid data'];
    }

    // Send the JSON response including the total sum
    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
