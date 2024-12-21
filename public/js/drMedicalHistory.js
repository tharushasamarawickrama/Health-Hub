document.addEventListener('DOMContentLoaded', function () {
    const editButton = document.getElementById('edit-btn');
    const saveButton = document.getElementById('save-btn');
    const container = document.querySelector('.medical-history-container');
    const addItemButtons = document.querySelectorAll('.add-item-button');

    // Initially hide add-item buttons
    addItemButtons.forEach(button => (button.hidden = true));

    // Enable edit mode
    editButton.addEventListener('click', function () {
        container.classList.add('editing');
        editButton.hidden = true;
        saveButton.hidden = false;

        // Show add-item buttons in edit mode
        addItemButtons.forEach(button => (button.hidden = false));

        // Show edit mode for all list items
        document.querySelectorAll('.display-mode').forEach(el => (el.hidden = true));
        document.querySelectorAll('.edit-mode').forEach(el => (el.hidden = false));

        // Add delete icons to existing items in edit mode
        document.querySelectorAll('.edit-mode').forEach(function (editMode) {
            const deleteIcon = document.createElement('button');
            deleteIcon.className = 'delete-icon';
            deleteIcon.textContent = '🗑';
            deleteIcon.title = 'Delete';

            deleteIcon.addEventListener('click', function () {
                const listItem = editMode.closest('li');
                if (confirm('Are you sure you want to delete this item?')) {
                    listItem.remove();
                }
            });

            editMode.appendChild(deleteIcon);
        });
    });

    // Save changes and disable edit mode
    saveButton.addEventListener('click', function (event) {
        const form = document.getElementById('history-form');
        let isValid = true;

        // Validate inputs
        document.querySelectorAll('.edit-mode input').forEach(input => {
            if (input.value.trim() === '') {
                isValid = false;
                input.classList.add('error'); // Highlight empty fields
            } else {
                input.classList.remove('error');
            }
        });

        if (!isValid) {
            alert('Please fill in all fields or remove empty inputs.');
            event.preventDefault();
            return;
        }

        // Remove empty list items dynamically
        document.querySelectorAll('ul li').forEach(li => {
            const inputs = li.querySelectorAll('input');
            if (Array.from(inputs).every(input => input.value.trim() === '')) {
                li.remove();
            }
        });

        // Submit the form after validation
        form.submit();
    });

    //Add new item to the appropriate section
    addItemButtons.forEach(button => {
        button.addEventListener('click', function () {
            const section = button.getAttribute('data-section'); // Get the section identifier
            const list = document.getElementById(`${section}-list`); // Target the appropriate list

            const li = document.createElement('li');
            li.innerHTML = `
                <div class="edit-mode">
                    <input type="text" name="${section}_keys[]" placeholder="Enter key">
                    <input type="text" name="${section}_values[]" placeholder="Enter value">
                    <button type="button" class="delete-icon">🗑</button>
                </div>
                <span class="display-mode" hidden>New Entry</span>
            `;

            // Add event listener for the delete icon of new items
            const deleteIcon = li.querySelector('.delete-icon');
            deleteIcon.addEventListener('click', function () {
                if (confirm('Are you sure you want to delete this item?')) {
                    li.remove();
                }
            });

            // Append new list item
            list.appendChild(li);
        });
    });
});
