$(document).ready(function () {
    $('body').on('click', '.cancel-comment', function (event) {
        $(this).parents('form:first')[0].reset();
    });

    $('body').on('click', '.cancel-reply', function (event) {
        $(this).parents('.user-add-comment').remove();
    });

    $('body').on('click', '.add-comment-btn', function (event) {
        event.preventDefault();
        var form = $(this).parents('form:first');
        var data = form.serialize();
        $.ajax({
            url: "/add-comment",
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('.error-box').html('');
                form[0].reset();
                if (data.success == false) {
                    $(".message-place").text(data.message);
                    $.map(data.errors, function (k, v) {
                        form.find('.' + v).text(k[0]);
                    });
                } else {
                    $(".user-add-comment-secondry").remove();
                    $(".message-place").text(data.message);
                    if (data.render == true) {
                        $(".comments-refresh").html(data.html);
                    }
                }
            },
            error: function (data) {
                // $(".message-place").text(data.message);
            }
        });
    });

    $('body').on('click', '.delete-comment', function (event) {
        event.preventDefault();
        let $_this = $(this);
        var form = $(this).parents('form:first');

        $.ajax({
            url: "/delete-comment",
            type: 'POST',
            data: {id: $(this).data('id')},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('.error-box').html('');
                if (data.success == false) {
                    $(".message-place").text(data.message);
                } else {
                    $(".user-add-comment-secondry").remove();
                    $(".message-place").text(data.message);
                    $_this.closest('.user-comment-img').remove();
                }
            },
            error: function (data) {
                // $(".message-place").text(data.message);
            }
        });
    });

    $('body').on('click', '.reply', function (e) {
        e.preventDefault();
        $(".user-add-comment-secondry").remove();
        var parentID = $(this).data('id');
        var data = $('#reply-comment').html();
        data = data.replace(/{parent}/g, parentID);

        $(this).closest(".card.arrow.left").append(data);
        $('.comments-refresh .user-comment-img').removeClass('user-commmet-add')
        $(this).closest(".user-comment-img").addClass("user-commmet-add");
        $('.comments-refresh .btn.reply').removeClass('d-none')
        $(this).addClass('d-none');
    })
});
