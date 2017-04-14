
/*Add Question*/
$('.jsAddQuestion').on('click', function() {
    var _numberQuestion = Number(new Date());
    var _question = '<div class="question" attr-question = "'+ _numberQuestion +'">' +
                '<div class="col-sm-11 p-10">' +
                    '<div class="form-group">' +
                        '<label for="content" class="col-sm-2 control-label">'+ Lang.get('general.label.question') +'</label>' +
                        '<div class="col-sm-10">' +
                            '<textarea class="form-control" rows="3" name="content['+ _numberQuestion +']" cols="50" id="content"></textarea>' +
                        '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                        '<label for="description" class="col-sm-2 control-label">'+ Lang.get('general.label.explain') +'</label>' +
                        '<div class="col-sm-10">' +
                            '<textarea class="form-control" rows="3" name="description['+ _numberQuestion +']" cols="50" id="description"></textarea>' +
                        '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                        '<label for="awser" class="col-sm-2 control-label">'+ Lang.get('general.label.answer') +'</label>' +
                        '<div class="awsers col-sm-10"></div>' +
                        '<div class="col-sm-10 col-sm-offset-2 p-3">' +
                            '<a href="javascript:void(0);" class="btn btn-warning jsAddAwser">'+ Lang.get('general.label.add_answer') +'</a>' +
                        '</div>  ' +          
                    '</div>' +                                
                '</div>' +
                '<div class="col-sm-1 w-50 p-10">' +
                     '<a href="javascript:void(0);" class="btn btn-danger btn-xs jsRemoveQuestion"><i class="fa fa-fw fa-trash-o"></i></a>' +
                '</div>' +
            '</div>';
    $('.questions').append(_question);
    removeQuestion($('.question[attr-question="'+ _numberQuestion +'"] .jsRemoveQuestion'));
    addAwser($('.question[attr-question="'+ _numberQuestion +'"] .jsAddAwser'), _numberQuestion);
})

/*Add Awser*/
function addAwser(item, _numberQuestion) {
    item.on('click', function() {
        var _numberAwser = Number(new Date());
        var _awser = '<div class="awser col-sm-12 p-3" attr-awser="'+ _numberAwser +'">' +
                        '<input type="hidden" class="isCorrect" name="is_correct['+ _numberQuestion +'][]" value="0"/>' +
                        '<div class="col-sm-1 w-30">' +
                            '<input type="checkbox" class="jsCheckbox">' +
                        '</div>' +
                        '<div class="col-sm-8">' +
                            '<input class="form-control" rows="3" name="awnser['+ _numberQuestion +'][]" type="text" value="">' +
                        '</div>' +                        
                        '<div class="col-sm-1 w-30">' +
                            '<a href="javascript:void(0);" class="btn btn-danger btn-xs jsRemoveAwser"><i class="fa fa-fw fa-trash-o"></i></a>' +
                        '</div>' +
                    '</div>';
        $('.question[attr-question="'+ _numberQuestion +'"] .awsers').append(_awser);
        removeAwser($('.question[attr-question="'+ _numberQuestion +'"] .awser[attr-awser = "'+ _numberAwser +'"] .jsRemoveAwser'));
        checkCorrectAwser($('.question[attr-question="'+ _numberQuestion +'"] .awser[attr-awser = "'+ _numberAwser +'"] .jsCheckbox'));
    })
}

/*Remove Question*/
function removeQuestion(item) {
    item.on('click', function() {
        item.closest('.question').remove();
    })
}

/*Remove Awser*/
function removeAwser(item) {
    item.on('click', function() {
        item.closest('.awser').remove();
    })
}

/*Check awser is correct*/
function checkCorrectAwser(item) {
    item.on('click', function() {
        if($(this).is(':checked')) {
            item.closest('.awser').find('.isCorrect').val(1);
        }
        else{
            item.closest('.awser').find('.isCorrect').val(0);
        }        
    })
}

loadQuestions();
function loadQuestions() {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: window.location.href,
        type: 'GET',
        data: {_token: token},
        dataType: 'JSON',
        success: function (res) {
            if (res.status) {
                console.log(res);
                var questions = res.data.questions;
                $('.questions').html('');
                $.each(questions, function (key, question) {
                    _numberQuestion = question.id;
                    var _html = ' <div class="question" attr-question="'+ _numberQuestion +'">' +
                                '<div class="col-sm-11 p-10">' +
                                    '<div class="form-group">' +
                                        '<label for="content" class="col-sm-2 control-label">'+ Lang.get('general.label.question') +'</label>' +
                                        '<div class="col-sm-10">' +
                                            '<textarea class="form-control" rows="3" name="content['+ _numberQuestion +']" cols="50" id="content">'+ question.content +'</textarea>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="form-group">' +
                                        '<label for="description" class="col-sm-2 control-label">'+ Lang.get('general.label.explain') +'</label>' +
                                        '<div class="col-sm-10">' +
                                            '<textarea class="form-control" rows="3" name="description['+ _numberQuestion +']" cols="50" id="description">'+ question.description +'</textarea>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="form-group">' +
                                        '<label for="awser" class="col-sm-2 control-label">'+ Lang.get('general.label.answer') +'</label>' +
                                        '<div class="awsers col-sm-10">';
                                            var awsers = question.awsers;
                                            $.each(awsers, function (key, awser) {
                                                _numberAwser = awser.id;
                                                _checked = awser.is_correct ? 'checked' : '';
                                                _html = _html + '<div class="awser col-sm-12 p-3" attr-awser="'+ _numberAwser +'">' +
                                                                    '<input type="hidden" class="isCorrect" name="is_correct['+ _numberQuestion +'][]" value="'+ awser.is_correct +'">' +
                                                                    '<div class="col-sm-1 w-30">' +
                                                                        '<input type="checkbox" class="jsCheckbox" ' + _checked + '>' +
                                                                    '</div>' +
                                                                    '<div class="col-sm-8">' +
                                                                        '<input class="form-control" rows="3" name="awnser['+ _numberQuestion +'][]" type="text" value="'+ awser.content +'">' +
                                                                    '</div>' +
                                                                    '<div class="col-sm-1 w-30">' +
                                                                        '<a href="javascript:void(0);" class="btn btn-danger btn-xs jsRemoveAwser"><i class="fa fa-fw fa-trash-o"></i></a>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                                '<script>' +
                                                                    '$(document).ready(function() {' +
                                                                        'removeAwser($(".question[attr-question=\'' + _numberQuestion + '\'] .awser[attr-awser = \''+ _numberAwser +'\'] .jsRemoveAwser"));' +
                                                                        'checkCorrectAwser($(".question[attr-question=\''+ _numberQuestion +'\'] .awser[attr-awser = \'' + _numberAwser + '\'] .jsCheckbox"));' +
                                                                    '})' +
                                                                '</script>';

                                                
                                                
                                           });
                        _html = _html + '</div>' +
                                        '<div class="col-sm-10 col-sm-offset-2 p-3">' +
                                            '<a href="javascript:void(0);" class="btn btn-warning jsAddAwser">'+ Lang.get('general.label.add_answer') +'</a>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                                    '<div class="col-sm-1 w-50 p-10">' +
                                        '<a href="javascript:void(0);" class="btn btn-danger btn-xs jsRemoveQuestion">' +
                                            '<i class="fa fa-fw fa-trash-o"></i>' +
                                        '</a>' +
                                    '</div>' +
                            '</div>';
                    $('.questions').append(_html);
                    removeQuestion($('.question[attr-question="'+ _numberQuestion +'"] .jsRemoveQuestion'));
                    addAwser($('.question[attr-question="'+ _numberQuestion +'"] .jsAddAwser'), _numberQuestion);
                });
            }
        },
        error: function () {
        }
    });
}
