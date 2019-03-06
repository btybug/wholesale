var attributesJson = {};
function makeSearchItem(basicData) {

}
function makeSearchItemssss(basicData) {
    var userList = null;
    $.ajax({
        url: basicData.url,
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $("input[name='_token']").val()
        },
        success: function(data) {
            userList = data;
        }
    });
    $(basicData.input).tagsinput({
        confirmKeys: [13, 32, 44],
        typeaheadjs: {
            displayKey: basicData.name,
            valueKey: basicData.name,
            source: function(query, processSync, processAsync) {
                return $.ajax({
                    url: basicData.url,
                    type: "POST",
                    data: { q: query },
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": $("input[name='_token']").val()
                    },
                    success: function(json) {
                        return processAsync(json);
                    }
                });
            },
            templates: {
                empty: [
                    '<div class="empty-message">',
                    "No results",
                    "</div>"
                ].join("\n"),
                header: `<h4>${basicData.title}</h4><hr>`,
                suggestion: function(data) {
                    return `<div class="user-search-result"><span> ${
                        data[basicData.name]
                    } </span></div>`;
                }
            }
        }
    });
    $(basicData.input).on("beforeItemAdd", function(event) {
        checkUser = userList.some(item => {
            if (item.name === event.item) {
                // input-items-value
                let input = $(event.target)
                    .closest(".main-attr-container")
                    .find(".input-items-value");
                let inputValue = input.val();
                if (inputValue) {
                    inputValue = inputValue.split(",");
                    if (!inputValue.includes(item.id)) {
                        inputValue.push(item.id);
                        input.val(inputValue.join());
                    }
                } else {
                    input.val(item.id);
                }

                return true;
            }
        });
        event.cancel = !checkUser;
    });
    $(basicData.input).on("beforeItemRemove", function(event) {
        checkUser = userList.some(item => {
            if (item.name === event.item) {
                let input = $(event.target)
                    .closest(".main-attr-container")
                    .find(".input-items-value");
                let inputValue = input.val();
                let arr = inputValue.split(",");
                let index = arr.indexOf(item.id + "");

                arr.splice(index, 1);
                input.val(arr.join());
                return true;
            }
        });
        event.cancel = !checkUser;
    });
    $(basicData.input).on("itemAdded", function() {
        let id = $(this).attr("data-id");
        addAttributeToJSON(id);
    });
    function makeSearchHtml(data) {
        return `<li><span class="remove-search-tag"><i class="fa fa-minus-circle"></i></span>${data}</li>`;
    }
}

$("body").on("change", "#stock", function() {
    var stockId = $(this).val();
    if (stockId != "") {
        var form = $(this).closest("form");
        AjaxCall("/admin/store/apply-stock", form.serialize(), function(res) {
            if (!res.error) {
                $(".tabs_content").html(res.html);
                var elementList = document.querySelectorAll(
                    ".main-attr-container"
                );
                // Iterate through each element in the array
                for (var i = 0; i < elementList.length; i++) {
                    var ele = elementList[i];
                    makeSearchItem({
                        input:
                            ".attributes-item-input-" + $(ele).data("attr-id"),
                        name: "name",
                        url:
                            "/admin/tools/attributes/get-options-by-id/" +
                            $(ele).data("attr-id"),
                        title: "Attributes",
                        inputValues: "#tags-names",
                        containerForAppend: ".coupon-tags-list"
                    });
                }
            }
        });
    }
});

$("body").on("click", ".get-all-attributes-tab-event", function() {
    let arr = [];
    $(".get-all-attributes-tab")
        .children()
        .each(function() {
            arr.push($(this).attr("data-id"));
        });
    AjaxCall("/admin/tools/attributes/get-all", { arr }, function(res) {
        if (!res.error) {
            $("#attributesModal .modal-body .all-list").empty();
            res.data.forEach(item => {
                let html = `<li data-id="${item.id}" class="option-elm-modal"><a
                                                href="#">${
                                                    item.name
                                                }</a> <a class="btn btn-primary add-attribute-event" data-id="${
                    item.id
                }">ADD</a></li>`;
                $("#attributesModal .modal-body .all-list").append(html);
            });
            $("#attributesModal").modal();
        }
    });
});

$(document).on("beforeItemRemove", "input", function(event) {});

$("body").on("click", ".add-attribute-event", function() {
    let id = $(this).data("id");
    AjaxCall("/admin/tools/attributes/get-attribute", { id: id }, function(
        res
    ) {
        if (!res.error) {
            let id = res.data.id;
            AjaxCall(
                "/admin/tools/attributes/get-options-by-id",
                { id },
                function(res2) {
                    if (!res2.error) {
                        $(".get-all-attributes-tab")
                            .append(`<li style="display: flex" data-option-container="${id}" data-id="${
                            res.data.id
                        }" class="option-elm-attributes"><a
                                                href="#">${res.data.name}</a>
                                                <div class="buttons">
                                                <a href="javascript:void(0)" class="btn btn-sm all-option-add-variations btn-success"><i class="fa fa-money"></i></a>
                                                <a href="javascript:void(0)" class="remove-all-attributes btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                </div>
                                                <input type="hidden" name="attributes[${id}][attributes_id]" value="${id}">
                                                <input type="hidden" class="is-shared-attributes" name="attributes[${id}][is_shared]"
                                                value="0">      
                                                </li>`);
                        $(".choset-attributes").append(
                            `<div style="height: 50px" class="attributes-container-${id} main-attr-container"></div>`
                        );
                        let value = "";
                        let optionIds = "";
                        res2.data.forEach((item, index) => {
                            let comon = "";
                            if (res2.data.length - 1 !== index) {
                                comon = ",";
                            }
                            value += item.name + comon;

                            optionIds += item.id + comon;
                            let html = `<li class="btn btn-primary attributes-item">
                                          <a href="#" class="title-attr">${
                                              item.name
                                          }</a>
                                           <span class="restore-item badge"><i class="fa fa-trash" ></i></span>
                                        </li>`;
                        });
                        $(`.attributes-container-${id}`).append(
                            `<input data-id=${id} class="attributes-item-input-${id}"  value="${value}">
                             <input type="hidden" class="input-items-value" name="options[${id}]" value="${optionIds}">`
                        );
                        // Tags
                        makeSearchItem({
                            input: `.attributes-item-input-${id}`,
                            name: "name",
                            url: `/admin/tools/attributes/get-options-by-id/${id}`,
                            title: "Attributes",
                            inputValues: "#tags-names",
                            containerForAppend: ".coupon-tags-list"
                        });
                    }
                }
            );
        }
    });
    $(this)
        .parent()
        .remove();
});
$("body").on("click", ".remove-all-attributes", function() {
    let id = $(this)
        .closest("li")
        .attr("data-id");
    $("body")
        .find(`.attributes-container-${id}`)
        .remove();
    $(this)
        .closest("li")
        .remove();
});

$("body").on("click", ".get-all-attributes", function() {
    let arr = [];
    $(".attribute-list-items")
        .children()
        .each(function() {
            arr.push($(this).attr("data-id"));
        });
    AjaxCall("/admin/tools/attributes/get-all", { arr }, function(res) {
        if (!res.error) {
            $("#attributesModal .modal-body .all-list").empty();
            res.data.forEach(item => {
                let html = `  <li data-id="${
                    item.id
                }" class="option-elm-modal"><a
                                                href="#">${
                                                    item.name
                                                }</a> <a class="btn btn-primary add-attribute" data-id="${
                    item.id
                }">ADD</a></li>`;
                $("#attributesModal .modal-body .all-list").append(html);
            });
            $("#attributesModal").modal();
        }
    });
});

$("body").on("click", ".add-attribute", function() {
    let id = $(this).data("id");
    AjaxCall("/admin/tools/attributes/get-attribute", { id: id }, function(
        res
    ) {
        if (!res.error) {
            $(".attribute-list-items").append(`<li data-id="${
                res.data.id
            }" class="option-elm-variations"><a
                                                href="#">${
                                                    res.data.name
                                                }</a></li>`);
        }
    });
    $(this)
        .parent()
        .remove();
});

$("body").on("click", ".option-elm-attributes", function() {
    let id = $(this).attr("data-id");
    AjaxCall("/admin/tools/attributes/get-options-by-id", { id }, function(
        res
    ) {
        if (!res.error) {
            $(".list-attributes-options").empty();
            res.data.forEach(item => {
                let html = `<li class="badge attributes-item"><a href="#">${
                    item.name
                }</a></li>`;
                $(".list-attributes-options").append(html);
            });
        }
    });
});

$("body").on("click", ".option-elm-variations", function() {
    let id = $(this).attr("data-id");
    AjaxCall(
        "/admin/tools/attributes/get-variations-table",
        { id },
        function(res) {
            if (!res.error) {
                $(".variations-table")
                    .empty()
                    .append(res.html);
            }
        }
    );
});

// $("body").on("click", ".attributes-item", function () {
//     // AJax petqa
//     let text = $(this).children().text()

//     $(".choset-attributes").append(`<li>${text} <span class="restore-item"><i class="fa fa-trash"></i></span> </li>`)
//     $(this).remove()
// })

$("body").on("click", ".restore-item", function() {
    // let text = $(this).parent().text()
    $(this)
        .closest("li")
        .remove();
    // let html = `<li class="badge attributes-item"><a href="#">${text}</a></li>`
    // $(".list").append(html)
});

$("body").on("click", ".all-option-add-variations", function() {
    let parentElm = $(this).closest(".option-elm-attributes");

    let id = parentElm.attr("data-id");
    if ($(this).hasClass("btn-success")) {
        $(this)
            .removeClass("btn-success")
            .addClass("btn-primary");
        parentElm.find(".is-shared-attributes").val(1);
        addAttributeToJSON(id);
    } else {
        $(this)
            .removeClass("btn-primary")
            .addClass("btn-success");
        parentElm.find(".is-shared-attributes").val(0);

        addAttributeToJSON(id, true);
    }
});

function addAttributeToJSON(id, remove = false) {
    let mainContainer = $("body").find(`[data-option-container="${id}"]`);
    let className = mainContainer
        .find(".all-option-add-variations")
        .hasClass("btn-primary");
    let text = mainContainer.find("a").text();
    let classInputContainer = `.attributes-container-${id}`;
    let inputOptions = $(classInputContainer).find(`.input-items-value`);
    // let inputOptions = $(classInputContainer).find(
    //     `.attributes-item-input-${id}`
    // );
    let inputOptionsValue = inputOptions.val();

    if (!remove && className) {
        attributesJson[id] = inputOptionsValue.split(",");
    } else {
        delete attributesJson[text];
    }
}

function HTMLmakeSelectVaritionOptions(name, data, text = "") {
    let value = "";
    data.forEach(
        item =>
            (value += `<option ${
                text === item ? "selected" : ""
            }>${item}</option>`)
    );
    return `<div class="form-group">
        <label for="exampleFormControlSelect1">${name}</label>
        <select class="form-control" id="exampleFormControlSelect1">
          ${value}
        </select>
      </div>`;
}

$("body").on("click", ".get-variationssssss", function() {
    let html = "";
    if (
        Object.keys(attributesJson).length === 0 ||
        $(".list-attrs-single-item").length ===
            nestedObjectToArray(attributesJson).length
    )
        return false;
    Object.entries(attributesJson).forEach(([key, val]) => {
        html += HTMLmakeSelectVaritionOptions(key, val);
    });
    $(".all-list-attrs").append(
        `<div class="list-attrs-single-item" style="display: flex; justify-content: space-between;"><div>
        <button class="variation-select"><i class="fa fa-list"></i></button>
     </div> ${html} <div><button class="remvoe-variations-select"><i class="fa fa-trash"></i></button></div> <div>`
    );
});

$("body").on("click", ".remove-variation", function() {
    $(this)
        .closest(".list-attrs-single-item")
        .remove();
});

$("body").on("click", ".get-all-variationssssss", function() {
    attributesJson = {};
    $(".get-all-attributes-tab")
        .children()
        .each(function() {
            let isShared = $(this)
                .find(".is-shared-attributes")
                .val();
            if (Number(isShared)) {
                addAttributeToJSON($(this).attr("data-id"));
            }
        });
    $(".all-list-attrs").empty();
    AjaxCall(
        "/admin/inventory/stock/link-all",
        { data: attributesJson },
        function(res) {
            if (!res.error) {
                $(".all-list-attrs").html(res.html);
            }
        }
    );
});

$("body").on("click", ".add-variationssssss", function() {
    attributesJson = {};
    $(".get-all-attributes-tab")
        .children()
        .each(function() {
            let isShared = $(this)
                .find(".is-shared-attributes")
                .val();
            if (Number(isShared)) {
                addAttributeToJSON($(this).attr("data-id"));
            }
        });
    AjaxCall(
        "/admin/inventory/stock/variation-form",
        { data: attributesJson },
        function(res) {
            if (!res.error) {
                $(".variation-box").html(res.html);
                $("#variationModal").modal();
            }
        }
    );
});
jQuery.extend({
    compare: function (arrayA, arrayB) {
        if (arrayA.length != arrayB.length) { return false; }
        // sort modifies original array
        // (which are passed by reference to our method!)
        // so clone the arrays before sorting
        var a = jQuery.extend(true, [], arrayA);
        var b = jQuery.extend(true, [], arrayB);
        a.sort();
        b.sort();
        for (var i = 0, l = a.length; i < l; i++) {
            if (a[i] !== b[i]) {
                return false;
            }
        }
        return true;
    }
});


$("body").on("click", ".apply-variationssssss", function() {
    var data = [];
    // var variationId = $(this).attr("variation-id");
    var variationForm = $("#variation_form").serialize();
    console.log(variationForm)
    var error = false;
    var optionsArr = [];
    $(".errors").html('');
    $("body .option-class")
        .each(function() {
            let val = $(this).val();
            optionsArr.push(parseInt(val));
        });

    var isRequred = false;

    if($("#variation_name").val() == ''){
        $(".name-error").text("Name field required");
        isRequred = true;
    }
    if($("#variation_id").val() == ''){
        $(".sku-error").text("Sku field required");
        isRequred = true;
    }
    if($("#variation_price").val() == ''){
        $(".price-error").text("Price field required");
        isRequred = true;
    }

    if(! isRequred){
        $('.list-attrs-single-item').map(function (e,item) {
            if($("#vId").val() != $(item).data('variation')){
                var jsonData = JSON.parse($(item).find('.variation-json').val());
                console.log(jsonData.options)
                var compareOptions = [];
                var massiveOptions = Object.values(jsonData.options)

                massiveOptions.map(function (e,i) {
                    compareOptions.push(parseInt(e.attributes_id))
                    compareOptions.push(parseInt(e.options_id))
                });

                console.log(optionsArr,compareOptions)
                var at = jQuery.compare(optionsArr, compareOptions);
                console.log(at)
                if(at == true){
                    $(".option-error").text("You already have variation with that options");
                    error = true;
                }

                if($("#variation_name").val() == $(item).attr('validate-name')){
                    $(".name-error").text("Name field is unqiue, please enter another name");
                    error = true;
                }

                if($("#variation_id").val() == $(item).attr('validate-sku')){
                    $(".sku-error").text("Sku field is unqiue, please enter another sku number");
                    error = true;
                }
            }

        });

        if(error === false){
            AjaxCall(
                "/admin/inventory/stock/add-variation",
                variationForm,
                function(res) {
                    if (!res.error) {
                        var vID = $("#vId").val();
                        if(vID){
                            $(".list-attrs-single-item[data-variation="+vID+"]").replaceWith(res.html);
                        }else{
                            $(".all-list-attrs").append(res.html);
                        }

                        $("#variation_form")[0].reset();
                        $("#variationModal").modal('hide');
                    }
                }
            );
        }
    }
});

$("body").on("click", ".edit-variationssssss", function() {
    var variationId = $(this).data("id");
    var data = $(this).closest(".list-attrs-single-item").find('.variation-json').val();
    data = JSON.parse(data);

    attributesJson = {};
    $(".get-all-attributes-tab")
        .children()
        .each(function() {
            let isShared = $(this)
                .find(".is-shared-attributes")
                .val();
            if (Number(isShared)) {
                addAttributeToJSON($(this).attr("data-id"));
            }
        });
    AjaxCall(
        "/admin/inventory/stock/edit-variation",
        {model : data, data : attributesJson,variationId : variationId },
        function(res) {
            if (!res.error) {
                $(".variation-box").html(res.html);
                $("#variationModal").modal();
            }
        }
    );
    // $.each(varationForm, function(key, val) {
    //     var name = val.name;
    //     data[name] = val.value;
    // });
    // var obj = varationForm.reduce(function(total, current) {
    //     total[current.name] = current.value;
    //     return total;
    // }, {});
    // $("#variation_" + variationId).val(JSON.stringify(obj));

});

// window.onload = function() {
//     var elementList = document.querySelectorAll(".main-attr-container");
//
//     // Iterate through each element in the array
//     for (var i = 0; i < elementList.length; i++) {
//         var ele = elementList[i];
//         makeSearchItem({
//             input: ".attributes-item-input-" + $(ele).data("attr-id"),
//             name: "name",
//             url:
//                 "/admin/inventory/attributes/get-options-by-id/" +
//                 $(ele).data("attr-id"),
//             title: "Attributes",
//             inputValues: "#tags-names",
//             containerForAppend: ".coupon-tags-list"
//         });
//     }
// };

// val.forEach((item, index) => {
//     // console.log(item)
//     // console.log(index)
//     // console.log(val)
//     html += HTMLmakeSelectVaritionOptions(key, val, item);
//     console.log(HTMLmakeSelectVaritionOptions(key, val, item));
// });
// // console.log(html);
// var discount_row = 3;

// function addDiscount() {
//     html = '<tr id="discount-row' + discount_row + '">';
//     html +=
//         '  <td class="text-left"><select name="product_discount[' +
//         discount_row +
//         '][customer_group_id]" class="form-control">';
//     html += '    <option value="1">Default</option>';
//     html += "  </select></td>";
//     html +=
//         '  <td class="text-right"><input type="text" name="product_discount[' +
//         discount_row +
//         '][quantity]" value="" placeholder="Quantity" class="form-control" /></td>';
//     html +=
//         '  <td class="text-right"><input type="text" name="product_discount[' +
//         discount_row +
//         '][priority]" value="" placeholder="Priority" class="form-control" /></td>';
//     html +=
//         '  <td class="text-right"><input type="text" name="product_discount[' +
//         discount_row +
//         '][price]" value="" placeholder="Price" class="form-control" /></td>';
//     html +=
//         '  <td class="text-left" style="width: 20%;"><div class="input-group "><input type="text" name="product_discount[' +
//         discount_row +
//         '][date_start]" value="" placeholder="Date Start" data-date-format="YYYY-MM-DD" class="form-control date" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
//     html +=
//         '  <td class="text-left" style="width: 20%;"><div class="input-group "><input type="text" name="product_discount[' +
//         discount_row +
//         '][date_end]" value="" placeholder="Date End" data-date-format="YYYY-MM-DD" class="form-control date" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
//     html +=
//         '  <td class="text-left"><button type="button" onclick="$(\'#discount-row' +
//         discount_row +
//         '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
//     html += "</tr>";

//     $("#discount tbody").append(html);

//     $("#tab-discount .date").datetimepicker({});

//     discount_row++;
// }

// $("#tab-discount .date").datetimepicker({
//     language: "en-gb"
// });

// HELPERSSSSSSSSSSSSSSSSS

function nestedObjectToArray(obj) {
    if (typeof obj !== "object") {
        return [obj];
    }
    var result = [];
    if (obj.constructor === Array) {
        obj.map(function(item) {
            result = result.concat(nestedObjectToArray(item));
        });
    }
    {
        Object.keys(obj).map(function(key) {
            if (obj[key]) {
                var chunk = nestedObjectToArray(obj[key]);
                chunk.map(function(item) {
                    result.push(key + "-" + item);
                });
            } else {
                result.push(key);
            }
        });
    }
    return result;
}

// MEDIAAAAAAAAAAAAAAAAAAAA

const HTMLyoutubeLinkToIframe = data => {
    let videoId = data.split("v=")[1];
    let ampersandPosition = videoId.indexOf("&");
    if (ampersandPosition != -1) {
        videoId = videoId.substring(0, ampersandPosition);
    }
    if ($(`[value="${videoId}"]`).length !== 0) return false;
    return `<div class="video-single-item" style="display: flex"><iframe width="200" height="200"
    src="https://www.youtube.com/embed/${videoId}">
    </iframe><div><button class="btn btn-danger remove-video-single-item"><i class="fa fa-trash"></i></button></div><input type="hidden" name="videos[]" value="${videoId}"> </div>`;
};

$("body").on("click", ".add-video-url", function() {
    let link = $(".video-url-link").val();
    $(".video-url-link").val("");
    $(".media-videos-preview").append(HTMLyoutubeLinkToIframe(link));
});

$("body").on("click", ".remove-video-single-item", function() {
    $(this)
        .closest(".video-single-item")
        .remove();
});
