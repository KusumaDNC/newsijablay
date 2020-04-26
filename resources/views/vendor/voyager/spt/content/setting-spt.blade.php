
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
            <h5>Dasar Data SPT  <strong>{{strtoupper(Auth::user()->username)}}</strong></h5>
            </div>
    <form class="form-horizontal" action="{{route('add.dasar')}}" method="post">
        @csrf
     <div class="ibox-content">
         <div class ="row">
            <div class="col-10">
                <div class="form-group"><label>Input Dasar Surat Perintah Tugas</label>
            <input placeholder="Dasar SPT" name="dasar_hukum" id="dasar_hukum" class="form-control" required>
                        </div>
                    </div>
         </div>
         <div class="ibox float-e-margins">
             <div class="ibox-content">
                 <div class="form-group">
                <button class="btn btn-app btn-success" type="submit">Tambah</button>
                 </div>
             </div>
          </div>
     </div>
     </form>
   </div>
  </div>

</div>


@isset($dasar_hukums)
     {{--{{dd($dasar_hukums)}}--}}
        <div class="row">
            <table class="footable table table-stripped toggle-arrow-tiny">
                <thead>
                <tr class="active">
                    <th>No</th>
                    <th>Dasar Surat Perintah Tugas</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                </tr>
                </thead>
                <tbody>

           @foreach($dasar_hukums as $dasar_hukum)
               {{--{{dd($dasar_hukum)}}--}}
                    <tr>
                        <td style="text-align: center">{{$loop->iteration}}</td>
                        <td style="text-align: center">{{$dasar_hukum->dasar_hukum}}</td>

                        <td>
                            <form action="{{route('edit.dasar', $dasar_hukum->id)}}" style="margin: 0">
                                <button class="btn btn-block btn-outline-success" id="edit-kategori">Edit</button>
                            </form>
                        </td>
                        <td>

                            <div id="openModal-about" class="modalDialog">
                                <div>
                                    <form action="{{route('delete.dasar', $dasar_hukum->id)}}" method="post">
                                       @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>

                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" class="text-center">
                        <ul class="pagination">
                        </ul>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
@endisset


<form class="form-horizontal" action={{--"{{route('add.dasar')}}"--}} method="post">
    {{--@csrf--}}
    <div class="ibox-content">
        <div class ="row">
            <div class="col-10">
                <div class="form-group"><label>Input Nomor DPA</label>
                    <input placeholder="" name="" id="" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="form-group">
                    <button class="btn btn-app btn-success" type="submit">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</form>

{{--@isset($dasar_hukums)--}}
    {{--{{dd($dasar_hukums)}}--}}
    <div class="row">
        <table class="footable table table-stripped toggle-arrow-tiny">
            <thead>
            <tr class="active">
                <th>No</th>
                <th>Daftar Nomor DPA</th>
                <th>Edit</th>
                <th>Hapus</th>
            </tr>
            </thead>
            <tbody>

           {{-- @foreach($dasar_hukums as $dasar_hukum)--}}
                {{--{{dd($dasar_hukum)}}--}}
                <tr>
                    <td style="text-align: center">{{--{{$loop->iteration}}--}}</td>
                    <td style="text-align: center">{{--{{$dasar_hukum->dasar_hukum}}--}}</td>

                    <td>
                        <form action="{{--{{route('edit.dasar', $dasar_hukum->id)}}--}}" style="margin: 0">
                            <button class="btn btn-block btn-outline-success" id="">Edit</button>
                        </form>
                    </td>
                    <td>

                        <div id="openModal-about" class="modalDialog">
                            <div>
                                <form action="{{--{{route('delete.dasar', $dasar_hukum->id)}}--}}" method="post">
                                   {{-- @csrf
                                    @method('DELETE')--}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>

          {{--  @endforeach--}}
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5" class="text-center">
                    <ul class="pagination">
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
{{--
@endisset--}}
