<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/CSS/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Signup ElectroNacer</title>
</head>
<body class="bg-white m-0 overflow-x-hidden">
    
    <section class="container-fluid m-0 p-0 d-sm-flex bg-primary align-items-center">
        <div>
            <img class="img-fluid" style="height: 100vh;" src="./assets/pics_electro/ElectroNacer.png" alt="">
        </div>
        <div class="container-fluid d-flex flex-column align-items-center p-2">
            <h1>Sign up</h1>
            <form class="d-flex flex-column p-4 rounded " action="regist.php" method="post">
                    <input class="form-control mb-2" type="text" id="fullname" name="fullname" placeholder="Full Name" >
                    <?php
                        if (isset($_SESSION['register_errors']['fullname'])) {
                            echo '<div style="color: red; font-weight: bold; text-align: left;">' . $_SESSION['register_errors']['fullname'] . '</div>';
                        }
                    ?>
                    
                    <input class="form-control mb-2" type="text" id="username" name="username" placeholder="Username" >
                    <?php
                        if (isset($_SESSION['register_errors']['username'])) {
                            echo '<div style="color: red; font-weight: bold; text-align: left;">' . $_SESSION['register_errors']['username'] . '</div>';
                        }
                    ?>

                    <input class="form-control mb-2" type="email" id="email" name="email" placeholder="Email" >
                    <?php
                        if (isset($_SESSION['register_errors']['email'])) {
                            echo '<div style="color: red; font-weight: bold; text-align: left;">' . $_SESSION['register_errors']['email'] . '</div>';
                        }
                    ?>

                    <input class="form-control mb-2" type="text" id="phonenumber" name="phonenumber" placeholder="Phone Number" >
                    <?php
                        if (isset($_SESSION['register_errors']['phonenumber'])) {
                            echo '<div style="color: red; font-weight: bold; text-align: left;">' . $_SESSION['register_errors']['phonenumber'] . '</div>';
                        }
                    ?>

                    <input class="form-control mb-2" type="text" id="adresse" name="adresse" placeholder="Address" >
                    <input class="form-control mb-2" type="text" id="city" name="city" placeholder="City" >
                    <input class="form-control mb-2" type="password" id="password" name="password" placeholder="Password" >
                    <input class="form-control mb-2" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" >
                    <button class="btn bg-light mt-4" type="submit">Sign Up</button>
                    <hr>
                    <div class="signup-link text-center">
                        <p>Already have an account? </p>
                        <a href="login.php">Log In</a>
                    </div>
                </form>
            <p class="mt-3">I already have an account: 
                <a class="text-light" href="./login.php">log in</a>
            </p>
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
    <script src="/assets/JS/main.js"></script>
    <!--/JS-->
    <?php
    unset($_SESSION['register_errors']);
    ?>

</body>
</html>