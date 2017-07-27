<?php

namespace App\Http\Controllers;

use Excel;
use App\Line;
use App\Waypoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lines = Line::latest()->get();
        return view('lines.index', compact('lines'));
    }

    public function downloadExcel($type)
    {
        $data = Line::get()->toArray();
        return Excel::create('Line', function($excel) use ($data) {
            $excel->sheet('Line Sheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('lines.create');
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
            'name' => 'required|max:191',
            'origin-input' => 'required|max:191',
            'destination-input' => 'required|max:191'
        ]);

        Line::create([
            'name' => $request->name,
            'latFromRoute' => $request->latFromRoute,
            'lngFromRoute' => $request->lngFromRoute,
            'latToRoute' => $request->latToRoute,
            'lngToRoute' => $request->lngToRoute,
            'addressFrom' => $request->addressFrom,
            'addressTo' => $request->addressTo,
            'notes' => $request->notes
        ]);

        $notification = [
            'type' => 'success',
            'message' => 'Line is added successfully!',
            'title' => 'Created'
        ];

        return Redirect::to('/lines')->with([
            'type' => $notification['type'],
            'title' => $notification['title'],
            'message' => $notification['message']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Line  $line
     * @return \Illuminate\Http\Response
     */
    public function show(Line $line)
    {
        // load buses
        // return $line->load('waypoints');
        return view('lines.show', compact('line'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Line  $line
     * @return \Illuminate\Http\Response
     */
    public function edit(Line $line)
    {
        //
        return view('lines.edit', compact('line'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Line  $line
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Line $line)
    {
        // return $request->all();
        //
         $this->validate($request, [
            'name' => 'required|max:191',
            'addressFrom' => 'required|max:191',
            'addressTo' => 'required|max:191'
        ]);

        $line->update([
            'name' => $request->name,
            'latFromRoute' => $request->latFromRoute,
            'lngFromRoute' => $request->lngFromRoute,
            'latToRoute' => $request->latToRoute,
            'lngToRoute' => $request->lngToRoute,
            'addressFrom' => $request->addressFrom,
            'addressTo' => $request->addressTo,
            'notes' => $request->notes
        ]);

        if (isset($request->addresses)) 
        {
            $i = 0;
            foreach ($request->addresses as $address) 
            {
                Waypoint::create([
                    'line_id' => $line->id,
                    'address' => $address,
                    'latitude' => $request->stationlats[$i],
                    'longitude' => $request->stationlngs[$i],
                    'stationNum' => $i
                ]);

                $i ++;
            }
        }


        $notification = [
            'type' => 'success',
            'message' => 'Line is updated successfully!',
            'title' => 'Updated'
        ];

        return Redirect::to('lines/'.$line->id)->with([
            'type' => $notification['type'],
            'title' => $notification['title'],
            'message' => $notification['message']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Line  $line
     * @return \Illuminate\Http\Response
     */
    public function destroy(Line $line)
    {
        //
        $line->delete();

        $notification = [
            'type' => 'error',
            'message' => 'Line has been deleted!',
            'title' => 'Deleted'
        ];

        return Redirect::to('/lines')->with([
            'type' => $notification['type'],
            'title' => $notification['title'],
            'message' => $notification['message']
        ]);
    }
}
