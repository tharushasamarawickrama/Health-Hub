let currentFocusedField = null; // Variable to track the currently focused field

// Function to validate all required fields in the specified section
function isSectionValid(sectionId) {
    let isValid = true;

    // Validate all fields in the specified section
    document.querySelectorAll(`#${sectionId} input`).forEach(input => {
        const config = inputFields.find(field => field.fieldName === input.name);
        if (config) {
            const isFieldValid = validateField(input, config.regex, config.errorId, config.message);
            if (!isFieldValid) isValid = false;
        }
    });

    // Confirm password validation in personalInfoSection
    if (sectionId === "personalInfoSection") {
        const passwordField = document.querySelector("input[name='Password']");
        const confirmPasswordField = document.querySelector("input[placeholder='Confirm Password']");
        const isConfirmPasswordValid = validateConfirmPassword(passwordField, confirmPasswordField);
        if (!isConfirmPasswordValid) isValid = false;
    }

    return isValid;
}

// Function to navigate to the next section
function nextSection(currentSectionId, nextSectionId) {
    console.log(`Navigating from ${currentSectionId} to ${nextSectionId}`); // Debug log
    if (isSectionValid(currentSectionId)) { // Validate the current section before navigating
        document.querySelectorAll('.form-section').forEach(el => el.classList.remove('active'));
        document.getElementById(nextSectionId).classList.add('active');
        console.log(`${nextSectionId} is now active`); // Debug log
    } else {
        alert("Please fill out all required fields before proceeding to the next section.");
    }
}

// Previous section function remains the same
function prevSection(sectionId) {
    document.querySelectorAll('.form-section').forEach(el => el.classList.remove('active'));
    document.getElementById(sectionId).classList.add('active');
}

// Validation function for individual fields
function validateField(field, regex, errorId, message) {
    const errorElement = document.getElementById(errorId);
    if (!regex.test(field.value.trim())) {
        errorElement.textContent = message;
        field.classList.add("invalid");
        return false; // Return false if invalid
    } else {
        errorElement.textContent = "";
        field.classList.remove("invalid");
        return true; // Return true if valid
    }
}

// Clear error message on focus
function clearErrorOnFocus(field, errorId) {
    field.addEventListener("focus", () => {
        if (currentFocusedField === field) {
            const errorElement = document.getElementById(errorId);
            errorElement.textContent = "";
            field.classList.remove("invalid");
        }
    });
}

// Password confirmation validation function
function validateConfirmPassword(passwordField, confirmPasswordField) {
    const confirmPasswordError = document.getElementById("confirmPasswordError");

    if (passwordField.value !== confirmPasswordField.value) {
        confirmPasswordError.textContent = "Passwords do not match.";
        confirmPasswordField.classList.add("invalid");
        return false; // Return false if they don't match
    } else {
        confirmPasswordError.textContent = "";
        confirmPasswordField.classList.remove("invalid");
        return true; // Return true if they match
    }
}

// Input field configurations
const inputFields = [
    { fieldName: "FirstName", regex: /^[A-Za-z]+$/, errorId: "firstNameError", message: "Please enter a valid first name." },
    { fieldName: "LastName", regex: /^[A-Za-z]+$/, errorId: "lastNameError", message: "Please enter a valid last name." },
    { fieldName: "Email", regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/, errorId: "emailError", message: "Please enter a valid email address." },
    { fieldName: "PhoneNumber", regex: /^\d{10}$/, errorId: "phoneError", message: "Please enter a valid 10-digit phone number." },
    { fieldName: "NIC", regex: /^(?:\d{9}[vVxX]|\d{12})$/, errorId: "nicError", message: "Please enter a valid NIC number." },
    { fieldName: "Password", regex: /^.{8,}$/, errorId: "passwordError", message: "Password must be at least 8 characters long." },
    { fieldName: "Age", regex: /^[0-9]+$/, errorId: "ageError", message: "Please enter a valid age." },
    { fieldName: "Address", regex: /.+/, errorId: "addressError", message: "Please enter an address." }
];

// Apply validation and focus listeners to each input field
inputFields.forEach(({ fieldName, regex, errorId, message }) => {
    const field = document.querySelector(`input[name='${fieldName}']`);

    // Validate field on blur
    field.addEventListener("blur", () => {
        validateField(field, regex, errorId, message);
        currentFocusedField = null; // Reset the current focused field after blur
    });

    // Clear field-specific error on focus
    field.addEventListener("focus", () => {
        currentFocusedField = field; // Set the current focused field
        clearErrorOnFocus(field, errorId);
    });
});

// Confirm Password Validation
const passwordField = document.querySelector("input[name='Password']");
const confirmPasswordField = document.querySelector("input[placeholder='Confirm Password']");

// Validate Confirm Password on blur
confirmPasswordField.addEventListener("blur", () => {
    validateConfirmPassword(passwordField, confirmPasswordField);
});

// Clear Confirm Password error on focus
confirmPasswordField.addEventListener("focus", () => {
    currentFocusedField = confirmPasswordField; // Set the current focused field
    clearErrorOnFocus(confirmPasswordField, "confirmPasswordError");
});

// Form submission event listener
document.getElementById("registrationForm").addEventListener("submit", function(event) {
    let isValid = true; // Flag to track overall validity

    // Clear all previous error messages before validation
    inputFields.forEach(({ errorId }) => {
        const errorElement = document.getElementById(errorId);
        errorElement.textContent = ""; // Clear error messages
    });

    // Validate all fields on form submission
    inputFields.forEach(({ fieldName, regex, errorId, message }) => {
        const field = document.querySelector(`input[name='${fieldName}']`);
        const isFieldValid = validateField(field, regex, errorId, message);
        
        // Check if there's any error in the field
        if (!isFieldValid) {
            isValid = false; // Set isValid to false if any field is invalid
        }
    });

    // Validate the confirm password separately
    const isConfirmPasswordValid = validateConfirmPassword(passwordField, confirmPasswordField);
    if (!isConfirmPasswordValid) {
        isValid = false; // Set isValid to false if confirm password is invalid
    }

    // If any validation fails, prevent the form from submitting
    if (!isValid) {
        event.preventDefault(); // Prevent form submission
    } else {
        // Optionally, you can show a success message or redirect the user after successful submission
        // alert("Form submitted successfully!"); // Uncomment to show a success message
    }
});

// Event listener for the New User button
document.getElementById("newUserButton").addEventListener("click", function(event) {
    event.preventDefault(); // Prevents default form submission behavior
    nextSection("loginSection", "personalInfoSection"); // Transitions from login to personal info section
});

// Add the validation to the "Next" button in Personal Information Section
document.querySelector('#personalInfoSection .regbutton[onclick*="nextSection"]').addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default button action
    nextSection("personalInfoSection", "additionalInfoSection"); // Validate and go to Additional Info
});

// Add the validation to the "Next" button in Additional Information Section
document.querySelector('#additionalInfoSection .regbutton[onclick*="nextSection"]').addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default button action
    nextSection("additionalInfoSection", "successSection"); // Validate and go to Success Section
});
