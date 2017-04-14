$(document).ready(function(){

});

function deleteMultiple(name) {
    if (typeof ajaxDeleteVariable !== 'undefined') {
        var items = getItemChoice(name);

        if (items.length) {
            var isDeleted = false;

            if (typeof ajaxMessage !== 'undefined') {
                isDeleted = confirmDelete(ajaxMessage.deleteMultiple.confirm);
            } else {
                alert('Do you want delete this categories');
            }

            if (isDeleted) {
                $.ajax({
                    type: 'POST',
                    url: ajaxDeleteVariable.route,
                    data: {
                        '_token': ajaxDeleteVariable.token,
                        'objectAjax': ajaxDeleteVariable.object,
                        'dataAjax': items
                    },
                    success:function(data){
                        if (data.status) {
                            $.each(data.data, function(key, value) {
                                $('#' + value).remove();
                            });
                        }

                        alert(data.message);
                    },
                    error: function(XMLHttpRequest) {
                        var messages = $.parseJSON(XMLHttpRequest.responseText);
                        var html = '';

                        $.each(messages, function(value) {
                            html += messages[value][0] + '\n';
                        });

                        alert(html);
                    }
                });
            }
        } else {
            if (typeof ajaxMessage !== 'undefined') {
                alert(ajaxMessage.deleteMultiple.not_select);
            } else {
                alert('Error handle message ajax');
            }
        }
    }
}

function getItemChoice(name) {
    var list = [];

    $("input[name='" + name + "']:checked").each(function () {
        list.push(this.value);
    });

    return list;
}