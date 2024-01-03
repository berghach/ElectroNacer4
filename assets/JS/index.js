
let subMenu = document.getElementById("subMenu");
var userPic = document.querySelector('.user-pic');
userPic.addEventListener('click', function(){
    console.log("clicked");
    subMenu.classList.toggle("menuwrpopen");
});

