<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Line;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $buses = Bus::all();

        return view('buses.index', compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lines = Line::all();
        return view('buses.create', compact('lines'));
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
        $this->validate($request, [
            'number' => 'required|max:191',
            'license' => 'required|max:191',
            'capacity' => 'required|min:1|numeric',
            'line' => 'required',
        ]);

        $line = Line::find($request->line);

        Bus::create([
            'number' => $request->number,
            'license' => $request->license,
            'capacity' => $request->capacity,
            'line_id' => $line->id
        ]);

        $notification = [
            'type' => 'success',
            'message' => 'Bus is added successfully!',
            'title' => 'Created'
        ];

        return Redirect::to('/buses')->with([
            'type' => $notification['type'],
            'title' => $notification['title'],
            'message' => $notification['message']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
        return view('buses.show', compact('bus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        //
        $lines = Line::all();
        return view('buses.edit', compact('bus', 'lines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        //
        $this->validate($request, [
            'number' => 'required|max:191',
            'license' => 'required|max:191',
            'capacity' => 'required|min:1|numeric',
            'line' => 'required',
        ]);

        $bus->update([
            'number' => $request->number,
            'license' => $request->license,
            'capacity' => $request->capacity,
            'line_id' => $line->id
        ]);

        $notification = [
            'type' => 'success',
            'message' => 'Bus is updated successfully!',
            'title' => 'Updated'
        ];

        return Redirect::to('/buses/'.$bus->id)->with([
            'type' => $notification['type'],
            'title' => $notification['title'],
            'message' => $notification['message']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        //
        $bus->delete();

        $notification = [
            'type' => 'error',
            'message' => 'Bus has been deleted!',
            'title' => 'Deleted'
        ];

        return Redirect::to('/buses')->with([
            'type' => $notification['type'],
            'title' => $notification['title'],
            'message' => $notification['message']
        ]);
    }
}
