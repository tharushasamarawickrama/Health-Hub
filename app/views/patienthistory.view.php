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
<!-- <?php show($data) ?> -->
<!-- Referral Filter Dropdown -->
<div style="margin: 20px;">
    <label for="referralFilter">Filter by Referral:</label>
    <select id="referralFilter">
        <option value="all">All</option>
        <?php if (!empty($referaluser)): ?>
            <?php foreach ($referaluser as $referal): ?>
                <option value="<?= $referal['referal_id'] ?>"><?= $referal['p_firstName'] . ' ' . $referal['p_lastName'] ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
</div>
<!-- Content Sections -->
<div id="prescriptionContent" class="content-section">
    <?php if (!empty($data)): ?>
        <?php foreach ($data as $index => $item): ?>
            <div class="pt-history-div2-main" data-referal-id="<?= $item['appointment']['referal_id'] ?>">
                <div class="pt-history-div2">
                    <span>Date-<?= $item['appointment']['appointment_date'] ?>, <span><?= $item['schedule']['weekday'] ?></span></span>

                    <span class="pt-history-span">Prescription-<?= $index + 1 ?></span>
                    <span class="pt-history-span">Appo: <?= $item['appointment']['appointment_id'] ?></span>
                    <button class="pt-history-button view-button" data-index="<?= $index ?>">View</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="patienthistorynopresc">No prescriptions found.</p>
    <?php endif; ?>
</div>

<div id="labReportsContent" class="content-section" style="display: none;">
    <!-- Lab Reports Display -->
    <?php if (!empty($data)): ?>
        <?php foreach ($data as $index => $item): ?>
            <div class="pt-history-div2-main" data-referal-id="<?= $item['appointment']['referal_id'] ?>">
                <div class="pt-history-div2">
                    <span class="pt-history-span">Lab Report-<?= $index + 1 ?></span>
                    <span class="pt-history-span">Appo ID: <?= $item['appointment']['appointment_id'] ?></span>
                    <div class="lab-report-details">
                        <?php foreach ($item['appointmentlabtest'] as $labTest): ?>
                            <div class="lab-test-item">
                                <span class="pt-history-span">Test: <?= $labTest['labtest_pdfname'] ?></span>

                                <?php foreach ($item['labtest'] as $labtest1): ?>
                                    <?php if ($labtest1['labtest_id'] == $labTest['labtest_id']): ?>
                                        <span class="pt-history-span"><?php echo $labtest1['labtest_name'] ?></span>
                                        <span class="pt-history-span"><?php echo $labtest1['labtest_category'] ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <a href="<?= URLROOT . '/' . $labTest['labtest_report'] ?>" class="pt-history-button" target="_blank">View</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="patienthistorynopresc">No lab reports found.</p>
    <?php endif; ?>
</div>


<div id="otherContent" class="content-section" style="display: none;">
    <!-- Medical History Display -->
    <?php if (!empty($data)): ?>
        <?php foreach ($data as $index => $item): ?>
            <div class="pt-history-div2-main" data-referal-id="<?= $item['appointment']['referal_id'] ?>">
                <div class="pt-history-div2">
                    <span class="pt-history-span">Medical History-<?= $index + 1 ?></span>
                    <span class="pt-history-span">Appo ID: <?= $item['appointment']['appointment_id'] ?></span>
                    <div class="other-details">
                        <h4>Patient Medical History</h4>
                        <?php
                        $medicalHistory = json_decode($item['patient'][0]['medical_history'], true);
                        ?>
                        <p><strong>Allergies:</strong></p>
                        <?php if (!empty($medicalHistory['allergies'])): ?>
                            <ul>
                                <?php foreach ($medicalHistory['allergies'] as $allergy => $reaction): ?>
                                    <li><?= $allergy ?>: <?= $reaction ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No allergies reported.</p>
                        <?php endif; ?>

                        <p><strong>Chronic Conditions:</strong></p>
                        <?php if (!empty($medicalHistory['chronic_conditions'])): ?>
                            <ul>
                                <?php foreach ($medicalHistory['chronic_conditions'] as $condition): ?>
                                    <li><?= $condition ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No chronic conditions reported.</p>
                        <?php endif; ?>

                        <p><strong>Past Surgeries:</strong></p>
                        <?php if (!empty($medicalHistory['past_surgeries'])): ?>
                            <ul>
                                <?php foreach ($medicalHistory['past_surgeries'] as $surgery): ?>
                                    <li><?= $surgery ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No past surgeries reported.</p>
                        <?php endif; ?>

                        <p><strong>Immunizations:</strong></p>
                        <?php if (!empty($medicalHistory['immunizations'])): ?>
                            <ul>
                                <?php foreach ($medicalHistory['immunizations'] as $immunization): ?>
                                    <li><?= $immunization ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No immunizations reported.</p>
                        <?php endif; ?>

                        <p><strong>Family Medical History:</strong></p>
                        <?php if (!empty($medicalHistory['family_medical_history'])): ?>
                            <ul>
                                <?php foreach ($medicalHistory['family_medical_history'] as $relative => $condition): ?>
                                    <li><?= $relative ?>: <?= $condition ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No family medical history reported.</p>
                        <?php endif; ?>

                        <p><strong>Other Notes:</strong></p>
                        <?php if (!empty($medicalHistory['others'])): ?>
                            <ul>
                                <?php foreach ($medicalHistory['others'] as $note): ?>
                                    <li><?= $note ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No additional notes reported.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="patienthistorynopresc">No medical history found.</p>
    <?php endif; ?>
</div>


<!-- Modal Structure -->
<div id="viewModal" class="modal1">
    <div class="modal-content1">
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const referralFilter = document.getElementById("referralFilter");
        const prescriptionContent = document.getElementById("prescriptionContent");

        // Add event listener to the referral filter dropdown
        referralFilter.addEventListener("change", function() {
            const selectedReferralId = this.value; // Get the selected referral ID
            const allEntries = prescriptionContent.querySelectorAll(".pt-history-div2-main");

            // Loop through all entries and show/hide based on the selected referral
            allEntries.forEach((entry) => {
                const entryReferralId = entry.getAttribute("data-referal-id");
                if (selectedReferralId === "all" || entryReferralId == selectedReferralId) {
                    entry.style.display = "block";
                } else {
                    entry.style.display = "none";
                }
            });
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        const referralFilter = document.getElementById("referralFilter");
        const otherContent = document.getElementById("otherContent");

        // Add event listener to the referral filter dropdown
        referralFilter.addEventListener("change", function() {
            const selectedReferralId = this.value; // Get the selected referral ID
            const allEntries = otherContent.querySelectorAll(".pt-history-div2-main");

            // Loop through all entries and show/hide based on the selected referral
            allEntries.forEach((entry) => {
                const entryReferralId = entry.getAttribute("data-referal-id");
                if (selectedReferralId === "all" || entryReferralId == selectedReferralId) {
                    entry.style.display = "block";
                } else {
                    entry.style.display = "none";
                }
            });
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        const referralFilter = document.getElementById("referralFilter");
        const labReportsContent = document.getElementById("labReportsContent");

        // Add event listener to the referral filter dropdown
        referralFilter.addEventListener("change", function() {
            const selectedReferralId = this.value; // Get the selected referral ID
            const allEntries = labReportsContent.querySelectorAll(".pt-history-div2-main");

            // Loop through all entries and show/hide based on the selected referral
            allEntries.forEach((entry) => {
                const entryReferralId = entry.getAttribute("data-referal-id");
                if (selectedReferralId === "all" || entryReferralId == selectedReferralId) {
                    entry.style.display = "block";
                } else {
                    entry.style.display = "none";
                }
            });
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sections = document.querySelectorAll(".pt-history-div1");
        const prescriptionContent = document.getElementById("prescriptionContent");
        const labReportsContent = document.getElementById("labReportsContent");
        const otherContent = document.getElementById("otherContent");

        // Add click event listener to each section
        sections.forEach((section) => {
            section.addEventListener("click", function() {
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
            button.addEventListener("click", function() {
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
        downloadPdfButton.addEventListener("click", function() {
            if (!currentData) return;
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            // Helper function to split long text into multiple lines
            function splitTextIntoLines(text, maxWidth, fontSize) {
                const words = text.split(' ');
                const lines = [];
                let currentLine = '';
                words.forEach((word) => {
                    const testLine = currentLine + word + ' ';
                    const testWidth = doc.getTextWidth(testLine); // Get the width of the test line
                    if (testWidth < maxWidth) {
                        currentLine += word + ' '; // Add the word to the current line
                    } else {
                        lines.push(currentLine.trim()); // Save the current line
                        currentLine = word + ' '; // Start a new line with the current word
                    }
                });
                if (currentLine.trim()) {
                    lines.push(currentLine.trim());
                }
                return lines;
            }

            // Function to add a gradient-like header
            function addStyledHeader(title, x, y, width, height) {
                // Draw a rectangle with a gradient-like effect
                doc.setFillColor(0, 123, 255); // Dark blue
                doc.rect(x, y, width, height, 'F'); // Fill the rectangle
                // Add the title text
                doc.setFontSize(18);
                doc.setTextColor(255, 255, 255); // White text
                doc.text(title, x + 10, y + 10);
            }

            // Function to add body content
            function addBodyContent(diagnosis, medications, startX, startY) {
                let yOffset = startY;
                // Add diagnosis
                doc.setFontSize(14);
                doc.setTextColor(0, 0, 0); // Black text
                const maxWidth = 180; // Maximum width for the text (in mm)
                const fontSize = 14; // Font size for the diagnosis
                const diagnosisLines = splitTextIntoLines(diagnosis, maxWidth, fontSize);
                doc.text("Diagnosis:", startX, yOffset);
                yOffset += 10; // Move down for the diagnosis content
                diagnosisLines.forEach((line) => {
                    doc.text(line, startX, yOffset);
                    yOffset += 10; // Increment Y-coordinate for the next line
                });
                // Add medications
                yOffset += 10; // Add some spacing between diagnosis and medications
                doc.setFontSize(12);
                doc.text("Medications:", startX, yOffset);
                yOffset += 10;
                if (medications.length > 0) {
                    medications.forEach((med) => {
                        const medicationText = `${med.name} - ${med.quantity} ${med.measurement} - ${med.sig_codes} (${med.duration})`;
                        const medicationLines = splitTextIntoLines(medicationText, maxWidth, 12);
                        medicationLines.forEach((line) => {
                            doc.text(line, startX, yOffset);
                            yOffset += 10; // Increment Y-coordinate for the next line
                        });
                    });
                } else {
                    doc.text("No medications prescribed.", startX, yOffset);
                    yOffset += 10;
                }
                return yOffset; // Return the final Y position
            }

            // Function to add footer
            function addFooter(startX, startY) {


                // Add the logo
                const logoWidth = 50; // Adjust the width as needed
                const logoHeight = 50; // Adjust the height as needed
                const logoBase64 = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgICAgMCAgIDAwMDBAYEBAQEBAgGBgUGCQgKCgkICQkKDA8MCgsOCwkJDRENDg8QEBEQCgwSExIQEw8QEBD/2wBDAQMDAwQDBAgEBAgQCwkLEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBD/wAARCAH0AfQDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD9U6KKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAormfFvxM+HfgLYvjXxzoWhvKMxx39/FC7j1VWYMfwFZ3hX43fCDxveLp3hP4leHNTvHxstYdQj85snAxGSGPPoO49arkk1zW0MXiaMZ+zc1zdrq/3Hb0UUVJsFFFcv4t+KHw38BOkPjTx3oOiSyjKRX2oRQyOPUIzBiPcCmk5aIidSNKPNN2XmdRRXF+E/jT8JPHV0tj4Q+JHh7VbtwGW2t9QjMxB9Iyd36V2lDi46SQqdWnWjzU5Jry1CiiikaBRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFfJ/7bH7V2ofCG3h+HHw9uo4/FWpwefd3u0OdNtmyF2jp5z4JGc7VGcZZSPrCvxh/aG8RXnir46eO9avmLSPr15AmeqxQyGKJfwjjQfhXfl9CNapeWyPluLMzq5fg1Gi7Sm7X7LrbzOG1LVNS1q/n1XWNQub+9unMk9zczNLLKx6szsSWPuTVdWZGDKxVlOQR1BpKK+hPyNtt3Z9lfsl/tvat4Vv7X4efGbWpr7QZ2EVlrV05ebT2PAWZzy8P+0eU91+7+icM0NxClxbypLFKodHRsqykZBBHBBHevwir2nwn+1x8YvBvwlvfhHo+t4s5sRWeoMWN3p9uQfMhhfPCnjB6oN23GV2+Xisv9rLmp6PqfbZFxZLBU3Qxt5RS919fR+XZ9PTb6k/a//bYk8IXF38Lvg7qUTaym6DVtajw4sT0MMB6GYdGfkJ0Hz8p+fN/qF/qt5NqWqXtxeXdw5kmuLiRpJJGPVmZiST7moCSxJPJNFdtDDww8eWJ85mmbYjNq3taz06Lov66sdHJJDIssUjI6MGVlOCpHQg9jX3N+xP8AtgeILzxDY/B34qaxLqMWoEW+h6rcuXnSf+G3mcnLq/RGOWDYXkEbfheprG9u9NvbfUbC4eC5tZUmhlQ4aN1IKsPcEA069CNeHLIjLMyrZXiI1qT9V0a7M/dqisrwpq8niDwvo+vSIEfUtPt7xlClQDJGrkYPI69DzWrXyzVj90jJTipLqFFFFIYUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFfkX+2N8N734b/H3xLFJb7LDX7l9csJAuFeO4ZncD02y+YmP9kdiK/XSvMP2gPgH4T/aA8Gt4d14fZdRtN0ulanGuZLOYgZ4/ijbADJ3AGMEKR14LEfV6l5bM8DiPKZZthOSn8cXdefl8/zPxuorqvid8MfGHwj8YXngnxtpptb+1O5HXJiuYiTtmibHzI2OD2wQQCCBytfSJqSuj8cqU50punUVmt0XI9F1maNZodJvZI3G5WW3cgj1BA5r9m/A/gPwU3grw+1x4L0QynS7QuX06HcW8lc5yuc5rN/Zn/5N9+Hv/Yu2X/ooV6XXz+MxbrPlta1z9Y4cyGGXU3Wcub2ii7W26933Pxk+OPhzUofjV8QItP0G5S1TxTqqwrDasI1jF3LtCgDAXGMY4xXnRBUkEYIr94K/C7X/APkPal/19zf+hmvTwWK+sJxta1j4viTJFlM41FPm53Lpa23m+5Qro/hz4G1j4leOtE8C6HEz3es3kdsrAZESE5eQ/wCyiBmPsprJ0XRdW8SataaDoOnXF/qN/MsFtbQIXklkY4CqB1NfqV+yT+ypp/wG0Q+IvEggvfGuqwhbqZcMlhEefs8TdznG9x94gAcDJ0xWJjh4X69DjyPJqub4hRStBfE/09X/AME+gNNsLbStPtdLs1K29nClvEpOSERQqjP0AqzRRXzJ+0pW0QUUUUDCiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooA8u/aA/Z/8AB/x/8HtoOvRi01S0DSaVqsaAy2cpH/j0bYAZCecAjDAEfk18Tvhj4w+EfjC88E+NtNNrf2p3I65MVzESds0TY+ZGxwe2CCAQQP22ry79oD9n/wAH/H/we2g69GLTVLQNJpWqxoDLZykf+PRtgBkJ5wCMMAR34PGOg+WXw/kfLcRcOwzSHt6GlVf+TeT8+z+T02/H2LW9agjWGHVr2ONBtVVuHAA9AAeK/ZrwP488FJ4K8PrceM9EWVdLtA4fUYdwbyVznLZzmvyC+J3wx8YfCPxheeCfG2mm1v7U7kdcmK5iJO2aJsfMjY4PbBBAIIHK16uIw0cXGLTsfCZRnNbIKlSMqd27Jpu1rX8j0X44+JNTm+NXxAl0/Xrp7V/FOqtC0N0xjaM3cu0qQcFcYxjjFcPoui6x4k1i00PQ9PuNQ1LUJlgtraBC8k0jHAUAdSaNF0XVvEmrWmg6Dp1xf6jfzLBbW0CF5JZGOAqgdTX6jfsm/sm6T8C9JTxR4ojgv/HF/DiaYYePTo2HMEJ7t2eQdeg+X7zr4iOEp+ZGV5VXz7FScdIXvJ9r9F5h+yb+ybpPwL0lPFHiiOC/8cX8OJphh49OjYcwQnu3Z5B16D5fvfRtFFfPVKkqsuaW5+u4PB0cBRVCgrRX9XfmFFFFZnUFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFAHlf7Q37P/hb9oDwXJoOrJFaaxaK0mkar5eZLSU9jjBaNsAMvfgjkAj8pPFXwh+Ifg/4ht8LdW8NXTeI2uFt7e1gQyfa95wjwkD50bqCPfOCCB+19Z1x4d0C81yz8TXWi2U2rafDJb2l88CtPBHJjeqORlQ2BnH9TXbhcbLDpx3R81nfDdHN5xrJ8s+r7r/Ps/l6eB/sm/sm6T8C9JTxR4ojgv/HF/DiaYYePTo2HMEJ7t2eQdeg+X730bRRXNUqSqy5pbnt4PB0cBRVCgrRX9XfmFFFFZnUFFFV9Q1Cx0qxuNU1O8htbO0iae4nmcJHFGoJZmY8AAAkk+lAN21Zz/wATPiN4b+FHgnVPHniu68qw0yHfsXHmTyHhIoweru2APrk4AJrw/wDYv/aT8QfHq38YWfi5II9R0vUFvLRIVwqWVwW2Qju3lshG48kOuea+OP2u/wBpq8+PXi4aToM0sPgzRJWGnQsCpu5eVa6kU85IyEB+6p6As1ej/wDBMlbj/hZ3i1l/1A0FQ/8AvG4j2/oGr1Xg1Swspz+L8j4aPEcsbnVPD4Z/uldf4tHr6Lp/wT9GK8D/AGvv2jLb4E+AWtdEu4z4w15Gh0mLhjbL0e6ZTxhM4XP3nI4IDY9E+Mfxe8J/BPwPeeNvFlx+7hHl2lorAS3twQdkMY9Tjk9FAJPAr8gvil8TPFHxd8baj468XXXm3t+/yRrny7aEfchjB6Io4Hc8k5JJOOBwvt5c8vhX4ndxPnqy2j9Xov8Aey/8lXf17fefrt8BfiS3xc+EPhn4gTKiXWp2eLxYxhVuYmaKbA7AujED0Irv6+aP+Cev2n/hnGz8/Oz+177yc/3Ny5x/wLdX0vXLXioVZRWyZ7mV15YnBUq1TdxTfrYKKKKyO8KKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAorgfi38cvhr8EtHXVvH3iBLaSZSbWxhHm3d0R/zziByR23HCjjJGa+F/il/wUa+J3iSa4sfhlpNn4V04krHdTRrdXzDpklh5SZ9AjEdmPWumjhKtfWK07njZln2Byv3a0ry/lWr/wCB87H6TVzepfEv4c6LI8esfEDw3YOnDLc6rBEV+oZxivxu8VfFj4neOd48YfEDxBq8cnWG71CV4h7CMttA9gK5Su+OVfzSPlq3Hev7mj97/RL9T9pP+F+fAocH40+AwR/1Mdn/APHK1NL+KXwy1xQ2i/EXwxqAPQ2ur28v/oLmvxHoq3lUf5jnjx1Xv71Ffez93Le4t7qJZ7WeOaNvuvGwZT9COKkr8K9M1rWdFm+0aNq17YS/89LW4eJvzUg13Ok/tGfHrRYxFp/xg8WrGv3Ul1WaZV+gdiAPYVlLKpfZkdtLjuk/4tFr0af6I/ZuivyDh/bE/aWt4/Lj+LOpkf7cFu5/NoyaxNc/aT+PviJSuqfF7xSUP3kt9Rktlb6rEVB/GpWVVOskbS45waXu05X+X+bP2H1rxDoPhuzOoeItc0/SrVes97cpBGP+BOQK8H+Iv7d37P8A4D8y107XrjxXfJx5OiRCWLPbM7FYiPdGY+1flhqOqaprF017q2o3V7cN96a4maRz9WYk1Db2891PHa2sMk00ziOOONSzOxOAoA5JJ4AFb08rhH45X/A8rFccYmouXDU1HzfvP9F+Z+y3wA+MUXx1+HMHxAh0FtHWe7uLYWrXHnFRG+0Nv2rnIwcY4yRzjNej15l+zX8Nbj4S/BPwx4K1CPZqMFqbnUFznbczMZZEyODsL7MjsgrsPGnjjwp8O/Dt14s8aa5baVpdmuZJ52xk9lUDl3PZVBJ7CvIqKLqNU9r6H6BhKlSOEhUxbtLlTk3prbXyRrX19Y6XZT6lqV5DaWlrG00880gSOKNRlmZjwoABJJr8z/2wP2wLz4uXk/w9+Hl5NbeDLaTbcXC5R9XdTwzDqIQRlUP3uGbsFxP2pP2wvEXx0uJPCvhlbnRvBUMmRbM2J9QZTlZLjBwFGAVjBIB5JYgbfLvhX8DPih8Z9S+weAfC9xeQo4We+k/dWlv/ANdJm+UHHO0ZY9ga9fCYONBe1rb/AJHwGfcQ1Mzl9Qy5Nxeja3l5Ly/P034NEeR1jjUszHaqqMkk9hX6E/sq+Eov2SfhH4m+MPxsZdFk8QC2+y6e/N55cYkMcXlnGJZGfOz+EKC23Dbaui/DH4D/ALDOhQeOvidqUHi74hSx+ZpllGo+ST/p3jbOxQeDcSc8fKATtb5B+NXxy8dfHbxU/iTxjfYhiLLYadCSLaxiP8KL3JwNzn5mwM8AAbSbxvuR0h1ff0POoU4cNv6xXd8Rb3YraN1vJ97bJFr4+fHrxd8fvGT+JPEEhttPtt0WlaXG5MVlCT0/2nbALvjJIHQBVHmdFe1/si/Bmb4zfGLTLG7tTJoWhuuqawzD5DFGwKQnsTI+1cddu8j7tdTcKFPskeFCOIzXFKLfNOb3/rovwR+k/wCzN4Gm+HPwI8G+FbqExXcWnLdXUbD5knuGM8in3VpCv/Aa9Ooor5acnOTk+p+6UKMcPSjRhtFJL5aBRRRUmoUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFfMf7VX7ZWi/BWObwV4JFtq/jSSP94GO630sEcNLj70hHKx/QtgYDWP2yv2ok+B/hxPCfhG4ik8aa5CzQnhv7NtzlftDL3YkERg8ZBJyFw35cXV3dX91NfX1zLcXNxI0s00rl3kdjlmZjySSSST1zXp4HBe1/eVNvzPieJuJXgm8HhH7/AFf8vkvP8vXbR8VeLPEvjjXrrxN4u1q71bVL1t011cybmb0A7Ko6BRgAYAAFZNFFe4lbRH5jKUpycpO7YUUUUxBRRRQAUUUUAFFfbHg//gmZ4i1Sxs9Q8V/FCy07z4Umkt7PTWuHXcoJTezoARnGcHpXtvgf/gnt8A/CsiXWvQ6v4quF+bGo3flwA+0cITI9mZhXDPMKEOtz6XDcJZpiLc0FFebX5K7/AAPzV8IeCPF/j/WI9A8F+G9Q1nUJSMQ2cLSFR/eYjhF9WYgDua/Q/wDZX/Yf0/4X3Nn8QvigYNS8Vw4ms7GMh7bTH6hieksw7MPlU/d3EB6+ofDfhTwx4O01NH8J+HdN0axTpb2NqkEefXagAJ9zzVXxX4N0/wAaWh0zXNQ1UadIMS2lnfSWizD0eSErKVPdd+0jqDXnV8wlW92Oi/E+wyvhOjl0vb1X7SotukU/x+/8LnkXxy/bG+Gfwgabw/pcp8VeLc+VHpGnPuEUvQLPKMhOf4Rufp8ozmvk3XPg9+2P+1rrsPibxpo76NpZbNnHqrmxs7ONv+eVsczHI/jKMWAGWPFfcq6T+z9+z7po1L7B4O8FQ7Sq3DJDbzTeoDn95KfbLGvB/ip/wUe+HPh+GWw+Fei3Xii/5VLy6RrWyQ9jhgJZPptQH+9Rh3KP+7wu+7/qyDN6dGp/yNsSow/59w/XeUvuXyLPw3/YD+DPw1sT4m+LWuDxJNZp507XkgstMtwOSWXdlgPV32nuormvjX+3p4L8CaU3gH9nPSbGeS2QwR6mlqsWnWQ9LeEACUjnBIEecH5wa+Qfi1+0F8V/jVdeZ468UTT2SPvh023Hk2cJ7bYl4Yjsz7m9686rvhg5TfPiJcz7dD5XE8RUsNB4fKKfs4/zfafz1t97foaXiTxL4g8Ya1deIvFGsXeqanev5k91dSl5HP1PQAcADgAADAFZtFFeglY+VlJyfNLVsmsbK81K8g07T7WW5urqVYYIYlLPLIxAVVA5JJIAA9a/XP8AZV+Adt8BPhpDpN4scniPVyl7rc64I87b8sKkdUjBKj1Yu38WB4J+wf8AssS6Stp8cviFp+26mj3+HbCZOYkYf8fjg/xMD+7B6A7+pUj7irw8xxXtH7KGy3P0zhHI3hYfXsQvel8K7Lv6v8vUKKKK8s+4CiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigArivjH8VPD/AMGfh7qnj7xCwaOyj221sG2vd3LcRwr7sep5woZugNdrX5f/ALe3xxk+JHxQbwFot5u8P+DZHtvkb5bi/wCk8h9dmPLHptcjhq6cJQ+sVOXp1PFz7NVlODdVfG9I+vf5b/gfPvjzxx4i+JHi7VPG3iq9N1qerTmeZudqjoqID0RVAVR2AArBoor6ZKysj8WnOVSTnJ3bCiiimSFFFFABRRRQAUUUUAfa/wAJ/wDgpDqXhvw3ZeHfiR4HfWZtPgjt01KwuhHLMiLtBljcEF8AZYMATngV2l7/AMFO/BMayf2d8LdcnYf6sTX0MQb64DY/Wvz0orjlgMPJ35T6GlxVmlKmqaqbd0m/yPtXXv8Agp340uI3Xwx8LdFsHP3Gvr+W7A+oRYs/mK8h8Yftu/tIeMI5LZvHR0W2k6xaPbJakfSUAyj8HrwiitIYSjD4Yo5a+fZlidKlaXy0/Kxc1bWdY1++k1TXdVvNRvJf9ZcXc7TSv9WYkn86p0UV0bHktuTuwooooEFfXf7FP7JMnxE1C2+K3xI0tl8K2UnmabZTpgarMp+8wPWBSOezsMcgMDH+yL+xhqHxIuLP4j/FLT5rPwlGVmsrCQFJdW7gkdVg9+rj7vB3V+klra21jaw2VlbxW9vbxrFDDEgRI0UYVVUcAAAAAdMV5WOxvL+7p79WfdcM8NOu443GL3d4xfXzfl27+m8iqqqFVQAOAB2paKK8Q/SwooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKAOV+KWoeMNL+HXiG++H+jvqniSOwlGmWyOilp2G1W+chTszv25yduByRX4u+JdB8TeG9YuNL8XaRqOm6ojFp4NQheKbcTyzBwCcnPPev3MrnPG/w58C/EjSzo/jvwpput2vO1buAM0RPUxv96M+6kGu3B4tYa6cb3PmuIMglnXLKNTlcdk9v81+PofiFRX6FfEz/gmn4V1NptQ+FPjK40WVssun6opubbPZVlX94i/7wkNfKPxK/ZR+O3wt8241/wAC3d5p8WT/AGhpX+mW+0fxMUG6Mf8AXRVr2qWLo1vhep+cY7IMwy/WrTbj3Wq/Db52PI6KKK6TxgooooAKKKKACiiigAooooAKKKKACiivW/gn+y98V/jpcR3HhvRjY6Hv2za1fho7VcHkIcbpWHogODjcVzmpnONNc0nZG2Hw9bFVFSoxcpPojyzT9P1DVr6DS9LsZ7y8upFhgt7eMySSuxwFVVBLEnoBX31+y7+wXDoz2vj7452MNzertmsvDrEPFCeoe6xw7f8ATMZUfxbs7R7r+z/+yp8OPgHZreabD/bHiWVNtxrd3EBKARgpCnIhQ88Aljn5mbAx7TXi4rMHP3KWi7n6RkfCUMLbEY73p9I9F693+HqIqqihVUKqjAA6AUtFFeWfbhRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAeb/ET9nT4K/FPzZvGXw+0u4vJfvX9vH9muyexM0RV2x6MSPavmjx1/wTJ0G5Ml18N/iNeWLclLTWLdZ0J9POj2lR9UY19v0VvTxVal8MjysZkmAx+takm+60f3qx+TvjL9hf9o7wjI5h8HQ6/bJ/y8aPeJMG+kb7ZT/3xXj3iTwH448GyGLxd4N1vRWBxjUNPlt8/TeozX7h02SOOaNopY1dHG1lYZBHoRXbDNKi+KKZ85iOBsLPWhUlH1s/8j8IaK/aHxN8Afgn4w3t4i+Ffhm6lk+9OunRxTH/ALaIA/61wOofsK/sw3+TH8PJbNz/ABW+r3g/RpSo/KumOaU38UWePV4GxkX+7qRa87r9Gfk5RX6gXn/BOn9nm6z5LeKLTP8Azx1NTj/vuNqy2/4Jp/Akkn/hKvHYz2F/Z8f+StWsyoeZyy4NzNbcr+f/AAD806K/UXR/+Cd/7Oumbft1t4j1fHX7Zqm3d9fJSP8ASu+0D9kn9m/w3Ik2m/CPRZWT7v24SXo/EXDOD+NTLNKK2TZtS4JzCfxyjH5t/p+p+R+geGPEniu9Gm+F/D+paxdnpBYWklxJ/wB8oCa9/wDh3+wH8evGrRXOvabZeErCTDGTVJgZ9v8AswR7mB9n2V+oWl6PpGh2a6foml2en2qfdgtYFijH0VQAKuVy1M0m/gVj3MJwPhqfvYmo5eS0X6v8j5m+FH7AnwW+H7Ral4ohm8aapHht+pIFtFYd1tlJUj2kZxX0pbW1vZ28VpZ28cEEKCOOKNQqIoGAqgcAAdhUtFefUqzqu83c+twmBw2AhyYaCivL9Xu/mFFFFZnWFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUV+YmgfFD4ly/toJ4cl+IniZ9JPxEms/sDatcG38gX7KIvL37dm3jbjGOK/TuujEYd0LXd7nk5Vm0M1VRxjbkdgor8w/jt8UPiZpf7W2saDpvxE8TWmmR+IrOFLKDVriOBYz5OVEauFAOTkYxya/Tyith3RjGTe4Zbm0MyqVqcY29m7eu/wDkFFFFc56wUUUUAcz8SviBonwr8D6r4/8AEcN5LpujxpJcJaRq8xDSKg2qzKDy46kcZrkvgX+0b4D/AGg4dZn8D2Os266G0CXP9pW8cRYzByuzZI+f9W2c47Vkftnf8my+Ov8Ar0t//SqGvAf+CXv/ACDviN/120v/ANBua7IUYyw0qr3T/wAj5/E5jXpZzRwMbckotvvf3v8AJH3RXhvxm/bA+F3wM8Xp4K8Yab4jnv3s474Np9rDJF5bsygZeVTnKHt6Vj/Df9tjwF8TPiva/CTSfCev2uo3dxd263NwIfJBt4pZGJ2uWwREQOOpFfJv/BRv/k4KD/sXrP8A9GT1WGwvNW9nWVtLmGcZ6qWXvFYCSlaSjt95+mmn3sOpWFtqNurCK6hSZAwwQrKCM++DVisnwn/yKujf9g+3/wDRa1rVxPRn0sHzRTCivzD/AGefih8TNW/ax0PQdV+Inia90yXXL2J7O41a4kgZAk2FMbOVIGBgY7Cv08rfEYd4eSi3e55eUZtHN6UqsI8vK7a/L/MKK/MS++KHxLX9tYeG1+IniYaR/wALKis/sA1a4+zfZ/7SVPK8rft2bfl24xjjGK/Tuivh3Q5bu9wyvNY5p7Tljbklb1Ciiiuc9Y8F8N/tnfCnxT8VU+D+m6X4lTW31KfSxLNaQi286EuGO4TFtv7s4O3PTiveq/K74Nf8n2W//Y46r/6FcV+qNdeMoxoyio9UfP8AD2ZV8ypVJ17XjJpW7WQUUUVyH0AUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFAH5Aa14usvAH7W2seNtStZ7m10Lx9eX80MGPMkSO+diq5IGSB3NfXX/DzT4Vf9E/8V/+S3/xyvlSHQ9J8Tfto3Ph/XrGO907UfiLc211byZ2yxPqDhlOOxBr9E/+GSf2b/8AokeiflJ/8VXtYuVBcvtU27dD83yGlmdT27wNSMVzu/Mr6/cz80vG3j/Tfil+0e3xA0myubSz1rX7KeKG52+YgDRLhtpIzlT0NfpR+0l+0p4Z/Z38N217fWTarrmql003TEl8vzNuN0kjYOyNcjnBJJAA6kfnZ8YPDWg+D/2r7/wz4Z0yHT9LsPEdlHbWsOdkS5hOBk56k/nXY/8ABRDVL6+/aHlsrp2MGnaNZw2ynoEYNISP+BO35VpUowxE6cfs2v8AkcmDzHEZVhsZUT/eOajfpf3rv8HY72H9uD9rCTRG+Iy/CHSpPCCPhrtdHvfswTdt/wBf5uOvG77ueMdq+r/2ef2iPCv7QHgyfxJpludL1DTGEWradNKGNqxBKuHwN0bANhiB91gRxXzLpd5/wUBbwHa+DLD4TeHZfDj6SmmwwH7DtezMIQKf9J5yn868/wDh98Gv2hPgL4E+K+ueKvCNxo2l6n4MuLMzC+tpf3zTwqOIpGYERPcc44yeawqUaNSLS5U76WZ6uEzLMMHWjOXtKlNxblzQas0r3T7HffGT/go5rVn4mudB+C/h/SrnTbSUw/2pqcckpu2BwWijR12oT0LFiw5wvSsqP/gpd48s/D4tNV+G+kf8JHDcqJH3TR2zwFWz+7LF0kDbP4mBBP3cDND/AIJqeDfC2ueO/FPijWLW3udV0Cztf7LWVQ3lec0glmUHoyiNF3dhIfWvUf8AgpT4O8LTfDTRPHUtpBDr9rrEWnxXCqBJPbyRSs0THqwBjDDP3fmx941Tjh4Vlh+T5mEK+b4jLp5ssRbf3bK1k7fJ9tPnqXvHnxZ1X42fsG+KfiFrWl2mn3V6hha3tWYxqI7+NARuJPIGa8c/Yj8dX3wz+Dnxq8fabYwXl1okOmXUUE5IjkI+0DDbecc9q6jwj/yjN1z/AHp//TmlW/8Agl+qvpvxGV1DKZtLyCOvy3NJqNOhUVtFL9UaQnVxWaYKTl78qO/m4z1PkT4afF3Vvhl8WrT4uabpVpeX1pcXdwtrOzCIm4iljYEqd2AJSR9BXa/tbeOb74l+MfCfjzUrKC0udb8IWN1LBASY42Ms4wu7nHHetz9k+ON/20tGjdFZf7T1v5SOP+PO7rW/4KMqqftAW6qoUDw7Z4AHT95PXZzR+sRjbXl3/Q+cjRqrJ6tRz932luW3Wy96/ppY6jWv2/PjdYabZap4N+Gun2HhO2SOzt7zU7C5mFyUUL80yOkYJ2n5V5HIycZr6t/Zd/aMsf2ifBl3qsulppeuaNMlvqdnG5eMFwTHLGTzsfa+AeQUYZOATS+MXh3R7L9jjW/D8NjELLT/AAdH5EW0bVMMKNG2PUMinPqK+cv+CYEkg8SePoQx2NY2DFfUiSYD+Z/OvOnGlWw8qkY2cWfYYetjsvzWjhq1b2kakbtWtZ2e33Hzr8O/iFpvwp/aIg+IOsWNzeWeja1ezSwW23zXDeamF3EDqw6mvsf/AIeafCr/AKJ/4r/8lv8A45Xyd8D/AAzoPjL9qnS/DPijS4dR0u/1y+jubWbOyVQszAHBz1AP4V+jP/DJP7N//RI9E/KT/wCKrfGSoKUfaxbduh5PDlHNKlCo8DUjGPM78yvrZeTPzf8AC/iyz8efte6F410+2mt7XXfiHZ6jDDNjzI0l1FHCtgkZAPODX2p+1h+194s/Z78eaX4T0DwppGqQX+kJqLy3jyh1dppY9o2EDGIwfxNfHVroul+HP22LHw/odlHZ6dp3xMtrW1t4/uxRJqaqqjPYAAV6T/wUw/5LP4c/7FiL/wBK7mtKlOFWtTjJaWOXCYvE4HLcVVpytNVFqvxPuy8+IF/a/BGf4pLYwG9i8Kt4gFqS3lGUWhn8vPXbnj1xXin7Jv7XHiv9oXxhrPhvxB4V0nS4dN037cklm8hZm81E2neSMYYn8K9B1Z1/4Y9vJNw2/wDCtZDntj+yzXyP/wAEy/8Akqniv/sX/wD25irgp0oOjUk1qtj6rF4/EU8xwdGMvdmveXfQ8dsfiBa/Cv8Aao1b4hXuny38WieJ9VuPs0ThGlYyTqq7jwoLMMnBwMnB6V663/BSX402+tR3114H8MLpEzbkszBcLI0Wf4ZjJgt/tbCP9muL+EfhHwz44/bcm8PeLreG402TxRrFw9vMAUuJIWuJY42B4Kl0XKnhgCO9feX7WHgrwn4q/Z+8Xp4hs7YDRdJuNS06ZkAa2uYYy0Xln+HcVCEDqGI71216lFVIRqRu2kfOZThcwqYWvXwtfkUZSdrbtJN3fRWt3Oh+B/xq8K/HfwPB408L+ZAwkNvfWMzAy2dwAC0bEcMMEFWHUEdDkD0Gvz0/4Ji6pqMfjTxroqO5sJ9Lt7qRf4RNHKVQ+x2yP+XtX6F15eKpKhVcI7H22RY+eZYGGIqfE7p+qdr/ADCiiiuc9cKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiuH8YfEqbwr8QvBPgFNBW7PjSW8ihuvtfli2+zQmaQsmw7sxg7cHluDgc0zw78S7rXPip4m+GU3h9LZvDVpa3j3y3nmCdLnd5QCeWCpwjbsng4xuzmr9nK1/n+hz/WqXP7O+t+XZ725rfdqd3RVHVNc0XRBAda1ixsBcyCGD7VcJF5sh6Iu4jcx9BzVySSOKNpZXVEQFmZjgADqSe1Qb8y2HUVU0vV9J1u1+3aLqlpf224p51rMsqbhwRuUkZB6iuS8I+ONY174leO/BeoWdnFaeFzpv2OSHcZJRcwvIxkJOMjaAAB68ntSi3fyM5VoxcV/M7L7m/wAkz4C0H4R/FaH9sxPFE3wx8WJow+IU17/aLaLci1+zm/ZhN5pTZs2/NuzjHOa/TWslvFnhdfEY8Ht4g08a4YRcDTzcKLgxndhgmckYRz9FJ6CuY8cfES78H/EDwT4cm/s2HSPER1L7feXUhRrcW1qZlKsSFUE4yWzx+ddFarLEtaWsjycuwNDJoVHGfMpS18m2lb72fA3x0+EfxX1f9rLV/Emk/DHxZe6TL4hs5kv7fRbmS3aNfJy4kVCpUYOTnHBr339ub9l3xF8WlsPiV8O7MXuv6Va/Y73T1YK95ahmdGjzwZELP8p5ZWGOVCn60tbq1vraK8sriK4t51EkcsTh0dTyGVhwQfUVLVvGzvBpW5dDnjw3hnTr06km1VfN6O7en3n5pad+1J+1povgKH4OW3w+v01S3tBpcGoNot3/AGnHEF2KAvTzAuFD7c8A8t81fQv7LPwX+MU3w/8AEMP7RHirxDe2fijT30u30HUtRkuHtbaRSJJX3lvLkIICqDlQDnk4Htmn/ErUfFereINP8AeHbbVbfwxfPpV9eXmom0SS+RVaSCELFIXKblVmbYNxwM4JHXaHqF1q2i2GqXul3GmXF5bRTy2VwQZbZ2UFon2kjcpJBwcZFFbEXjyxgo3+/wD4BGX5Qo1lUrV5VVFNJPSNtn5SPy01r4Y/tFfsf/E2XXfCFjqcsEReG01izsmuLO+tWOfLmUAqpOBmNsEMuVPCtT/itb/te/tDaRYeNvGHgPxHfaXZz/ZdPstP0WZVVnUs8qQIpdl+QAytkZKqD2H6k6brejaw1wukatZXxtJPKuBbXCS+U/8AdfaTtPsaW71jSbC4itL7VLS2nn5iimnVHf5lT5QTk/M6rx3YDqRWv9oSupOC5l1OR8J0+SVKGIkqT15el/1Pjbwv4A8eW/8AwTz1nwVceCdei8QytN5ekvpswvXzqCOMQFd5yoLdOnPSrX/BOXwH458D2Hj1PGngzXfD7Xk2mm3GqadNamYKtxu2eYo3Y3LnHTI9a+wtS1PTdHs5NS1bULaxtIQDJcXMqxxoCcDLMQByQOfWpLa6t723ivLO4jngnQSRSxsGR0IyGUjggjkEVhLFSlTlC3xO56dHJKVHFUK6m70ocqXdWau/vPzd/Zj+E/xS0D9rrSfEuu/DXxVp2kR6jq7vqF3o1xDbKr2t0qEysgUBiygHPJYY61pft8fC34neMfjlBq3hH4c+J9csRoVrCbrTdIuLmISCSYld8aFdwBGRnPIr9Fa8w8N/F7W/E/iXxFotj4Ltls/DHiCPQL66k1gK5d/LIkjjMQDALKp2lgSQQMnGdY4ycqntlHZWOCpw/hqOCeXzqO05817Xd7baeSIPjBousan+zP4k0HTdJvLvU5/Cr28VlBA0k8kvkAeWsagsWzxgDNfOP/BOn4d/EDwR4j8az+NPAviHQI7qys0t31TTJ7VZWWSQkIZFG4jIzj1FfbWpappuj2b6hq+o2tjax43z3MyxRrngZZiAKmgnhuoY7m2mSWGVRJHJGwZXUjIYEcEEd65415RpSp20Z61bK6dbHUsY5e9TVrd9/wDM/M39nv4R/FfRf2rtE8Rax8MfFlhpMWt3ssl9daLcxW6IyTBWMjIFAORg55yK/Tas+18ReH77VLjQ7LXNPuNRtV3z2cV0jTRLkDLoDuUZIHI71DcaxeQ+KLLQhp0RtbqznuGu2vI1dZI2jAjEJ+dwQ7EuOF2gH7wp4ivLESTatZCynLaWUUZU6c+ZSlf5uytofnBffCP4rP8AtpDxUvwx8WNov/CyY77+0hotz9l+zDUlczebs2eXt+bfnGOc4r3v9vb9nTxZ8VNP0b4geANNk1PVtChks7zT4eZp7Vm3q0S/xMjF8qOSH45GD9BeMvHGseHfiH8P/CdnZ2clh4svL+1vJZN3nReRYy3CeWAQvLRgEnPHQc5HReItYvNFhsZrTTorv7VqFtZy+ZeR24hjlkCGQF/vkZGIx8zEgDmtZYqpzwmlsv8AgHn0siwv1fE4aUm1KV3pqnZSVvvR+Xsvxw/alufhav7PzeFdTNgLUaXxoVx/aJtR8oticfd2gJ9zdt4zX1N+wX+zv4q+E2i61428fac+m6x4hWK3ttPl/wBbbWqEsWkH8LOxHynkBBnk4H1HruvaL4Y0m517xFqltp2n2i757m4kCRoM4GSfUkADqSQBzS/25on9k/29/bFj/Znl+b9t+0J5Gz+95mduPfNFXFupTcIRsnuVgcghhMVHEYis6koL3U+i27s/KnXvgj+0NdfHTXda8F/DnxfZXY8RX9/pupnS7i3hDLNJLG6zsgjG7A2knaSw5wa0/iZ8Xv2vvjFp6fCfxV4Z1w5kRbrT7Lw/JBNduhBXzgq5IDANgbUyASOBj9QLPxH4e1C4gtdP17Trma5g+1Qxw3SO0sOceYoByyZ43DitGtPr+qcoK62ORcKRUZRo4mSjN+8ls/I+dP2Lf2ddT+BXge+1DxdHGnifxK8Ut5CjBxZwRhvKh3Dgtl3ZiDjJA525P0XXBeNvipD4T8beH/h/b6bbTap4ktrq5snv777HbytAYwYEk8t98zeYCEwBhSSRwD2P9pRW+lLqusbNNRIBNcC4lULb/Llg752/LyCc44riqynUl7SfU+iwFLD4Ol9Uw+1PR/nq+7vcuUVm2fibw3qM1tb6f4g026lvYTcWyQ3UbtNECQXQA5ZQQQSOOKmutY0ixvLXTr7VLO3u75itrBLOqSTkDJCKTliB6VnZnbzxavcuUVmeIPE3h7wpYrqfibWrLS7R54rZZ7uZYkMsjBUXLHGST/M9AavxXNvPbpeQ3EckEiCRJVYFGQjIYEcEEc5osHNG/LfUkoqlpOtaPr1qb7Q9WstRtg5jM1pcLMgcdV3KSMjuKim8TeHLe+/sufxBpsd55qQfZ3uoxL5jglE2k53MASBjJwcUWYc8bXvozSoqppuraXrELXOkala30KSNE0ltMsqq6/eUlSQCO47VbpDTT1QUUUUDCiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKAPKPit8KdX+IXxK+HfiKTSvD2o+HvCk2oS6naanM++4Fzb+SoSLyXRthw/wAzDJAHHWofhz8JdX8C/GLxj4ys9D8M6X4b8QWNja2lrpk7rLG9t5mXeIQJGN/mZOHONvfPHrtFa+1ly8vS1vxucTwFF1vbfa5ub58vL91jyf4l/CvWvF3jy28QrY6ZreiXOgz6Df6Xf6pdWIjWSZZDKhgRxKHACvGwXOyMg8V2fj7Q9W1jwDrHh/w9Z6Nd39zYPbW0Gso0ljKxXAWZRksh7g5z3zzXS0VPtHp5GiwtNc7X29zzf4N+CfGng2bxhN4wnsJm8Q66NYt3t7rznAa0t4XSTEEKAhoOCq8hug72vB/gvxJonxT8e+MdSGm/2Z4mGmixEFzI86/ZoWjbzUaNVXO7I2u3Su+oodRu/mEMLCEYRTfutterv/mzzrT/AADrmmfHLWviFHa6PcaRrukWFo8ryst5az2xuB8ieWVZXE6gt5ikBCMHil8f+Atd8UfEfwD4qs7TR7jTPCs2oTXkd7cOsjtPb+VH5aCJ1JU/NlmXpxXolFHtHe/lb9BPCU3B0+jlzfO/N+ZwXwP8F+Ifh78ObHwj4m/s43lldXsinT7h5ofKmupZo1BeOMjasgTG3Hy8e3e0UVMpczcmbUaUaFONKOySX3Hlfg34f+NPhfr3i5fCtvo+s6F4q1qfxFFHe30lpcWN5cBfPjJWGRZImZQykbWXJG1utd/Db67J4a+z6k2nzaxJZlZtquLUzlTkAff8vccf3to9a1aKqU3LVkUsPGjHlg3bXTtf+vkePfBX4cfETwb4o1bXfGMfh6K31TQdI05bfSZj5drLZG4HlxRC3iVINs42AlmUKFJbrWrrHwxvNW+O+mfEq70Xw9eaRZeHpNKb7Sxa7S5N1HPHMiGEr8nlkA+YGG8kYxz6ZRTdWTk5GUMDThSjR1aTvr3vf8zz74u+CPEfi9fDGoeG5baSfw5rS6pJYXV9NZxXqeRNCV8+FWeN187ehCkblAIwcjpvBfh218J+F7Dw/ZaXa6dDaIwW0tZ5JoodzFiqySAM4BY8kDPoOg26Klzbjym0aEI1XWW7/r9F5BXjvw5+CTaL478beMfG3hvwteT654iGtaPewkz3loioiqhZ4UMZBj3fI5HzEe59ioojNxTS6iq4enWlGU9eXVfdY4r4naB4u16HQ/8AhELfRHmstTFxcSajxJBF5MqGS2YxSqkuXAy0Z+RpAMEg0fBfwlr3gL4V+GPBfiR7J9R0PTorGZ7OV5Im8sbQVZ1U8gA4xx05xk9rRT53y8oLDxVb293e1vLp/kjzT4L+BfF3w/0O18K+JLfQ7qHR1u4bXWLeeSS8vlmuDNvlRolEJOcuA8m5wDkVa1jwLr158b/DnxGs4NJGmaXoV/pN27zut27TyQum1BEVZFMJ6yD/AFjEDj5vQaKHUbk5dyI4SnGlGj0ja3y2/I4Lx14M8SeIPiJ8PPFOkjTfsHhS/vbq/W4uZI5nSezltwIlWNlYjzd3zMv3cd8iP4yeBde8daf4Zi8PwaU9xofijS9ddtQneICO1nEjrGyRSHewBUcAfMcntXoNFCqNWfYc8LTnGcX9vV/cl+iOF+N3gXU/iR8MtX8I6K1kt/dNbTW32xmWEvDcRzbWZVYqGEZXIU43dDXU2dh9q0FNN1rS7CMT25iurKA+bbgMMPGCyrvXBIyVXPoM4rRopcz5eU09jH2jq9Wkvkr/AObPJv2f/B+oeG9GvYtQ1SLUrPSLm48P+HrgEsw0m3uJPKDE/wAYZjExHDLbRHnrXrNQWNjZaZZw6fptnBaWtugjhggjCRxoOAqqoAAHoKnonLnlzE4aisPSjTj0POPjP8Pbz4meH7rwrceGdB1fT7m0f7PJe3Ultc2F/wAiK4idI3wFznI2sMY+YMQOu8L6LfaT4P0jw54i1I61eWemwWV9eTL/AMfsiRKkkjA5++QSQc9a2aKHNuPKEcPCNV1urVvl/Xc8j+Avgm78Lw6taz6lFqGkaDe3Wh+FpFyzRaaJvMeMsepWQi3PbFklXvHHw58S658UPDnjrw5dWtkumfZ4NQea4LpeWazSSSQvbmNlLqSjRSq6srM+cjFej2NjY6Zax2Om2cFpbQjbHDBGERB1wFUYH4VPVOq3JyMoYKmqMaL2Vn93+W3poeffGjwJrPjzQ9Dj0CHTLi90PxFp2uLb6jK0UNwlvLueIyLHIU3KSM7G9xWj8SvBup+OvhfrvgfT7+DS77VtLezSVQ3kxuy42nGG8s8qcc7Sa7CikptW8jSWGpzc2/tKz/r5nHfDfwrc+HbW/vtU8PadpOp6rJFLerZatc6iszxxrGHMs6I33VVQNvCqvJ6Dyzx98A/GPifUPiTd6dpvhLPjDUtBu7CS4u5VeOOxeFphLi2ba0nlHAUsPm5PHP0JRTjVlGXMjKrgKVakqMtlft1TT6ebPPPhr4G8ReEfGHj7WNRtdHt9M8T6rBqFhBYXUjmIJaQwP5iNEiqzGHeSpb72O2T6HRRUyk5O7OijSjRjyR2u397v+oUUUVJqFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQB//9k=';
                doc.addImage(logoBase64, 'JPEG', startX, startY + 10, logoWidth, logoHeight);

                // Add the text "HealthHub"
                doc.setFontSize(12);
                doc.setTextColor(0, 0, 0); // Black text
                doc.text("HealthHub", startX + logoWidth, startY + 40); // Position the text next to the logo

                // Add the text "Health Care Facility System"
                doc.setFontSize(8);
                doc.setTextColor(100, 100, 100); // Gray text
                doc.text("Health Care Facility System", startX + logoWidth, startY + 45); // Position the text below "HealthHub"
            }

            // Main logic to generate the PDF
            // Add header
            addStyledHeader("Prescription Details", 10, 10, 190, 30);

            // Add body content
            let finalY = addBodyContent(
                currentData.prescription?.diagnosis || "No diagnosis provided.",
                currentData.prescriptionMed || [],
                20,
                50
            );

            // Add footer
            addFooter(10, finalY + 20);

            // Save the PDF
            doc.save(`Prescription_${currentData.appointment.appointment_id}.pdf`);
        });

        // Close modal
        document.querySelector(".modal-close").addEventListener("click", function() {
            modal.style.display = "none";
        });

        // Close modal when clicking outside of it
        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
</script>