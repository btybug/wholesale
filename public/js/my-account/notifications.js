/**
 * Created by hook on 1/9/2019.
 */

$(document).ready(function(){

    function Get_content() {
        var _this = this;

        this.myEvents = function(){

            $(".__modal").click(function(){
                let data = {id:$(this).attr("data-id"),object:$(this).attr("data-object")};
                var button=$(this);

                $.ajax({
                    url: "/my-account/notifications",
                    method: "POST",
                    data:data,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(responce){
                        if(!responce.error){
                            $(".modal-body-info").html(responce.message.content);
                            $("#notif_modal").modal();
                            button.closest('tr').attr('style','')
                        }

                    }
                })
            })

        }();

    }

    var app = new Get_content();

    $("body").on('change', '.message-checkbox', function () {
        var notifications = [];
        $.each($("input[name='notifications']:checked"), function () {
            var not_checkbox = $(this);
            notifications.push({id: not_checkbox.attr('data-id'), object: not_checkbox.attr('data-object')});
        });

        if (notifications.length > 0) {
            $(".notification-actions-bar").removeClass('d-none').addClass('d-flex')
        } else {
            $(".notification-actions-bar").removeClass('d-flex').addClass('d-none')
        }
    });

    $("body").on('click', '.mark-us-read', function () {
        var notifications = [];
        var button=$(this);
        $.each($("input[name='notifications']:checked"), function () {
            var not_checkbox = $(this);
            notifications.push({id: not_checkbox.attr('data-id'), object: not_checkbox.attr('data-object')});
        });
        console.log('mark-us-read', notifications)
        if (notifications.length > 0) {
            $.ajax({
                type: "post",
                url: "/my-account/mark-us-read-notifications",
                cache: false,
                datatype: "json",
                data: {ids: notifications},
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function (data) {
                    if (!data.error) {
                        data.result.map(function(element) {
                            $(element.attr_id).addClass('notification-is_read');
                        });
                    } else {
                        alert('error')
                    }
                }
            });
        }
    });

    $("body").on('click', '.mark-us-unread', function () {
        var notifications = [];
        $.each($("input[name='notifications']:checked"), function () {
            var not_checkbox = $(this);
            notifications.push({id: not_checkbox.attr('data-id'), object: not_checkbox.attr('data-object')});
        });
        console.log('mark-us-unread', notifications)
        if (notifications.length > 0) {
            $.ajax({
                type: "post",
                url: "/my-account/mark-us-unread-notifications",
                cache: false,
                datatype: "json",
                data: {ids: notifications},
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function (data) {
                    if (!data.error) {
                        data.result.map(function(element) {
                            $(element.attr_id).removeClass('notification-is_read');
                        });
                    } else {
                        alert('error')
                    }
                }
            });
        }
    })

    $("body").on('click', '.delete-selected-notifications', function () {
        var notifications = [];
        $.each($("input[name='notifications']:checked"), function () {
            var not_checkbox = $(this);
            notifications.push({id: not_checkbox.attr('data-id'), object: not_checkbox.attr('data-object')});
        });
        console.log('delete-selected-notifications', notifications)

        if (notifications.length > 0) {
            $.ajax({
                type: "post",
                url: "/my-account/delete-notifications",
                cache: false,
                datatype: "json",
                data: {ids: notifications},
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function (data) {
                    if (!data.error) {
                        data.result.map(function(element) {
                            $(element.attr_id).remove();
                        });
                    } else {
                        alert('error')
                    }
                }
            });
        }
    })
    $("body").on('click', "input[name='notifications']", function () {
        if(Array.prototype.slice.call(document.querySelectorAll('.message-checkbox')).every(function(el) {return el.checked === true})) {
            $('#message-checkbox-all').prop('checked', true)
        } else {
            $('#message-checkbox-all').prop('checked', false)
        }
    })

    $('#message-checkbox-all').on('change', function() {
        if($('#message-checkbox-all').is(':checked')) {
            $('.message-checkbox').prop('checked', true);
            $(".notification-actions-bar").removeClass('d-none').addClass('d-flex')
        } else {
            $('.message-checkbox').prop('checked', false);
            $(".notification-actions-bar").removeClass('d-flex').addClass('d-none')
        }
    });
})