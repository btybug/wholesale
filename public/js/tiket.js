/**
 * Created by sahak on 1/31/2019.
 */
$(function () {
    $('body').on('change','#category',function () {
        let data= {'category':$(this).val()};
        $.ajax({
            type: "post",
            url: '/my-account/tickets/category-select',
            cache: false,
            datatype: "json",
            data: data,
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function(data) {
              if(!data.error){
                  $('#category-related').html(data.html)
              }
              else {
                  $('#category-related').html('')
              }
            },
            error: function(errorThrown) {
                // if (error) {
                //     error(errorThrown);
                // }
                // return errorThrown;
            }
        });
    });
});
