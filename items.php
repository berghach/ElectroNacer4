<?php
session_start();

require_once("productDAO.php");
$product = new productDAO();
$products=$product-> get_products();
require_once("categoryDAO.php");
$category = new categoryDAO();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <h3>Category</h3>
                <?php
                if ($isAdmin) {
                        echo '<div class="my-2">
                        <a class="btn btn-outline-primary" href=add.php>ADD</a>
                        <a class="btn btn-outline-danger mx-3" href=Manage.php>Manage</a>
                        </div>';
                }
                ?>
          
              
                <div>
                    <label>
                        <input type="checkbox" class="common_selector" id="sort_alphabetically"> Sort Alphabetically
                    </label>
                    <label>
                    <input type="checkbox" class="common_selector" id="stock_filter"> Stock Filter
                    </label>
                    <?php
                        $categories=$category->get_categories();
                        foreach($categories as $cat) {
                            echo '<div class="list-group-item checkbox">';
                            echo '<label>';
                            echo '<input type="checkbox" class="common_selector category" value='.$cat->getCat_name().'>';
                            echo '<img src="./assets/pics_electro/'.$cat->getImg().'" alt="Category Image" style="width: 50px; height: 50px;">';
                            echo $cat->getCat_name();
                            echo '</label>';
                            echo '</div>';
                            
                        }
                    ?>
                    
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <br />
            <div class="input-group mb-3">
                <input type="text" id="search" class="form-control" placeholder="Search by product name">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="searchData()">Search</button>
                </div>
            </div>
            <div class="row filter_data"></div>
            <div class="pagination mt-3" id="pagination-container"></div>
        </div>
    </div>
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



<?php
    // // Check if the POST data contains the 'cartItems' key
    // if(isset($_POST['cartItems'])) {
    //     // Retrieve the JSON string from the POST data
    //     $cartItemsJSON = $_POST['cartItems'];

    //     // Decode the JSON string to a PHP array
    //     $cartItems = json_decode($cartItemsJSON, true);

    //     // Now $cartItems is a PHP array containing the data sent from the client

    //     // You can do whatever you need with the $cartItems array here

    //     // For example, you can loop through the items
    //     foreach ($cartItems as $item) {

    //         $order_id = $item['reference'];  // Replace 'order_id' with the actual key in your item array
    //         $product_ref = $item['reference'];  // Replace 'product_ref' with the actual key in your item array
    //         $quantity = $item['quantity'];  // Replace 'quantity' with the actual key in your item array

    //         $query = "INSERT INTO orderproduct (order_id, product_ref, quantity) VALUES ('$order_id', '$product_ref', '$quantity')";

    //         if ($conn->query($query) === TRUE) {
    //             // Record inserted successfully
    //             echo "Item added to orderproduct table successfully";
    //         } else {
    //             // Handle errors
    //             echo "Error adding item to orderproduct table: " . $conn->error;
    //         }        }


    // }
 ?>
</body>

</html>
