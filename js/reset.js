let sendBtn = document.getElementById('sendLink');
    sendBtn.addEventListener("click", function () {
        switchPage("login");})

let backBtn = document.getElementById('back');
backBtn.addEventListener("click", function (){
     window.history.back();
})