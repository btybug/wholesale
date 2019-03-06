(function () {
    $('#login-form').on('submit', function (ev) {
        ev.preventDefault();

        const GOOGLE_RECAPTCHA_KEY = $('meta[name="google-recaptcha-key"]').attr("content");
        grecaptcha.ready(() => {
            grecaptcha.execute(GOOGLE_RECAPTCHA_KEY, { action: 'action_name' })
                .then((token) => {
                    $('.g-recaptcha-response').val(token);
                })
                .then(() => {
                    var data = $(this).serialize();

                    var errorHandler = function (fieldElement, errorObject, message, fieldElementName) {
                        var change = function (fieldElementChange, fieldElementNameChange) {
                            fieldElementChange.removeClass('transition-horizontal input-error');
                            $(fieldElementNameChange + '~p').remove();
                        };
                        change(fieldElement, fieldElementName);

                        var pTag = fieldElement.next().prop("tagName") !== 'p';

                        if (errorObject && message && pTag) {
                            fieldElement.parent().append('<p style="color: red; font-size: 12px; margin-top: 2px;">' + message + '</p>');
                            fieldElement.addClass('transition-horizontal input-error');
                            setTimeout(() => {
                                fieldElement.removeClass('transition-horizontal');
                            }, 500)
                        }
                        fieldElement.on('keypress', function () { change(fieldElement, fieldElementName) });
                        fieldElement.on('change', function () { change(fieldElement, fieldElementName) });
                    };

                    $.ajax({
                        type: "post",
                        url: "/login",
                        cache: false,
                        datatype: "json",
                        data: data,
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (data) {
                            if (!data.error) {
                                location.href = data.redirectPath
                                console.log(data)
                            } else {
                                alert('error')
                            }
                        },
                        error: function (error) {
                            var emailEl = $('#loginEmail');
                            var passwordEl = $('#loginPass');
                            errorHandler(emailEl, error.responseJSON.errors, error.responseJSON.errors.email, '#loginEmail');
                            errorHandler(passwordEl, error.responseJSON.errors, error.responseJSON.errors.password, '#loginPass');
                        }
                    });
                });
        });
    });

    $('#login-form-checkout').on('submit', function (ev) {
        ev.preventDefault();

        const GOOGLE_RECAPTCHA_KEY = $('meta[name="google-recaptcha-key"]').attr("content");
        grecaptcha.ready(() => {
            grecaptcha.execute(GOOGLE_RECAPTCHA_KEY, { action: 'action_name' })
                .then((token) => {
                    $('.g-recaptcha-response').val(token);
                })
                .then(() => {
                    var data = $(this).serialize();

                    var errorHandler = function (fieldElement, errorObject, message, fieldElementName) {
                        var change = function (fieldElementChange, fieldElementNameChange) {
                            fieldElementChange.removeClass('transition-horizontal input-error');
                            $(fieldElementNameChange + '~p').remove();
                        };
                        change(fieldElement, fieldElementName);

                        var pTag = fieldElement.next().prop("tagName") !== 'p';

                        if (errorObject && message && pTag) {
                            fieldElement.parent().append('<p style="color: red; font-size: 12px; margin-top: 2px;">' + message + '</p>');
                            fieldElement.addClass('transition-horizontal input-error');
                            setTimeout(() => {
                                fieldElement.removeClass('transition-horizontal');
                            }, 500)
                        }
                        fieldElement.on('keypress', function () { change(fieldElement, fieldElementName) });
                        fieldElement.on('change', function () { change(fieldElement, fieldElementName) });
                    };

                    $.ajax({
                        type: "post",
                        url: "/login",
                        cache: false,
                        datatype: "json",
                        data: data,
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (data) {
                            if (!data.error) {
                                location.href = data.redirectPath
                                console.log(data)
                            } else {
                                alert('error')
                            }
                        },
                        error: function (error) {
                            var emailEl = $('#loginEmail');
                            var passwordEl = $('#loginPass');
                            errorHandler(emailEl, error.responseJSON.errors, error.responseJSON.errors.email, '#loginEmail');
                            errorHandler(passwordEl, error.responseJSON.errors, error.responseJSON.errors.password, '#loginPass');
                        }
                    });
                });
        });
    });
})();
