<?php

namespace App\Http\Controllers;

use App\Models\Shortlink;
use App\Models\User;
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
        $this->authorize('viewAny', Shortlink::class);
        $shortlinks = Shortlink::where('user_id', auth()->user()->id)->get();
        return view('shortlink.index', compact('shortlinks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $this->authorize('create', Shortlink::class);
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

        $this->authorize('create', Shortlink::class);
        $request->validate([
            'url' => 'required|active_url'
        ]);

        Shortlink::create([
            'url' => $request->input('url'),
            'user_id' => auth()->user()->id
        ]);

        $shortlinks = Shortlink::where('user_id', auth()->user()->id)->get();
        return redirect()->route('shortlink.index');
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

        $this->authorize('update', $shortlink);

        $shortlink->url = $request->url;
        $shortlink->save();
        return redirect()->route('shortlink.index');
    }

    /**
     * Disable the specified resource from storage
     *
     * @param  \App\Models\Shortlink  $shortlink
     * @return \Illuminate\Http\Response
     */
    public function delete(Shortlink $shortlink)
    {


        $this->authorize('delete', $shortlink);
        $shortlink->delete();

        return redirect()->route('shortlink.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shortlink  $shortlink
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shortlink = Shortlink::withTrashed()->where('id', $id)->first();
        $this->authorize('forceDelete', $shortlink);
        $shortlink->forceDelete();
        return view('shortlink.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {


        $shortlink = Shortlink::onlyTrashed()->where('id', $id)->first();
        $this->authorize('restore', $shortlink);
        $shortlink->restore();
        return view('shortlink.index');
    }



    /**
     * redirect
     *
     * @param  mixed $id
     * @return void
     */
    public function redirect($id)
    {


        $shortlink = Shortlink::where('id', $id)->first();
        return redirect()->to($shortlink->url);
    }
}