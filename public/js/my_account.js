$(function () {

    $('#retrievingfilename').html5imageupload({
        onAfterProcessImage: function() {
            $('#filename').val($(this.element).data('name'));
        },
        onAfterCancel: function() {
            $('#filename').val('');
        }

    });

    $('#save').html5imageupload({
        onSave: function(data) {
        },

    });

    $('.dropzone').html5imageupload({
        data: {_token: $('meta[name="csrf-token"]').attr('content')},
        onSave:function () {
            console.log(data);
        }
    });
    $('.dropzone').html5imageupload({
        data: {_token: $('meta[name="csrf-token"]').attr('content')},
        onSave: function () {
        },
        onAfterCancel: function () {
            AjaxCall("/my-account/delete-avatar", {}, function (res) {
                if (!res.error) {

                }
            })
        }
    });
    $( "#myModal" ).on('shown.bs.modal', function(){
        $('#modaldialog').html5imageupload();
    });

});
