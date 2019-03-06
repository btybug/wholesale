

$("#based-on").on("change", function() {
    let value = $(this).val();
    $(".based-on-container")
        .empty()
        .append(HTML[value]);
    if (value === "product") {
        $("#select-product-option").select2();
    }
});

if ($("#select-product-option").length) {
    $("#select-product-option").select2();
}

$("body").on("click", `[name="choice_type"]`, function() {
    let value = $(this).val();
    $(".radio-wall-container")
        .empty()
        .append(HTML[value]);
});

$("body").on("click", ".add-more-query", function(e) {
    $(this)
        .find("i")
        .attr("class", "fa fa-trash");
    e.preventDefault();
    $(this).attr("class", "btn btn-danger btn-sm remove-more-query");
    $(".query-tbody").append(HTML['query_juices_tr']);
});

$("body").on("click", ".remove-more-query", function() {
    $(this)
        .closest("tr")
        .remove();
});
