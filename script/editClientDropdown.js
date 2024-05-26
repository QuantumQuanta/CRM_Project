$('#offcanvas_toggler').contextmenu( function(event){
    event.preventDefault();
    var ce = document.getElementById('client_edit_dropdown-content');
    if(ce.style.display ==='none'){
        ce.style.display ='block';
    }
    else{
        ce.style.display ='none';
    }
})