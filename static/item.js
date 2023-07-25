// JavaScript for the item page interactivity
const decreaseBtn = document.getElementById('decrease-btn');
const increaseBtn = document.getElementById('increase-btn');
const quantityInput = document.getElementById('quantity');

// Handle quantity decrease button click
decreaseBtn.addEventListener('click', () => {
    if (quantityInput.value > 1) {
        quantityInput.value--;
    }
});

// Handle quantity increase button click
increaseBtn.addEventListener('click', () => {
    quantityInput.value++;
});

// Add more interactivity or logic as needed
