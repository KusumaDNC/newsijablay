
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
                {{--        <th>NODIN</th>--}}
                        <th>SPT</th>
                        <th>SPPD</th>
                    </tr>
                    </thead>

                    <tbody>



                           <tr>
                               <td>{{$spt->nomor_spt}}</td>
                               @foreach($spt->tujuan as $tujuans)
                                   <td>
                                       @foreach($tujuans as $t)
                                           <li>
                                               {{$t}}
                                           </li>
                                       @endforeach
                                   </td>
                               @endforeach
                               <td>{{$spt->perihal}}</td>
                               <td>
                                   @foreach($spt->pivot as $j)
                                       <li>{{$j->namad->nama}}</li>
                                   @endforeach

                               </td>
                               <td>{{Carbon\Carbon::parse($spt->tgl_berangkat)->formatLocalized('%A, %d %B %Y')}}</td>
                               <td>{{Carbon\Carbon::parse($spt->tgl_pulang)->formatLocalized('%A, %d %B %Y')}}</td>
                               <td>{{$spt->kendaraan}}</td>
                          {{--     <td>
                                   <form action="#{{route('cetak.nodin', $spt->id)}}" method="get" disabled="">
                                        <button class="btn-trans" ><i class="fa fa-download text-navy"></i></button>
                                    </form>
                                </td>--}}
                                <td>
                                    <form action="{{route('cetak.spt', $spt->id)}}" method="get">
                                        <button class="btn-trans" ><i class="fa fa-download text-navy"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('cetak-adv.sppd', $spt->id)}}" method="get">
                                        <button class="btn-trans" ><i class="fa fa-download text-navy"></i></button>
                                    </form>
                                </td>

                            </tr>




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

