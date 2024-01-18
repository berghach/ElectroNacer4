<?php
session_start();

//Check if the user is logged in and is an admin
if ($_SESSION["User_session"]["role"] != 'admin') {
    header("Location: index.php");
    exit();
}

require_once("clientDAO.php");// file DAO containe client method including get_client()
$client = new clientDAO();
require_once("orderDAO.php");
$orderDAO = new orderDAO();
require_once("orderProductModel.php");
$orderprodDAO = new orderProductDAO();
require_once("productDAO.php");
$productDAO = new productDAO();

// manage order's status
if (isset($_GET["verify_order"])) {
    $ord_id = $_GET["verify_order"];

    $orderDAO->valid_order($ord_id);
        header("Location: order_detail.php?reference='$ord_id'");
        exit();
}

if (isset($_GET["unverify_order"])) {
    $ord_id = $_GET["unverify_order"];

    $orderDAO->unverify_order($ord_id);
        header("Location: order_detail.php?reference='$ord_id'");
        exit();
}

if (isset($_GET["delete_order"])) {
    $ord_id = $_GET["delete_order"];

    $orderDAO->delete_order($ord_id);
        header("Location: adminpan.php");
        exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order detail</title>
    <link rel="stylesheet" href="assets\CSS\style.css">
    <link rel="stylesheet" href="assets\CSS\home.css">
    <link rel="stylesheet" href="assets\CSS\basket.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-...." crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-expand-sm navbar-dark ">
    <div class="container">
        <a href="#" class="navbar-brand">NE</a>
        
        <!-- Add the burger menu button for smaller screens -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="items.php" class="nav-link">items</a>
                </li>
            </ul>
            <span class="navbar-text">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#cartModal">
                <ion-icon class="fs-4" name="cart-outline"></ion-icon>
            </a>
            </span>
            <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="cartItems">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="checkout()">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
            <ion-icon name="person-outline" class="user-pic text-light fs-4 fw-bold icon-link icon-link-hover"></ion-icon>
            <!-- <img width="48" src="assets/pics_electro/user_av.png" alt="profile" class="user-pic"> -->
            <div class="menuwrp" id="subMenu">
                <div class="submenu">
                    <div class="userinfo">
                        <?php
                            if (isset($_SESSION["User_session"])){
                                echo '<img src="assets/pics_electro/user_av.png" alt="user">';
                                echo "<h2>".$_SESSION["User_session"]["name"]."</h2>"; 
                                echo '<hr>';
                                if ($_SESSION["User_session"]["role"] == 'admin') {
                                    echo '<a href="adminpan.php">Admin Panel </a><br>';
                                }
                                echo '<a href="logout.php">Logout</a>'; 
                            }else{
                                echo '<a href="login.php">Login</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
        <?php

        // Check if the 'reference' parameter is present in the URL
        if (isset($_GET['reference'])) {
            $order_id = $_GET['reference'];
            // Fetch product details from the database based on the reference
            $order = $orderDAO->get_orderByID($order_id);
            $orderProducts = $orderprodDAO->get_ordProducts($order_id);

            if (!empty($order)) {
                // Display order details 
                echo '<div class="row">';
                echo '<div class="container mt-5">';
                echo '<h3 class="mt-5 text-center">Orders detail</h3>';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>order id</th>';
                echo '<th>client name</th>';
                echo '<th>creation date</th>';
                echo '<th>sending date</th>';
                echo '<th>delivring date</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>';
                echo "<td>".$order->getId()."</td>";
                echo "<td>".$client->get_client_by_id($order->getClient_id())->getFull_name()."</td>";
                echo "<td>".$order->getCreation_date()."</td>";
                echo "<td>".$order->getShipping_date()."</td>";
                echo "<td>".$order->getDelivery_date()."</td>";
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
            
                echo '<h4>Ordered products</h4>';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Reference</th>';
                echo '<th>Product</th>';
                echo '<th>Quantity</th>';
                echo '<th>Total price</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach($orderProducts as $row){
                    echo '<tr>';
                    echo "<td>".$productDAO->get_products_by_id($row->get_product_id())->getRef()."</td>";
                    echo "<td>".$productDAO->get_products_by_id($row->get_product_id())->getProd_name()."</td>";
                    echo "<td>".$row->get_quantity()."</td>";
                    $prod_price = $productDAO->get_products_by_id($row->get_product_id())->getfinal_price() * $row->get_quantity();
                    echo "<td>{$prod_price}</td>";
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo "<h5>Order's total Price:".$order->getTotal_price()."</h5>";
                echo '<div class="d-flex align-items-center column-gap-5">';
                echo "<h5>Order's status</h5>";
                if ($order->getBl() == 0) {
                    echo "<p>Unvalid order</p>";
                    echo "<a href='order_detail.php?verify_order=".$order->getId()."' class='btn btn-success btn-sm mr-2'>Valid</a>";
                }else {
                    echo "<p>Valid order</p>";
                    echo "<a href='order_detail.php?unverify_order=".$order->getId()."' class='btn btn-warning btn-sm mr-2'>Unvalid</a>";
                }
                echo '</div>';
                echo "<a href='order_detail.php?delete_order=".$order->getId()."' class='btn btn-danger btn-sm mr-2'>Delete order</a>";
                echo '</div>';
                echo '</div>';
                
                echo '<a href="adminpan.php" class="btn btn-primary mt-3">Back to Panel</a>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Order not found.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Invalid request. Please provide an order reference.</div>';
        }
        ?>

        <!--icones component-->
    <!--  <ion-icon name=""></ion-icon>  -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!--/icones component-->



    <script src="assets\JS\cart.js"></script>
    <script src="assets\JS\filter.js"></script> 
    <script src="assets\JS\index.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
