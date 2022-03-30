<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class FleetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Fleet::where('location', Auth::user()->location)->get()->toArray();
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
        try {
            $product = new Fleet([
                'vehicle_reg' => $request->input('vehicle_reg'),
                'location' => $request->input('location')
            ]);
            $product->save();
            return response()->json('Vehicle created!');
        }catch (Exception $exception)
        {
            return response()->json('Creating record Failed');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fleet  $fleet
     */
    public function show(Fleet $fleet)
    {
        return $fleet;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fleet  $fleet
     * @return \Illuminate\Http\Response
     */
    public function edit(Fleet $fleet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fleet  $fleet
     */
    public function update(Request $request, Fleet $fleet)
    {
        $fleet->update($request->all());
        return response()->json('Vehicle updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fleet  $fleet
     */
    public function destroy(Fleet $fleet)
    {
        $fleet->delete();
        return response()->json('Vehicle deleted!');
    }
}
