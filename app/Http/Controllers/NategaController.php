<?php

namespace App\Http\Controllers;

use DB;
use Excel;
use Input;
use App\Natega;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class NategaController extends Controller
{
    public function Natega()
    {
        return view('natega.mangeNatega');
    }

    public function downloadExcel($type)
    {
        $data = Natega::get()->toArray();
        return Excel::create('Natega', function($excel) use ($data) {
            $excel->sheet('Natega Sheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function importExcel()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $row) {
                   $insert[] = [
                   "studentNum"=> $row->studentnum,
                   "studentName"=> $row->studentname,
                   "Arabic"=> $row->arabic,
                   "English"=> $row->english,
                   "French"=> $row->french,
                   "Spanish"=> $row->spanish,
                   "math"=> $row->math,
                   "Geometry"=> $row->geometry,
                   "Science"=> $row->science,
                   "Computers"=> $row->computers,
                   ];
               }
                // return $insert;
               if(!empty($insert)){
                DB::table('nategas')->insert($insert);
                $notification = [
                'type' => 'success',
                'message' => 'Natega Is Publish successfully!',
                'title' => 'Published'
                ];
                return Redirect::to('/home')->with([
                    'type' => $notification['type'],
                    'message' => $notification['message'],
                    'title' => $notification['title']
                    ]);
            }
        }
    }
    return back();
}
}
