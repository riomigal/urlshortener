<?php

namespace App\Http\Controllers;

use App\Models\Shortlink;
use Illuminate\Http\Request;

class ShortlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shortlink.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'url' => 'required|active_url'
        ]);

        Shortlink::create([
            'url' => $request->input('url'),
            'user_id' => auth()->user()->id
        ]);

        $shortlinks = Shortlink::where('user_id', auth()->user()->id)->get();
        return view('shortlink.index', compact('shortlinks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shortlink  $shortlink
     * @return \Illuminate\Http\Response
     */
    public function show(Shortlink $shortlink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shortlink  $shortlink
     * @return \Illuminate\Http\Response
     */
    public function edit(Shortlink $shortlink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shortlink  $shortlink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shortlink $shortlink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shortlink  $shortlink
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shortlink $shortlink)
    {
        //
    }
}