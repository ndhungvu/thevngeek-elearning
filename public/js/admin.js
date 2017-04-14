$(document).ready(function(){
    /**
     * Page: category.index
     * Show popover of this parent
     *
     * author: haihq
     */
    $('[data-toggle="popover"]').popover();

    /**
     * Page: category.create
     * Validate form create category
     *
     */
    $.validator.addMethod('fileSize', function(value, element, param) {
        //element.files[0].size ==> size is byte
        return this.optional(element) || (element.files[0].size <= param)
    });

    if (typeof category !== "undefined") {
        $("#category_form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 100
                },
                description: {
                    maxlength: 255
                },
                image: {
                    accept : true,
                    extension: 'jpeg|jpg|gif|bmp|png',
                    fileSize: 10485760
                }
            },
            messages: {
                name: {
                    required: category.name.required,
                    maxlength: category.name.max
                },
                description: {
                    maxlength: category.description.max
                },
                image: {
                    accept: category.image.accept,
                    extension: category.image.extension,
                    fileSize: category.image.fileSize
                }
            }
        });
    }

    /**
     * Page: user.create
     * Validate form create user
     *
     */
    if (typeof user !== "undefined") {
        $("#user_form").validate({
            rules: {
                fullname: {
                    required: true,
                    maxlength: 255
                },
                nickname: {
                    required: true,
                    maxlength: 100
                },
                email: {
                    required: true,
                    maxlength: 100,
                    email: true
                },
                password: {
                    required: true,
                    maxlength: 64
                },
                phone: {
                    maxlength: 100
                },
                facebook_link: {
                    maxlength: 255,
                    url: true
                },
                linkedin_link: {
                    maxlength: 255,
                    url: true
                },
                github_link: {
                    maxlength: 255,
                    url: true
                },
                stackoverflow_link: {
                    maxlength: 255,
                    url: true
                },
                status: {
                    required: true
                }
            },
            messages: {
                fullname: {
                    required: user.fullname.required,
                    maxlength: user.fullname.max
                },
                nickname: {
                    required: user.nickname.required,
                    maxlength: user.nickname.max
                },
                email: {
                    required: user.email.required,
                    maxlength: user.email.max,
                    email: user.email.email
                },
                password: {
                    required: user.password.required,
                    maxlength: user.password.max
                },
                phone: {
                    maxlength: user.phone.max
                },
                facebook_link: {
                    maxlength: user.facebook_link.max,
                    url: user.facebook_link.url
                },
                linkedin_link: {
                    maxlength: user.linkedin_link.max,
                    url: user.linkedin_link.url
                },
                github_link: {
                    maxlength: user.github_link.max,
                    url: user.github_link.url
                },
                stackoverflow_link: {
                    maxlength: user.stackoverflow_link.max,
                    url: user.stackoverflow_link.url
                },
                status: {
                    required: user.status.required
                }
            }
        });
    }

    /**
     * Page: document.create
     * Validate form create document
     *
     */
    if (typeof documentPage !== "undefined") {
        $("#document_form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                alias: {
                    required: true,
                    maxlength: 255
                },
                description: {
                    maxlength: 255
                },
                file: {
                    extension: 'doc|docx|dot|pdf|xlsx|xls|xlm|xla|xlc|xlt|xlw|xlam|xlsb|xlsm|xltm|csv',
                    fileSize: 20917520
                },
                link: {
                    maxlength: 255,
                    url: true
                }
            },
            messages: {
                name: {
                    required: documentPage.name.required,
                    maxlength: documentPage.name.max
                },
                alias: {
                    required: documentPage.alias.required,
                    maxlength: documentPage.alias.max
                },
                description: {
                    maxlength: documentPage.description.max
                },
                file: {
                    extension: documentPage.file.extension,
                    fileSize: documentPage.file.fileSize
                },
                link: {
                    maxlength: documentPage.link.max,
                    url: documentPage.link.url
                }
            }
        });
    }

    /**
     * Page: comment.edit
     * Validate form edit comment
     *
     */
    if (typeof comment !== "undefined") {
        $('input:radio[name="type"]').change(function(){
            var objectComment = '<option value="0">' + settings.placeholder_object + '</option>';

            if(this.value == 1){
                $.each(articles, function( index, value ) {
                    objectComment += '<option value="' + index +'">' + value + '</option>';
                });
            } else {
                $.each(documents, function( index, value ) {
                    objectComment += '<option value="' + index +'">' + value + '</option>';
                });
            }

            $('#object_id').html(objectComment);
        });

        $("#comment_form").validate({
            rules: {
                content: {
                    required: true
                },
                status: {
                    required: true
                },
                type: {
                    required: true
                }
            },
            messages: {
                content: {
                    required: comment.content.required
                },
                status: {
                    required: comment.status.required
                },
                type: {
                    required: comment.type.required
                }
            }
        });
    }

    /**
     * Page: search
     * Validate form search
     *
     */
    if (typeof searchPage !== "undefined") {
        $("#search_form").validate({
            rules: {
                keyword: {
                    maxlength: 255
                }
            },
            messages: {
                keyword: {
                    max: searchPage.keyword.max
                }
            }
        });
    }
});

/**
 * confirm before delete a item
 * @param message
 */
function confirmDelete(message) {
    return confirm(message);
}
