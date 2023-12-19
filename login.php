<?php

require_once("connection.php");//file of connection with database
require_once("clientDAO.php");// file DAO containe client method including get_client()
$client = new clientDAO();
$clients = $client->get_client();
require_once("adminDAO.php");
$admin = new adminDAO();
$admins=$admin-> get_admin();

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!empty($admins)){
        foreach ($admins as $adm){ // Check if it's an admin
            if ($username == $adm->getUsername()) {
                if($password == $adm->getPassw()){

                    $_SESSION["admin_username"] = $username;
                    $_SESSION["is_admin"] = true;
    
                    header("Location: homepage.php");
                    exit();
                }else {
                    echo "Error: Incorrect admin password.";
                }
            }
        }
    }else{
        if (!empty($clients)) { //check if it's the client
            foreach( $clients as $cl){
                if ($username == $cl->getUsername() && password_verify($password, $cl->getPsw())) {
                    $_SESSION["client_username"] = $username;
                    $_SESSION["is_client"] = true;

                    header("Location: homepage.php");
                    exit();
                }else {
                    echo "Error: Incorrect password.";
                }
            }
        } else {
            echo "Error: User not found.";
        }  
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Login ElectroNacer</title>
</head>
<body class="bg-white m-0 overflow-x-hidden">
    
    <section class="container-fluid m-0 p-0 d-sm-flex bg-primary align-items-center">
        <div>
            <img class="img-fluid" style="height: 100vh;" src="./assets/pics_electro/ElectroNacer.png" alt="">
        </div>
        <div class="container-fluid d-flex flex-column align-items-center p-2">
            <h1>Login</h1>
            <form class="login-form" action="login.php" method="POST">
                <h2 class="text-center mb-4">Login</h2>
                <input class="form-control mb-2" type="text" id="username" name="username" placeholder="Username" required>
                <input class="form-control mb-2" type="password" id="password" name="password" placeholder="Password" required>
                <button class="tso btn btn-primary  mt-4" type="submit">Login</button>
                <hr>
                <div class="signup-link text-center">
                    <p>Don't have an account? </p>
                    <a class="text-light" href="signup.php">Sign up</a>
                </div>
            </form>
        </div>

    </section>

    <!--icones component-->
    <!--  <ion-icon name=""></ion-icon>  -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!--/icones component-->

    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!--/bootstrap-->

    <!--JS-->
    <script src="./assets/JS/main.js"></script>
    <!--/JS-->

</body>
</html>