<?php
    session_start();

require_once("productDAO.php");
$product = new productDAO();
require_once("categoryDAO.php");
$category = new categoryDAO();
require_once("adminDAO.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Electro nacer website for arduino its tools.">
    <meta name="keywords" content="arduino, electro, buy arduino UNO">
    <meta name="author" content="YOUCODE">
    <title>ELECTRO NACER - HOME</title>
    <link rel="stylesheet" href="assets/CSS/home.css">
    <link rel="stylesheet" href="assets/CSS/style.css">
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
    <!-- Welcome section -->
    <section class="home-welcome-section">

        <div class="home-welcome-p-container">
            <p class="home-welcome-p">ELECTRO NACER</p>
        </div>


        <div class="home-welcome-img-container">
            <img class="home-welcome-img" src="assets/pics_electro/ElectroNacer.png">
        </div>

    </section>
    <!-- Welcome section -->




    <!-- HIGH STOCK PRODUCTS  -->
    <h3 style="color: rgb(0, 137, 236); margin: 50px;">
        HIGH STOCK PRODUCTS
        <small class="text-muted">High stock quantity products now</small>
    </h3>
    
        
        <?php
            $products=$product->get_products_by_filter("SELECT * FROM product ORDER BY stock_quant DESC");
            echo '<div class="card-deck" style="margin: 50px;">';
            $limit = 5; 
            $counter = 0; 

            foreach ($products as $prod) {
                if ($counter < $limit) {
                    echo '<div class="card" style="background-color: rgb(169, 201, 223); ">';
                    echo '<img class="card-img-top" src="./assets/pics_electro/'.$prod->getImg().'" alt="Card image cap">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">'.$prod->getProd_name().'</h5>';
                    echo '<p>'.$prod->getProd_desc().'</p>';
                    echo '</div>';
                    echo '</div>';

                    $counter++;
                } else {
                    break;
                }
            }

            echo '</div>';
        ?>

    
    <!-- POPULAR PRODUCTS  -->



    <!-- CATEGORIES  -->
    <h3 style="color: rgb(0, 137, 236); margin: 50px;">
        CATEGORIES
        <small class="text-muted">Many and many categories and special pieces</small>
    </h3>
    <div class="card-deck" style="margin: 50px;">
        
        <?php
            $categories=$category->get_categories();
            echo '<div class="card-deck" style="margin: 50px;">';
            foreach($categories as $cat) {
                echo '<div class="card" style="background-color: rgb(169, 201, 223); ">';
                echo '<img class="card-img-top" src="./assets/pics_electro/'.$cat->getImg().'" alt="Card image cap">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$cat->getCat_name().'</h5>';
                echo '<p class="card-text">'.$cat->getCat_descr().'</p>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        ?>

    </div>
    <!-- CATEGORIES  -->




    <!-- ABOUT US -->
    <h3 style="color: #0096FF; margin: 50px;">
        EXPLORE OUR SUPERPOWERS
        <small class="text-muted">Unleashing Extraordinary Features</small>
    </h3>
    <div class="row" style="margin: 50px;">

        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rare pieces</h5>
              <p class="card-text">Explore the extraordinary with our Rare Pieces collection. Discover unique and hard-to-find electronic gems available exclusively at our store. Elevate your tech experience today.</p>
              <a href="#" class="btn btn-primary">Learn more</a>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Swift Delivery, Exceptional Service</h5>
                <p class="card-text">Experience the convenience of rapid delivery with our commitment to swift service. At ELECTRO-NACER, we prioritize your time, ensuring that your purchases reach your doorstep with speed and efficiency. Our fast delivery service is designed to exceed expectations, bringing your selected items to you in record time.</p>
                <a href="#" class="btn btn-primary">Learn more</a>
              </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">High quality</h5>
                <p class="card-text">Pieces selected with exceptional quality.<br>Our commitment to excellence ensures that each piece is carefully chosen and curated to meet the highest standards. Explore our collection and enjoy the epitome of craftsmanship and durability.</p>
                <a href="#" class="btn btn-primary">Learn more</a>
              </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Peace of Mind with Our Warranty</h5>
                <p class="card-text">At ELECTRO-NACER, we stand behind the quality of our products. Every purchase comes with our commitment to your satisfaction and a comprehensive warranty for your peace of mind.</p>
                <a href="#" class="btn btn-primary">Learn more</a>
              </div>
            </div>
        </div>

      </div>
    <!-- ABOUT US -->




    <!--icones component-->
    <!--  <ion-icon name=""></ion-icon>  -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!--/icones component-->



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



    <script src="assets/JS/index.js"></script>
    <script src="assets/JS/cart.js"></script>
    <script src="assets/JS/filter.js"></script>


</body>
</html>