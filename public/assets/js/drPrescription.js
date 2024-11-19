document.addEventListener("DOMContentLoaded", () => {
    const editButton = document.getElementById("edit-button");
    const saveButton = document.getElementById("save-button");
    const medicationsContainer = document.getElementById("medications-container");
    const addMedicationSection = document.getElementById("add-medication");
    const diagnosisText = document.getElementById("diagnosis-text");
    const addMedicationButton = document.getElementById("add-medication-btn");

    // Toggle edit mode
    editButton.addEventListener("click", () => toggleEditMode(true));
    saveButton.addEventListener("click", () => {
        toggleEditMode(false);
        savePrescription();
    });

    // Add medication button
    addMedicationButton.addEventListener("click", () => {
        const medicationRow = document.createElement("div");
        medicationRow.classList.add("medication-row");

        medicationRow.innerHTML = `
            <input type="text" class="med-name">
            <input type="number" class="med-qty">
            <select class="med-measurement">
                <option>mg</option>
                <option>ml</option>
                <option>gtt</option>
                <option>tab</option>
                <option>cap</option>
            </select>
            <select class="med-sig-code1">
                <option>qd</option>
                <option>bd</option>
                <option>tds</option>
                <option>qid</option>
                <option>po</option>
                <option>IV</option>
                <option>ou</option>
                <option>od</option>
                <option>mane</option>
                <option>nocte</option>
            </select>
            <input type="number" class="med-duration-num">
            <select class="med-duration-period">
                <option>365</option>
                <option>52</option>
                <option>12</option>
            </select>
            <button class="delete-medication-btn">Delete</button>
        `;
        medicationsContainer.appendChild(medicationRow);

        // Add delete functionality
        medicationRow.querySelector(".delete-medication-btn").addEventListener("click", () => {
            medicationRow.remove();
        });
    });

    // Toggle edit mode
    function toggleEditMode(isEditMode) {
        const inputs = medicationsContainer.querySelectorAll("input, select, .delete-medication-btn");
        inputs.forEach(input => {
            if (input.tagName === "INPUT") {
                input.readOnly = !isEditMode;
            } else if (input.tagName === "SELECT") {
                input.disabled = !isEditMode;
            } else if (input.classList.contains("delete-medication-btn")) {
                input.style.display = isEditMode ? "inline-block" : "none";
            }
        });

        addMedicationSection.style.display = isEditMode ? "block" : "none";
        diagnosisText.readOnly = !isEditMode;
        editButton.style.display = isEditMode ? "none" : "inline-block";
        saveButton.style.display = isEditMode ? "inline-block" : "none";
    }

    // Save prescription
    function savePrescription() {
        const medications = [];
        medicationsContainer.querySelectorAll(".medication-row").forEach(row => {
            const medication = {
                name: row.querySelector(".med-name").value,
                qty: row.querySelector(".med-qty").value,
                measurement: row.querySelector(".med-measurement").value,
                sig_code1: row.querySelector(".med-sig-code1").value,
                duration_num: row.querySelector(".med-duration-num").value,
                duration_period: row.querySelector(".med-duration-period").value,
            };
            medications.push(medication);
        });

        console.log("Saved Prescription:", {
            diagnosis: diagnosisText.value,
            medications,
        });
        alert("Prescription saved successfully!");
    }
});
