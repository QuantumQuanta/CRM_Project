$(document).ready(function () {
    document.querySelector('#emp_stat').addEventListener("change", function () {
        var stat_val = this.value;
        switch(stat_val){
            case 'active':
                alert('Active');
                break;
            case 'on_call':
                alert('On a Call!');
                break;
            default:    
                alert('default choice');
        }
    })

})