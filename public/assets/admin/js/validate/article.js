$("#frmArticle").validate({
    rules: {
        name: {
            required: true
        },
        content: {
            required: true
        },
        time_tracking : {
            required: true,
            number: true
        }
    },
    messages: {
        
    },
    ignore: []
});