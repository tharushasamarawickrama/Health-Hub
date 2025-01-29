// Initialize selected tests from the controller's data
const selectedTests = JSON.parse(document.getElementById("selected-tests-data").textContent);

function addTest(testName, displayName) {
    if (!selectedTests.includes(testName)) {
        selectedTests.push(testName);
        updateTestDisplay();

        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Adds a smooth scrolling effect
        });

    } else {
        alert(displayName + " is already selected.");
    }
}

function removeTest(testName) {
    const index = selectedTests.indexOf(testName);
    if (index > -1) {
        selectedTests.splice(index, 1);
        updateTestDisplay();
    } else {
        alert("Test not found.");
    }
}

function updateTestDisplay() {
    const testContainer = document.getElementById("selected-tests");
    testContainer.innerHTML = "";

    if (selectedTests.length === 0) {
        testContainer.innerHTML = "<p id='no-tests-msg'>No lab tests available.</p>";
        return;
    }

    selectedTests.forEach(testName => {
        const testTag = document.createElement("span");
        testTag.className = "test-tag";
        testTag.innerHTML = `
            ${testName}
            <button class="remove-btn" onclick="removeTest('${testName}')">&times;</button>
        `;
        testContainer.appendChild(testTag);
    });
}

function clearTests() {
    selectedTests.length = 0;
    updateTestDisplay();
    window.scrollTo(0, 0);
}

function saveTests() {
    const form = document.createElement('form');
    form.method = 'POST';

    selectedTests.forEach(testName => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'tests[]';
        input.value = testName;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    dropdown.classList.toggle("show");
}

// Close dropdowns if clicked outside
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
};

// Initialize the test display
updateTestDisplay();
