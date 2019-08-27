
const GOOGLE_RECAPTCHA_KEY = $('meta[name="google-recaptcha-key"]').attr("content");
console.log();
function onRecaptchaLoadCallback() {
    var clientId = grecaptcha.render('inline-badge', {
        'sitekey': GOOGLE_RECAPTCHA_KEY,
        'badge': 'bottomleft',
        'size': 'invisible'
    });
}
(function(){
    $('body').on('change','.wholesaler_radio', function(ev) {
        if($(this).val() == 1){
            $("body").find(".wholesaler-box").addClass('show').removeClass('d-none');
        }else{
            $("body").find(".wholesaler-box").addClass('d-none').removeClass('show');
        }
    });


    $('#register-form-1').on('submit', function(ev) {
		ev.preventDefault();

        grecaptcha.ready(() => {

            grecaptcha.execute(GOOGLE_RECAPTCHA_KEY, { action: 'action_name'})
                .then((token) => {
                    $('.g-recaptcha-response').val(token);
                })
                .then(() => {
                    var data = $(this).serialize();

                    const firstNameEl = $('#firstName');
                    const lastNameEl = $('#lastName');
                    const emailEl = $('#e-mail');
                    const phoneEl = $('#phoneNumber');
                    const passwordEl = $('#password');
                    const wholesaler_radio = $('.wholesaler_radio');
                    const companyName = $('#companyName');
                    const companyNumber = $('#companyNumber');

                    const errorHandler = (fieldElement, errorObject, message, fieldElementName) => {
                        const change = (fieldElementChange, fieldElementNameChange) => {
                            fieldElementChange.removeClass('transition-horizontal input-error');
                            $(fieldElementNameChange + '~p').remove();
                        };
                        change(fieldElement, fieldElementName);

                        const pTag = fieldElement.next().prop("tagName") !== 'p';

                        if (errorObject && message && pTag) {
                            fieldElement.parent().append('<p style="color: red; font-size: 12px; margin-top: 2px;">' + message + '</p>');
                            fieldElement.addClass('transition-horizontal input-error');
                            setTimeout(() => {
                                fieldElement.removeClass('transition-horizontal');
                            }, 500);
                        }
                        fieldElement.on('keypress', () => change(fieldElement, fieldElementName));
                        fieldElement.on('change', () => change(fieldElement, fieldElementName));
                    };
                    // const validation = () => {
                    //     !firstNameEl.val() && errorHandler(firstNameEl, true, 'The name field is required.', '#firstName');
                    //     firstNameEl.val().length === 1 && errorHandler(firstNameEl, true, 'The name must be at least 2 characters.', '#firstName');
                    //     !lastNameEl.val() && errorHandler(lastNameEl, true, 'The name field is required.', '#lastName');
                    //     lastNameEl.val().length === 1 && errorHandler(lastNameEl, true, 'The name must be at least 2 characters.', '#lastName');
                    // }
                    // validation() &&
                    $.ajax({
                        type: "post",
                        url: "/register",
                        cache: false,
                        datatype: "json",
                        data: data,
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                        },
                        success: (data) => {
                            if (!data.error) {
                                window.location = data.redirectPath;
                            }
                        },
                        error: (error) => {
                            console.log($('form')[0])
                            errorHandler(firstNameEl, error.responseJSON.errors, error.responseJSON.errors.name, '#firstName');
                            errorHandler(lastNameEl, error.responseJSON.errors, error.responseJSON.errors.last_name, '#lastName');
                            errorHandler(emailEl, error.responseJSON.errors, error.responseJSON.errors.email, '#e-mail');
                            errorHandler(phoneEl, error.responseJSON.errors, error.responseJSON.errors.phone, '#phoneNumber');
                            errorHandler(passwordEl, error.responseJSON.errors, error.responseJSON.errors.password, '#password');
                            console.log(wholesaler_radio.val(), typeof wholesaler_radio.val())
                            if(wholesaler_radio.val()){

                                errorHandler(companyName, error.responseJSON.errors, error.responseJSON.errors.company_name, '#companyName');
                                errorHandler(companyNumber, error.responseJSON.errors, error.responseJSON.errors.company_number, '#companyNumber');

                            }
                        }
                    });
                });
        });
    });
})();
