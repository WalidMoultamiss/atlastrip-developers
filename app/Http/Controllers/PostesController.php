<?php

namespace App\Http\Controllers;

use App\Models\Postes;
use Illuminate\Http\Request;

class PostesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Postes::all();
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
            'title'=> 'required',
            'description'=>'required',
            'creator'=>'required'
        ]);
        return Postes::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Postes::find($id);
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
        $postes = Postes::find($id);
        $postes->update($request->all());
        return $postes;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Postes::destroy($id);
    }

    /**
     * Search for a Post
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($title)
    {
        $result = isset($title) ? Postes::where('title','like','%'.$title.'%')->get() : ['error','what are you doing'];
        return $result;
    }
}
