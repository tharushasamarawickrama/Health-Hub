document.addEventListener("DOMContentLoaded", () => {
    const editBtn = document.getElementById("editProfileBtn");
    const saveBtn = document.getElementById("saveProfileBtn");
    const cancelBtn = document.getElementById("cancelEditBtn");
    const formFields = document.querySelectorAll("#profileForm input, #profileForm textarea");

    // Enable editing
    editBtn.addEventListener("click", () => {
        formFields.forEach((field) => field.removeAttribute("readonly"));
        editBtn.style.display = "none";
        saveBtn.style.display = "inline-block";
        cancelBtn.style.display = "inline-block";
    });

    // Save changes
    saveBtn.addEventListener("click", () => {
        const formData = new FormData(document.getElementById("profileForm"));
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });

        fetch("../../../../app/controllers/DrProfile/update", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(jsonData),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert("Profile updated successfully!");
                    location.reload(); // Reload to show updated data
                } else {
                    alert("Failed to update profile: " + data.message);
                }
            })
            .catch((error) => {
                console.error("Error updating profile:", error);
                alert("An error occurred while updating the profile.");
            });
    });

    // Cancel editing
    cancelBtn.addEventListener("click", () => {
        formFields.forEach((field) => field.setAttribute("readonly", true));
        editBtn.style.display = "inline-block";
        saveBtn.style.display = "none";
        cancelBtn.style.display = "none";
    });
});
