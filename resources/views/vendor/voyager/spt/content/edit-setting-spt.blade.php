<div class="ibox float-e-margins">
    <div class="ibox-content">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
    </div>

    <div class="ibox-title">
        <h5>FORM EDIT SPT</h5>
    </div>

    <form class="form-horizontal" action="{{route('update.dasar', $edit_dasar_hukum->id)}}" method="post">
        @csrf
        @method('PATCH')
        <div class="ibox-content">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group"><label>Edit Dasar Surat Perintah Tugas *</label>
                            <input placeholder="Dasar Hukum" name="dasar_hukum" value="{{$edit_dasar_hukum->dasar_hukum}}" id="dasar_hukum" class="form-control"> {{--<span class="help-block m-b-none">Example block-level help text here.</span>--}}
                        </div>
                    </div>

                </div>
                <div class="space-15"></div>
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="form-group">
                            <button class="btn btn-app btn-success" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>
