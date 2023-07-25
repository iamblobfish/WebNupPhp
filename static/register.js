let backBtn = document.getElementById('back');
backBtn.addEventListener("click", function (){
     window.history.back();
})

let continueBtn = document.getElementById('guestMode');
continueBtn.addEventListener("click", function (){
     window.location.href = "/";
})