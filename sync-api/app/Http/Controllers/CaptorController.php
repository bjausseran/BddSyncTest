<?php

namespace App\Http\Controllers;

use App\Models\Captor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CaptorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dbcloud = "dbcloud";
        $dblocal = "dblocal";
        $captor = DB::connection($dblocal)->table("captor")->paginate();
        return $captor;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dbcloud = "dbcloud";
        $dblocal = "dblocal";

        $inputs = $request->except('_token');
        $captor = new Captor();
        foreach($inputs as $key => $value) 
        {
            $captor->$key = $value;
        }
        $captor->uid = decbin(ord(Str::orderedUuid()));
        DB::connection($dblocal)->table("captor")->insert($captor->toArray());
        DB::connection($dbcloud)->table("captor")->insert($captor->toArray());

        return $captor;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Captor  $captor
     * @return \Illuminate\Http\Response
     */
    public function show($captorid)
    {
        $dbcloud = "dbcloud";
        $dblocal = "dblocal";

        $captor = DB::connection($dblocal)->select('select * from captor where id = :id', ['id' => $captorid]);
        return $captor;

        //return $captor;
    }
    
    public function check($captorid)
    {
        $dbcloud = "dbcloud";
        $dblocal = "dblocal";

        $captorLocal = DB::connection($dblocal)->select('select * from captor where id = :id', ['id' => $captorid]);
        $captorCloud = DB::connection($dbcloud)->select('select * from captor where id = :id', ['id' => $captorid]);

        $isSame['is the same ?'] = $captorCloud[0]->name === $captorLocal[0]->name&& 
        $captorCloud[0]->client_id === $captorLocal[0]->client_id && 
        $captorCloud[0]->value_int === $captorLocal[0]->value_int && 
        $captorCloud[0]->value_bool === $captorLocal[0]->value_bool;

        $isSame['Local captor'] = $captorLocal[0];
        $isSame['Cloud captor'] = $captorCloud[0];

        return $isSame;

        //return $captor;
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
