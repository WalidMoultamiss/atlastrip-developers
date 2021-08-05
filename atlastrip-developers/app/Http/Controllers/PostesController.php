<?php

namespace App\Http\Controllers;

use App\Models\Postes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return DB::table("postes, users")
        // ->where("postes.user_id", "=", "users.id")
        // ->get();

        return DB::table("postes")
        ->rightJoin('users', 'postes.user_id', '=', 'users.id')
        ->select("users.name","postes.*")
        ->get();
        // DB::table("postes, users")
        // ->select("users.name", "postes.*")
        // ->where("postes.user_id", "=", "users.id")
        // ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->user()->id);
        $request->validate([
            'title'=> 'required',
            'description'=>'required',
        ]);
        return Postes::create(
            [
            'title' => $request->title,
            'description' =>  $request->description,
            'user_id' =>  $request->user()->id
            ]
        );
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
    public function destroy(Request $request, $id)
    {
        if($request->user()->role == 'admin'){
            return Postes::destroy($id);
        }else{
            return print_r(json_encode(array(
                'error' => "Token is invalid"
            )));
        }
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
