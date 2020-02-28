@extends('layouts.admin')
@section('content')
    <div class="card panel panel-default">
{{--        <div class="card-header panel-heading d-flex flex-wrap justify-content-between">--}}
{{--            <h2 class="m-0">Barcodes</h2>--}}
{{--        </div>--}}
        <div class="d-flex justify-content-end px-4 mt-2">
            <div class="d-flex flex-wrap">
                @ok('admin_inventory_barcodes_settings')
                <span class="btn btn-success mx-2" data-toggle="modal" data-target="#barcodeModalCenter">
  Settings
</span>
                @endok
                @ok('admin_inventory_barcodes_new')
                <div>
                    <a class="btn btn-primary" href="{!! route('admin_inventory_barcodes_new') !!}">Add new</a>
                </div>
                @endok
            </div>
        </div>
        <div class="card-body panel-body pt-0">
            <table id="stocks-table" class="table table-style table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Related Item</th>
                    <th>Barcode</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="barcodeModalCenter" tabindex="-1" role="dialog" aria-labelledby="barcodeModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="barcodeModalCenterTitle">Barcode title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="w-75 d-flex flex-column mx-auto" style="padding-bottom: 20px" id="barcode_form">
                        <div id="barcode_container" style="margin-bottom: 15px; display: flex; justify-content: center; align-items: center; height: 200px">
                            <svg id="barcode"></svg>
                            <div id="invalid_barcode" style="display: none; color: red; weight: bold; text-align: center; font-size: 30px">Invalid Value</div>
                        </div>
                        <div style="margin-bottom: 15px; display: flex">
                            {{--                <label for="barcode_text" class="barcode_text">Barcode Text</label>--}}
                            <input class="form-control" type="text" placeholder="Default input" readonly name="text" id="barcode_text" value="5060730202285" style="width: 70%"/>
                            <select class="form-control" name="format" id="barcode_format" style="width: 30%">
                                <option value="CODE128">CODE128 auto</option>
                                <option value="CODE128A">CODE128 A</option>
                                <option value="CODE128B">CODE128 B</option>
                                <option value="CODE128C">CODE128 C</option>
                                <option value="EAN13" selected>EAN13</option>
                                <option value="EAN8">EAN8</option>
                                <option value="UPC">UPC</option>
                                <option value="CODE39">CODE39</option>
                                <option value="ITF14">ITF14</option>
                                <option value="ITF">ITF</option>
                                <option value="MSI">MSI</option>
                                <option value="MSI10">MSI10</option>
                                <option value="MSI11">MSI11</option>
                                <option value="MSI1010">MSI1010</option>
                                <option value="MSI1110">MSI1110</option>
                                <option value="pharmacode">Pharmacode</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 15px; display: flex; justify-content: space-between">
                            <label for="barcode_width" style="width: 15%">Bar Width</label>
                            <input type="range" name="width" class="custom-range" min="1" max="4" step="1" id="barcode_width" style="width: 75%" value="2">
                            <div class="value" style="width: 10%; text-align: end">2</div>
                        </div>

                        <div style="margin-bottom: 15px; display: flex; justify-content: space-between">
                            <label for="barcode_height" style="width: 15%">Height</label>
                            <input type="range" name="height" class="custom-range" min="10" max="150" step="5" id="barcode_height" style="width: 75%" value="100">
                            <div class="value" style="width: 10%; text-align: end">100</div>
                        </div>

                        <div style="margin-bottom: 15px; display: flex; justify-content: space-between">
                            <label for="barcode_margin" style="width: 15%">Margin</label>
                            <input type="range" name="margin" class="custom-range" min="0" max="25" step="1" id="barcode_margin" style="width: 75%" value="10">
                            <div class="value" style="width: 10%; text-align: end">10</div>
                        </div>

                        <div style="margin-bottom: 15px; display: flex; justify-content: space-between">
                            <label for="barcode_background_color" class="col-form-label" style="width: 15%">Background</label>
                            <div style="width: 75%">
                                <div class="example-content well">
                                    <div class="example-content-widget">
                                        <input id="barcode_background_color" name="background_color" type="text" class="form-control" value="#ffffff" style="background-color: #ffffff"/>
                                    </div>
                                </div>
                            </div>
                            <div class="value" style="width: 10%; text-align: end"></div>
                        </div>

                        <div style="margin-bottom: 15px; display: flex; justify-content: space-between">
                            <label for="barcode_line_color" class="col-form-label" style="width: 15%">Line Color</label>
                            <div style="width: 75%">
                                <div class="example-content well">
                                    <div class="example-content-widget">
                                        <input id="barcode_line_color" name="line_color" type="text" class="form-control" value="#000000" style="background-color: #000000"/>
                                    </div>
                                </div>
                            </div>
                            <div class="value" style="width: 10%; text-align: end"></div>
                        </div>

                        <div class="custom-control custom-switch" style="margin-bottom: 15px; display: flex; justify-content: center">
                            <input type="checkbox" name="text_switch" class="custom-control-input" id="barcode_text_switch" checked>
                            <label class="custom-control-label" for="barcode_text_switch">Show text</label>
                        </div>

                        <div id="barcode_text_options">
                            <div style="margin-bottom: 15px; display: flex; justify-content: center">
                                <label class="col-form-label" style="width: 15%">Text Align</label>
                                <div style="display: flex; justify-content: space-around; width: 75%">

                                    <div>
                                        <label class="col-form-label">Left
                                            <input type="radio" name="text_align" value="left">
                                        </label>
                                    </div>
                                    <div>
                                        <label class="col-form-label">Center
                                            <input type="radio" name="text_align" value="center" checked>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="col-form-label">Right
                                            <input type="radio" name="text_align" value="right">
                                        </label>
                                    </div>
                                </div>
                                <div class="value" style="width: 10%; text-align: end"></div>
                            </div>

                            <div style="margin-bottom: 15px">
                                <label  for="barcode_text_font"  class="col-form-label">Font</label>
                                <select class="form-control" name="text_font" id="barcode_text_font">
                                    <option>Sans-serif</option>
                                    <option>Serif</option>
                                    <option>Cursive</option>
                                </select>
                            </div>

                            <div style="margin-bottom: 15px; display: flex; justify-content: center">
                                <label style="width: 15%">Font Options</label>
                                <div style="display: flex; justify-content: space-around; width: 75%">
                                    <div>
                                        <input type="checkbox" name="bold" class="custom-control-input" id="text_bold">
                                        <label class="custom-control-label" for="text_bold"><b>Bold</b></label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="italic" class="custom-control-input" id="text_italic">
                                        <label class="custom-control-label" for="text_italic"><i>Italic</i></label>
                                    </div>
                                </div>
                                <div class="value" style="width: 10%; text-align: end"></div>
                            </div>

                            <div style="margin-bottom: 15px; display: flex; justify-content: space-between">
                                <label for="barcode_font_size" style="width: 15%">Font Size</label>
                                <input type="range" name="font_size" class="custom-range" min="8" max="36" step="1" id="barcode_font_size" style="width: 75%" value="20">
                                <div class="value" style="width: 10%; text-align: end">20</div>
                            </div>

                            <div style="margin-bottom: 15px; display: flex; justify-content: space-between">
                                <label for="barcode_text_margin" style="width: 15%">Text Margin</label>
                                <input type="range" name="text_margin" class="custom-range" min="-15" max="40" step="1" id="barcode_text_margin" style="width: 75%" value="0">
                                <div class="value" style="width: 10%; text-align: end">0</div>
                            </div>
                        </div>
                        {{--            <button id="svg">Svg -></button>--}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_barcode">Save</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{!! url('public/js/jquery.printPage.js') !!}"></script>
    <script>
        $(function () {
            const shortAjax = function (URL, obj = {}, cb) {
                fetch(URL, {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('input[name="_token"]').val()
                    },
                    credentials: "same-origin",
                    body: JSON.stringify(obj)
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (json) {
                        return cb(json);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            };

            var table = $('#stocks-table').DataTable({
                ajax: "{!! route('datatable_all_barcodes') !!}",
                "processing": true,
                "serverSide": true,
                "bPaginate": true,
                "scrollX": true,
                dom: '<"d-flex justify-content-between align-items-baseline"lfB><rtip>',
                displayLength: 10,
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                buttons: [
                    'csv', 'excel', 'pdf',
                    {
                        extend: "print",
                        exportOptions: {
                            stripHtml: false,
                            columns: [ 0, 1, 2,3 ]
                        }
                    }
                ],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'code', name: 'code'},
                    {data: 'item_name', name: 'item_translations.name'},
                    {data: 'barcode', name: 'barcode',orderable : false,'searchable':false},
                    {data: 'actions', name: 'actions',orderable : false,'searchable':false}
                ],
                order: [ [0, 'desc'] ]
            });

            const barcode_settings = JSON.parse($('#barcode-settings').text());

            table.on('draw.dt', function () {
                let width = Number(barcode_settings.width);
                let height = Number(barcode_settings.height);
                let margin = Number(barcode_settings.margin);
                let back_color = barcode_settings.background_color;
                let line_color = barcode_settings.line_color;
                let text_align = barcode_settings.text_align;
                let text_font = barcode_settings.text_font;
                let format = barcode_settings.format;
                let font_size = Number(barcode_settings.font_size);
                let text_margin = Number(barcode_settings.text_margin);
                let displayValue = Boolean(Number(barcode_settings.text_switch));
                let bold = Number(barcode_settings.bold);
                let italic = Number(barcode_settings.italic);
                let fontOptions = '';

                if(bold && italic) {
                    fontOptions = 'bold italic'
                } else if(bold) {
                    fontOptions = 'bold'
                } else if(italic) {
                    fontOptions = 'italic'
                } else {
                    fontOptions = ''
                }

                $('body').find('.barcodes').each(function(key, value) {
                    JsBarcode(`#code_${$(value).data('barcode')}`, $(value).data('barcode'), {
                        format,
                        font: text_font,
                        fontSize: font_size,
                        textMargin: text_margin,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        fontOptions,
                        displayValue
                    })
                        .render();
                    // var s = new XMLSerializer().serializeToString(document.getElementById(`code_${$(value).data('barcode')}`));
                    // var encodedData = window.btoa(s);
                    // $("#img").attr('src', 'data:image/svg+xml;base64,' + encodedData);
                    // console.log(encodedData);
                });
                $('body').on('click', '.barcodes', function(ev) {
                    saveSvgAsPng(document.getElementById($(ev.target).closest('svg.barcodes').attr('id')), `${$(ev.target).closest('svg.barcodes').attr('data-name').replace(/\s/g, '_')}.png`, {scale: 10});
                })
            } );

            const barcode_edit = function() {
                let text = 5060730202285;
                let width = Number(barcode_settings.width);
                let height = Number(barcode_settings.height);
                let margin = Number(barcode_settings.margin);
                let back_color = barcode_settings.background_color;
                let line_color = barcode_settings.line_color;
                let text_align = barcode_settings.text_align;
                let text_font = barcode_settings.text_font;
                let format = barcode_settings.format;
                let font_size = Number(barcode_settings.font_size);
                let text_margin = Number(barcode_settings.text_margin);
                let displayValue = Boolean(Number(barcode_settings.text_switch));
                let bold = Number(barcode_settings.bold);
                let italic = Number(barcode_settings.italic);
                let fontOptions = '';

                if(bold && italic) {
                    fontOptions = 'bold italic'
                } else if(bold) {
                    fontOptions = 'bold'
                } else if(italic) {
                    fontOptions = 'italic'
                } else {
                    fontOptions = ''
                }
                $('#barcode_height').val(barcode_settings.height);
                $('#barcode_height').next('.value').text(height)
                $('#barcode_width').val(barcode_settings.width);
                $('#barcode_width').next('.value').text(width)
                $('#barcode_margin').val(barcode_settings.margin);
                $('#barcode_margin').next('.value').text(margin)
                $('#barcode_background_color').val(back_color);
                $('#barcode_line_color').val(line_color);
                $('#barcode_text_switch').attr('checked', displayValue);
                $('#barcode_text_font').val(text_font);
                $('#barcode_format').val(format);
                $('#barcode_font_size').val(barcode_settings.font_size);
                $('#barcode_font_size').next('.value').text(font_size)
                $('#barcode_text_margin').val(barcode_settings.text_margin);
                $('#barcode_text_margin').next('.value').text(text_margin)
                $('#barcode_background_color').val(back_color);
                $('#barcode_background_color').css('background-color', back_color);
                $('#barcode_line_color').val(line_color);
                $('#barcode_line_color').css('background-color', line_color);
                $('#text_bold').attr('checked', !!bold);
                $('#text_italic').attr('checked', !!italic);

                $('[name="text_align"]').each(function(key, radio) {
                    $(radio).val() === text_align && $(radio).trigger('click')
                });

                if(displayValue) {
                    $('#barcode_text_options').addClass('d-block');
                    $('#barcode_text_options').removeClass('d-none');
                } else {
                    $('#barcode_text_options').addClass('d-none');
                    $('#barcode_text_options').removeClass('d-block');
                }

                JsBarcode("#barcode", text, {
                    format,
                    fontOptions,
                    textMargin: text_margin,
                    font: text_font,
                    fontSize: font_size,
                    height,
                    width,
                    margin,
                    background: back_color,
                    lineColor: line_color,
                    textAlign: text_align,
                    displayValue
                })
                    .render();

                // $('body').on('input', '#barcode_text', function(ev) {
                //     text = $(ev.target).val();
                //     if(text === '') {
                //         $('#barcode').css('display', 'none');
                //         $('#invalid_barcode').css('display', 'block');
                //     } else {
                //         $('#invalid_barcode').css('display', 'none');
                //         JsBarcode("#barcode", text, {
                //             format,
                //             font: text_font,
                //             fontOptions,
                //             textMargin: text_margin,
                //             fontSize: font_size,
                //             height,
                //             width,
                //             margin,
                //             background: back_color,
                //             lineColor: line_color,
                //             textAlign: text_align,
                //             displayValue
                //         })
                //             .render();
                //     }
                // });

                $('body').on('input', '#barcode_height', function(ev) {
                    height = Number($(ev.target).val());
                    $('#barcode_height').next('.value').text(height)
                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                })

                $('body').on('input', '#barcode_width', function(ev) {
                    width = Number($(ev.target).val());
                    $('#barcode_width').next('.value').text(width);
                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                })

                $('body').on('input', '#barcode_margin', function(ev) {
                    margin = Number($(ev.target).val());
                    $('#barcode_margin').next('.value').text(margin);

                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                });

                $('#barcode_background_color').colorpicker();
                $('#barcode_line_color').colorpicker();

                $('body').on('change', '#barcode_background_color', function(ev) {
                    back_color = $(ev.target).val();

                    $('#barcode_background_color').css('background-color', back_color);
                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                });

                $('body').on('change', '#barcode_line_color', function(ev) {
                    line_color = $(ev.target).val();

                    $('#barcode_line_color').css('background-color', line_color);
                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                });

                $('body').on('change', '#barcode_text_switch', function(ev) {
                    displayValue = $(ev.target).is(':checked');
                    if($(ev.target).is(':checked')) {
                        $('#barcode_text_options').addClass('d-block');
                        $('#barcode_text_options').removeClass('d-none');
                    } else {
                        $('#barcode_text_options').addClass('d-none');
                        $('#barcode_text_options').removeClass('d-block');
                    }

                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                });

                $('body').on('change', '[name="text_align"]', function(ev) {

                    text_align = $(ev.target).val();
                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                });

                $('body').on('change', '#barcode_text_font', function(ev) {

                    text_font = $(ev.target).val();
                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                });

                $('body').on('change', '#barcode_format', function(ev) {

                    format = $(ev.target).val();
                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                });

                $('body').on('change', '#text_bold', function(ev) {
                    bold = $(ev.target).is(':checked');
                    if(bold && italic) {
                        fontOptions = 'bold italic'
                    } else if(bold) {
                        fontOptions = 'bold'
                    } else if(italic) {
                        fontOptions = 'italic'
                    } else {
                        fontOptions = ''
                    }
                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                })

                $('body').on('change', '#text_italic', function(ev) {
                    italic = $(ev.target).is(':checked');
                    if(bold && italic) {
                        fontOptions = 'bold italic'
                    } else if(bold) {
                        fontOptions = 'bold'
                    } else if(italic) {
                        fontOptions = 'italic'
                    } else {
                        fontOptions = ''
                    }
                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                })

                $('body').on('input', '#barcode_font_size', function(ev) {
                    font_size = Number($(ev.target).val());
                    $('#barcode_font_size').next('.value').text(font_size);
                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                })

                $('body').on('input', '#barcode_text_margin', function(ev) {
                    text_margin = Number($(ev.target).val());
                    $('#barcode_text_margin').next('.value').text(text_margin)
                    JsBarcode("#barcode", text, {
                        format,
                        font: text_font,
                        fontOptions,
                        textMargin: text_margin,
                        fontSize: font_size,
                        height,
                        width,
                        margin,
                        background: back_color,
                        lineColor: line_color,
                        textAlign: text_align,
                        displayValue
                    })
                        .render();
                })

                $('body').on('click', '#save_barcode', function(ev) {
                    ev.preventDefault();
                    function getFormData($form){
                        var unindexed_array = $form.serializeArray();
                        var indexed_array = {};

                        $.map(unindexed_array, function(n, i){
                            indexed_array[n['name']] = n['value'];
                        });

                        return indexed_array;
                    }

                    var $form = $("#barcode_form");
                    var data = getFormData($form);

                    data = Object.assign(data, {
                        text_switch: $('#barcode_text_switch').is(':checked'),
                        bold: $('#text_bold').is(':checked'),
                        italic: $('#text_italic').is(':checked')
                    });
                    shortAjax('/admin/inventory/barcode/settings', data, (res) => {
                        if(res.success) {
                            let width = Number(data.width);
                            let height = Number(data.height);
                            let margin = Number(data.margin);
                            let back_color = data.background_color;
                            let line_color = data.line_color;
                            let text_align = data.text_align;
                            let text_font = data.text_font;
                            let format = data.format;
                            let font_size = Number(data.font_size);
                            let text_margin = Number(data.text_margin);
                            let displayValue = Boolean(Number(data.text_switch));
                            let bold = Number(data.bold);
                            let italic = Number(data.italic);
                            let fontOptions = '';

                            if(bold && italic) {
                                fontOptions = 'bold italic'
                            } else if(bold) {
                                fontOptions = 'bold'
                            } else if(italic) {
                                fontOptions = 'italic'
                            } else {
                                fontOptions = ''
                            }
                            $('body').find('.barcodes').each(function(key, value) {
                                JsBarcode(`#code_${$(value).data('barcode')}`, $(value).data('barcode'), {
                                    format,
                                    font: text_font,
                                    fontSize: font_size,
                                    textMargin: text_margin,
                                    height,
                                    width,
                                    margin,
                                    background: back_color,
                                    lineColor: line_color,
                                    textAlign: text_align,
                                    fontOptions,
                                    displayValue
                                })
                                    .render();
                            });
                            $('#barcodeModalCenter').modal('hide');
                        }
                    }
                    )
                })


                $('#barcodeModalCenter').on('show')

                // $('#svg').on('click', function(ev) {
                //     svgAsDataUri(document.getElementById("barcode"), {})
                //         .then(uri => console.log(uri));
                // })
                // saveSvgAsPng(document.getElementById("barcode"), "barcode.png", {scale: 10});
            };



            barcode_edit();
        });
    </script>
    @stop
