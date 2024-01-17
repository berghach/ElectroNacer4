<?php
session_start();

require_once("productDAO.php");
$product = new productDAO();
require_once("categoryDAO.php");
function generateProductCard($pr) {
    $category = new categoryDAO();

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
                            <strong>Category:</strong> '. $category->get_category_by_id($pr->getCategory())->getCat_name() .'  <br>
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


// Search filter
// $searchQuery = mysqli_real_escape_string($conn, $_POST['search_query']);
// $searchFilter = mysqli_real_escape_string($conn, $searchQuery);

// Stock filter
// $stockFilter = isset($_POST['stock_filter']) ? $_POST['stock_filter'] : false;

// Regular query
$query = "SELECT product.* FROM product LEFT JOIN category ON category.id = product.category_fk WHERE product.bl = 1";

if (isset($_POST["category"]) && !empty($_POST["category"])) {
    $category_array = json_decode($_POST["category"], true);

    if (!empty($category_array)) {
        $category_filter = implode(",", $category_array);
        $query .= " AND category.cat_name IN ($category_filter)";
    }
}

if (isset($_POST['search_query']) && !empty($_POST['search_query'])) {
    $searchFilter = $_POST['search_query'];
    $query .= " AND product.prod_name LIKE '". $searchFilter ."%'";
}

if (isset($_POST['stock_filter']) && !empty($_POST['stock_filter'])) {
    $query .= " AND product.stock_quant < product.min_quant";
}
if (isset($_POST['sort_alphabetically']) && !empty($_POST['sort_alphabetically'])) {
    $query .= " ORDER BY product.prod_name ASC";
}else{
    $query .= " ORDER BY RAND()";
}

echo $query;

$products = $product->get_products_by_filter($query);

// $products = $product->get_products();


$total_items = count($products);

if ($total_items > 0) {
    $count = 0;
    while ($count < $limit && $offset<$total_items) {
        echo generateProductCard($products[$offset]);
        $offset++;
        $count++;
    }

    // Generate pagination links for regular query
    $total_regular_pages = ceil($total_items / $limit);
    echo '<ul class="pagination">';
    for ($i = 1; $i <= $total_regular_pages; $i++) {
        echo '<li class="page-item"><a class="page-link pagination-link" href="#" onclick="filter_data(' . $i . ')" id="' . $i . '">' . $i . '</a></li>';
    }
    echo '</ul>';
}else{
    echo '<h5>No result</h5>';
}

?>