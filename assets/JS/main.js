//these functions redirect the actor to login/signup page
function tologin(){
    window.location.href = "login.php";
}

function tosignup(){
    window.location.href = "signup.php";
}

// Function to display the popup
function showPopup() {
    document.getElementById('userInfoPopup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}

// Function to close the popup
function closePopup() {
    document.getElementById('userInfoPopup').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}

// Event listener for the link
document.getElementById('showPopup').addEventListener('click', function (e) {
    e.preventDefault(); // Prevent the default behavior of the link
    showPopup();
});