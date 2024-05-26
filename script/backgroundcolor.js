var selectedColor = localStorage.getItem('bgcolor') || '##b3d1f3';
var selectedTextColor = localStorage.getItem('textcolor') || '#000000';

function setColor() {
    selectedColor = $('#colorit').val();
    localStorage.setItem('bgcolor', selectedColor);
    $('.bg_change.selected').css('background-color', selectedColor);

    // Store cell colors in local storage
    var cellColors = {};
    $('.bg_change.selected').each(function () {
        var id = $(this).data('id');
        if (id) {
            cellColors[id] = selectedColor;
        }
    });
    localStorage.setItem('cellColors', JSON.stringify(cellColors));
}

function setTextColor() {
    selectedTextColor = $('#textcolorit').val();
    localStorage.setItem('textcolor', selectedTextColor);
    $('.bg_change.selected').css('color', selectedTextColor);

    // Store cell text colors in local storage
    var cellTextColors = {};
    $('.bg_change.selected').each(function () {
        var id = $(this).data('id');
        if (id) {
            cellTextColors[id] = selectedTextColor;
        }
    });
    localStorage.setItem('cellTextColors', JSON.stringify(cellTextColors));
}

function getColor() {
    $('#colorit').val(selectedColor);
}

function getTextColor() {
    $('#textcolorit').val(selectedTextColor);
}

// Set initial colors
getColor();
getTextColor();

// Retrieve cell colors and text colors from local storage and apply them to the corresponding cells
var cellColors = JSON.parse(localStorage.getItem('cellColors')) || {};
var cellTextColors = JSON.parse(localStorage.getItem('cellTextColors')) || {};
$.each(cellColors, function (id, color) {
    $('[data-id="' + id + '"]').addClass('selected').css('background-color', color);
    if (cellTextColors[id]) {
        $('[data-id="' + id + '"]').css('color', cellTextColors[id]);
    }
});

// Attach click handler to table cells
$('.bg_change').click(function () {
    $(this).toggleClass('selected');
    if ($(this).hasClass('selected')) {
        $(this).css({
            'background-color': selectedColor,
            'color': selectedTextColor
        });
    } else {
        $(this).css({
            'background-color': '',
            'color': ''
        });
    }
    // Update cell colors and text colors in local storage for the selected cell only
    var id = $(this).data('id');
    if (id) {
        var cellColors = JSON.parse(localStorage.getItem('cellColors')) || {};
        var cellTextColors = JSON.parse(localStorage.getItem('cellTextColors')) || {};
        if ($(this).hasClass('selected')) {
            cellColors[id] = selectedColor;
            cellTextColors[id] = selectedTextColor;
        } else {
            delete cellColors[id];
            delete cellTextColors[id];
        }
        localStorage.setItem('cellColors', JSON.stringify(cellColors));
        localStorage.setItem('cellTextColors', JSON.stringify(cellTextColors));
    }
});