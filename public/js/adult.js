/**
 * Created by sahak on 1/7/2019.
 */
$(document).ready(function () {
    var modalHtml='<div class="modal adult-modal" tabindex="-1" role="dialog">' +
        '<div class="modal-dialog modal-lg modal-dialog-centered" role="document">' +
        '<div class="modal-content rounded-0">' +
        '<div class="modal-body d-flex flex-column">' +
        '<h2 class="font-25 font-main-bold text-uppercase text-center mb-5">Are you of legal smoking age ?</h2>' +
        '<div class="d-flex justify-content-center">' +
        '<button type="button" class="btn ntfs-btn adult col-3 mr-4 rounded-0">Yes (18+)</button>' +
        '<button type="button" class="btn btn-transp not-adult col-3 rounded-0" data-dismiss="modal">No (under 18)</button>' +
        '</div>' +
        '<div class="mt-auto text-center">' +
        '<p class="text-uppercase mb-0 font-12"><i>The products of this website are intended for adults only.</i></p>'+
        '<p class="font-12"><i>By entering this website, you certify that you are of legel smoking age, in the district in which you reside.</i></p>'+
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';

    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function setCookie(name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    }

    if(!getCookie('adult')){
        $('body').append(modalHtml);
        $('body').find('.adult-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
    }
    $('body').on('click','.not-adult',function () {
        window.location='http://www.google.com';
    });
    $('body').on('click','.adult',function () {
       setCookie('adult',1,3600*24*40);
        window.location.reload();
    });
});

