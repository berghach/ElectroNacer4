<?php
require_once("clientDAO.php");
$client = new clientDAO();
$clients = $client->get_client();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>admin panel</title>
</head>
<body>
    <!--navigation bar-->
    <header class="" id="site_header">
        <nav>
            <div class="logo">
                <a href="home.php">
                    <p>ELECTRO</p>
                    <p>NACER</p>
                </a>
            </div>
            <div id="topnav">
                <a class="active" href="home.php">Home</a>
                <a href="">Categories</a>
                <a href="#subscribe">Order</a>
            </div>
            <div class="">
                <ion-icon name="search-outline"></ion-icon>
                <ion-icon name="bag-outline"></ion-icon>
                <ion-icon name="person-outline"></ion-icon>
                <!-- condition -->
                <ion-icon name="log-in-outline"></ion-icon>
                <ion-icon name="log-out-outline"></ion-icon>
                <!-- condition -->
            </div>
        </nav>
    </header>
    <!--/navigation bar-->

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
                    foreach($clients as $Cl) {
                    echo "<tr>";
                    echo "<td>".$Cl->getId()."</td>";
                    echo "<td>".$Cl->getUsername()."</td>";
                    echo "<td>".$Cl->getE_mail()."</td>";
                    if($Cl->getActiv_account()==1){
                        echo "<td class='text-seccess'>valid</td>";
                    }else {
                        echo "<td class='text-danger'>unvalid</td>";
                    }
                    echo "<td>";
                    echo "<a href='adminpan.php?delete_user={$Cl['id']}' class='btn btn-danger btn-sm mr-2'>Delete</a>";
                    if ($Cl->getActiv_account() == 0) {
                        echo "<a href='adminpan.php?verify_user={$Cl['id']}' class='btn btn-success btn-sm mr-2'>Verify</a>";
                    }
                    if ($Cl->getActiv_account() == 1) {
                        echo "<a href='adminpan.php?unverify_user={$Cl['id']}' class='btn btn-warning btn-sm mr-2'>Unverify</a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                    }
                ?>

    <!--footer-->
    <section id="footer">
        <div class="footer1">
            <div class="logo">
                <a href="/homepge.html">
                    <p>ELECTRO</p>
                    <p>NACER</p>
                </a>
            </div>
            <div class="social-pages">
                <ion-icon name="logo-twitter"></ion-icon>
                <ion-icon name="logo-instagram"></ion-icon>
                <ion-icon name="logo-facebook"></ion-icon>
            </div>
        </div>
        <div class="footer2">
            <div>
                <p style="font-weight: bold;">contact us</p>
                <div>
                    <ion-icon name="call-outline"></ion-icon>
                    <p>+1 (0) 234-56798</p>
                </div>
                <div>
                    <ion-icon name="business-outline"></ion-icon>
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                </div>
            </div>
            <div class="except">
                <p style="font-weight: bold;">2023 company</p>
                <p>Privacy Policy</p>
                <p>Privacy Policy</p>
            </div>
        </div>
    </section>
    <!--/footer-->

    <!--icones component-->
    <!--  <ion-icon name=""></ion-icon>  -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!--/icones component-->

    <!--bootstrap-->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!--/bootstrap-->

    <!--JS-->
    <script src="./assets/JS/main.js"></script>
    <!--/JS-->

</body>
</html>