<?php
session_start();

require_once("productDAO.php");
$product = new productDAO();
$products=$product-> get_products();
require_once("categoryDAO.php");
$category = new categoryDAO();
require_once("clientDAO.php");
$client=new clientDAO();
require_once("adminDAO.php");
$admin=new adminDAO();
require_once("orderDAO.php");
$order=new orderDAO();

//Check if the user is logged in and is an admin
if (isset($_SESSION["admin_username"])) {
    $isAdmin = true;
} elseif (isset($_SESSION["username"])) {
    $isAdmin = false;
} else {
    header("Location: index.php");
    exit();
}

// Establish a database connection (replace these with your actual database details)
require_once("config.php");

// Handle delete clients request
if (isset($_GET["delete_user"])) {
    $user_id = $_GET["delete_user"];

    // Delete client from the database
    $client->delete_client($user_id);

    // Redirect back to the admin panel
    header("Location: adminpan.php");
    exit();
}

// Handle verify user request
if (isset($_GET["verify_user"])) {
    $user_id = $_GET["verify_user"];

    // Update user's valide status to 1 (true)
    $client->verify_client($user_id);

    // Redirect back to the admin panel
    header("Location: adminpan.php");
    exit();
}
// Handle unverify user request
if (isset($_GET["unverify_user"])) {
    $user_id = $_GET["unverify_user"];

    // Update user's valide status to 1 (true)
    $client->unverify_client($user_id);

    // Redirect back to the admin panel
    header("Location: adminpan.php");
    exit();
}


// // Retrieve all for display 
// //$select_users_sql = "SELECT * FROM users";
// $client_result = $conn->query("SELECT * FROM clients");
// //$select_admins_sql = "SELECT * FROM admins";
// $admins_result = $conn->query("SELECT * FROM admins");
// $order_result = $conn->query("SELECT orders.id, orders.creation_date, clients.fullname 
//                                 FROM orders  INNER JOIN clients 
//                                 ON orders.client_id=clients.id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="assets\CSS\style.css">
    <link rel="stylesheet" href="assets\CSS\home.css">
    <link rel="stylesheet" href="assets\CSS\basket.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>
<!--style="background: linear-gradient(to bottom, #6ab1e7,#023364)"-->
<body>
<nav class="navbar navbar-expand-sm navbar-dark z-1">
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
                        
                        $displayName = '';
                        $isAdmin = false;
                    
                        if (isset($_SESSION["admin_username"])) {
                        $displayName = $_SESSION["admin_username"];
                        $isAdmin = true;
                        } elseif (isset($_SESSION["username"])) {
                        $displayName = $_SESSION["username"];
                        $isAdmin = false;
                        } if (empty($displayName)) {
                            echo '<a href="login.php">Login</a>';
                        } else {
                        ?>
                        <div class="userinfo">
                            <img src="assets/pics_electro/user_av.png" alt="user">
                            <h2>
                                <?php echo $displayName; ?>
                            </h2>
                            <hr>
                            <?php
                            if ($isAdmin) {
                                echo '<a href="adminpan.php">Admin Panel </a><br>';
                            }
                            echo '<a href="logout.php">Logout</a>'; 
                            ?>
                                
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Admin Panel</h2>
        <h3 class="mb-4 text-center">Clients</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $clients = $client->get_client();
                foreach ($clients as $cl) {
                    echo "<tr>";
                    echo "<td>".$cl->getId()."</td>";
                    echo "<td>".$cl->getUsername()."</td>";
                    echo "<td>".$cl->getE_mail()."</td>";
                    if ($cl->getActiv_account()==0){
                        echo "<td>unvalide</td>";
                    }else{
                        echo "<td>valide</td>";
                    }
                    echo "<td>";
                    echo "<a href='adminpan.php?delete_user=".$cl->getId()."' class='btn btn-danger btn-sm mr-2'>Delete</a>";
                    if ( $cl->getActiv_account() == 0) {
                        echo "<a href='adminpan.php?verify_user=".$cl->getId()."' class='btn btn-success btn-sm mr-2'>Verify</a>";
                    }
                    if ( $cl->getActiv_account() == 1) {
                        echo "<a href='adminpan.php?unverify_user=".$cl->getId()."' class='btn btn-warning btn-sm mr-2'>Unverify</a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-5">
        <h3 class="mt-5 text-center">Admins</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $admins = $admin->get_admin();
                foreach ($admins as $ad) {
                    echo "<tr>";
                    echo "<td>".$ad->getId()."</td>";
                    echo "<td>".$ad->getUsername()."</td>";
                    echo "<td>".$ad->getEmail()."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-5">
        <h3 class="mt-5 text-center">Orders</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <td>Order</td>
                    <td>order's date</td>
                    <td>client name</td>
                    <td>detail</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $orders = $order->get_order();
                    foreach ($orders as $or) {
                        echo "<tr>";
                        echo "<td>".$or->getId()."</td>";
                        echo "<td>".$or->getCreation_date()."</td>";

                        echo "<td>".$client->get_client_by_id($or->getId())->getFull_name()."</td>";
                        echo "<td>";
                        echo "<a href='order_detail.php?reference=".$or->getId()."' class='btn btn-info btn-sm mr-2'>Detail</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

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
