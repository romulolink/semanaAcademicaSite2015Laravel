<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Palestras;

class PalestraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "Hello to Palestra";
    }


    public function mostrar(){

        $palestras = Palestras::all();
       
        return view('palestra/index', ['palestras' => $palestras]);
        
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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



    public function isLikedByMe($id)
    {
        $palestra = Palestra::findOrFail($id)->first();
        if (Like::whereUserId(Auth::id())->where('palestra_id', $palestra->id)->exists()){
            return 'true';
        }
        return 'false';
    }

    public function like()
    {
        // Get the palestra
        $palestra = Palestra::findOrFail($id)->first();
        // If the user already like this palestra, we delete the like
        $existing_like = Like::where('palestra_id', $palestra->id)->where('user_id', Auth::id())->first();
        if (!is_null($existing_like)) {
            $existing_like->delete();
        }
        else { // The user don't like this palestra yet

            // We check if the user already liked this palestra once, but unliked it.
            $existing_like = Like::onlyTrashed()->where('palestra_id', $palestra->id)->where('UserId', Auth::id())->first();

            if (!is_null($existing_like)) { // The user has liked the palestra before, but deleted his like later
                // Then, we restore this like
                $existing_like->restore();
            }
            else { // The user never liked this palestra before, so we create the like, and we can trigger some events (notifications, etc)
                $like = new Like;
                $like->look_id = $look->id;
                $like->user_id = Auth::id();
                $like->save();
            }
        }
    }
}
