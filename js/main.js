function switchPage(page) {
    window.location.href = "index.php?page=" + page;
}

function showCustomAlert(warning) {
    const customAlertContainer = document.getElementById('customAlertContainer');
    customAlertContainer.style.display = 'flex';
    document.getElementById('warning').textContent = warning
}

// Function to hide the custom alert
function hideCustomAlert() {
    const customAlertContainer = document.getElementById('customAlertContainer');
    customAlertContainer.style.display = 'none';
}

let backBtn = document.getElementById('back');
if (backBtn) {
    backBtn.addEventListener("click", function () {
        window.history.back();
    })
}

function getListFromSessionStorage() {
    // Check if 'itemList' key exists in sessionStorage
    if (sessionStorage.getItem('itemList')) {
        // Retrieve the list and parse it as an array
        console.log('itemList: ' + sessionStorage.getItem('itemList'))

        return JSON.parse(sessionStorage.getItem('itemList'));
    } else {
        // If the key doesn't exist, return an empty array
        return [];
    }
}

function addToItemList(newId) {
    // Get the current list of IDs from sessionStorage
    let itemList = getListFromSessionStorage();

    // Store the updated list back in sessionStorage
    itemList.push(newId);

    sessionStorage.setItem('itemList', JSON.stringify(itemList));
    console.log("id: " + newId);
    sendDataToServer(getListFromSessionStorage())
}

function sendDataToServer(data) {
    let elements;
    if (data != []) {
        elements = data.join(',')
    } else {
        elements = ""
    }
    $.post('index.php?page=cart', {'elements': elements}, function (response) {
        // Logic to handle the response from the server
        console.log(response); // or any other logic you want to apply
    });
    console.log(elements);

}

function delFromItemList(newId) {
    // Get the current list of IDs from sessionStorage
    let itemList = getListFromSessionStorage();
    console.log(itemList)
    console.log(newId)
    // Store the updated list back in sessionStorage
    itemList.splice(itemList.indexOf(newId), 1);

    sessionStorage.setItem('itemList', JSON.stringify(itemList));
    console.log("id: " + newId);
    sendDataToServer(getListFromSessionStorage())
    location.reload()
}

function buy(total) {
    let data = getListFromSessionStorage()
    if (data != []) {
        let elements = data.join(',')
        $.post('index.php?page=cart', {'buy': elements, 'total' : total}, function (response) {
            // Logic to handle the response from the server
            // console.log(response); // or any other logic you want to apply
        });
        console.log(elements);
        sendDataToServer("")
        sessionStorage.setItem('itemList', JSON.stringify([]));
        location.reload()
    }
}

