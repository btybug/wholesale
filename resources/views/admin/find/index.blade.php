@extends('layouts.admin')
@section('content-header')
@stop

@section('content')
    <div class="admin-find-wrapper">
        <div class="form-group row border-bottom pb-2">
            <label for="find" class="col-sm-2 col-form-label">Find</label>
            <div class="col-sm-4">
                {!! Form::select('find',$options,null,['class' => 'form-control','id' => 'find']) !!}
            </div>
        </div>
        <div class="find-form">

        </div>
        <div class="find-wrapper-results mt-5">
            <div class="find-wrapper-results-head">
                <h3>Results</h3>
                <div class="find-wrapper-results-head-right">
                    <button class="btn btn-warning btn-edit mr-3">Edit</button>
                    <select class="form-control">
                        <option value="">Action</option>
                        <option value="">Print Barcode</option>
                        <option value="">Print Qr Code</option>
                    </select>
                </div>
            </div>

            <div class="find-wrapper-results-content row">

            </div>

        </div>
    </div>
@stop
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    {!! HTML::script('/public/js/google/analytic/date-range-selector.js') !!}
    <script>
        function call_find(option){
            AjaxCall("/admin/find/call-find", {key: option}, function (res) {
                if (!res.error) {
                    $(".find-form").html(res.form);
switch (option) {
    case 'products':
        date_column();
        call_products();
        break;
    case 'items':

        break;
    case 'orders':   break;
}
                    if(option == 'products'){
                        date_column();
                        call_products();

                    }else if(option == 'orders'){
                        date_column();
                        $("body").find("#customer").select2();
                        $("body").find("#payment_method").select2();
                        $("body").find("#status").select2();
                    }
                }
            });
        }


        $(document).ready(function () {

            var option = $("#find").val();
            call_find(option);

            $("body").on('change','#find',function () {
                $(".find-wrapper-results-content").html("");

                call_find($(this).val());
            })


            $("body").on("change","#findForm", function() {
                $(this).closest('form').data('changed', true);
                doSubmitForm()
            });
        });

        function call_products() {
            $("body").find(".categories").select2();
            $("body").find(".brands").select2();
            $("body").find(".barcodes").select2();

            // for date rang
            (function (w, d, s, g, js, fs) {
                g = w.gapi || (w.gapi = {});
                g.analytics = {
                    q: [], ready: function (f) {
                        this.q.push(f);
                    }
                };
                js = d.createElement(s);
                fs = d.getElementsByTagName(s)[0];
                js.src = 'https://apis.google.com/js/platform.js';
                fs.parentNode.insertBefore(js, fs);
                js.onload = function () {
                    g.load('analytics');
                };
            }(window, document, 'script'));


        }
function date_column() {
    $('.daterange').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    }, function (start, end) {
        $('#find-date__ranged').val(`${start.format('MMMM D, YYYY')} - ${end.format('MMMM D, YYYY')}`);
        doSubmitForm();
    });
}
        function doSubmitForm() {
            
            $('.find-wrapper-results-content').html('<div id="loading" class="justify-content-center align-items-center my-5 d-flex">\n' +
                '            <div class="lds-dual-ring"></div>\n' +
                '        </div>');
            let form = $("#findForm");
            let serializeValue = form.serialize();

            let url = form.attr('action');
            // let url = "/products/" + category;
            // console.log(typeof serializeValue)
            // console.log(window.location.origin + window.location.pathname + '?' + serializeValue + `&sort_by=${sort_by}&q=${search_text}`)
            // window.location.replace(window.location.origin + window.location.pathname + '?' + form);

            $.ajax({
                type: "post",
                url: url,
                cache: false,
                datatype: "json",
                data: `${serializeValue}`,
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function (data) {
                    if (!data.error) {
                        $(".find-wrapper-results-content").html(data.html);
                    }
                },
                error: function() {
                    $(".find-wrapper-results-content").html('Error')
                }
            });
        }
    </script>
@stop
