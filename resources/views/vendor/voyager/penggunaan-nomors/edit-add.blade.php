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

                        <div class="row">
                            @foreach($kategoris as $kategori)
                                @if($kategori->id == 2)

                                @else
                                    <div class="col-6">
                                        <button class="btn btn-block btn-outline-success" style="min-height: 300px; font-size: 68px" onclick="{{str_replace(' ', '', (strtolower($kategori->nama_kategori)))}}()">{{$kategori->nama_kategori}}</button>
                                    </div>
                                @endif

                            @endforeach
                        </div>
                        {{--nomor sementara--}}


                        <div class="row">



                            <div class="col-12">
                                <form class="form-horizontal" action="{{route('add.nd')}}" method="post" >
                                    @csrf
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-12">

                                                <input name="kategori" id="kategori" value="kategori" hidden> {{--<span class="help-block m-b-none">Example block-level help text here.</span>--}}
                                                <input name="user_id" id="user_id" value="{{Auth::user()->id}}" hidden> {{--<span class="help-block m-b-none">Example block-level help text here.</span>--}}

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group"><label>Perihal </label>
                                                    <input placeholder="Perihal Surat" name="perihal" id="perihal" class="form-control"> <span class="help-block m-b-none">{{--Example block-level help text here.--}}</span>
                                                </div>
                                            </div>
                                            {{--<div class="col-6">
                                                <div class="form-group"><label>Perihal</label>
                                                    <select class="form-control" name="perihal" id="perihal">
                                                        <option value="Cuti"> Cuti </option>
                                                        <option value="Pengadaan Barang dan Jasa"> Pengadaan Barang dan Jasa </option>
                                                    </select>
                                                </div>
                                            </div>--}}
                                            <div class="col-6">
                                                <div class="form-group"><label>Tanggal</label>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                                                               value="{{$today}}">
                                                        <input type="time" name="time" id="time" class="form-control"
                                                               value="{{date('H:i:s')}}" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group" id="kode">

                                                    <label class="col-lg-12 control-label">Jenis Surat*</label>

                                                    <select class="select2_demo_3 form-control" name="kode" id="kode"
                                                            style="width: 100%" required>
                                                        @foreach($kodes as $kode)
                                                            <option value="{{$kode->id}}">{{$kode->kode}} | {{$kode->desc}}</option>
                                                        @endforeach
                                                    </select>


                                                    {{--<label class="col-lg-12 control-label">Pembuka Nota Dinas</label>
                                                    <div class="col-12">

                                                        <input placeholder="Pembuka Nota Dinas/ Sebelum dalam rangka" name="pembuka" id="pembuka" class="form-control">

                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-sm btn-white" type="submit">Submit</button>
                                            </div>
                                        </div>


                                    </div>
                                </form>
                            </div>



                        </div>

                        @isset($nomors)
                            <div class="row">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-limit-navigation="5" data-sorting="true" data-show-toggle="true" data-filtering="true">
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
