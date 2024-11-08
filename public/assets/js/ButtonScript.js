// buttonScript.js

// JS to dynamically create buttons 1 to 25
const buttonGrid = document.querySelector('.button-grid');

// Create buttons from 1 to 25 and add to the grid
for (let i = 1; i <= 25; i++) {
    const button = document.createElement('button');
    button.innerText = i;
    button.addEventListener('click', () => {
        alert(`You selected number: ${i}`);
    });
    buttonGrid.appendChild(button);
}
