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

function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
		the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
										(or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
						increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
						decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
				except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}


$(document).ready(function () {
    // if($('#filter-form .filter-sidebar-wrapper').length === 0) {
        document.getElementById("search-product")
            .addEventListener("keyup", function(event) {
                event.preventDefault();

                event.target.value.trim() === '' ? $('#autocomplite_content_search').css('display', 'none') : $('#autocomplite_content_search').css('display', 'block')
                if(event.target.value.trim() !== '') {
                    console.log('***********************')
                    $('.search_icon_header').removeClass('d-flex').addClass('d-none');
                    $('.close_icon_header').removeClass('d-none').addClass('d-flex');
                } else {
                    $('.search_icon_header').removeClass('d-none').addClass('d-flex');
                    $('.close_icon_header').removeClass('d-flex').addClass('d-none');
                }
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
    // }

    $(document).on('click', function(ev) {
        if($(ev.target).closest('#autocomplite_content_search').length > 0) {

        } else {
            $('#autocomplite_content_search').css('display', 'none');
        };
    });

    $('body').on('click', '.close_icon_header', function() {
        $('#search-product').val('');
        $('.search_icon_header').removeClass('d-none').addClass('d-flex');
        $('.close_icon_header').removeClass('d-flex').addClass('d-none');
        $('#search-product').focus();
        $('#autocomplite_content_search').css('display', 'none');
    });

    // $('#search-product').val().trim() === '' ? $('#autocomplite_content_search').css('display', 'none') : $('#autocomplite_content_search').css('display', 'block')

    $("#search-product").autocomplete({
        // serviceUrl: '/search',
        // onSelect: function (suggestion) {
        //     alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        // },
        // source:countries,
        // lookup: countries,
        appendTo: "#autocomplite_content_search",
        width: '100%',
        source: function (d, e) {

            var category = $(".all_categories").val();
            category= category.length === 0 ? null : $(".all_categories").val();
            var data = {
                name: $("#search-product").val(),
                category: category
            };
            $.ajax({
                type: 'POST',
                url: '/search',
                dataType: "JSON",
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                data: data,
                success: function (b) {
                    // console.log(b, d, e);
                    var c = [];
                    console.log('------------------', b.data);


                    if(b.data.length > 0) {
                        $.each(b.data, function (i, a) {
                            c.push(a);
                        });
                        $('#autocomplite_content_search .not_found').removeClass('d-flex').addClass('d-none');
                    } else {

                        if($('#search-product').val().trim() === '') {
                            $('#autocomplite_content_search').css('display', 'none')
                            $('#autocomplite_content_search .not_found').removeClass('d-flex').addClass('d-none');
                        } else {
                            $('#autocomplite_content_search').css('display', 'block');
                            $('#autocomplite_content_search .not_found').removeClass('d-none').addClass('d-flex');
                        }

                    }
                    e(c);

                }
            });
        },
        onSelect: function (suggestion) {
            alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        // console.log(location, 55555555555, item);
        encodeURI(item.slug)
        var inner_html = `  <a class="autocomplete_link_custom" style="all: unset;" href="${location.origin}/products/${encodeURI(item.category)}/${encodeURI(item.slug)}">
                                <div class="autocomplete_content_custom">
                                    <div class="autocomplete_image_container_custom">
                                        <img class="autocomplete_image_custom" src="${item.image}">
                                    </div>
                                    <div class="autocomplete-right-main-content">
                                         <div class="autocomplete_title_container_custom">
                                            <h4 class="font-sec-reg font-17 text-main-clr lh-1 autocomplete_title_custom">${item.name}</h4>
                                        </div>
                                        <p class="font-main-light text-light-clr font-14 autocomplete_description_custom">${item.short_description}...</p>
                                    </div>

                                </div>
                            </a>`;
        // console.log('--------------', item);
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append(inner_html)
            .appendTo( ul );
    };

    $("body").on('click','.shopping-cart-content .inp-up, .shopping-cart-content .inp-down',function () {
        var uid = $(this).closest('.shopping__cart-tab-table-wall').data('uid');
        var condition = $(this).hasClass('inp-up');
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
                        $('.cart-area').html(data.html);
                        $('#cartSidebar').html(data.headerHtml);
                    }else{
                        alert('error');
                    }
                }
            });
        }else{
            alert('Select available variation');
        }
    });

    // $("body").on('change', '.qty-input' ,function () {
    //     var uid = $(this).data('uid');
    //     var condition = 'inner';
    //     var value = $(this).val();
    //     if(uid && uid != ''){
    //         $.ajax({
    //             type: "post",
    //             url: "/update-cart",
    //             cache: false,
    //             datatype: "json",
    //             data: {  uid : uid, condition: condition,value :value },
    //             headers: {
    //                 "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
    //             },
    //             success: function(data) {
    //                 if(! data.error){
    //                     $('.cart-area').html(data.html)
    //                     $('#cartSidebar').html(data.headerHtml)
    //                 }else{
    //                     alert('error')
    //                 }
    //             }
    //         });
    //     }else{
    //         alert('Select available variation');
    //     }
    // });


    $("body").on('click','.remove-from-cart',function (e) {
        e.stopPropagation();
        var uid = $(this).data('uid');

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
                        $(".cart-count").html(data.count);
                    }else{
                        alert('error');
                    }
                }
            });
        }else{
            alert('Select available variation');
        }
    });

    $("body").on('click','.remove-extra-from-cart',function (e) {
        e.stopPropagation();
        var uid = $(this).data('uid');
        var section_id = $(this).data('section-id');

        if(uid && uid != '' && section_id && section_id != ''){
            $.ajax({
                type: "post",
                url: "/remove-from-cart",
                cache: false,
                datatype: "json",
                data: {  uid : uid,section_id :section_id },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function(data) {
                    if(! data.error){
                        $('.cart-area').html(data.html)
                        $('#cartSidebar').html(data.headerHtml)
                        $(".cart-count").html(data.count);
                    }else{
                        alert('error');
                    }
                }
            });
        }else{
            alert('Select available variation');
        }
    });

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
