let backBtn = document.getElementById('back');
backBtn.addEventListener("click", function () {
    window.history.back();
})

let continueBtn = document.getElementById('guestMode');
continueBtn.addEventListener("click", function () {
    window.location.href = "/";
})

function submit() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const phone = document.getElementById('phone').value;
    const name = document.getElementById('name').value;
    const surname = document.getElementById('surname').value;
    const age = document.getElementById('age').value;

    const data = {
        'password': password,
        'email': email,
        'phone_number': phone,
        'first_name': name,
        'last_name': surname,
        'age': age,
        'sex': 'none'
    };

    fetch('/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(result => {
            console.log(result.message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

let loginBtn = document.getElementById('login');
loginBtn.addEventListener("click", submit)