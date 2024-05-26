
const noteCards = document.querySelectorAll('.noteCard');
// Loop through each note card and add event listeners
noteCards.forEach((noteCard) => {
    const cardText = noteCard.querySelector('.card-text');
    // Store the original height of the card text  
    const originalHeight = cardText.clientHeight;
    const originalwidth = noteCard.clientWidth;
    // Add a click event listener to expand and collapse the card text  
    noteCard.addEventListener('click', () => {
        if (cardText.style.height === 'auto') {
            cardText.style.height = originalHeight + 'px';
            cardText.style.overflow = 'hidden';
            cardText.style.textOverflow = 'ellipsis';
            cardText.style.display = '-webkit-box';
            cardText.style.webkitBoxOrient = 'vertical';
            cardText.style.webkitLineClamp = '8';
            cardText.style.whiteSpace = 'pre-wrap';
            cardText.style.width = '100%';
        } else {
            cardText.style.height = 'auto';
            cardText.style.overflow = 'visible';
            cardText.style.textOverflow = 'clip';
            // cardText.style.display = 'block';      
            cardText.style.webkitBoxOrient = 'vertical';
            cardText.style.webkitLineClamp = 'inherit';
            cardText.style.whiteSpace = 'pre-wrap';
            cardText.style.width = '100%';
        }
    });
});
const createNoteBtn = document.getElementById('createNoteBtn');
const addNoteBtn = document.getElementById('addBtn');
const closeNote = document.getElementById('note_headDiv');
const noteCol2 = document.getElementById('noteCol2');
const noteCol1 = document.getElementById('noteCol1');
let hoverEffectEnabled = true;

createNoteBtn.addEventListener('click', () => {
    // Define a variable to control the hover effect 
    if (noteCol2.style.display === 'none') {
        // console.log("inside if loop");
        noteCol2.style.display = 'block';
        noteCol1.style.width = '68%';
        createNoteBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';

        createNoteBtn.style.color = 'black';
        createNoteBtn.style.background = 'white';
        hoverEffectEnabled = true;
        // Add event listener for hover effect    
        createNoteBtn.addEventListener('mouseenter', function () {
            if (hoverEffectEnabled) {
                createNoteBtn.style.background = 'red';
                createNoteBtn.style.color = 'white';
            }
        });
        createNoteBtn.addEventListener('mouseleave', function () {
            if (hoverEffectEnabled) {
                createNoteBtn.style.background = 'white';
                // Reset to original color on mouseleave       
                createNoteBtn.style.color = 'black';
            }
        });
    } else if (noteCol2.style.display === 'block') {
        // console.log("inside else loop");
        noteCol2.style.display = 'none';
        noteCol1.style.width = '100%';
        createNoteBtn.innerHTML = '<i class="fa-solid fa-pen-to-square"></i>';
        createNoteBtn.style.color = 'white';
        createNoteBtn.style.background = 'linear-gradient(to bottom right, #2196F3, #0D47A1)';

        // Disable hover effect
        hoverEffectEnabled = false;
    }


});
addNoteBtn.addEventListener('click', () => {
    if (noteCol2.style.display === 'block') {
        noteCol2.style.display = 'none';
        noteCol1.style.width = '100%';
        createNoteBtn.innerHTML = '<i class="fa-solid fa-pen-to-square"></i>';
        createNoteBtn.style.color = 'white';
        createNoteBtn.style.background = 'linear-gradient(to bottom right, #2196F3, #0D47A1)';
        hoverEffectEnabled = false;
    }
});
closeNote.addEventListener('click', () => {
    if (noteCol2.style.display === 'block') {
        noteCol2.style.display = 'none';
        noteCol1.style.width = '100%';
        createNoteBtn.innerHTML = '<i class="fa-solid fa-pen-to-square"></i>';
        createNoteBtn.style.color = 'white';
        createNoteBtn.style.background = 'linear-gradient(to bottom right, #2196F3, #0D47A1)';
        hoverEffectEnabled = false;
    }
});
