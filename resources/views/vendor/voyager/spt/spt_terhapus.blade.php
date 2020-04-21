@if($spt_terhapus == null)
    <h1 style="color: dimgrey;text-align: center; background-color: white">Belum Ada SPT yang di HAPUS</h1>
@else
    <div class="row">
        <div class="col-lg-12">
            @if ($message = Session::get('warning'))
                <div class="alert alert-warning alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data SPT dan SPPD di Bidang <strong>{{strtoupper(Auth::user()->username)}}</strong></h5>
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
                    <table class="footable table table-stripped toggle-arrow-tiny">
                        <thead>
                        <tr>
                            <th data-toggle="true">Detail</th>
                            <th>Tujuan</th>
                            <th>Dalam Rangka</th>
                            <th data-hide="all">Nama</th>
                            <th data-hide="all">Tanggal Berangkat</th>
                            <th data-hide="all">Tanggal Kembali</th>
                            <th data-hide="all">Kendaraan</th>
                            {{--<th>NODIN</th>--}}
                            <th>SPT</th>
                            <th>SPPD</th>
                            <th>Hapus Permanen</th>
                        </tr>
                        </thead>

                        <tbody>

                        @if(count($spt_terhapus) == 0)
                            <tr>
                                <td>

                                </td>
                            </tr>

                        @else
                            @foreach($spt_terhapus as $s)

                                <tr>
                                    <td>{{$s->nomor_spt}}</td>
                                    @foreach($s->tujuan as $tujuans)
                                        <td>
                                            @foreach($tujuans as $t)
                                                <li>
                                                    {{$t}}
                                                </li>
                                            @endforeach
                                        </td>
                                    @endforeach
                                    <td>{{$s->perihal}}</td>
                                    <td>
                                        @foreach($s->pivot as $j)
                                            <li>{{$j->namad->nama}}</li>
                                        @endforeach

                                    </td>
                                    <td>{{Carbon\Carbon::parse($s->tgl_berangkat)->formatLocalized('%A, %d %B %Y')}}</td>
                                    <td>{{Carbon\Carbon::parse($s->tgl_pulang)->formatLocalized('%A, %d %B %Y')}}</td>
                                    <td>{{$s->kendaraan}}</td>
                                    {{--<td>
                                        <form action="#--}}{{--{{route('cetak.nodin', $s->id)}}--}}{{--" method="get" disabled="">
                                            <button class="btn-trans" ><i class="fa fa-download text-navy"></i></button>
                                        </form>
                                    </td>--}}
                                    <td>
                                        <form action="{{route('cetak.spt', $s->id)}}" method="get">
                                            <button class="btn-trans" ><i class="fa fa-download text-navy"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{route('cetak.sppd', $s->id)}}" method="get">
                                            <button class="btn-trans" ><i class="fa fa-download text-navy"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{route('destroy.spt', $s->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-trans" type="submit"><i class="fa fa-eraser text-red"></i></button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        @endif


                        </tbody>
                        <tfoot>
                        <tr>

                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endif
