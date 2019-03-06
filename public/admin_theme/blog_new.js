function makeSearchItem(basicData) {
    // basicData = {
    //     input: "input",
    //     name: "name",
    //     url: "url",
    //     title: "title",
    //     inputValues: "inputValues",
    //     containerForAppend: "containerForAppend",
    //     inputValues: "inputValues"
    // };
    var userList = null;
    $.ajax({
        url: basicData.url,
        type: "POST",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $("input[name='_token']").val()
        },
        success: function(data) {
            userList = data.map(item => item.name);
        }
    });
    $(basicData.input).tagsinput({
        maxTags: 5,
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
        event.cancel = true;
        let valueCatergorayName = $(basicData.inputValues).val();
        if (
            !valueCatergorayName.includes(event.item) &&
            userList.includes(event.item)
        ) {
            $(basicData.containerForAppend).append(makeSearchHtml(event.item));
            if (
                $(basicData.inputValues)
                    .val()
                    .trim()
            ) {
                let arr = JSON.parse($(basicData.inputValues).val());
                arr.push(event.item);
                $(basicData.inputValues).val(JSON.stringify(arr));
                return;
            }
            let elm = [event.item];
            $(basicData.inputValues).val(JSON.stringify(elm));
            return;
        }
    });

    function makeSearchHtml(data) {
        return `<li><span class="remove-search-tag"><i class="fa fa-minus-circle"></i></span>${data}</li>`;
    }
}
$("body").on("click", ".remove-search-tag", function() {
    let text = $(this)
        .closest("li")
        .text();

    let arr = JSON.parse(
        $(this)
            .closest(".wall")
            .find(".search-hidden-input")
            .val()
    );
    let index = arr.indexOf(text);
    arr.splice(index, 1);
    $(this)
        .closest(".wall")
        .find(".search-hidden-input")
        .val(JSON.stringify(arr));
    $(this)
        .closest("li")
        .remove();
});

// basicData = {
//     input: "input",
//     name: "name",
//     url: "url",
//     title: "title",
//     inputValues: "inputValues",
//     containerForAppend: "containerForAppend",
//     inputValues: "inputValues"
// };
// makeSearchItem({
//     input: "#input-category",
//     name: "name",
//     url: "/admin/get-categories",
//     title: "Categoris",
//     inputValues: "#category-names",
//     containerForAppend: ".coupon-category-list"
// });
makeSearchItem({
    input: "#input-tags",
    name: "name",
    url: "/admin/tools/tags/search",
    title: "Tags",
    inputValues: "#tags-names",
    containerForAppend: ".coupon-tags-list"
});
// $("#input-category").tagsinput({
//     maxTags: 5,
//     confirmKeys: [13, 32, 44],
//     typeaheadjs: {
//         displayKey: "name",
//         valueKey: "name",
//         source: function(query, processSync, processAsync) {
//             return $.ajax({
//                 url: "/admin/get-categories",
//                 type: "POST",
//                 data: { query: query },
//                 dataType: "json",
//                 headers: {
//                     "X-CSRF-TOKEN": $("input[name='_token']").val()
//                 },
//                 success: function(json) {
//                     return processAsync(json);
//                 }
//             });
//         },
//         templates: {
//             empty: ['<div class="empty-message">', "No results", "</div>"].join(
//                 "\n"
//             ),
//             header: "<h4>Categoris</h4><hr>",
//             suggestion: function(data) {
//                 return `<div class="user-search-result"><span> ${
//                     data.name
//                 } </span></div>`;
//             }
//         }
//     }
// });
// $("#input-category").on("beforeItemAdd", function(event) {
//     event.cancel = true;
//     let valueCatergorayName = $("#category-names").val();
//     if (!valueCatergorayName.includes(event.item)) {
//         $(".coupon-category-list").append(makeSearchHtml(event.item));
//         if (
//             $("#category-names")
//                 .val()
//                 .trim()
//         ) {
//             let arr = JSON.parse($("#category-names").val());
//             arr.push(event.item);
//             $("#category-names").val(JSON.stringify(arr));

//             console.log(1);
//             return;
//         }
//         console.log(2);
//         let elm = [event.item];
//         $("#category-names").val(JSON.stringify(elm));
//         return;
//     }
// });

// function makeSearchHtml(data) {
//     return `<li><span class="remove-search-tag"><i class="fa fa-minus-circle"></i></span>${data}</li>`;
// }

// $("body").on("click", ".remove-search-tag", function() {
//     let text = $(this)
//         .closest("li")
//         .text();
//     let arr = JSON.parse($("#category-names").val());
//     let index = arr.indexOf(text);
//     arr.splice(index, 1);
//     $("#category-names").val(JSON.stringify(arr));
//     $(this)
//         .closest("li")
//         .remove();
// });
