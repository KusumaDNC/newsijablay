<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Sekretariat\ArsipNomor;
use App\Models\Sekretariat\KategoriNomorModel;
use App\Models\Sekretariat\PenggunaanNomorModel;
use App\Models\Sekretariat\SettingNomorModel;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use App\Models\Sekretariat\RekModel;
use App\Models\PD\SptModel;
use App\Models\SPT\DasarHukumModel;
use App\PivotName;




class SuperController extends Controller
{
    public function index()
    {
        // Check permission
        $this->authorize('browse', Voyager::model('Setting'));
        $data = Voyager::model('Setting')->orderBy('order', 'ASC')->get();
        $settings = [];
        $settings[__('voyager::settings.group_general')] = [];
        foreach ($data as $d) {
            if ($d->group == '' || $d->group == __('voyager::settings.group_general')) {
                $settings[__('voyager::settings.group_general')][] = $d;
            } else {
                $settings[$d->group][] = $d;
            }
        }
        if (count($settings[__('voyager::settings.group_general')]) == 0) {
            unset($settings[__('voyager::settings.group_general')]);
        }

        $groups_data = Voyager::model('Setting')->select('group')->distinct()->get();
        $groups = [];
        foreach ($groups_data as $group) {
            if ($group->group != '') {
                $groups[] = $group->group;
            }
        }
        $active = (request()->session()->has('setting_tab')) ? request()->session()->get('setting_tab') : old('setting_tab', key($settings));


        $kategoris = KategoriNomorModel::all();
        $settingsnm = SettingNomorModel::all();
        $nomors = PenggunaanNomorModel::orderByDesc('updated_at')->get();
        $todayss = date('Y-m-d');
        $kodes_null = ArsipNomor::where('is_able', 0)->get();
        $kodes = ArsipNomor::where('is_able', 1)->get(); 


        // return Voyager::view('voyager::settings.index', compact('settings', 'groups', 'active'));
        return view('vendor.voyager.penggunaan-nomors.browse', compact('settings', 'groups', 'active', 'kategoris', 'settingsnm', 'nomors', 'todayss', 'kodes_null', 'kodes'));

    }


    public function addnmrs(Request $request){
        $this->authorize('browse', Voyager::model('Setting'));

        $tanggal_nomor = Carbon::parse($request->tanggal)->format('Y-m-d').' '.$request->time;
        //dd(Carbon::today()->gt(Carbon::parse($tanggal_nomor)));
        //dd( Carbon::parse($request->tanggal)->format('Y-m-d'));
        $total_nomor = PenggunaanNomorModel::latest()->first(); //bug
        //dd($total_nomor->count);
        $nomor_terakhir = PenggunaanNomorModel::findOrFail($total_nomor); //bug on 0

        if (Carbon::today()->gt(Carbon::parse($tanggal_nomor))){
            $nomor_spare = PenggunaanNomorModel::orderBy('created_at')->where('used', 0)->whereDate('tanggal', Carbon::parse($request->tanggal)->format('Y-m-d'))->first();
            //dd($nomor_spare);
            //dd(isset($nomor_spare));
            if (isset($nomor_spare)){
                $nomor_spare->user_id = $request->user_id;
                // $nomor_spare->kategori_nomor_id = $request->kategori;
                $nomor_spare->arsip_id = $request->kode;
                $nomor_spare->perihal = $request->perihal;
                $nomor_spare->used = 1;
                //dd($nomor_spare);
                $nomor_spare->update();

                return redirect()->back()->with('success', 'NOMOR ANDA ADALAH' .' '. $nomor_spare->count);
            }
            else{
                return redirect()->back()->with('success', 'BELUM ADA NOMOR DI TANGGAL'.' '.Carbon::parse($request->tanggal)->toFormattedDateString());
            }


        }
        else{
            //dd($nomor_terakhir);
            $nomor = new PenggunaanNomorModel();
            $nomor->user_id = $request->user_id;
            $nomor->kategori_nomor_id = $request->kategori;
            $nomor->arsip_id = $request->kode;
            $nomor->perihal = $request->perihal;
            $nomor->tanggal = $tanggal_nomor;
            $nomor->count = ($total_nomor->count) + 1;
            $nomor->used = 1;

            // dd($nomor);
            $nomor->save();
        }



        return redirect()->back()->with('success', 'berhasil menambahkan nomor surat');
    }



    //spt
    // public function sptindx()
    // {
    //     $today = date('Y-m-d');
    //     $nama = DB::table('data_asn_models')->get();
    //     $rek = RekModel::all(['jns_rek', 'id']);
    //     return view('spt.base.base-spt', compact('today','nama', 'rek'));
    // }




    public function gabung(){
        $today = date('Y-m-d');
        $nama = DB::table('data_asn_models')->get();
        foreach ($nama as $n){
            //dd($n);
        }
        $rek = RekModel::all(['jns_rek', 'id']);
        $user_name = Auth::user()->name;
        $user = Auth::user()->id;
        $spt = SptModel::all()->where('user_id', '=', $user)->sortByDesc('created_at');
        //dd(count($spt));

        $spt_terhapus = SptModel::onlyTrashed()->where('user_id', '=', $user)->get();
        //dd($spt_terhapus);
        $dasar_hukums=DasarHukumModel::all();

        if (count($spt) == 0){
            $sptnol = 'Belum Ada SPT';

        }
        else {
            foreach ($spt as $s) {
                $namas = $s->data_asn_models_id;
                //dd($s->tgl_berangkat);
                $b_spt = Carbon::parse($s->tgl_spt)->formatLocalized('%A, %d %B %Y');
                $b_mgk = Carbon::parse($s->tgl_berangkat)->formatLocalized('%A, %d %B %Y');
                $b_mlh = Carbon::parse($s->tgl_pulang)->formatLocalized('%A, %d %B %Y');
                $get_nama = DataAsnModel::find($s->data_asn_models_id);

                //dd($s->tujuan);

                //dd(count($s->tujuan));
            }

        }
           //dd($b_mgk);

            $na = PivotName::all();

    //dd($na);

        return view('vendor.voyager.spt.browse', compact('today','spt_terhapus', 'nama', 'rek' ,'user_name', 'spt', 'user',  'na','dasar_hukums'));

    }















    // public function store(Request $request)
    // {
    //     // Check permission
    //     $this->authorize('add', Voyager::model('Setting'));

    //     $key = implode('.', [Str::slug($request->input('group')), $request->input('key')]);
    //     $key_check = Voyager::model('Setting')->where('key', $key)->get()->count();

    //     if ($key_check > 0) {
    //         return back()->with([
    //             'message'    => __('voyager::settings.key_already_exists', ['key' => $key]),
    //             'alert-type' => 'error',
    //         ]);
    //     }

    //     $lastSetting = Voyager::model('Setting')->orderBy('order', 'DESC')->first();

    //     if (is_null($lastSetting)) {
    //         $order = 0;
    //     } else {
    //         $order = intval($lastSetting->order) + 1;
    //     }

    //     $request->merge(['order' => $order]);
    //     $request->merge(['value' => '']);
    //     $request->merge(['key' => $key]);

    //     Voyager::model('Setting')->create($request->except('setting_tab'));

    //     request()->flashOnly('setting_tab');

    //     return back()->with([
    //         'message'    => __('voyager::settings.successfully_created'),
    //         'alert-type' => 'success',
    //     ]);
    // }

    // public function update(Request $request)
    // {
    //     // Check permission
    //     $this->authorize('edit', Voyager::model('Setting'));

    //     $settings = Voyager::model('Setting')->all();

    //     foreach ($settings as $setting) {
    //         $content = $this->getContentBasedOnType($request, 'settings', (object) [
    //             'type'    => $setting->type,
    //             'field'   => str_replace('.', '_', $setting->key),
    //             'group'   => $setting->group,
    //         ], $setting->details);

    //         if ($setting->type == 'image' && $content == null) {
    //             continue;
    //         }

    //         if ($setting->type == 'file' && $content == null) {
    //             continue;
    //         }

    //         $key = preg_replace('/^'.Str::slug($setting->group).'./i', '', $setting->key);

    //         $setting->group = $request->input(str_replace('.', '_', $setting->key).'_group');
    //         $setting->key = implode('.', [Str::slug($setting->group), $key]);
    //         $setting->value = $content;
    //         $setting->save();
    //     }

    //     request()->flashOnly('setting_tab');

    //     return back()->with([
    //         'message'    => __('voyager::settings.successfully_saved'),
    //         'alert-type' => 'success',
    //     ]);
    // }

    // public function delete($id)
    // {
    //     // Check permission
    //     $this->authorize('delete', Voyager::model('Setting'));

    //     $setting = Voyager::model('Setting')->find($id);

    //     Voyager::model('Setting')->destroy($id);

    //     request()->session()->flash('setting_tab', $setting->group);

    //     return back()->with([
    //         'message'    => __('voyager::settings.successfully_deleted'),
    //         'alert-type' => 'success',
    //     ]);
    // }

    // public function move_up($id)
    // {
    //     // Check permission
    //     $this->authorize('edit', Voyager::model('Setting'));

    //     $setting = Voyager::model('Setting')->find($id);

    //     // Check permission
    //     $this->authorize('browse', $setting);

    //     $swapOrder = $setting->order;
    //     $previousSetting = Voyager::model('Setting')
    //                         ->where('order', '<', $swapOrder)
    //                         ->where('group', $setting->group)
    //                         ->orderBy('order', 'DESC')->first();
    //     $data = [
    //         'message'    => __('voyager::settings.already_at_top'),
    //         'alert-type' => 'error',
    //     ];

    //     if (isset($previousSetting->order)) {
    //         $setting->order = $previousSetting->order;
    //         $setting->save();
    //         $previousSetting->order = $swapOrder;
    //         $previousSetting->save();

    //         $data = [
    //             'message'    => __('voyager::settings.moved_order_up', ['name' => $setting->display_name]),
    //             'alert-type' => 'success',
    //         ];
    //     }

    //     request()->session()->flash('setting_tab', $setting->group);

    //     return back()->with($data);
    // }

    // public function delete_value($id)
    // {
    //     $setting = Voyager::model('Setting')->find($id);

    //     // Check permission
    //     $this->authorize('delete', $setting);

    //     if (isset($setting->id)) {
    //         // If the type is an image... Then delete it
    //         if ($setting->type == 'image') {
    //             if (Storage::disk(config('voyager.storage.disk'))->exists($setting->value)) {
    //                 Storage::disk(config('voyager.storage.disk'))->delete($setting->value);
    //             }
    //         }
    //         $setting->value = '';
    //         $setting->save();
    //     }

    //     request()->session()->flash('setting_tab', $setting->group);

    //     return back()->with([
    //         'message'    => __('voyager::settings.successfully_removed', ['name' => $setting->display_name]),
    //         'alert-type' => 'success',
    //     ]);
    // }

    // public function move_down($id)
    // {
    //     // Check permission
    //     $this->authorize('edit', Voyager::model('Setting'));

    //     $setting = Voyager::model('Setting')->find($id);

    //     // Check permission
    //     $this->authorize('browse', $setting);

    //     $swapOrder = $setting->order;

    //     $previousSetting = Voyager::model('Setting')
    //                         ->where('order', '>', $swapOrder)
    //                         ->where('group', $setting->group)
    //                         ->orderBy('order', 'ASC')->first();
    //     $data = [
    //         'message'    => __('voyager::settings.already_at_bottom'),
    //         'alert-type' => 'error',
    //     ];

    //     if (isset($previousSetting->order)) {
    //         $setting->order = $previousSetting->order;
    //         $setting->save();
    //         $previousSetting->order = $swapOrder;
    //         $previousSetting->save();

    //         $data = [
    //             'message'    => __('voyager::settings.moved_order_down', ['name' => $setting->display_name]),
    //             'alert-type' => 'success',
    //         ];
    //     }

    //     request()->session()->flash('setting_tab', $setting->group);

    //     return back()->with($data);
    // }
}
