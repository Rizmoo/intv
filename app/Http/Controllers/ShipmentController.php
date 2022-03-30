<?php

namespace App\Http\Controllers;


use App\Enums\ShipmentStates;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Str;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Shipment::where('from', Auth::user()->location)->with('fleet')->get()->toArray();
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
            $item = new Shipment([
                'fleet_id' => $request->input('fleet_id'),
                'shipment_id' => 'FRM_'.\Illuminate\Support\Str::random(7),
                'from' => $request->input('from'),
                'to' => $request->input('to'),
                'departure_time' => $request->input('departure_time'),
                'state' => ShipmentStates::PENDING
            ]);
            $item->save();
            return response()->json('Shipment created!');
        }catch (Exception $exception)
        {
            return response()->json('Shipment Creation Failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function show(Shipment $shipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipment $shipment)
    {
        $shipment->update($request->all());
        return response()->json('Shipment updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return response()->json('Vehicle deleted!');
    }

    public function active()
    {

        return Shipment::where('from', Auth::user()->location)
            ->where('state', 'pending')
            ->with('fleet')->get()->toArray();
    }
}
