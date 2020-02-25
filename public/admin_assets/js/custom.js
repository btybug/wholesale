var translation_id = 0;
var base_url = window.location.origin;
var url2 = base_url + "/translations/get-entry";

window.onload = function() {
    var token = $('meta[name="csrf-token"]').attr("content");

    var table_translations = $("#translations-table").DataTable({
        ajax: base_url + "/translations/get-all",
        columns: [
            {
                data: "id",
                name: "id",
                render: function(data) {
                    return (
                        data +
                        '<input type="hidden" class="data_id" data-name="translations" data-id="' +
                        data +
                        '">'
                    );
                }
            },
            {
                data: "key",
                name: "key"
            },
            {
                data: "object_type",
                name: "object type"
            }
        ]
    });
    var table_entry = $("#translations-table-entry").DataTable({
        ajax: url2,
        columns: [
            {
                data: "id",
                name: "id",
                render: function(data) {
                    return (
                        data +
                        '<input type="hidden" class="data_id" data-name="translation_entry" data-id="' +
                        data +
                        '">'
                    );
                }
            },
            {
                data: "language_id",
                name: "language_id"
            },
            {
                data: "text",
                name: "text",
                class: "custom_text",
                createdCell: function(td) {
                    $(td).attr("data-field", "text");
                }
            }
        ]
    });

    $("#translations-table tbody").on("click", "tr", function() {
        $("tr").removeClass("tr-style");
        $(this).addClass("tr-style");
        translation_id = $(this)
            .children()
            .first()
            .text();
        var full_path = url2 + "/" + translation_id;

        table_entry.ajax.url(full_path);
        table_entry.ajax.reload();
    });

    // editable datatable columns functionality
    function renderInput(id, text) {
        var div = $("<div />", { class: "is_active" });
        var input = $("<input />");
        var span = $("<span />");

        var result = div.clone();

        var append_to_div = span
            .clone()
            .append([
                span
                    .clone()
                    .attr(
                        "class",
                        "glyphicon glyphicon-ok send_save margin-left glyph-custom glyf-success-custom"
                    ),
                span
                    .clone()
                    .attr(
                        "class",
                        "glyphicon glyphicon-remove cancel_changing margin-left glyph-custom glyf-danger-custom"
                    )
            ]);
        result.append([
            input.clone().attr({
                type: "hidden",
                class: "get_td_old_value",
                value: text
            }),
            input.clone().attr({
                type: "text",
                class: "get_input_value",
                value: text,
                "data-id": id
            }),
            append_to_div
        ]);

        return result;
    }

    function sendAjax(method, url, data, callback) {
        $.ajax({
            method: method,
            url: url,
            data: data
        })
            .done(function(data) {
                return callback;
            })
            .fail(function() {
                alert("Something went wrong. Please try again");
            });
        return false;
    }

    function successMethodForEntry(obj) {
        if (obj.length) {
            var val = obj
                .parents("div.is_active")
                .children("input.get_input_value")
                .val();
            return obj
                .parents("td.custom_text")
                .html(val)
                .parent()
                .addClass("animated zoomIn");
        } else {
            console.log("success");
        }
    }

    function returnPrevState(obj) {
        var old_value = obj
            .parents("div.is_active")
            .children("input.get_td_old_value")
            .val();
        obj.parents("tr")
            .children("td.custom_text")
            .html(old_value);
        return false;
    }

    function _defineProperty(obj, key, value) {
        if (key in obj) {
            Object.defineProperty(obj, key, {
                value: value,
                enumerable: true,
                configurable: true,
                writable: true
            });
        } else {
            obj[key] = value;
        }
        return obj;
    }

    $("body").delegate(".custom_text", "dblclick", function() {
        var is_active = $(this).children("div.is_active");
        if (is_active.length) {
            return false;
        }
        var text = $(this).text();
        var id = $(this)
            .parents("tr")
            .removeClass("animated zoomIn")
            .children("td")
            .first()
            .children("input.data_id")
            .data("id");
        var html = renderInput(id, text);

        $(this).html(html);

        var Input = $(this)
            .children("div.is_active")
            .children("input.get_input_value");
        return $(Input).focus();
    });

    $("body").delegate(".cancel_changing", "click", function() {
        return returnPrevState($(this));
    });

    $("body").delegate(".send_save", "click", function() {
        var old_value = $(this)
            .parents("div.is_active")
            .children("input.get_td_old_value")
            .val();
        var text = $(this)
            .parents("div.is_active")
            .children("input.get_input_value")
            .val();
        var key = $(this)
            .parents("div.is_active")
            .parent()
            .data("field");

        if (old_value === text) {
            return returnPrevState($(this));
        }

        var id = $(this)
            .parents("tr")
            .children("td")
            .first()
            .children("input.data_id")
            .data("id");
        var table_name = $(this)
            .parents("tr")
            .children("td")
            .first()
            .children("input.data_id")
            .data("name");
        var that = $(this);
        var url = base_url + "/ajax";

        var json_for_ajax = {
            id: id,
            _token: token,
            table: table_name
        };

        json_for_ajax = _defineProperty(json_for_ajax, key, text);

        return sendAjax(
            "post",
            url,
            json_for_ajax,
            successMethodForEntry(that)
        );
    });
    $(function () {
        $('#admin_find').on('change',function () {
            if($(this).val()!==null){
                window.location.href=$(this).val();
            }
        });
    });
};
