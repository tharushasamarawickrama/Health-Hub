document.addEventListener('DOMContentLoaded', () => {
    const medicationsList = document.getElementById('medications-list');
    const addMedicationButton = document.getElementById('add-medication');
    const clearMedicationsButton = document.getElementById('clear-medications');

    // Input validation function
    const validateInput = (input, type) => {
        if (type === 'medication_qty' && input.value < 1) {
            input.value = 1; // Ensure qty is always at least 1
        }
        if (type === 'duration_value') {
            if (input.value < 1) input.value = 1; // Ensure duration_value is at least 1
            if (input.value > 364) input.value = 364; // Cap at 364
        }
    };

    // Attach input listeners to all current and future inputs for medication_qty and duration_value
    medicationsList.addEventListener('input', (e) => {
        if (e.target.name === 'medication_qty') {
            validateInput(e.target, 'medication_qty');
        }
        if (e.target.name === 'duration_value') {
            validateInput(e.target, 'duration_value');
        }
    });

    // Function to add a new medication row
    const addMedicationRow = () => {
        const newRow = document.createElement('tr'); // Create a new table row
        newRow.innerHTML = `
            <td>
                <input type="text" name="medication_name" class="form-control" value="">
            </td>
            <td>
                <input type="number" name="medication_qty" value="">
            </td>
            <td>
                <select name="medication_measurement">
                    <option value=""></option>
                    <option value="mg">mg</option>
                    <option value="ml">ml</option>
                    <option value="tab">tab</option>
                </select>
            </td>
            <td>
                <div class="sig-codes">
                    <select name="sig_codes[]">
                        <option value=""></option>
                        <option value="po">po</option>
                        <option value="mane">mane</option>
                        <option value="bid">bid</option>
                    </select>
                    <button type="button" class="add-sig-code">+</button>
                </div>
            </td>
            <td>
                <div class="duration">
                    <input type="number" name="duration_value" value=""> / 
                    <select name="duration_period">
                        <option value=""></option>
                        <option value="12">12</option>
                        <option value="52">52</option>
                        <option value="365">365</option>
                    </select>
                </div>
            </td>
            <td>
                <button type="button" class="delete-medication">Delete</button>
            </td>
        `;
        medicationsList.appendChild(newRow); // Add the new row to the medications list
    };

    // Add a new medication row on button click
    addMedicationButton.addEventListener('click', addMedicationRow);

    // Clear all medications
    clearMedicationsButton.addEventListener('click', () => {
        medicationsList.innerHTML = ''; // Clear the table body
    });

    // Event delegation for dynamic elements
    medicationsList.addEventListener('click', (e) => {
        // Handle delete medication
        if (e.target.classList.contains('delete-medication')) {
            e.target.closest('tr').remove();
        }

        // Handle add sig code
        if (e.target.classList.contains('add-sig-code')) {
            const sigCodesDiv = e.target.closest('.sig-codes');
            const newSigCode = document.createElement('select');
            newSigCode.name = "sig_codes[]"; // Ensure this aligns with backend expectations
            newSigCode.innerHTML = `
                <option value=""></option>
                <option value="po">po</option>
                <option value="mane">mane</option>
                <option value="bid">bid</option>
            `;
            sigCodesDiv.insertBefore(newSigCode, e.target); // Insert before the "+" button
        }
    });

    document.getElementById('doctor-prescription-form').addEventListener('submit', function (e) {
        const medications = [];
        const rows = document.querySelectorAll('#medications-list tr');
        
        rows.forEach(row => {
            const name = row.querySelector('[name="medication_name"]').value;
            const qty = row.querySelector('[name="medication_qty"]').value;
            const measurement = row.querySelector('[name="medication_measurement"]').value;
            
            const sigCodes = Array.from(row.querySelectorAll('[name="sig_codes[]"]'))
                .map(select => select.value)
                .filter(value => value)
                .join(',');
    
            const durationValue = row.querySelector('[name="duration_value"]').value;
            const durationPeriod = row.querySelector('[name="duration_period"]').value;
    
            const duration = `${durationValue},${durationPeriod}`;
            
            medications.push({ name, quantity: qty, measurement, sig_codes: sigCodes, duration });
        });
    
        const formattedData = {
            diagnosis: document.getElementById('diagnosis-text').value,
            medications
        };
    
        document.getElementById('formatted_prescription_data').value = JSON.stringify(formattedData);
    });
    
});
