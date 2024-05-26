new DataTable('#ceo_master_table', {
    scrollX: true,
    scrollY: 250,
    stateSave: true,
});
$(document).ready(function () {

    let table = new DataTable('#ceo_master_table');
    document.getElementById('ceo_master_table').addEventListener('click', function (event) {
        if (event.target.tagName === 'TD') {
            event.target.classList.toggle('expanded');
        }
    });
    $('#actionAll').on('click', function () {
        if ($('#actionAll:checked').length == $('#actionAll').length) {
            $('.action_cl').prop('checked', true);
        }
        else {
            $('.action_cl').prop('checked', false);
        }
    });

    const targetDiv = $('#mixedDataTableCont');
    const MixTableHideBtn = $('#mixhide_dropdown');
    $('#mixedTableShow').on('click', function () {
        if (targetDiv.css('display') === 'none') {
            targetDiv.css('display', 'block');
            MixTableHideBtn.css('display', 'block');
        } else if (targetDiv.css('display') === 'block') {
            MixTableHideBtn.css('display', 'none');
            targetDiv.css('display', 'none');
        } else {
            console.log('Error in launching the table! Please reload the page or contact the admin.');
        }
    });

    // const targetDiv = $('#mixedDataTableCont');
    // const MixTableHideBtn = $('#mixhide_dropdown');
    // //const computedStyle = getComputedStyle(targetDiv);
    // $('#mixedTableShow').on('click', function () {
    //     console.log("MixTableHideBtn", targetDiv);
    //     if (targetDiv.style.display === 'none') {
    //         targetDiv.style.display = 'block';
    //         MixTableHideBtn.style.display = 'block';
    //     } else if (targetDiv.style.display === 'block') {
    //         MixTableHideBtn.style.display = 'none';
    //         targetDiv.style.display = 'none';

    //     } else {
    //         console.log('Error in launching the table! Please reload the page or contact with the admin.');
    //     }

    // });

});