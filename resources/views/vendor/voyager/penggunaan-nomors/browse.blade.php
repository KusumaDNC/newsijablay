@extends('voyager::master')

<!-- @section('page_title', __('voyager::generic.viewing').' '.__('voyager::generic.settings')) -->
<title>SIJABLAY - DPMPTSP PROV. JATENG</title>


@section('css')
    <!-- <style type="text/css">
        div.dataTables_wrapper {
            margin-bottom: 3em;
        }
    </style> -->
    
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
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form class="form-horizontal" action="{{route('nmr.store')}}" method="post" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <input name="kategori" id="kategori" value="kategori" hidden>
                                        <input name="user_id" id="user_id" value="{{Auth::user()->id}}" hidden>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group"><label>Perihal </label>
                                            <input placeholder="Perihal Surat" name="perihal" id="perihal" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group"><label>Tanggal</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{$todayss}}">
                                                <input type="hidden" name="time" id="time" class="form-control" value="{{date('H:i:s')}}" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group" id="kode">
                                        <label class="col-lg-12 control-label">Jenis Surat*</label>
                                        <select class="select2_demo_3 form-control" name="kode" id="kode" style="width: 100%" required>
                                        @foreach($kodes as $kode)
                                            <option value="{{$kode->id}}">{{$kode->kode}} | {{$kode->desc}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-1 col-lg-11">
                                        <button type="submit" class="btn btn-primary save">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <p>&nbsp;</p><br><br><br>
                        </div>
                        <hr>
                        <br>
                        <br>
                        <div class="col-md-12">
                            @isset($nomors)
                                <div class="row">
                                    <div class="col-md-12">
                                            <table id="example" class="display" style="width:100%">
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
                                </div>
                            @endisset
                        </div>
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
        $(document).ready(function () {
            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
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
    <iframe id="form_target" name="form_target" style="display:none"></iframe>
    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="POST" enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
        {{ csrf_field() }}
        <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
        <input type="hidden" name="type_slug" id="type_slug" value="settings">
    </form>

    
@stop
