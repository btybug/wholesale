$(function () {
    var data={};
    var edit=JSON.parse($('#rich-property-button').attr('data-edit'));
    $('#rich-property-button').on('click', function () {
        AjaxCall('/admin/seo/rich-properties', {type: 'stock'}, success)
    });

    function success(obj) {
        data=obj;
        $('#rich-modal .modal-body').empty();
        let button = $('<button/>', {class: 'btn btn-info btn-block rich-property',type:'button'});
        let container = $('<div/>', {class: 'col-md-3 mb-1'})
        $.each(obj, function (k, v) {
            if(!edit.includes(k)){
                let b = button.clone();
                let c = container.clone();
                b.text(v.label);
                b.attr('data-key', k);
                c.append(b);
                $('#rich-modal .modal-body').append(c)
            }


        })
        $('#rich-modal').modal()
    }


$('body').on('click', '.rich-property', function () {
    let property=data[$(this).attr('data-key')];
    let group = $('<div/>', {class: 'form-group'});
    let label = $('<label/>');
    let inputWrap = $('<div/>', {class: 'd-flex'});
    let span = $('<span/>',{
        text: 'x',
        class: 'btn btn-danger delete-rich-property'
    });
    let input = $('<input/>', {
        type: 'text',
        class: 'form-control'
    });

    let g = group.clone();
    let l = label.clone();
    let i = input.clone();
    let iw = inputWrap.clone();
    let sp = span.clone();
    sp.attr('data-key',$(this).attr('data-key'))
    i.attr('name','rich['+ $(this).attr('data-key')+']');
    i.val(property.default);
    iw.append(i);
    iw.append(sp);
    l.text(property.label);
    g.append(l, iw);
    $('.rich-body').append(g);
    $(this).remove();
    edit.push($(this).attr('data-key'));
    $('#rich-property-button').attr('data-edit',JSON.stringify(edit));

});
    $('body').on('click','.delete-rich-property',function () {

        $(this).closest('.form-group').remove()
        edit.splice(edit.indexOf($(this).attr('data-key')),1);
        $('#rich-property-button').attr('data-edit',JSON.stringify(edit));
    })
});
// <div class="form-group">
//     <label for="exampleInputEmail1">Email address</label>
// <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
//     <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
// </div>


// let group=$('<div/>',{class:'form-group'});
// let label=$('<label/>');
// let input=$('<input/>',{
//     type: 'text',
//     class:'form-control'
// });



