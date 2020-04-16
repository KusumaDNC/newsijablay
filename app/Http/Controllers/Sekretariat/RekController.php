<?php

namespace App\Http\Controllers\Sekretariat;

use App\Models\Sekretariat\RekModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rek()
    {
        $user = Auth::user()->id;
        $rek = RekModel::all();

        return view('sekretariat.base.rek', compact('rek', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function rekPost(Request $request)
    {
        $user = Auth::user()->id;
        $this->validate($request, [
            'jns_rek' => 'required',
            'no_rek' => 'required',
        ]);

        $post = new RekModel();
        $post->jns_rek = $request->input('jns_rek');
        $post->no_rek = $request->input('no_rek');
        $post->save();

        return redirect()->back()->with('success', 'Masyuuuuk', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
