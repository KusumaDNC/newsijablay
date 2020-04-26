<div class="ibox float-e-margins">

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($message = Session::get('warning'))
            <div class="alert alert-warning alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
    </div>

    <div class="ibox-title">
        <h5>EDIT SPT</h5>
    </div>

    <form class="form-horizontal" action="{{route('update.spt', $spt->id)}}" method="post">
        @csrf
        @method('PATCH')
        <div class="ibox-content">
        <div class="row">
            <div class="col-8" id="input-player-list">
                <div class="form-group"><label>Tujuan*</label>
                    <input placeholder="Tujuan" name="tujuan[]" id="tujuan" class="form-control"
                           required>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group"><label>Transportasi*</label>
                    <input value="{{$spt->kendaraan}}" placeholder="Transportasi" name="kendaraan" class="form-control" required>
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
                    <input value="{{$spt->perihal}}" placeholder="Perihal" name="perihal" id="perihal"
                           class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="form-group" id="data_1"><label class="col-lg-12 control-label">Tanggal
                        SPT*</label>

                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="tgl_spt" id="tgl_spt" class="form-control"
                               value="{{$spt->tgl_spt}}">
                    </div>

                </div>
            </div>
            <div class="col-4">
                <div class="form-group" id="data_1"><label class="col-lg-12 control-label">Tanggal
                        Berangkat*</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="tgl_berangkat" id="tgl_berangkat" class="form-control"
                               value="{{$spt->tgl_berangkat}}">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group" id="data_1"><label class="col-lg-12 control-label">Tanggal
                        Kembali*</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="tgl_pulang" id="tgl_pulang" class="form-control"
                               value="{{$spt->tgl_pulang}}">
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
</div>
