<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

// Simulate fetched prescription data
$fetchedPrescription = "Take 1 tablet twice daily after meals.";
$isEditable = false; // Toggle this to true when editing

?>

    <div class="dr-prescription-container">
        <a href="#" class="back-arrow"><img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back"></a>
        <div class="prescription-container">
            <h2>Prescription</h2>
            
            <textarea id="prescription-text" 
                    placeholder="Type here... (Prescription displayed if already available)"
                    <?php echo !$isEditable ? 'readonly' : ''; ?>>
                <?php echo $fetchedPrescription ? htmlspecialchars($fetchedPrescription) : ''; ?>
            </textarea>

            <div class="prescription-actions">
                <?php if ($fetchedPrescription && !$isEditable): ?>
                    <button class="prescription-button" id="edit-button" onclick="toggleEdit(true)">Edit</button>
                <?php endif; ?>
                <button class="prescription-button" id="save-button" onclick="savePrescription()" <?php echo ($fetchedPrescription && !$isEditable) ? 'style="display:none;"' : ''; ?>>Save</button>
            </div>
        </div>
    </div>

    <script>
        function toggleEdit(editMode) {
            const textArea = document.getElementById("prescription-text");
            const saveButton = document.getElementById("save-button");
            const editButton = document.getElementById("edit-button");

            if (editMode) {
                textArea.removeAttribute("readonly");
                saveButton.style.display = "inline-block";
                editButton.style.display = "none";
            } else {
                textArea.setAttribute("readonly", true);
                saveButton.style.display = "none";
                editButton.style.display = "inline-block";
            }
        }

        function savePrescription() {
            const prescriptionText = document.getElementById("prescription-text").value;
            // Simulate saving to server here
            alert("Prescription saved: " + prescriptionText);
            toggleEdit(false);
        }
    </script>

<?php require APPROOT . '/views/Components/footer.php'; ?>