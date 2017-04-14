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
            number: true,
            min: 0,
            max: 1000
        }
    },
    messages: {
        name: {
            required: Lang.get('validation.required', {'attribute': Lang.get('validation.attributes.name')})
        },
        content: {
            required: Lang.get('validation.required', {'attribute': Lang.get('validation.attributes.content')})
        },
        time_tracking: {
            required: Lang.get('validation.required', {'attribute': Lang.get('validation.attributes.time_tracking')}),
            number: Lang.get('validation.numeric', {'attribute': Lang.get('validation.attributes.time_tracking')}),
            min: Lang.get('validation.min.numeric', {'attribute': Lang.get('validation.attributes.time_tracking'), 'min': 0}),
            max: Lang.get('validation.max.numeric', {'attribute': Lang.get('validation.attributes.time_tracking'), 'max' :1000 }),
        }
    },
    ignore: []
});