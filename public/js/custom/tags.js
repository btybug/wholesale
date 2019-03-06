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

const makeHtml = data => {
    return `<div class="single-tags label label-primary">
                    <div class="single-tags-text">
                        <p>${data.name}</p>
                    </div>
                    <div class="delete-button label label-danger" data-id=${
                        data.id
                    } data-key=${data.id} data-href="/admin/tools/tags/delete" data-callback="makeAllHtml(data.data)">
                        <i class="fa fa-times"></i>
                    </div>
                </div>`;
};
const makeAllHtml = data => {
    $(".tags").empty();
    data.forEach(item => {
        $(".tags").append(makeHtml(item));
    });
};
AjaxCall("/admin/tools/tags/save", {}, function(res) {
    if (!res.error && res.data) {
        makeAllHtml(res.data);
    }
});

$("#add-new-tags").keypress(function(event) {
    var code = event.keyCode || event.which;
    if (
        code == 32 &&
        $(this)
            .val()
            .trim()
    ) {
        $("#form-tags").submit();
    }
});

$("form").submit(function(e) {
    e.preventDefault();
    let value = $("#add-new-tags")
        .val()
        .trim();
    if (!value) {
        alert("Please fill the form");
        return;
    }
    AjaxCall("/admin/tools/tags/save", { tags: value }, function(res) {
        if (!res.error && res.data) {
            makeAllHtml(res.data);
        }
    });
    // let allData = JSON.parse(localStorage.getItem("tags"));
    // if (allData === null) {
    //     let arr = value.split(",");
    //     localStorage.setItem("tags", JSON.stringify([value]));
    //     makeAllHtml(arr);
    //     return;
    // }

    // let newData = [...new Set([...allData, ...value.split(",")])];
    // makeAllHtml(newData);
    // localStorage.setItem("tags", JSON.stringify(newData));

    $("#add-new-tags").tagsinput("removeAll");
});

$("body").on("click", ".remove-tag", function() {
    let value = $(this).attr("data-id");
    AjaxCall("/admin/tools/tags/delete", { id: value }, function(res) {
        if (!res.error && res.data) {
            makeAllHtml(res.data);
        }
    });
    // let allData = JSON.parse(localStorage.getItem("tags"));
    // let index = allData.indexOf(value);
    // allData.splice(index, 1);
    // makeAllHtml(allData);
    // localStorage.setItem("tags", JSON.stringify(allData));
});

$("#add-new-tags").tagsinput({
    confirmKeys: [13, 32, 44]
});
