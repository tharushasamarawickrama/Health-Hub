<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

$fetchedLabTests = ["TFT", "Allergy Test"];

?>

    <div class="dr-labtest-container">
        <a href="<?php echo URLROOT; ?>drAppointment" class="labtest-back-arrow"><img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back"></a>
        <div class="labtests-container">
            <h2>Lab Tests</h2>

            <!-- Display Fetched Lab Tests -->
            <div id="selected-tests" class="lab-tests-display">
                <?php if (!empty($fetchedLabTests)): ?>
                    <?php foreach ($fetchedLabTests as $test): ?>
                        <span class="test-tag">
                            <?php echo htmlspecialchars($test); ?>
                            <button class="remove-btn" onclick="removeTest('<?php echo htmlspecialchars($test); ?>')">&times;</button>
                        </span>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p id="no-tests-msg">No lab tests available.</p>
                <?php endif; ?>
            </div>

            <h3>Order Lab Test</h3>
            <div class="test-options">
                <div class="labtest-dropdown">
                    <button class="test-option-btn" onclick="toggleDropdown('bloodTests')">Blood Tests <span>&#x25BC;</span></button>
                    <div id="bloodTests" class="labtest-dropdown-content">
                        <a href="#" onclick="addTest('Complete Blood Count (CBC)')">Complete Blood Count (CBC)</a>
                        <a href="#" onclick="addTest('Liver Function Test (LFT)')">Liver Function Test (LFT)</a>
                        <a href="#" onclick="addTest('Kidney Function Test (KFT)')">Kidney Function Test (KFT)</a>
                        <a href="#" onclick="addTest('Lipid Panel (Cholesterol Test)')">Lipid Panel (Cholesterol Test)</a>
                        <a href="#" onclick="addTest('Blood Glucose Test')">Blood Glucose Test</a>
                        <a href="#" onclick="addTest('Hemoglobin A1C (HbA1c)')">Hemoglobin A1C (HbA1c)</a>
                    </div>
                </div>
                <div class="labtest-dropdown">
                    <button class="test-option-btn" onclick="toggleDropdown('urineTests')">Urine Tests <span>&#x25BC;</span></button>
                    <div id="urineTests" class="labtest-dropdown-content">
                        <a href="#" onclick="addTest('Urinalysis')">Urinalysis</a>
                        <a href="#" onclick="addTest('Urine Culture')">Urine Culture</a>
                        <a href="#" onclick="addTest('Pregnancy Test (hCG)')">Pregnancy Test (hCG)</a>
                    </div>
                </div>
                <div class="labtest-dropdown">
                    <button class="test-option-btn" onclick="toggleDropdown('imagingTests')">Imaging Tests <span>&#x25BC;</span></button>
                    <div id="imagingTests" class="labtest-dropdown-content">
                        <a href="#" onclick="addTest('X-Ray')">X-Ray</a>
                        <a href="#" onclick="addTest('MRI (Magnetic Resonance Imaging)')">MRI (Magnetic Resonance Imaging)</a>
                        <a href="#" onclick="addTest('CT Scan (Computed Tomography)')">CT Scan (Computed Tomography)</a>
                        <a href="#" onclick="addTest('Ultrasound')">Ultrasound</a>
                    </div>
                </div>
                <button class="test-option-btn" onclick="addTest('TFT')">TFT</button>
                <button class="test-option-btn" onclick="addTest('Electrolyte Panel')">Electrolyte Panel</button>
                <button class="test-option-btn" onclick="addTest('HIV Test')">HIV Test</button>
                <button class="test-option-btn" onclick="addTest('Allergy Test')">Allergy Test</button>
                <button class="test-option-btn" onclick="addTest('Blood Gas Test')">Blood Gas Test</button>
                <button class="test-option-btn" onclick="addTest('Vitamin D Test')">Vitamin D Test</button>
                <button class="test-option-btn" onclick="addTest('Bone Density Test')">Bone Density Test</button>
            </div>

            <div class="labtest-actions">
                <button class="labtest-button" onclick="clearTests()">Clear</button>
                <button class="labtest-button" onclick="saveTests()">Save</button>
            </div>
        </div>
    </div>

    <script>
        const selectedTests = <?php echo json_encode($fetchedLabTests); ?>;

        function addTest(testName) {
            if (!selectedTests.includes(testName)) {
                selectedTests.push(testName);
                updateTestDisplay();
            } else {
                alert(testName + " is already selected.");
            }
        }

        function removeTest(testName) {
            const index = selectedTests.indexOf(testName);
            if (index > -1) {
                selectedTests.splice(index, 1);
                updateTestDisplay();
            }
        }

        function updateTestDisplay() {
            const testContainer = document.getElementById("selected-tests");
            testContainer.innerHTML = "";
            
            if (selectedTests.length === 0) {
                testContainer.innerHTML = "<p id='no-tests-msg'>No lab tests available.</p>";
                return;
            }

            selectedTests.forEach(test => {
                const testTag = document.createElement("span");
                testTag.className = "test-tag";
                testTag.innerHTML = `${test} <button class="remove-btn" onclick="removeTest('${test}')">&times;</button>`;
                testContainer.appendChild(testTag);
            });
        }

        function clearTests() {
            selectedTests.length = 0;
            updateTestDisplay();
        }

        function saveTests() {
            alert("Lab tests saved: " + selectedTests.join(", "));
        }

        function toggleDropdown(id) {
            document.getElementById(id).classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.test-option-btn')) {
                const dropdowns = document.getElementsByClassName("labtest-dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>

<?php require APPROOT . '/views/Components/footer.php' ?>