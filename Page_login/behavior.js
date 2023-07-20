// Function to handle form submission


function onInputID(event) {
    const studentIdInput = event.target;
    const studentId = studentIdInput.value;

    // Check if student ID is empty (required field)
    if (studentId.trim() === '') {
        studentIdInput.setCustomValidity('Student ID is required.');
        return;
    }

    // Check if student ID matches the desired pattern
    const pattern = /^[0-9]{5}$/;
    if (!pattern.test(studentId)) {
        studentIdInput.setCustomValidity('Student ID should contain only digits and be 5 characters long.');
    } else {
        studentIdInput.setCustomValidity('');
    }

}

function handleSubmit(event) {
    event.preventDefault(); // Prevent form submission from refreshing the page

    // Retrieve form values
    const name = document.getElementById('name').value;
    const studentId = document.getElementById('student-id').value;
    console.log(studentId); // Check if studentId value is correctly retrieved

    // Check if all fields are completed
    if (!name || !studentId || !document.getElementById('cookie-acceptance').checked) {
        alert('Please fill in all fields.');
        return;
    }

    // Validate student ID length
    if (studentId.length !== 5) {
        alert('Student ID should be 5 characters long.');
        return;
    }

    if (!/^\d+$/.test(studentId)) {
        alert('Student ID should contain only digits.');
        return;
    }

    // Convert student ID string into an array of integers
    const studentIdArray = Array.from(studentId).map(Number);

    // Bubble Sort algorithm to sort the student ID array in increasing order
    for (let i = 0; i < studentIdArray.length - 1; i++) {
        for (let j = 0; j < studentIdArray.length - i - 1; j++) {
            if (studentIdArray[j] > studentIdArray[j + 1]) {
                // Swap elements
                const temp = studentIdArray[j];
                studentIdArray[j] = studentIdArray[j + 1];
                studentIdArray[j + 1] = temp;
            }
        }
    }

    // Print the student name, original ID, and sorted ID on the screen
    const result = document.createElement('h2');
    result.textContent = `Student Name: ${name} Original ID: ${studentId} Sorted ID: ${studentIdArray.join('')}`;
    document.body.appendChild(result);
}

// Function to handle Cancel button click
function handleCancel(event) {
    event.preventDefault(); // Prevent form submission from refreshing the page

    // Clear all input fields
    document.getElementById('name').value = '';
    document.getElementById('student-id').value = '';
    document.getElementById('dob').value = '';
    document.getElementById('email').value = '';
    document.getElementById('male').checked = false;
    document.getElementById('female').checked = false;
    document.getElementById('other').checked = false;
    document.getElementById('cookie-acceptance').checked = false;
}


// Attach the handleSubmit function to the form's submit event
const form = document.querySelector('form');
form.addEventListener('submit', handleSubmit);

// Attach the handleCancel function to the Cancel button's click event
const cancelButton = document.querySelector('input[value="Cancel"]');
cancelButton.addEventListener('click', handleCancel);

// // Attach the handleCancel function to the Cancel button's click event
// const studentIdInput = document.getElementById('student-id');
// studentIdInput.addEventListener('input', onInputID);
//
// const nameInput = document.getElementById('name');
// nameInput.addEventListener('input', onInputName);