<?php

namespace App\Http\Controllers;

use App\Models\Captor;
use Illuminate\Http\Request;

class CaptorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $captor = Captor::paginate();
        return $captor;
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
        $inputs = $request->except('_token');
        $captor = new Captor();
        foreach($inputs as $key => $value) 
        {
            $captor->$key = $value;
        }
        $captor->inventory_id = $count +1;
        $captor->save();
        return $captor;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Captor  $captor
     * @return \Illuminate\Http\Response
     */
    public function show(Captor $captor)
    {
        return $captor;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Captor  $captor
     * @return \Illuminate\Http\Response
     */
    public function edit(Captor $captor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Captor  $captor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Captor $captor)
    {
        $inputs = $request->except('_token', '_method');
        foreach($inputs as $key => $value)
        {
            $captor->$key = $value;
        }
        $captor->save();
        return $captor;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Captor  $captor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Captor $captor)
    {
        $captor->delete();
        return response()->json();
    }
}
