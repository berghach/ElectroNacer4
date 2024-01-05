<?php
session_start();

require_once("productDAO.php");
$product = new productDAO();
require_once("categoryDAO.php");
$category = new categoryDAO();


$products = $product->get_products();
// $prodByAlfa = $product->get_products_by_alfa();
$prodByStock = $product->get_products_high_stock();
// $prodBycategory = $product->get_products_by_category($c);



function generateProductCard($pr) {
    $isAdmin = isset($_SESSION['is_admin']);

    $adminButton = $isAdmin ? '<a href="Modify.php?product_id=' . $pr->getRef() . '" class="btn btn-danger btn-sm admin-only-button">Modify</a>' : '';

        return '<div class="col-sm-6 col-md-4 col-lg-3 mb-4">
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

if(isset($_POST['page'])) {
    $page = $_POST['page'];
}
$limit = 8;
$offset = ($page - 1) * $limit;



// echo $offset;

/*$sortAlphabetically = isset($_POST['sort_alphabetically']) ? (bool)$_POST['sort_alphabetically'] : false;
if($sortAlphabetically == true) {
    $prodByAlfa = $product->get_products_by_alfa();
    foreach( $prodByAlfa as $row ) {
        echo generateProductCard($row);
    }
}*/

/*if (isset($_POST["category"]) && !empty($_POST["category"])) {
    $category_array = json_decode($_POST["category"], true);
    if (is_array($category_array)) {
        $category_filter = implode("','", $category_array);
        echo "". $category_filter ."";
        foreach ($category_array as $key) {
            $prodBycategory = $product->get_products_by_category($key);
            foreach( $prodBycategory as $row ) {
                echo generateProductCard($row);
            }
        }
    }
}*/


// foreach( $products as $row ) {
// echo generateProductCard($row);
// }
    

?>

