<?php
session_start();


require_once("Client.php"); //client class file
require_once("clientDAO.php"); //DAO for client management

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $phonenumber = $_POST["phonenumber"];
    $adresse = $_POST["adresse"];
    $city = $_POST["city"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    function isValidPhoneNumber($phoneNumber) {
        $pattern = '/^\+\d{1,3}\s\(\d{1,}\)\s\d{1,}-\d{1,}$/';
        return preg_match($pattern, $phoneNumber) === 1;
    }

    // Validation errors array
    $errors = [];

    // Validation
    if (empty($fullname)) {
        $errors['fullname'] = "Error: Full Name is required.";
    }
     
    if ($password !== $confirm_password) {
        $errors['password'] = "Error: Passwords do not match.";
    }

    if (!isValidEmail($email)) {
        $errors['email'] = "Error: Invalid email address.";
    }

    if (!isValidPhoneNumber($phonenumber)) {
        $errors['phonenumber'] = "Error: Invalid phone number.";
    }

    // If there are errors, store them in the session variable
    if (!empty($errors)) {
        $_SESSION['register_errors'] = $errors;
        header("Location: signup.php");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $client = new Client(0, $fullname, $adresse, $city, $phonenumber, $username, $email, $hashed_password, 0);
    $cldao = new clientDAO();

   
    $cldao->insert_client($client);
    
    
}
?>
