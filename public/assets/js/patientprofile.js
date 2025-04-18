// Get the image and file input elements
const profileImage = document.getElementById('profileImage');
const fileInput = document.getElementById('file');

// Add click event listener to the image
profileImage.addEventListener('click', () => {
    // Trigger the file input click
    fileInput.click();
});

// Add change event listener to the file input
fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0]; // Get the selected file

    if (file) {
        // Check if the file is an image
        if (file.type.startsWith('image/')) {
            // Create a FileReader to read the file and preview it
            const reader = new FileReader();
            reader.onload = (e) => {
                // Set the image src to the uploaded file
                profileImage.src = e.target.result;
            };
            reader.readAsDataURL(file); // Read the file as a Data URL
        } else {
            alert('Please upload a valid image file.');
        }
    }
});