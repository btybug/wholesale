

@extends('layouts.admin')
@section('content-header')
@stop
@section('content')
    <div class="admin-find-wrapper">
        <div class="find-form">
            @include('admin.find.items.form')
        </div>

        <div class="find-wrapper-results mt-5">
            <div class="find-wrapper-results-head">
                <h3>Results</h3>
                <div class="find-wrapper-results-head-right">
                    <select class="form-control edit_selected_option mr-3 ">
                        <option value="">Action</option>
                        <option value="edit">Edit</option>
                        <option value="barcode">Print Barcode</option>
                        <option value="qr_code">Print Qr Code</option>
                        <option value="download_barcode">Download Barcode</option>
                        <option value="download_qr_code">Download Qr Code</option>
                    </select>
                    <button class="btn btn-warning btn-edit edit_selected">GO</button>
                </div>
            </div>

            <div class="find-wrapper-results-content">
                @include('admin.find.items.results')
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="barcodeModalPrint" tabindex="-1" role="dialog" aria-labelledby="barcodeModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="barcodeModalCenterTitle">Barcode title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="printThis">
                        <ul class="barcodes_image_list" style="width: 100%; display: flex; flex-wrap: wrap">

                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="print_barcodes">Print</button>
                </div>
            </div>
        </div>
    </div>
    <div id="svg_barcode" style="display: none"></div>
    <div id="qr_codes"></div>
    <svg id="svg_barcode_print" style="display: none"></svg>

<div class="edit-list--container"  id="heading">
    <div class="d-flex justify-content-end heading">
        <button class="heading-btn editing_minimize"><i class="fa fa-minus"></i></button>
        <button class="heading-btn editing_max"><i class="fa fa-window-maximize"></i></button>
        <button class="heading-btn editing_close"><i class="fa fa-times"></i></button>
    </div>
    <div class="edit-list--container-content main-scrollbar">
        
    </div>
</div>

@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/public/js/DataTables/css/editor.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="/public/js/DataTables/css/editor.dataTables.css">
    <link rel="stylesheet" href="/public/js/DataTables/css/editor.bootstrap.css">
    <style>
        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility:hidden;
            }
            #printSection, #printSection * {
                visibility:visible;
            }
            #printSection {
                position:absolute;
                left:0;
                top:0;
            }
        }

    </style>
@stop
@section('js')

    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>--}}
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>

    <script src="{{url('public/js/DataTables/js/editor.bootstrap4.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>

    <script src="{{url('public/js/DataTables/js/editor.bootstrap.min.js')}}"></script>
{{--    <script src="{{url('public/js/DataTables/js/editor.select2.js')}}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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


            $("body").find(".categories").select2();
            $("body").find(".brands").select2();
            $("body").find(".barcodes").select2();


            $('#barcodeModalPrint #print_barcodes').on('click', function() {

                printElement(document.getElementById("printThis"));

                function printElement(elem) {
                    var domClone = elem.cloneNode(true);

                    var $printSection = document.getElementById("printSection");

                    if (!$printSection) {
                        var $printSection = document.createElement("div");
                        $printSection.id = "printSection";
                        document.body.appendChild($printSection);
                    }

                    $printSection.innerHTML = "";
                    $printSection.appendChild(domClone);
                    var page = new XMLSerializer().serializeToString(document.getElementById('printThis'));
                    shortAjax('/admin/find/items/html', {print: page}, function(res) {
                        console.log(res);
                        if(res.success) {
                            $('#barcodeModalPrint').modal('hide');
                        } else {
                            // alert(res.error)
                        }
                    });
                }
            });

            const barcode_settings = JSON.parse($('#barcode-settings').text());
            $('body').on('click', '.edit_selected', function(ev) {
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

                const ids = [];
                $('#items-table tbody tr.selected').each(function() {
                    ids.push($(this).find('td.sorting_1').text());
                });

                if($('.edit_selected_option').val() === 'barcode') {
                    if($('#items-table tbody tr.selected').length === 0) {
                        return false;
                    }
                    if(ids.length === 0) {
                        return false;
                    }
                    shortAjax('/admin/find/items/barcodes', {ids}, function(res) {

                        $('.barcodes_image_list').empty();
                        res.barcodes.map(function(barcode, key) {
                            JsBarcode('#svg_barcode_print', barcode.value, {
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
                            $('#svg_barcode').css('display', 'none');
                            var s = new XMLSerializer().serializeToString(document.getElementById('svg_barcode_print'));
                            var encodedData = window.btoa(s);

                            var img = $(`<img id="${'barcode_'+barcode.value}">`); //Equivalent: $(document.createElement('img'))
                            var li = $('<li style="list-style-type: none; margin: 0 20px 20px 0"></li>');
                            img.attr('src', 'data:image/svg+xml;base64,' + encodedData);
                            img.appendTo(li);

                            li.appendTo('.barcodes_image_list');
                            console.log(encodedData);
                        });
                        $('#barcodeModalPrint').modal('show');
                        $('#svg_barcode_print').css('display', 'none')
                        console.log(res);
                    });
                } else if($('.edit_selected_option').val() === 'download_barcode') {
                    $('.loader_container').css('display', 'block');
                    $('body').css('overflow', 'hidden');
                    if(ids.length === 0) {
                        $('.loader_container').css('display', 'none');
                        $('body').css('overflow', 'auto');
                        return false;
                    }
                    shortAjax('/admin/find/items/barcodes', {ids}, function(res) {

                        res.barcodes.map(function(barcode) {
                            $('#svg_barcode').append(`<svg id="svg_${barcode.value}"></svg>`)
                        });
                        res.barcodes.map(function(barcode, key) {
                            JsBarcode(`#svg_${barcode.value}`, barcode.value, {
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
                                displayValue,
                            })
                                .render();
                            $(`#svg_${barcode.value}`).css('display', 'none');
                            $('.loader_container').css('display', 'none');
                            $('body').css('overflow', 'auto');
                            saveSvgAsPng(document.getElementById(`svg_${barcode.value}`), `${barcode.file_name.replace(/\s/g, '_').trim()}.png`, {scale: 10});

                            // var s = new XMLSerializer().serializeToString(document.getElementById('svg_barcode'));
                            // var encodedData = window.btoa(s);
                            //
                            // var img = $(`<img id="${'barcode_'+value}">`); //Equivalent: $(document.createElement('img'))
                            // var li = $('<li style="list-style-type: none; margin: 0 20px 20px 0"></li>');
                            // img.attr('src', 'data:image/svg+xml;base64,' + encodedData);
                            // img.appendTo(li);
                            //
                            // li.appendTo('.barcodes_image_list');
                            // console.log(encodedData);
                        });
                        // $('#barcodeModalPrint').modal('show');
                    });
                } else if($('.edit_selected_option').val() === 'download_qr_code') {
                    $('.loader_container').css('display', 'block');
                    $('body').css('overflow', 'hidden');

                    function toDataURL(url) {
                        return fetch(url).then((response) => {
                            return response.blob();
                        }).then(blob => {
                            return URL.createObjectURL(blob);
                        });
                    }

                    async function forceDownload(url, fileName){
                        const a = document.createElement("a");
                        a.href = await toDataURL(url);
                        a.download = fileName;
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    }
                    if(ids.length === 0) {
                        $('.loader_container').css('display', 'none');
                        $('body').css('overflow', 'auto');
                        return false;
                    }
                    shortAjax('/admin/find/items/qrcodes', {ids}, function(res) {

                        console.log(res.qrcodes);
                        $('.loader_container').css('display', 'none');
                        $('body').css('overflow', 'auto');

                        res.qrcodes.map(function(arr, key) {
                            setTimeout(function() {
                                arr.map(function(er, key) {
                                    forceDownload(er.url, er.name.replace(/\s/g, '_').trim() + '.png');
                                });
                            }, key*3000);
                        });
                    });
                } else if($('.edit_selected_option').val() === 'edit') {
                    if(ids.length === 0) {
                        $('.loader_container').css('display', 'none');
                        $('body').css('overflow', 'auto');
                        return false;
                    }
                    shortAjax('/admin/find/items/edit', {ids}, function(res) {
                        $('.edit-list--container .edit-list--container-content').html(res.html);
                        $('.custom-select').select2();
                        $('.edit-list--container').show();
                        $(".edit-list--container").draggable({ handle:'.heading'});
                    });
                }
            });
            function getFormData($form){
                var unindexed_array = $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){
                    indexed_array[n['name']] = n['value'];
                });

                return indexed_array;
            }
            $('body').on('click', '.edit-list--container .edit_item_custom', function(ev) {
                ev.preventDefault();
                console.log($(ev.target).closest('form').find('[name="categories"]').val());
                console.log();
                let data = Object.assign(getFormData($(ev.target).closest('form')), {'categories': $(ev.target).closest('form').find('[name="categories"]').val()});
                console.log(data);
                shortAjax('/admin/find/items/save', data, function(res) {
                    window.LaravelDataTables["items-table"].ajax.reload()
                });
            });

            let min;
            let max;
            let i;
            $('body').on('click', '.edit-list--container .heading-btn', function(ev) {
                if($(ev.target).closest('.heading-btn').hasClass('editing_close')) {
                    $('.edit-list--container').find('.edit-list--container-content').empty();
                    $('body').css('overflow', 'unset');
                    $('.edit-list--container').hide();
                    $(".edit-list--container").draggable('destroy');

                    $('.edit-list--container').removeClass('max-wrap');
                    $('.edit-list--container').removeClass('min-wrap');
                    $('body').css('overflow', 'unset');
                } else if($(ev.target).closest('.heading-btn').hasClass('editing_max')) {
                    i = $(ev.target).closest('.heading-btn').find('i');

                    if(!$('.edit-list--container').hasClass('max-wrap')) {
                        if($(".edit-list--container").data('draggable')) {
                            $(".edit-list--container").draggable('destroy');
                        }
                        min = $('.edit-list--container').hasClass('min-wrap');
                        max = true;
                        min && $('.edit-list--container').removeClass('min-wrap');
                        i.removeClass('fa-window-maximize');
                        i.addClass('fa-window-restore');
                        $('.edit-list--container').addClass('max-wrap');
                        $('body').css('overflow', 'hidden');
                    } else {
                        max = false;
                        $(".edit-list--container").draggable({ handle:'.heading'});
                        min && $('.edit-list--container').addClass('min-wrap');
                        i.removeClass('fa-window-restore');
                        i.addClass('fa-window-maximize');
                        $('.edit-list--container').removeClass('max-wrap');
                        $('body').css('overflow', 'unset');
                    }
                } else if($(ev.target).closest('.heading-btn').hasClass('editing_minimize')) {
                    if($('.edit-list--container').hasClass('min-wrap')) {
                        if(max) {
                            i.removeClass('fa-window-maximize');
                            i.addClass('fa-window-restore');
                            $('.edit-list--container').addClass('max-wrap');
                            $('body').css('overflow', 'hidden');
                        } else {
                            $(".edit-list--container").draggable({ handle:'.heading'});

                        }
                        $('.edit-list--container').removeClass('min-wrap');
                    } else {
                        if(max) {
                            i.removeClass('fa-window-restore');
                            i.addClass('fa-window-maximize');
                            $('.edit-list--container').removeClass('max-wrap');
                            $('body').css('overflow', 'unset');
                        }
                        $('.edit-list--container').addClass('min-wrap');
                    }
                }
            });

            // const heading = document.getElementById('heading');
            //
            // heading.onmousedown = function(event) {
            //
            //     moveAt(event.pageX, event.pageY, event.clientX, event.clientY);
            //
            //     function moveAt(pageX, pageY, clientX, clientY) {
            //         heading.style.left = pageX - heading.offsetWidth + 'px';
            //         heading.style.top = pageY - heading.offsetHeight + 'px';
            //     }
            //
            //     function onMouseMove(event) {
            //         moveAt(event.pageX, event.pageY, event.clientX, event.clientY);
            //     }
            //
            //     document.addEventListener('mousemove', onMouseMove);
            //
            //     heading.onmouseup = function() {
            //         document.removeEventListener('mousemove', onMouseMove);
            //         heading.onmouseup = null;
            //     };
            //
            // };


            // let clicked_mouse = false;
            //
            // $('.edit-list--container .heading').on('mousedown', function() {
            //     clicked_mouse = true;
            // });
            //
            // $('.edit-list--container .heading').on('mouseup', function() {
            //     clicked_mouse = false;
            // });
            // $('.edit-list--container .heading').on('mousemove', function(ev) {
            //     if(clicked_mouse) {
            //         let afterLeft = $('.edit-list--container').css('left');
            //         let afterTop = $('.edit-list--container').css('top');
            //         let width = $('.edit-list--container').css('width').slice(0, $('.edit-list--container').css('width').length - 2);
            //         let height = $('.edit-list--container').css('height').slice(0, $('.edit-list--container').css('height').length - 2);
            //         $('.edit-list--container').css('left', ev.pageX - Number(width) + 'px')
            //         // $('.edit-list--container').css('top', ev.pageY - Number(height) + 'px')
            //
            //         console.log(ev, Number(width), ev.pageY, Number(height));
            //     } else {
            //         return false
            //     }
            // });







            {{$dataTable->generateScripts()}}


        });
    </script>
@stop
