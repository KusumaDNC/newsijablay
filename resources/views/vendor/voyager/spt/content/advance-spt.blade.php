<div class="ibox float-e-margins">

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!! $message !!}</strong>
        </div>
    @endif
    <div class="ibox-content">
        <div class="col-lg-12">
            <div class="ibox collapsed">
                <div class="ibox-title">
                    <h5>Setting Umum Perjalanan Dinas Bidang
                        <strong><i><u>{{strtoupper(Auth::user()->username)}}</u></i></strong></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
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
                </div>
            </div>


        </div>
    </div>

    <div class="space-30">

    </div>

</div>

@if($spt == null)
    <h1 style="color: dimgrey;text-align: center; background-color: white">Silahkan Buat SPT terlebih dahulu</h1>
    @else
        <div class="ibox float-e-margins">

    <div class="ibox-content">
        <div class="ibox-title">
            <h3>Setting Khusus</h3>
        </div>
        <div class="spcae-15">
        </div>
        <div class="hr-line-dashed"></div>
        <h4>Transportasi</h4>
        <div class="hr-line-dashed"></div>
        <form class="form-horizontal" action="{{route('adv.postSpt')}}" method="post">
            @csrf
            @foreach($spt->pivot as $n)

                <div class="row">
                    <div class="col-8" id="input-player-list">
                        <div class="form-group">
                            <label>
                                Nama Pelaksana {{$loop->iteration}}
                            </label>
                            <input value="{{$n->namad->nama}}" name="nama_{{$loop->iteration}}"
                                   class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group"><label>Transportasi</label>
                            <input value="{{$spt->kendaraan}}"
                                   name="kendaraan_{{$loop->iteration}}" class="form-control"
                                   required>
                        </div>
                    </div>
                </div>

            @endforeach

            <div class="space-15">
            </div>
            <div class="hr-line-dashed"></div>
            <h4>Berangkat dari</h4>
            <div class="hr-line-dashed"></div>
            @foreach($spt->pivot as $n)
                <div class="row">

                    <div class="col-4" id="input-player-list">
                        <div class="form-group">
                            <label>
                                Nama Pelaksana
                            </label>
                            <input value="{{$n->namad->nama}}" name="nama_{{$loop->iteration}}" class="form-control"
                                   disabled>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group"><label>Berangkat dari</label>
                            <input value="Semarang" name="awal_{{$loop->iteration}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group" id="data_1"><label class="col-lg-12 control-label">Tanggal
                                Berangkat*</label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="tgl_berangkat_{{$loop->iteration}}" class="form-control"
                                       value="{{$today}}">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


            <div class="space-15">
            </div>
            <div class="hr-line-dashed"></div>
            <h4>Alur Perjalanan Dinas</h4>
            <div class="hr-line-dashed"></div>

            <div class="row">
                <div class="col-lg-6">
                    <h3 style="text-align: center;color: red"><strong>Tiba</strong></h3>
                </div>
                <div class="col-lg-6">
                    <h3 style="text-align: center;color: red"><strong>Berangkat</strong></h3>
                </div>
            </div>
            <div class="hr-line-dashed"></div>

            @foreach($spt->tujuan as $da)
                @for($i = 1; $i <= count($da); $i++)
                    @foreach($spt->pivot as $n)
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-4" id="input-player-list">
                                                <div class="form-group">
                                                    <label>
                                                        Nama Pelaksana {{$loop->iteration}}
                                                    </label>

                                                    <input value="{{$n->namad->nama}}"
                                                           name="nama_tb_{{$loop->iteration}}_{{$i}}"
                                                           class="form-control" readonly>

                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group" id="pd">
                                                    <label class="col-lg-12 control-label"><h4><strong>Kota <i
                                                                    style="color: red"></i></strong></h4></label>
                                                    <select class="select2_demo_3 form-control"
                                                            name="tujuan_tb_{{$loop->iteration}}_{{$i}}" required>

                                                        @foreach($da as $d)
                                                            <option value="{{$d}}">{{$d}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group" id="data_1"><label
                                                        class="col-lg-12 control-label">Tgl
                                                        Tiba*</label>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-calendar"></i></span>
                                                        <input type="text" name="tgl_tb_{{$loop->iteration}}_{{$i}}"
                                                               class="form-control"
                                                               value="{{$today}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-4" id="input-player-list">
                                                <div class="form-group">
                                                    <label>
                                                        Nama Pelaksana
                                                    </label>

                                                    <input value="{{$n->namad->nama}}"
                                                           name="nama_brkt_{{$loop->iteration}}_{{$i}}"
                                                           class="form-control" readonly>

                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group" id="pd">
                                                    <label class="col-lg-12 control-label"><h4><strong>Kota <i
                                                                    style="color: red"></i></strong></h4></label>
                                                    <select class="select2_demo_3 form-control"
                                                            name="kota__brkt_{{$loop->iteration}}_{{$i}}" required>

                                                        @foreach($da as $d)
                                                            <option value="{{$d}}">{{$d}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group" id="data_1"><label
                                                        class="col-lg-12 control-label">Tgl
                                                        Brgkt*</label>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-calendar"></i></span>
                                                        <input type="text" name="tgl_brkt_{{$loop->iteration}}_{{$i}}"
                                                               class="form-control"
                                                               value="{{$today}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="hr-line-dashed"></div>
                @endfor
            @endforeach
            <div class="space-30"></div>
            <div class="form-group">
                <div class="col-lg-offset-12 col-lg-12">
                    <button class="btn btn-sm btn-outline-success btn-block" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endif
