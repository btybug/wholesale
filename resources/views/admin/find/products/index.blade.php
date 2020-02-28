@extends('layouts.admin')
@section('content-header')
@stop
@section('content')
    <div class="admin-find-wrapper">
        <div class="find-form">
            @include('admin.find.products.form')
        </div>

        <div class="find-wrapper-results mt-5">
            <div class="find-wrapper-results-head">
                <h3>Results</h3>
                <div class="find-wrapper-results-head-right ">
                    <select class="form-control mr-3">
                        <option value="">Action</option>
                        <option value="">Print Barcode</option>
                        <option value="">Print Qr Code</option>
                    </select>
                    <button class="btn btn-warning btn-edit ">GO</button>
                </div>
            </div>

            <div class="find-wrapper-results-content">
                @include('admin.find.products.results')
            </div>

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
@stop
@section('js')

    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
    {{--    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>--}}
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>

    <script src="{{url('public/js/DataTables/js/editor.bootstrap4.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>

    <script src="{{url('public/js/DataTables/js/editor.bootstrap.min.js')}}"></script>
    <script src="{{url('public/js/DataTables/js/editor.select2.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(function () {
            $("body").find(".categories").select2();
            $("body").find(".brands").select2();
            $("body").find(".barcodes").select2();
        })
    </script>
    <script>

        (function ($, DataTable) {

            if ( ! DataTable.ext.editorFields ) {
                DataTable.ext.editorFields = {};
            }

            var Editor = DataTable.Editor;
            var _fieldTypes = DataTable.ext.editorFields;

            _fieldTypes.status = {
                create: function ( conf ) {
                    var that = this;

                    conf._enabled = true;

                    // Create the elements to use for the input
                    conf._input = $(
                        '<div id="'+Editor.safeId( conf.id )+'">'+
                        '<button type="button" class="inputButton" value="Draft">Draft</button>'+
                        '<button type="button" class="inputButton" value="Published">Published</button>'+
                        '</div>');

                    // Use the fact that we are called in the Editor instance's scope to call
                    // the API method for setting the value when needed
                    $('button.inputButton', conf._input).click( function () {
                        if ( conf._enabled ) {
                            that.set( conf.name, $(this).attr('value') );
                        }

                        return false;
                    } );

                    return conf._input;
                },

                get: function ( conf ) {
                    return $('button.selected', conf._input).attr('value');
                },

                set: function ( conf, val ) {
                    $('button.selected', conf._input).removeClass( 'selected' );
                    $('button.inputButton[value='+val+']', conf._input).addClass('selected');
                },

                enable: function ( conf ) {
                    conf._enabled = true;
                    $(conf._input).removeClass( 'disabled' );
                },

                disable: function ( conf ) {
                    conf._enabled = false;
                    $(conf._input).addClass( 'disabled' );
                }
            };

        })(jQuery, jQuery.fn.dataTable);

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            var editor = new $.fn.dataTable.Editor({
                ajax: "/admin/find/products",
                table: $('body').find("#products-table"),
                display: "bootstrap",
                idSrc: 'id',
                fields: [
                    {label: "ID:", name: "id", type: 'readonly'},
                    {label: "Name:", name: "name"},
                    {label: "Brand:", name: "brand_id"},
                    {label: "Price:", name: "price"},
                    {label: "Slug:", name: "slug"},
                    {label: "Categories:", name: "categories"},
                    {label: "Status:", name: "status"}
                ]
            });


            // editor.on("preOpen", function (e, mode, action) {
            //         $('#DTE_Field_categories_lists').val('1');
            //         $('#DTE_Field_categories_lists').trigger('change')
            // });

            // $('#items-table').on( 'click', 'tbody td:not(:first-child)', function (e) {
            //     $('body').find('#DTE_Field_barcodes_code').select2()
            //     editor.inline( this, {
            //         onBlur: 'submit'
            //     } );
            // } );
            // $('body').find('#items-table').on('click', 'tbody td:not(:first-child)', function (e) {
            //     editor.inline(this);
            // });

            {{$dataTable->generateScripts()}}

        });
    </script>
@stop
