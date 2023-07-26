let logedin = getGlobalVariable();



element = document.getElementById("buy");
itemId = element.getAttribute('data_id')
console.log(itemId)
element.addEventListener("click", function () {
    let idList = sessionStorage.getItem("idList").split(',');
    idList.push('itemId')
})