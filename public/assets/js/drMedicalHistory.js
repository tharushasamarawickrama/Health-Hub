document.addEventListener('DOMContentLoaded', function () {
    const editButton = document.getElementById('edit-btn');
    const saveButton = document.getElementById('save-btn');
    const container = document.querySelector('.medical-history-container');
    const addItemButtons = document.querySelectorAll('.add-item-button');

    // Initially hide add-item buttons
    addItemButtons.forEach(button => {
        button.hidden = true;
    });

    // Toggle edit mode
    editButton.addEventListener('click', function () {
        container.classList.add('editing');
        editButton.hidden = true;
        saveButton.hidden = false;

        // Show add-item buttons in edit mode
        addItemButtons.forEach(button => {
            button.hidden = false;
        });
    });

    saveButton.addEventListener('click', function () {
        container.classList.remove('editing');
        editButton.hidden = false;
        saveButton.hidden = true;

        // Hide add-item buttons when not in edit mode
        addItemButtons.forEach(button => {
            button.hidden = true;
        });

        // Optional: Submit the form
        // document.getElementById('history-form').submit();
    });

    // Add new item to the appropriate section
    addItemButtons.forEach(button => {
        button.addEventListener('click', function () {
            const section = button.getAttribute('data-section'); // Get the section identifier
            const list = document.getElementById(`${section}-list`); // Target the appropriate list

            const li = document.createElement('li');
            li.innerHTML = `
                <div class="edit-mode">
                    <input type="text" name="${section}_keys[]" placeholder="Enter key">
                    <input type="text" name="${section}_values[]" placeholder="Enter value">
                </div>
                <span class="display-mode" hidden>New Entry</span>
            `;
            list.appendChild(li);
        });
    });
});
