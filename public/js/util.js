window.AjaxCall = function postSendAjax(url, data, success, error) {
    $.ajax({
        type: "post",
        url: url,
        cache: false,
        datatype: "json",
        data: data,
        headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        },
        success: function(data) {
            if (success) {
                success(data);
            }
            return data;
        },
        error: function(errorThrown) {
            if (error) {
                error(errorThrown);
            }
            return errorThrown;
        }
    });
};

$(document).ready(function () {
    document.getElementById("search-product")
        .addEventListener("keyup", function(event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                var form = $("#filter-form");
                var category = $('.all_categories').val();
                var search_text = $("#search-product").val();
                var url = "/products/"+category;

                if(form.length > 0){
                    if(search_text){
                        var input = $("<input>")
                            .attr("type", "hidden")
                            .attr("name", "q").val(search_text);
                        form.append(input);
                    }
                    form.attr('action',url);
                    form.submit();
                }else{
                    window.location = "/products/"+category +"?q="+$(this).val();
                }
            }
        });

    $("body").on('click','.qtycount',function () {
        var uid = $(this).data('uid');
        var condition = $(this).data('condition');
        if(uid && uid != ''){
            $.ajax({
                type: "post",
                url: "/update-cart",
                cache: false,
                datatype: "json",
                data: {  uid : uid, condition: condition },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function(data) {
                    if(! data.error){
                        $('.cart-area').html(data.html)
                        $('#cartSidebar').html(data.headerHtml)
                    }else{
                        alert('error')
                    }
                }
            });
        }else{
            alert('Select available variation');
        }
    });

    $("body").on('change', '.qty-input' ,function () {
        var uid = $(this).data('uid');
        var condition = 'inner';
        var value = $(this).val();
        if(uid && uid != ''){
            $.ajax({
                type: "post",
                url: "/update-cart",
                cache: false,
                datatype: "json",
                data: {  uid : uid, condition: condition,value :value },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function(data) {
                    if(! data.error){
                        $('.cart-area').html(data.html)
                        $('#cartSidebar').html(data.headerHtml)
                    }else{
                        alert('error')
                    }
                }
            });
        }else{
            alert('Select available variation');
        }
    });


    $("body").on('click','.remove-from-cart',function (e) {
        e.stopPropagation();
        var uid = $(this).data('uid');
        console.log(44444)
        if(uid && uid != ''){
            $.ajax({
                type: "post",
                url: "/remove-from-cart",
                cache: false,
                datatype: "json",
                data: {  uid : uid },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function(data) {
                    if(! data.error){
                        $('.cart-area').html(data.html)
                        $('#cartSidebar').html(data.headerHtml)
                        $(".cart-count").html(data.count)
                    }else{
                        alert('error')
                    }
                }
            });
        }else{
            alert('Select available variation');
        }
    })

    $("#change-currency").change(function () {
        let code = $(this).val();
        $.ajax({
            type: "post",
            url: "/change-currency",
            cache: false,
            datatype: "json",
            data: {
                code: code
            },
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function (data) {
                window.location.reload();
            }
        });
    })
});
