<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background: linear-gradient(to bottom, #6ab1e7,#023364)">

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

<?php
// Establish your database connection
include("config.php");
// Function to fetch all products
function fetchProducts() {
    global $conn;
    $sql = "SELECT * FROM Products WHERE bl = true";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Function to display product details in a form
function displayProductDetails($productId) {
    global $conn;
    $sql = "SELECT * FROM Products WHERE reference = $productId";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}

// Function to update product details
function updateProduct($productId, $productName, $barcode, $purchasePrice, $finalPrice, $priceOffer, $descrip, $minQuantity, $stockQuantity) {
    global $conn;
    $sql = "UPDATE Products SET productname='$productName', barcode='$barcode', purchase_price=$purchasePrice, final_price=$finalPrice, price_offer=$priceOffer, descrip='$descrip', min_quantity=$minQuantity, stock_quantity=$stockQuantity WHERE reference=$productId";
    
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to delete (hide) a product
function deleteProduct($productId) {
    global $conn;
    $sql = "UPDATE Products SET bl=false WHERE reference=$productId";
    
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Check if a product ID is provided
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    
    // Check if the form is submitted for updating
    if (isset($_POST['update'])) {
        $productName = $_POST['productname'];
        $barcode = $_POST['barcode'];
        $purchasePrice = $_POST['purchase_price'];
        $finalPrice = $_POST['final_price'];
        $priceOffer = $_POST['price_offer'];
        $descrip = $_POST['descrip'];
        $minQuantity = $_POST['min_quantity'];
        $stockQuantity = $_POST['stock_quantity'];
        
        if (updateProduct($productId, $productName, $barcode, $purchasePrice, $finalPrice, $priceOffer, $descrip, $minQuantity, $stockQuantity)) {
            echo "Product updated successfully!";
        } else {
            echo "Error updating product: " . $conn->error;
        }
    }
    
    // Check if the form is submitted for deleting
    if (isset($_POST['delete'])) {
        if (deleteProduct($productId)) {
            echo "Product deleted successfully!";
        } else {
            echo "Error deleting product: " . $conn->error;
        }
    }
    
    // Display product details in a form for editing
    $productDetails = displayProductDetails($productId);
    if ($productDetails) {
?>
<div class="container">
<form method="post" action="" class="bg-light p-4 rounded formedit my-5">
    <h2 class="mb-4 text-center">Edit Product</h2>

    <div class="mb-3">
        <label for="productName" class="form-label">Product Name:</label>
        <input type="text" class="form-control form-control-sm" id="productName" name="productname" value="<?php echo $productDetails['productname']; ?>">
    </div>

    <div class="mb-3">
        <label for="barcode" class="form-label">Barcode:</label>
        <input type="text" class="form-control form-control-sm" id="barcode" name="barcode" value="<?php echo $productDetails['barcode']; ?>">
    </div>

    <div class="mb-3">
        <label for="purchasePrice" class="form-label">Purchase Price:</label>
        <input type="text" class="form-control form-control-sm" id="purchasePrice" name="purchase_price" value="<?php echo $productDetails['purchase_price']; ?>">
    </div>

    <div class="mb-3">
        <label for="finalPrice" class="form-label">Final Price:</label>
        <input type="text" class="form-control form-control-sm" id="finalPrice" name="final_price" value="<?php echo $productDetails['final_price']; ?>">
    </div>

    <div class="mb-3">
        <label for="priceOffer" class="form-label">Price Offer:</label>
        <input type="text" class="form-control form-control-sm" id="priceOffer" name="price_offer" value="<?php echo $productDetails['price_offer']; ?>">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control form-control-sm" id="description" name="descrip"><?php echo $productDetails['descrip']; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="minQuantity" class="form-label">Min Quantity:</label>
        <input type="text" class="form-control form-control-sm" id="minQuantity" name="min_quantity" value="<?php echo $productDetails['min_quantity']; ?>">
    </div>

    <div class="mb-3">
        <label for="stockQuantity" class="form-label">Stock Quantity:</label>
        <input type="text" class="form-control form-control-sm" id="stockQuantity" name="stock_quantity" value="<?php echo $productDetails['stock_quantity']; ?>">
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary" name="update">Update</button>
        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
    </div>
    
<a href="items.php">View All Items</a>
</form>

</div>
<?php
    } else {
        echo "Product not found!";
    }
} 
?>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "delete" button is clicked
    if (isset($_POST['delete'])) {
        $reference = $_POST['reference'];

    require_once("config.php");

        // Update the 'bl' column to false (0)
        $sql = "UPDATE Products SET bl = 0 WHERE reference = $reference";

        if ($conn->query($sql) === TRUE) {
            echo "Item deleted successfully.";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
}
?>

<footer class=" bg-primary text-light text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 Copyright:ElectroNacer
    </div>

  </footer>

    <!--icones component-->
    <!--  <ion-icon name=""></ion-icon>  -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!--/icones component-->


<script src="index.js"></script>
</body>
</html>
