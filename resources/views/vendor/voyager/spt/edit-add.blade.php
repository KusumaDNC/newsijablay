@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <form class="form-horizontal" action="{{route('create.spt')}}" method="post">
        @csrf

        <div class="row">
            <div class="col-8" id="input-player-list">
                <div class="form-group"><label>Tujuan*</label>
                    <input placeholder="Tujuan" name="tujuan[]" id="tujuan" class="form-control"
                           required>
                </div>
                <div class="col-lg-12">
                    <div class="ui-tooltip">
                        <button type='button' class="btn btn-danger btn-circle float-left"
                                data-toggle="tooltip" data-placement="bottom" title="Hapus Tujuan"
                                id='removePlayer'>
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type='button' class="btn btn-info btn-circle float-right" id='addPlayer'
                                data-toggle="tooltip" data-placement="bottom" title="Tambah Tujuan">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group"><label>Transportasi*</label>
                    <input placeholder="Transportasi" name="kendaraan" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="space-30"></div>

        <div class="row">
            <div class="col-4">
                <div class="form-group" id="pd">
                    <label class="col-lg-12 control-label">Jenis PD*</label>
                    <select class="select2_demo_2 form-control" name="jns_rek" id="jns_rek" required>
                        @foreach($rek as $d)
                            <option value="{{$d->id}}">{{$d->jns_rek}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-8">
                <div class="form-group"><label class="col-lg-12 control-label">Perihal*</label>

                    <input placeholder="Perihal" name="perihal" id="perihal"
                           class="form-control" required>
                </div>
            </div>
        </div>

    <div class="space-15">
    </div>
     {{--<label class="form-group">Dasar Surat Perintah Tugas*</label>--}}
      {{--<div class="col-12">
            <select class="form-control" name="dasar_hukum" id="dasar_hukum">
                multiple="multiple" required>
                @foreach($dasar_hukums as $dasar_hukum)
                    <option value="{{$dasar_hukum->id}}">{{$dasar_hukum->dasar_hukum}}</option>
                @endforeach
            </select>
     </div>--}}

        <div class="space-15">
        </div>

        <div class="row">
            <div class="col-4">
                <div class="form-group" id="data_1"><label class="col-lg-12 control-label">Tanggal
                        SPT*</label>

                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="tgl_spt" id="tgl_spt" class="form-control"
                               value="{{$today}}">
                    </div>

                </div>
            </div>
            <div class="col-4">
                <div class="form-group" id="data_1"><label class="col-lg-12 control-label">Tanggal
                        Berangkat*</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="tgl_berangkat" id="tgl_berangkat" class="form-control"
                               value="{{$today}}">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group" id="data_1"><label class="col-lg-12 control-label">Tanggal
                        Kembali*</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="tgl_pulang" id="tgl_pulang" class="form-control"
                               value="{{$today}}">
                    </div>
                </div>
            </div>
        </div>

        <div class="space-15">

        </div>
        @if ($errors->has('pelaksana'))
            <span class="help-block">
                            <strong>{{ $errors->first('pelaksana') }}</strong>
                        </span>
        @endif
        <div class="form-group" id="plk">

            <label class="col-lg-12 control-label">Pelaksana*</label>
            <div class="col-12">
                <select class="select2_demo_3 form-control" name="pelaksana[]" id="pelaksana"
                        multiple="multiple" required>
                    @foreach($nama as $d)
                        <option value="{{$d->id}}">{{$d->nama}}</option>
                    @endforeach
                </select>
            </div>

            {{--<label class="col-lg-12 control-label">Pembuka Nota Dinas</label>
            <div class="col-12">

                <input placeholder="Pembuka Nota Dinas/ Sebelum dalam rangka" name="pembuka" id="pembuka" class="form-control">

            </div>--}}


        </div>

        <div class="space-15">

        </div>
        <div class="form-group">
            <div class="col-lg-offset-12 col-lg-12">
                <button class="btn btn-sm btn-outline-success btn-block" type="submit">Submit</button>
            </div>
        </div>
    </form>
























                

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                            enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                                 onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
