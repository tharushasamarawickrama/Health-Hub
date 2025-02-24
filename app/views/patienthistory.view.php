<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>
<div class="pt-history-maindiv">
    <div class="pt-history-div1">
        <p class="pt-history-div1-h1 pt-thick-underline">Prescription</p>
    </div>
    <div class="pt-history-div1">
        <p class="pt-history-div1-h1">Lab Reports</p>
    </div>
    <div class="pt-history-div1">
        <p class="pt-history-div1-h1">Others</p>
    </div>
</div>
<div id="prescriptionContent" class="content-section">
    <div>
        <?php if (!empty($data)): ?>
            <?php foreach ($data as $index => $item): ?>
                <div class="pt-history-div2-main">
                    <div class="pt-history-div2">
                        <span class="pt-history-span">Prescription-<?php echo $index + 1; ?></span>
                        <span class="pt-history-span">Appo: <?php echo $item['appointment']['appointment_id']; ?></span>
                        <button class="pt-history-button view-button" data-index="<?php echo $index; ?>">View</button>
                       
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No prescriptions found.</p>
        <?php endif; ?>
    </div>
</div>
<div id="labReportsContent" class="content-section" style="display: none;">
    <div>
        <?php if (!empty($data)): ?>
            <?php foreach ($data as $index => $item): ?>
                <div class="pt-history-div2-main">
                    <div class="pt-history-div2">
                        <span class="pt-history-span">Lab Report-<?php echo $index + 1; ?></span>
                        <span class="pt-history-span">Appo: <?php echo $item['appointment']['appointment_id']; ?></span>
                        <button class="pt-history-button">View</button>
                        
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No lab reports found.</p>
        <?php endif; ?>
    </div>
</div>
<div id="otherContent" class="content-section" style="display: none;">
    Other
</div>

<!-- Modal Structure -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <!-- Header Section with Close Button -->
        <div class="modal-header">
            <h4>Prescription Details</h4>
        </div>
        <!-- Body Section -->
        <div class="modal-body">
            <p><strong>Diagnosis:</strong> <span id="modal-diagnosis"></span></p>
            <p><strong>Medications:</strong></p>
            <ul id="modal-medications"></ul>
        </div>
        <!-- Footer Section -->
        <div class="modal-footer">
            <button class="btn-secondary modal-close">Close</button>
            <button class="btn-primary download-pdf-button">Download PDF</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sections = document.querySelectorAll(".pt-history-div1");
        const prescriptionContent = document.getElementById("prescriptionContent");
        const labReportsContent = document.getElementById("labReportsContent");
        const otherContent = document.getElementById("otherContent");

        // Add click event listener to each section
        sections.forEach((section) => {
            section.addEventListener("click", function () {
                // Remove the thick underline from all sections
                sections.forEach((sec) => {
                    sec.querySelector(".pt-history-div1-h1").classList.remove("pt-thick-underline");
                });
                // Add the thick underline to the clicked section
                this.querySelector(".pt-history-div1-h1").classList.add("pt-thick-underline");
                // Hide all content sections
                prescriptionContent.style.display = "none";
                labReportsContent.style.display = "none";
                otherContent.style.display = "none";
                // Show the corresponding content based on the clicked section
                if (this.querySelector(".pt-history-div1-h1").textContent.trim() === "Prescription") {
                    prescriptionContent.style.display = "block";
                } else if (this.querySelector(".pt-history-div1-h1").textContent.trim() === "Lab Reports") {
                    labReportsContent.style.display = "block";
                } else if (this.querySelector(".pt-history-div1-h1").textContent.trim() === "Others") {
                    otherContent.style.display = "block";
                }
            });
        });

        // Handle View button click event
        const viewButtons = document.querySelectorAll(".view-button");
        const modal = document.getElementById("viewModal");
        const modalDiagnosis = document.getElementById("modal-diagnosis");
        const modalMedications = document.getElementById("modal-medications");
        const downloadPdfButton = document.querySelector(".download-pdf-button");

        let currentData = null;

        viewButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const index = this.getAttribute("data-index");
                const item = <?php echo json_encode($data); ?>[index];
                currentData = item;

                // Populate modal with data
                modalDiagnosis.textContent = item.prescription.diagnosis;
                modalMedications.innerHTML = "";
                item.prescriptionMed.forEach((med) => {
                    const li = document.createElement("li");
                    li.textContent = `${med.name} - ${med.quantity} ${med.measurement} - ${med.sig_codes} (${med.duration})`;
                    modalMedications.appendChild(li);
                });

                // Show the modal
                modal.style.display = "block";
            });
        });

        // Handle Download PDF button in modal
        downloadPdfButton.addEventListener("click", function () {
    if (!currentData) return;

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Helper function to split long text into multiple lines
    function splitTextIntoLines(text, maxWidth, fontSize) {
        const words = text.split(' ');
        const lines = [];
        let currentLine = '';

        words.forEach((word) => {
            // Check if adding the next word exceeds the max width
            const testLine = currentLine + word + ' ';
            const testWidth = doc.getTextWidth(testLine); // Get the width of the test line
            if (testWidth < maxWidth) {
                currentLine += word + ' '; // Add the word to the current line
            } else {
                lines.push(currentLine.trim()); // Save the current line
                currentLine = word + ' '; // Start a new line with the current word
            }
        });

        // Add the last line
        if (currentLine.trim()) {
            lines.push(currentLine.trim());
        }

        return lines;
    }

    // Add title
    doc.setFontSize(18);
    doc.text("Prescription Details", 10, 10);

    // Add diagnosis with line wrapping
    doc.setFontSize(14);
    const diagnosis = currentData.prescription?.diagnosis || "No diagnosis provided.";
    const maxWidth = 180; // Maximum width for the text (in mm)
    const fontSize = 14; // Font size for the diagnosis
    const diagnosisLines = splitTextIntoLines(diagnosis, maxWidth, fontSize);

    let yOffset = 20; // Starting Y-coordinate for the diagnosis
    diagnosisLines.forEach((line) => {
        doc.text(line, 10, yOffset); // Render each line
        yOffset += 10; // Increment Y-coordinate for the next line
    });

    // Add medications
    doc.setFontSize(12);
    yOffset += 10; // Add some spacing between diagnosis and medications
    if (currentData.prescriptionMed && currentData.prescriptionMed.length > 0) {
        currentData.prescriptionMed.forEach((med) => {
            const medicationText = `${med.name} - ${med.quantity} ${med.measurement} - ${med.sig_codes} (${med.duration})`;
            const medicationLines = splitTextIntoLines(medicationText, maxWidth, 12);
            medicationLines.forEach((line) => {
                doc.text(line, 10, yOffset); // Render each line
                yOffset += 10; // Increment Y-coordinate for the next line
            });
        });
    } else {
        doc.text("No medications prescribed.", 10, yOffset);
        yOffset += 10;
    }

    // Save the PDF
    doc.save(`Prescription_${currentData.appointment.appointment_id}.pdf`);
});

        // Close modal
        document.querySelector(".modal-close").addEventListener("click", function () {
            modal.style.display = "none";
        });

        // Close modal when clicking outside of it
        window.addEventListener("click", function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
</script>