<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdStore;
use App\Http\Requests\AdUpdate;


class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = DB::table('ads')->orderBy('created_at', 'DESC')->paginate(5);
        return view('showAds', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdStore $request)
    {
        $validated = $request->validated();
        // $filename = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->store('public/images');
        $newPath = $request->file('photo')->store('/images');

        $ad = new Ad();
        $ad->id_user = auth()->user()->id;
        $ad->title = $validated['title'];
        $ad->description = $validated['description'];
        $ad->photo = $newPath;
        $ad->price = $validated['price'];
        $ad->localisation = $validated['localisation'];
        $ad->save();

        return view('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show()
    {
        $ads = DB::table('ads')->where('id_user', auth()->id())->orderBy('created_at', 'DESC')->paginate(5);
        return view('showMyAds', compact('ads'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ads = Ad::All();
        $editAds = $ads->find($id);

        return view('editAd', compact('editAds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, AdUpdate $request)
    {
        $validated = $request->validated();
    

        $path = $request->file('photo')->store('public/images');
        $newPath = $request->file('photo')->store('/images');

        $ad = new Ad();
        $ad->find($id)->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'photo' => $newPath,
        'price' => $validated['price'],
        'localisation' => $validated['localisation']
        ]);

        return view('edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ads = DB::table('ads')->where('id', $id)->delete();

        return view('delete');
    }

    public function searchName(Request $request)
    {
        $ads = DB::table('ads')->where('title', 'like', '%'.$request['name'].'%')->get();

        return view('researchResult', compact('ads'));
    }

    public function searchPrice(Request $request)
    {
        $ad = new Ad();
        $ads = Ad::All()->whereBetween('price', [$request['pricemin'], $request['pricemax']]);

        return view('researchResult', compact('ads'));
    }

    public function searchLocalisation(Request $request)
    {
        $ads = DB::table('ads')->where('localisation', 'like', '%'.$request['localisation'].'%')->get();

        return view('researchResult', compact('ads'));
    }
}