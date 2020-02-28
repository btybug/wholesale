<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel DataTables Editor</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.4/css/select.bootstrap.min.css">
    <link rel="stylesheet" href="/public/js/DataTables/css/editor.dataTables.css">
    <link rel="stylesheet" href="/public/js/DataTables/css/editor.bootstrap.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
    <script src="{{asset('public/js/DataTables/js/dataTables.editor.js')}}"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.0/js/buttons.bootstrap.min.js"></script>

    <script src="{{url('public/js/DataTables/js/editor.bootstrap.min.js')}}"></script>
</head>
<body>
<div class="container">
    {{$dataTable->table(['id' => 'items-table'])}}
</div>

<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });

        var editor = new $.fn.dataTable.Editor({
            ajax: "/admin/items-editor",
            table: "#items-table",
            display: "bootstrap",
            idSrc:  'id',
            fields: [
                {label: "ID:", name: "id",type:'readonly'},
                {label: "Width:", name: "width"},
                {label: "Action:", name: "action",type:'readonly'}
            ]
        });

        $('#items-table').on('click', 'tbody td:not(:first-child)', function (e) {
            editor.inline(this);
        });

        {{$dataTable->generateScripts()}}
        $("#items-table").append(
            $('<tfoot/>').append( $("#items-table thead tr").clone() )
        );

        $('#items-table thead th').each( function () {
            var title = $('#items-table tfoot th').eq($(this).index()).text();
            console.log(title)
            $(this).html( '<input placeholder="'+title+'">' );
        } );

        // DataTable
        var table =  window.LaravelDataTables["items-table"];

        // Apply the search
        table.columns().eq( 0 ).each( function ( colIdx ) {
            $( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
                table
                    .column( colIdx )
                    .search( this.value )
                    .draw();
            } );
        } );

    })
</script>
</body>
</html>
