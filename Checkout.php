<?php
// Start or resume the session
session_start();

require_once("clientDAO.php");// file DAO containe client method including get_client()
$client = new clientDAO();
require_once("Order.php");
require_once("orderDAO.php");
$orderDAO = new orderDAO();
require_once("orderProductModel.php");
$orderprodDAO = new orderProductDAO();
require_once("Product.php");
require_once("productDAO.php");
$productDAO = new productDAO();




// Check if the user is logged in and has a valid session
if ($_SESSION["User_session"]["role"] != 'client') {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit();
}

// Retrieve client_id from the session
$theclient = $client->get_client_by_username($_SESSION["User_session"]["username"]);
$clientId = $theclient->getId();

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON data']);
    exit();
}

try {
    // Calculate the total price based on the items in the cart
    $totalPrice = 0;

    $newOrder = new Order(0, 0, null, null, $totalPrice,0, $clientId);
        // Insert into the orders table
        $orderInsertResult=$orderDAO->add_order($newOrder);

    foreach ($data as $item) {
        $quantity = $item['quantity'];
        $productRef = $item['reference'];

        $productByRef = $productDAO->get_products_by_id($productRef);

        if (!empty($productByRef)) {
            $productPrice = $productByRef->getfinal_price();
            $totalPrice += $productPrice * $quantity;
        } else {
            echo json_encode(['success' => false, 'error' => 'Unable to fetch product price']);
            exit();
        }

        // Insert into the orderproduct table
        $orderProduct = new OrderProduct($lastOrder->getId(), $productRef, $quantity);
        $orderProductInsert = $orderprodDAO->insert_order_product($orderProduct);

        if (!$orderProductInsertResult) {
            // Handle error: Unable to insert into orderproduct table
            echo json_encode(['success' => false, 'error' => 'Unable to insert into orderproduct table']);
            exit();
        }
    }

    

    if ($orderInsertResult) {
        // Get the last inserted order
        $lastOrder = $orderDAO->get_lastOrder();
        // Process the data and insert it into the orderproduct table
        foreach ($data as $item) {
            $productRef = $item['reference'];
            $quantity = $item['quantity'];

            
        }

        echo json_encode(['success' => true, 'order_id' => $orderId]);
    } else {
        // Handle error: Unable to insert into orders table
        echo json_encode(['success' => false, 'error' => 'Unable to insert into orders table']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
