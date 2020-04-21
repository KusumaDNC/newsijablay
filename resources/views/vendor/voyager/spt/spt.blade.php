
<div class="ibox float-e-margins">
    <div class="ibox-content">
        @include('voyager::alerts')

    </div>

    <div class="col-md-12">
        <a href="{{route('adv.spt')}}">
        <button class="btn btn-danger btn-block" >
            <i class="fa fa-align-right fa-arrow-circle-right"></i>
            Advance SPT
        </button>
        </a>

    </div>

    <form class="form-horizontal" action="{{route('create.spt')}}" method="post">
        @csrf

        <div class="row">
            <div class="col-md-8" id="input-player-list">
                <div class="form-group"><label>Tujuan*</label>
                    <input placeholder="Tujuan" name="tujuan[]" id="tujuan" class="form-control"
                           required>
                </div>
                <div class="col-md-12">
                    <div class="ui-tooltip">
                        <button type='button' class="btn btn-danger btn-circle float-left"
                                data-toggle="tooltip" data-placement="bottom" title="Hapus Tujuan"
                                id='removePlayer'>
                            <!-- <i class="fa fa-minus"></i> -->
                            <div class="icon voyager-x"></div>
                        </button>
                        <button type='button' class="btn btn-info btn-circle float-right" id='addPlayer'
                                data-toggle="tooltip" data-placement="bottom" title="Tambah Tujuan">
                            <!-- <i class="fa fa-plus"></i> -->
                            <div class="icon voyager-plus"></div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group"><label>Transportasi*</label>
                    <input placeholder="Transportasi" name="kendaraan" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="space-30"></div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group" id="pd">
                    <label class="col-lg-12 control-label">Jenis PD*</label>
                    <select class="select2_demo_2 form-control" name="jns_rek" id="jns_rek" required>
                        @foreach($rek as $d)
                            <option value="{{$d->id}}">{{$d->jns_rek}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-8">
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
            <div class="col-md-4">
                <div class="form-group" id="data_1"><label class="col-lg-12 control-label">Tanggal
                        SPT*</label>

                    <div class="input-group date">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input type="date" name="tgl_spt" id="tgl_spt" class="form-control"
                               value="{{$today}}">
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" id="data_1"><label class="col-lg-12 control-label">Tanggal
                        Berangkat*</label>
                    <div class="input-group date">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input type="date" name="tgl_berangkat" id="tgl_berangkat" class="form-control"
                               value="{{$today}}">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group" id="data_1"><label class="col-lg-12 control-label">Tanggal
                        Kembali*</label>
                    <div class="input-group date">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        <input type="date" name="tgl_pulang" id="tgl_pulang" class="form-control"
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
            <div class="col-md-12">
                <button class="btn btn-sm btn-success btn-block" type="submit">Submit</button>
            </div>
        </div>
    </form>
</div>
