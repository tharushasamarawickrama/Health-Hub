function nextSection(sectionId) {
    document.querySelectorAll('.form-section').forEach(function (el) {
        el.classList.remove('active');
    });
    document.getElementById(sectionId).classList.add('active');
}

function prevSection(sectionId) {
    document.querySelectorAll('.form-section').forEach(function (el) {
        el.classList.remove('active');
    });
    document.getElementById(sectionId).classList.add('active');
}