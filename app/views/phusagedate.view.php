<?php require APPROOT . '/views/Components/header.php'; ?>
<?php require APPROOT . '/views/Components/phNavbar.php'; ?>
    <div class="ph-usage-date-content">
            <div class="ph-usage-date-back-button-container">
                <a href="<?php echo URLROOT; ?>/phdailyusage" class="ph-usage-date-back-button">
                <img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back" width="20px">
                Back
                </a>
            </div>
        <div class="ph-usage-date-usage">
            
            <div class="ph-usage-date-date">
            <p><strong><?php echo htmlspecialchars($data['issued_date']?? 'N/A'); ?></strong> </p>            

            </div>
            <table class="ph-usage-date-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>No.of units issued <small>(tablets/bottles)</small></th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($medications)): ?>
                    <?php foreach ($medications as $medication): ?>
                    <tr>
                    <td><?php echo htmlspecialchars($medication['name'] ?? 'N/A'); ?></td>
                    <?php if ($medication['measurement'] == 'ml'): ?>
                        <td><?php echo htmlspecialchars($medication['totalUnitsIssued'] ?? 'N/A'); ?> bottles</td>
                    <?php else: ?>
                        <td><?php echo htmlspecialchars($medication['totalUnitsIssued'] ?? 'N/A'); ?> tablets</td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No medications found</td></tr>
            <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php require APPROOT . '/views/Components/footer.php'; ?> 