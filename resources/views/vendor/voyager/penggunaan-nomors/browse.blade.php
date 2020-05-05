@extends('voyager::master')

<!-- @section('page_title', __('voyager::generic.viewing').' '.__('voyager::generic.settings')) -->
<meta name="_token" content="{{ csrf_token() }}"/>
<title>SIJABLAY - DPMPTSP PROV. JATENG</title>


@section('css')
    <!-- <style type="text/css">
        div.dataTables_wrapper {
            margin-bottom: 3em;
        }
    </style> -->

    <!-- link https://jmkleger.com/post/ajax-crud-for-laravel-5-4  -->

    <style>


        .panel-actions .voyager-trash {
            cursor: pointer;
        }
        .panel-actions .voyager-trash:hover {
            color: #e94542;
        }
        .settings .panel-actions{
            right:0px;
        }
        .panel hr {
            margin-bottom: 10px;
        }
        .panel {
            padding-bottom: 15px;
        }
        .sort-icons {
            font-size: 21px;
            color: #ccc;
            position: relative;
            cursor: pointer;
        }
        .sort-icons:hover {
            color: #37474F;
        }
        .voyager-sort-desc {
            margin-right: 10px;
        }
        .voyager-sort-asc {
            top: 10px;
        }
        .page-title {
            margin-bottom: 0;
        }
        .panel-title code {
            border-radius: 30px;
            padding: 5px 10px;
            font-size: 11px;
            border: 0;
            position: relative;
            top: -2px;
        }
        .modal-open .settings  .select2-container {
            z-index: 9!important;
            width: 100%!important;
        }
        .new-setting {
            text-align: center;
            width: 100%;
            margin-top: 20px;
        }
        .new-setting .panel-title {
            margin: 0 auto;
            display: inline-block;
            color: #999fac;
            font-weight: lighter;
            font-size: 13px;
            background: #fff;
            width: auto;
            height: auto;
            position: relative;
            padding-right: 15px;
        }
        .settings .panel-title{
            padding-left:0px;
            padding-right:0px;
        }
        .new-setting hr {
            margin-bottom: 0;
            position: absolute;
            top: 7px;
            width: 96%;
            margin-left: 2%;
        }
        .new-setting .panel-title i {
            position: relative;
            top: 2px;
        }
        .new-settings-options {
            display: none;
            padding-bottom: 10px;
        }
        .new-settings-options label {
            margin-top: 13px;
        }
        .new-settings-options .alert {
            margin-bottom: 0;
        }
        #toggle_options {
            clear: both;
            float: right;
            font-size: 12px;
            position: relative;
            margin-top: 15px;
            margin-right: 5px;
            margin-bottom: 10px;
            cursor: pointer;
            z-index: 9;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .new-setting-btn {
            margin-right: 15px;
            position: relative;
            margin-bottom: 0;
            top: 5px;
        }
        .new-setting-btn i {
            position: relative;
            top: 2px;
        }
        textarea {
            min-height: 120px;
        }
        textarea.hidden{
            display:none;
        }

        .voyager .settings .nav-tabs{
            background:none;
            border-bottom:0px;
        }

        .voyager .settings .nav-tabs .active a{
            border:0px;
        }

        .select2{
            width:100% !important;
            border: 1px solid #f1f1f1;
            border-radius: 3px;
        }

        .voyager .settings input[type=file]{
            width:100%;
        }

        .settings .select2{
            margin-left:10px;
        }

        .settings .select2-selection{
            height: 32px;
            padding: 2px;
        }

        .voyager .settings .nav-tabs > li{
            margin-bottom:-1px !important;
        }

        .voyager .settings .nav-tabs a{
            text-align: center;
            background: #f8f8f8;
            border: 1px solid #f1f1f1;
            position: relative;
            top: -1px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        .voyager .settings .nav-tabs a i{
            display: block;
            font-size: 22px;
        }

        .tab-content{
            background:#ffffff;
            border: 1px solid transparent;
        }

        .tab-content>div{
            padding:10px;
        }

        .settings .no-padding-left-right{
            padding-left:0px;
            padding-right:0px;
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover{
            background:#fff !important;
            color:#62a8ea !important;
            border-bottom:1px solid #fff !important;
            top:-1px !important;
        }

        .nav-tabs > li a{
            transition:all 0.3s ease;
        }


        .nav-tabs > li.active > a:focus{
            top:0px !important;
        }

        .voyager .settings .nav-tabs > li > a:hover{
            background-color:#fff !important;
        }
    </style>

@stop
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


@section('page_header')
    <h1 class="page-title">
        <i class="voyager-settings"></i> Pengambilan Nomor <!-- {{ __('voyager::generic.settings') }} -->
    </h1>
@stop

@section('content')
    <!-- <div class="container-fluid">
        @include('voyager::alerts')
        @if(config('voyager.show_dev_tips'))
        <div class="alert alert-info">
            <strong>{{ __('voyager::generic.how_to_use') }}:</strong>
            <p>{{ __('voyager::settings.usage_help') }} <code>setting('group.key')</code></p>
        </div>
        @endif
    </div> -->
    <div class="page-content browse container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{!! $message !!}</strong>
                        </div>

                    @elseif($message = Session::get('danger'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{!! $message !!}</strong>
                        </div>
                    @endif
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Ambil Nomor</h5>
                        </div>
                        <div class="ibox-content">
                            <!-- <a href="#" class="add-modal"><li>Add a Post</li></a> -->
                            <a href="#">
                                <button class="btn btn-info btn-block add-surat" >
                                    <i class="fa fa-align-right fa-arrow-circle-right"></i>
                                    Create Nomor
                                </button>
                            </a>
                            <!-- <a href="#">
                                <button class="btn btn-info btn-block add-nodin" >
                                    <i class="fa fa-align-right fa-arrow-circle-right"></i>
                                    Nota Dinas
                                </button>
                            </a> -->

                             <!-- Modal form to add Surat -->
                                <div id="addSurat" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title"></h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" role="form">
                                                <!-- <form id="productForm" name="productForm" class="form-horizontal"> -->

                                                    @csrf
                                                    <div class="form-group">
                                                                <label class="control-label col-sm-3" for="title">Kategori</label>
                                                                <div class="col-sm-9">
                                                    @foreach($kategoris as $kategori)
                                                        @if($kategori->id == 2)
                                                            @else
                                                            
                                                                
                                                                    <input class="form-check-input" type="checkbox" onclick="check();" name="kategori_nomor_id" value="{{$kategori->id}}">
                                                                            {{$kategori->nama_kategori}}
                                                                            @endif
                                                    @endforeach
                                                    <br>
                                                                            <small>*) Pilih Salah Satu</small>
                                                                </div>
                                                            </div>
                                                        




                                                    <input name="user_id" id="user_id" value="{{Auth::user()->id}}" hidden>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3" for="title">Perihal</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" placeholder="Input Perihal" id="perihal" autofocus>
                                                            <!-- <textarea class="form-control" id="perihal" cols="40" rows="5"></textarea> -->
                                                            <!-- <small>Min: 2, Max: 32, only text</small> -->
                                                            <p class="errorTitle text-center alert alert-danger hidden"></p>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3" for="content">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group date">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                                <input type="date" name="tanggal" id="tanggal" class="form-control"
                                                                           value="{{$todayss}}">
                                                                <input type="time" name="time" id="time" 
                                                                           value="{{date('H:i:s')}}" hidden>
                                                            </div>
                                                            
                                                            <!-- <small>Min: 2, Max: 128, only text</small> -->
                                                            <p class="errorContent text-center alert alert-danger hidden"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3" for="content">Jenis Surat*</label>

                                                        <div class="col-sm-9">
                                                            <select class="select2_demo_3 form-control" name="kode" id="kode"
                                                                        style="width: 100%" required>
                                                                    @foreach($kodes as $kode)
                                                                        <option value="{{$kode->id}}">{{$kode->kode}} | {{$kode->desc}}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success addn" data-dismiss="modal">
                                                        <span id="" class='glyphicon glyphicon-check'></span> Add
                                                    </button>
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                                                        <span class='glyphicon glyphicon-remove'></span> Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <!-- Modal form to add Nota Dinas -->
                                <div id="addNodin" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title"></h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" role="form">

                                                <!-- <form id="productForm" name="productForm" class="form-horizontal"> -->

                                                    @csrf
                                                    <input name="kategori" id="kategori" value="3" hidden>
                                                    <input name="user_id" id="user_id" value="{{Auth::user()->id}}" hidden>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3" for="title">Perihal</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" placeholder="Input Perihal" id="perihal">
                                                            <!-- <textarea class="form-control" id="perihal" cols="40" rows="5"></textarea> -->
                                                            <!-- <small>Min: 2, Max: 32, only text</small> -->
                                                            <p class="errorTitle text-center alert alert-danger hidden"></p>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3" for="content">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group date">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                                <input type="date" name="tanggal" id="tanggal" class="form-control"
                                                                           value="{{$todayss}}">
                                                                <input type="time" name="time" id="time" 
                                                                           value="{{date('H:i:s')}}" hidden>
                                                            </div>
                                                            
                                                            <!-- <small>Min: 2, Max: 128, only text</small> -->
                                                            <p class="errorContent text-center alert alert-danger hidden"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3" for="content">Jenis Surat*</label>

                                                        <div class="col-sm-9">
                                                            <select class="select2_demo_1 form-control" name="kode" id="kode"
                                                                        style="width: 100%" required>
                                                                    @foreach($kodes as $kode)
                                                                        <option value="{{$kode->id}}">{{$kode->kode}} | {{$kode->desc}}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success addnodin" data-dismiss="modal">
                                                        <span id="" class='glyphicon glyphicon-check'></span> Add
                                                    </button>
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                                                        <span class='glyphicon glyphicon-remove'></span> Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @isset($nomors)
                                <div class="row">
                                    <!-- <table id="example" class="display" style="width:100%"> -->
                                    <table class="table table-striped table-bordered table-hover" id="example">

                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bidang</th>
                                            <th>Perihal</th>
                                            <th>Tanggal</th>
                                            <th>Nomor Surat</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(Auth::user()->id == 7)
                                            @foreach($nomors->where('arsip_id', '!=', null) as $nomor)
                                                <tr>
                                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                                    <td style="text-align: center">{{$nomor->user->name}}</td>
                                                    <td style="text-align: center">{{$nomor->perihal}}</td>
                                                    <td style="text-align: center">{{$nomor->tanggal}}</td>
                                                    <td style="text-align: center">{{$nomor->kodenomor->kode}}/{{$nomor->count}}</td>
                                                </tr>
                                            @endforeach

                                        @elseif(Auth::user()->id == 1)
                                            @foreach($nomors->where('arsip_id', '!=', null) as $nomor)
                                                <tr>
                                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                                    <td style="text-align: center">{{$nomor->user->name}}</td>
                                                    <td style="text-align: center">{{$nomor->perihal}}</td>
                                                    <td style="text-align: center">{{$nomor->tanggal}}</td>
                                                    <td style="text-align: center">{{$nomor->kodenomor->kode}}/{{$nomor->count}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach($nomors->where('user_id', Auth::user()->id) as $nomor)
                                                <tr>
                                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                                    <td style="text-align: center">{{$nomor->user->name}}</td>
                                                    <td style="text-align: center">{{$nomor->perihal}}</td>
                                                    <td style="text-align: center">{{$nomor->tanggal}}</td>
                                                    <td style="text-align: center">{{$nomor->kodenomor->kode}}/{{$nomor->count}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <ul class="pagination pagination-centered">
                                                </ul>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>



    </div>

@stop

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        stateSave: true
    } );
} );
</script>


<script>
    $(document).ready(function(){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#nodin").click(function(){
            $("#nodins").modal();
        });
        $(".select2_demo_4").select2({
            placeholder: "Select a state",
            allowClear: true
        });

        var table=$('.data-table').DataTable( {
            processing: true, serverSide: true, ajax: "{{ route('indxnomor') }}", columns: [ {
            data: 'DT_RowIndex', name: 'DT_RowIndex'}, 
            { data: 'name', name: 'name'}, 
            { data: 'detail', name: 'detail'},
            { data: 'action', name: 'action', 
              orderable: false, searchable: false}, ]
        });

        $('#saveBtn').click(function(e) {
             e.preventDefault();
             $(this).html('Sending..');

             $.ajax({
                 data: $('#productForm').serialize(),
                 url: "{{ route('add.nd') }}",
                 type: "POST",
                 dataType: 'json',

                 success: function(data) {

                     $('#productForm').trigger("reset");
                     $('#ajaxModel').modal('hide');
                     table.draw();
                     url: "{{ route('indxnomor') }}";

                 },
                 error: function(data) {
                     console.log('Error:', data);
                     $('.result').html(data);
                     $('#saveBtn').html('Save Changes');
                    // var currentLocation = window.location;
                 }
             });
         });

        
    });
</script>





    <script>
        $(document).ready(function () {
            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });
            $(".select2_demo_4").select2({
                placeholder: "Select a state",
                allowClear: true
            });

            $('#data_1 .input-group.date').datepicker({
                changeMonth: true,
                changeYear: true,
                startView: "months",
                minViewMode: "months",
                showButtonPanel: true,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm"
            });


            var lineData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Example dataset",
                        backgroundColor: "rgba(26,179,148,0.5)",
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
                        pointBorderColor: "#fff",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    },
                    {
                        label: "Example dataset",
                        backgroundColor: "rgba(220,220,220,0.5)",
                        borderColor: "rgba(220,220,220,1)",
                        pointBackgroundColor: "rgba(220,220,220,1)",
                        pointBorderColor: "#fff",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    }
                ]
            };

            var lineOptions = {
                responsive: true
            };



        });
    </script>

    <script src="{{asset('dpmptsp/js/bootstrap-datepicker.js')}}"></script>
    <script>
        $('document').ready(function () {
            $('#toggle_options').click(function () {
                $('.new-settings-options').toggle();
                if ($('#toggle_options .voyager-double-down').length) {
                    $('#toggle_options .voyager-double-down').removeClass('voyager-double-down').addClass('voyager-double-up');
                } else {
                    $('#toggle_options .voyager-double-up').removeClass('voyager-double-up').addClass('voyager-double-down');
                }
            });

            @can('delete', Voyager::model('Setting'))
            $('.panel-actions .voyager-trash').click(function () {
                var display = $(this).data('display-name') + '/' + $(this).data('display-key');

                $('#delete_setting_title').text(display);

                $('#delete_form')[0].action = '{{ route('voyager.settings.delete', [ 'id' => '__id' ]) }}'.replace('__id', $(this).data('id'));
                $('#delete_modal').modal('show');
            });
            @endcan

            $('.toggleswitch').bootstrapToggle();

            $('[data-toggle="tab"]').click(function() {
                $(".setting_tab").val($(this).html());
            });

            $('.delete_value').click(function(e) {
                e.preventDefault();
                $(this).closest('form').attr('action', $(this).attr('href'));
                $(this).closest('form').submit();
            });
        });
    </script>
    <script type="text/javascript">
    $(".group_select").not('.group_select_new').select2({
        tags: true,
        width: 'resolve'
    });
    $(".group_select_new").select2({
        tags: true,
        width: 'resolve',
        placeholder: '{{ __("voyager::generic.select_group") }}'
    });
    $(".group_select_new").val('').trigger('change');
    </script>







    <!-- add a Nomor Surat operations -->
    <script type="text/javascript">
        // add a Nomor
        $(document).on('click', '.add-surat', function() {
            $('.modal-title').text('Create Nomor Surat');
            $('#addSurat').modal('show');
        });

        $('.modal-footer').on('click', '.addn', function() {
            $.ajax({
                type: 'POST',
                url: '{{ route('add.nd') }}',
                // data: $('#productForm').serialize(),

                data: {
                    '_token': $('input[name=_token]').val(),
                    'kategori': $('#kategori').val(),
                    'user_id': $('#user_id').val(),
                    'perihal': $('#perihal').val(),
                    'tanggal': $('#tanggal').val(),
                    'kode': $('#kode').val(),
                    'tanggal': $('#tanggal').val()
                },
                success: function(data) {
                    $('.errorTitle').addClass('hidden');
                    $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addSurat').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.title) {
                            $('.errorTitle').removeClass('hidden');
                            $('.errorTitle').text(data.errors.title);
                        }
                        if (data.errors.content) {
                            $('.errorContent').removeClass('hidden');
                            $('.errorContent').text(data.errors.content);
                        }
                    } else {
                        toastr.success('Successfully Created Nomor !', 'Success Alert', {timeOut: 5000});
                        window.location.reload(true);
                        // $('#example').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.iteration + "</td><td>" + data.perihal + "</td><td>" + data.tanggal + "</td><td>" + data.kode / data.count + "</td></tr>");
                        

                         // $('#example').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.title + "</td><td>" + data.content + "</td><td class='text-center'><input type='checkbox' class='new_published' data-id='" + data.id + " '></td><td>Right now</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                        
                    }
                },
            });
        });
    </script>


    <script type="text/javascript">


        // add a Nomor Nota Dinas
        $(document).on('click', '.add-nodin', function() {
            $('.modal-title').text('Create Nomor Nota Dinas');
            $('#addNodin').modal('show');
        });

        $('.modal-footer').on('click', '.addnodin', function() {
            $.ajax({
                type: 'POST',
                url: '{{ route('add.nd') }}',
                // data: $('#productForm').serialize(),

                data: {
                    '_token': $('input[name=_token]').val(),
                    'kategori': $('#kategori').val(),
                    'user_id': $('#user_id').val(),
                    'perihal': $('#perihal').val(),
                    'tanggal': $('#tanggal').val(),
                    'kode': $('#kode').val(),
                    'tanggal': $('#tanggal').val()
                },
                success: function(data) {
                    $('.errorTitle').addClass('hidden');
                    $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addNodin').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 2000});
                        }, 500);

                        if (data.errors.title) {
                            $('.errorTitle').removeClass('hidden');
                            $('.errorTitle').text(data.errors.title);
                        }
                        if (data.errors.content) {
                            $('.errorContent').removeClass('hidden');
                            $('.errorContent').text(data.errors.content);
                        }
                    } else {
                        toastr.success('Successfully Created Nomor !', 'Success Alert', {timeOut: 2000});
                        window.location.reload(true);
                        
                    }
                },
            });
        });
    </script>



@stop

