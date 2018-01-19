<?php

namespace App\Http\Controllers;

use App\Fielder;
use Illuminate\Http\Request;
use App\Http\Requests\FielderRequest;

class FieldersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FielderRequest $request)
    {
        $fielders=Fielder::oldest("name")->paginate(5);

        if ($request->wantsJson()) {

           return $fielders;
        }
       
       return view("fielders.index",compact("fielders"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Fielder $fielder)
    {
        return view("fielders.create",compact("fielder"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FielderRequest $request)
    {
        Fielder::Create($request->all());
        flash('Dsr Registration successfull');
        return redirect()->route("fielders.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fielder  $fielder
     * @return \Illuminate\Http\Response
     */
    public function show(Fielder $fielder)
    {

        $transactions=$fielder->compileTransactions();

       return view("fielders.show",compact("fielder","transactions"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fielder  $fielder
     * @return \Illuminate\Http\Response
     */
    public function edit(Fielder $fielder)
    {
    
        return view("fielders.edit",compact("fielder"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fielder  $fielder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fielder $fielder)
    {
        $fielder->update($request->all());
        
        flash("Dsr's profile updated successfully");

        return redirect()->route("fielders.show",$fielder);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fielder  $fielder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fielder $fielder)
    {
        //
    }

    public function search(Request $request)
    {
        if ($request->has("q")) {

            $fielders=Fielder::search($request->q)->oldest("name")->get();
            
            return $fielders;
        }
        

    }

    public function avatar(Fielder $fielder)
    {
        return view("fielders.avatars.create",compact("fielder"));
    }

    public function uploadAvatar(Request $request , Fielder $fielder)
    {
        $this->validate($request,["avatar"=>"required|image"]);

        $fielder->imagePath->load($request->avatar)->makeThumbnail(70,70);

        flash("Upload was successfull");

        return redirect()->route("fielders.show",$fielder);
    }
}
