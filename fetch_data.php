<?php
session_start();

require_once("productDAO.php");
$product = new productDAO();
require_once("categoryDAO.php");
$category = new categoryDAO();

$isAdmin = isset($_SESSION['is_admin']);

$products = $product->get_products();
$prodByAlfa = $product->get_products_by_alfa();
foreach($products as $pr){
     $adminButton = $isAdmin ? '<a href="Modify.php?product_id=' . $pr->getRef() . '" class="btn btn-danger btn-sm admin-only-button">Modify</a>' : '';

    echo '<div class="col-sm-6 col-md-4 col-lg-3 mb-4">
        <div class="card h-100 border-0 shadow product-card">
            <a href="product_details.php?reference=' . $pr->getRef() . '" class="text-decoration-none text-dark">
                <img src="assets/pics_electro/' . $pr->getImg() . '" alt="' . $pr->getProd_name() . '" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><a href="#" class="text-decoration-none text-dark">' . $pr->getProd_name() . '</a></h5>
                    <h6 class="card-subtitle mb-2 text-danger">Price: DH' . $pr->getFinal_price() . '</h6>
                    <h6 class="card-subtitle mb-2 text-danger">DISCOUNT: DH ' . $pr->getOffer_price() . '</h6><br>
                    <p class="card-text">
                        <strong>Description:</strong> ' . $pr->getProd_desc() . '<br>
                        <strong></strong> '. $pr->getCategory() .'  <br>
                    </p>
                </div>
                <div class="card-footer bg-white">
                    <button class="btn btn-primary btn-sm add-to-cart"
                            data-product-reference="' . $pr->getRef() . '"
                            data-product-name="' . $pr->getProd_name() . '"
                            data-product-price="' . $pr->getFinal_price() . '"
                            onclick="addToCart(this)">
                        Add to Cart
                    </button>
                    ' . $adminButton . '
                </div>
            </a>
        </div>
    </div>';
}

?>

