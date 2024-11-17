document.addEventListener('DOMContentLoaded', () => {
    const addMedicationButton = document.getElementById('add-medication');
    const medicationsTable = document.getElementById('medications-table');

    addMedicationButton.addEventListener('click', () => {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" placeholder="Medication Name"></td>
            <td><input type="number" placeholder="Quantity"></td>
            <td>
                <select>
                    <option value="mg">mg</option>
                    <option value="ml">ml</option>
                    <option value="gtt">gtt</option>
                    <option value="tab">tab</option>
                    <option value="cap">cap</option>
                </select>
            </td>
            <td>
                <select>
                    <option value="qd">qd</option>
                    </select>
            </td>
            <td>
                <select>
                    <option value="365">365</option>
                    <option value="52">52</option>
                    <option value="12">12</option>
                </select>
            </td>
            <td><button class="remove-medication">Remove</button></td>
        `;
        medicationsTable.appendChild(newRow);

        // Add event listener to remove button
        const removeButton = newRow.querySelector('.remove-medication');
        removeButton.addEventListener('click', () => {
            medicationsTable.removeChild(newRow);
        });
    });
});