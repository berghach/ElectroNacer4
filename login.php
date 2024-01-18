<?php
session_start();
// require_once("connection.php");//file of connection with database
require_once("clientDAO.php");// file DAO containe client method including get_client()
$client = new clientDAO();
$clients = $client->get_client();
require_once("adminDAO.php");
$admin = new adminDAO();
$admins=$admin-> get_admin();

 // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $userSESSION = array();

    if(!empty($loginUser = $admin->get_admin_by_username($username))) {
        if($password == $loginUser->getPassw()){
            $userSESSION["name"] = $username;
            $userSESSION["role"] = 'admin';
            $_SESSION["User_session"] = $userSESSION;

            header('Location: index.php');
            exit();
        }else{
            $_SESSION['login_error'] = 'Error: password incorrect';
            header("Location: login.php");
            exit();
        }
    }elseif(!empty($loginUser= $client->get_client_by_username($username))) {
        if(password_verify($password,$loginUser->getPsw())){
            $userSESSION["name"] = $loginUser->getFull_name();
            $userSESSION["username"] = $username;
            $userSESSION["role"] = 'client';
            $_SESSION["User_session"] = $userSESSION;

            header('Location: index.php');
            exit();
        }else{
            $_SESSION['login_error'] = 'Error: password incorrect';
            header("Location: login.php");
            exit();
        }
    }else{
        $_SESSION['login_error'] = 'Error: User not found';
        header("Location: login.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\CSS\style.css">
    <link rel="stylesheet" href="assets\CSS\home.css">
    <link rel="stylesheet" href="assets\CSS\basket.css">

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
            <?php
                if (isset($_SESSION['login_error'])) {
                    echo '<div style="color: red; font-weight: bold; text-align: left;">' . $_SESSION['login_error'] . '</div>';
                }
            ?>
            <form class="login-form" action="login.php" method="POST">
                <input class="form-control mb-2" type="text" id="username" name="username" placeholder="Username" required>
                <input class="form-control mb-2" type="password" id="password" name="password" placeholder="Password" required>
                <button class="tso btn btn-primary  mt-4" type="submit">Login</button>
                <hr>
                <div class="signup-link text-center">
                    <p>Don't have an account? </p>
                    <a href="signup.php">Sign up</a>
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
    
    <!--/JS-->
    <?php
    session_destroy();
    ?>
</body>
</html>