<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
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
                    
                        if (isset($_SESSION["User_session"])) {
                        $displayName = $_SESSION["User_session"]["name"];
                        $role = $_SESSION["User_session"]["role"];
                        }else{
                            echo '<a href="login.php">Login</a>';
                        }
                        ?>
                        <div class="userinfo">
                            <img src="assets/pics_electro/user_av.png" alt="user">
                            <h2>
                                <?php echo $displayName; ?>
                            </h2>
                            <hr>
                            <?php
                            if ($role = 'admin') {
                                echo '<a href="adminpan.php">Admin Panel </a><br>';
                            }
                            echo '<a href="logout.php">Logout</a>'; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<?php
include("config.php");
// Function to display category details in a form
function displayCategoryDetails($categoryName) {
    global $conn;
    $sql = "SELECT * FROM Categories WHERE catname = '$categoryName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}

// Function to update category details
function updateCategory($categoryName, $description, $imagePath) {
    global $conn;
    $sql = "UPDATE Categories SET descrip='$description', imgs='$imagePath' WHERE catname='$categoryName'";

    return $conn->query($sql);
}


if (isset($_GET['category_name'])) {
    $categoryName = $_GET['category_name'];

    // Check if the form is submitted for updating
    if (isset($_POST['update'])) {
        $newDescription = $_POST['new_description'];

        // Check if an image file is uploaded
        if ($_FILES['new_image']['error'] == 0) {
            $imagePath = "img/";
            $imageFileName = $_FILES['new_image']['name'];
            $imageFilePath = $imagePath . $imageFileName;

            move_uploaded_file($_FILES['new_image']['tmp_name'], $imageFilePath);
        } else {
            $imagePath = "";
            $imageFilePath = ""; // Set a default value for the case where no image is uploaded
        }

        if (updateCategory($categoryName, $newDescription, $imageFilePath)) {
            echo "Category updated successfully!";
        } else {
            echo "Error updating category: " . $conn->error;
        }
    }
}
    // Display category details in a form for editing
    $categoryDetails = displayCategoryDetails($categoryName);
    if ($categoryDetails) {
?>
    <div class="container">
        <form method="post" action="" enctype="multipart/form-data" class="bg-light p-4 rounded formedit my-5">
            <h2 class="mb-4 text-center">Edit Category</h2>

            <div class="mb-3">
                <label for="new_description" class="form-label">Description:</label>
                <textarea class="form-control form-control-sm" id="new_description" name="new_description"><?php echo $categoryDetails['descrip']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="new_image" class="form-label">Image:</label>
                <input type="file" class="form-control-file" id="new_image" name="new_image">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </div>
        </form>
    </div>
<?php
    } else {
        echo "Category not found!";
    }

?>

<script src="index.js"></script>
</body>
</html>
