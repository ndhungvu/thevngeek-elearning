$(document).ready(function(){
    if (typeof notify != 'undefined') {
        $.notify({
            // options
            message: notify.message
        },{
            // settings
            type: notify.level,
            timer: 500
        });
    }
});
