<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

// Data passed from the controller
$allLabTests = $data['labTests']; // Categorized lab tests
$uncategorizedTests = $data['uncategorizedTests']; // Uncategorized lab tests
$fetchedLabTests = $data['fetchedLabTests']; // Lab tests linked to the current appointment

$today = date('Y-m-d');
$isPastAppointment = strtotime($appointment_date) < strtotime($today);
$notEditable = $isPastAppointment || $data['appointment_status'] === 'completed';

if($data['last_appointment_id']){
    $backPage = '&last_appointment=' . $data['last_appointment_id'];
}
else{
    $backPage = '';
}
?>

<div class="dr-labtest-container">
    <a href="<?php echo URLROOT; ?>drAppointment?appointment_id=<?= $appointment_id . $backPage; ?>" class="labtest-back-arrow">
        <img src="<?php echo URLROOT; ?>assets/images/arrow-back.png" alt="Back">
    </a>

    <div class="tabs-container">
    <div class="tabs">
        <button 
            class="tab-link <?= $notEditable ? '' : 'active' ?>" 
            onclick="<?= $notEditable ? 'return false;' : 'switchTab(event, \'order-tests\')' ?>" 
            <?= $notEditable ? 'disabled style="opacity: 0.6; cursor: not-allowed;"' : '' ?>
        >
            Order Lab Test
        </button>

        <button 
            class="tab-link <?= $notEditable ? 'active' : '' ?>" 
            onclick="switchTab(event, 'lab-reports')"
        >
            Lab Reports
        </button>
    </div>

        <!-- Order Lab Tests Section -->
        <div id="order-tests" class="tab-content <?= $notEditable ? '' : 'active' ?>">
            <!-- Display Selected Lab Tests -->
        <div id="selected-tests" class="lab-tests-display">
            <?php if (!empty($fetchedLabTests)): ?>
                <?php foreach ($fetchedLabTests as $test): ?>
                    <span class="test-tag">
                        <?php echo htmlspecialchars($test['labtest_name']); ?>
                        <button class="remove-btn" onclick="removeTest('<?php echo htmlspecialchars($test['labtest_name']); ?>')">&times;</button>
                    </span>
                <?php endforeach; ?>
            <?php else: ?>
                <p id="no-tests-msg">No lab tests available.</p>
            <?php endif; ?>
        </div>

        <!-- Dropdowns for Categorized Lab Tests -->
        <div class="test-options">
            <?php foreach ($allLabTests as $category): ?>
                <?php $tests = explode('|', $category['tests']); ?>
                <div class="labtest-dropdown">
                    <button class="test-option-btn" onclick="toggleDropdown('<?php echo $category['labtest_category']; ?>')">
                        <?php echo htmlspecialchars($category['labtest_category']); ?> <span>&#x25BC;</span>
                    </button>
                    <div id="<?php echo $category['labtest_category']; ?>" class="labtest-dropdown-content">
                        <?php foreach ($tests as $test): ?>
                            <a href="#" onclick="addTest('<?php echo htmlspecialchars($test); ?>', '<?php echo htmlspecialchars($test); ?>')">
                                <?php echo htmlspecialchars($test); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Uncategorized Lab Tests -->
            <?php foreach ($uncategorizedTests as $test): ?>
                <button class="test-option-btn" onclick="addTest('<?php echo htmlspecialchars($test['labtest_name']); ?>', '<?php echo htmlspecialchars($test['labtest_name']); ?>')">
                    <?php echo htmlspecialchars($test['labtest_name']); ?>
                </button>
            <?php endforeach; ?>
        </div>

            <div class="labtest-actions">
                <button class="labtest-button" onclick="clearTests()">Clear</button>
                <button class="labtest-button" onclick="saveTests()">Save</button>
            </div>
        </div>

        <!-- Lab Reports Section -->
        <div id="lab-reports" class="tab-content <?= $notEditable ? 'active' : '' ?>">
            <h3>Lab Reports</h3>
            <div class="lab-report-list">
                <?php foreach ($labReports as $labTestName => $labTestReport): 
                    $filePath = APPROOT . "/../public/assets/" . $labTestReport;
                ?>
                    <div class="lab-report-item">
                        <p><?php echo htmlspecialchars($labTestName); ?></p>
                        <?php if ($labTestReport): ?>
                            <button class="view-report-btn" onclick="window.open('<?php echo URLROOT . htmlspecialchars($labTestReport); ?>', '_blank')">View</button>
                        <?php else: ?>
                            <p class="missing-report">Report Not Available</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script id="selected-tests-data" type="application/json">
    <?php echo json_encode(array_map(function($test) {
        return $test['labtest_name'];
    }, $fetchedLabTests)); ?>
</script>
<script src="<?php echo URLROOT; ?>js/drLabTests.js?v=<?php echo time(); ?>"></script>

<?php require APPROOT . '/views/Components/footer.php'; ?>