function getGlobalVariable() {
  return sessionStorage.getItem('myGlobalVariable');
}
// Retrieve the variable value from the cookie
function setGlobalVariable(value) {
  sessionStorage.setItem('myGlobalVariable', value);
}

function onLog(message) {
    if (message === 'User not found') {
        alert(message)
    } else {
        if (message === 'Wrong password') {
            alert(message)
        } else {
            if (message === 'Success!') {
                setGlobalVariable("true");
                switchPage("");
            }
        }
    }
}
function checkLogin() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const data = {
        email: email,
        password: password
    };

    fetch('/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(result => {
            onLog(result.message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

let loginBtn = document.getElementById('login');
loginBtn.addEventListener("click", checkLogin)

let forgetBtn = document.getElementById('fgtPassword');
forgetBtn.addEventListener("click", function (){
     switchPage("reset");
})

let backBtn = document.getElementById('back');
backBtn.addEventListener("click", function (){
     window.history.back();
})

let continueBtn = document.getElementById('guestMode');
continueBtn.addEventListener("click", function (){
     switchPage("");
})

let registerBtn = document.getElementById('register');
registerBtn.addEventListener("click", function (){
    switchPage("register");
})