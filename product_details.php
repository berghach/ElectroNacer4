<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            
        }

        .product-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>
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
    <div class="product-container mt-3">
        <?php
        include("config.php");

        // Check if the 'reference' parameter is present in the URL
        if (isset($_GET['reference'])) {
            $reference = mysqli_real_escape_string($conn, $_GET['reference']);

            // Fetch product details from the database based on the reference
            $query = "SELECT * FROM Products WHERE reference = '$reference' AND bl = 1";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $product = mysqli_fetch_assoc($result);

                // Display product details
                echo '
                    <div class="row">
                        <div class="col-md-6">
                            <img src="' . $product['imgs'] . '" alt="' . $product['productname'] . '" class="product-image">
                        </div>
                        <div class="col-md-6">
                            <h1>' . $product['productname'] . '</h1>
                            <p><strong>Price:</strong> DH' . $product['final_price'] . '</p>
                            <p><strong>Discount:</strong> DH' . $product['price_offer'] . '</p>
                            <p><strong>Description:</strong> ' . $product['descrip'] . '</p>
                            <p><strong>Category:</strong> ' . $product['category_name'] . '</p>
                            <p>barcode:'.$product['barcode'].'</p>
                            <p>left in stock: ' . $product['stock_quantity'].'</p> 
                        </div>
                    </div>
                    
                    <a href="index.php" class="btn btn-primary mt-3">Back to Products</a>
                ';
            } else {
                echo '<div class="alert alert-danger" role="alert">Product not found.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Invalid request. Please provide a product reference.</div>';
        }
        ?>
    </div>

    <!--icones component-->
    <!--  <ion-icon name=""></ion-icon>  -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!--/icones component-->


    <script src="index.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="assets/js/home.js"></script>

</body>

</html>
