<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shifts;
use DB;

class shift extends Controller
{
    public function index()
    {
        $shift = shifts::get();
        return view('settings.shifts.shift_list', compact('shift'));
    }

    public function add_shift()
    {
        return view('settings.shifts.add_shift');
    }

    public function store(Request $request)
    {
        $data = array();
        $data['shift'] = $request['shift'];
        $data['shiftCode'] = $request['shiftCode'];
        $data['startTime'] = $request['startTime'];
        $data['endTime'] = $request['endTime'];
        $data['weekend'] = $request['weekend'];
        $data['toShift'] = $request['toShift'];
        $data['intimeRange'] = $request['intimeRange'];
        $data['outtimeRange'] = $request['outtimeRange'];
        shifts::insert($data);
        return redirect()->route('shift_list')->with('message','Added successfully!');
        //return back();
    }

    public function edit_shift(Request $request, $id)
    {
        $shift_info = shifts::findOrFail($id);
        return view('settings.shifts.edit_shift', compact('shift_info'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $shift = shifts::findOrFail($id);
        // print_r($shift);
        // exit;

        $shift->shift = $request->shift;
        $shift->shiftCode = $request->shiftCode;
        $shift->startTime = $request->startTime;
        $shift->endTime	 = $request->endTime	;
        $shift->weekend = $request->weekend;
        $shift->toShift = $request->toShift;
        $shift->intimeRange = $request->intimeRange;
        $shift->outtimeRange = $request->outtimeRange;
    //    echo '<pre>';
    //    print_r($shift);
    //    exit;outtimeRange

        $shift->save();
        return redirect()->route('shift_list')->with('message','Updated successfully!');
    }


    public function view_shift(Request $request, $id)
    {
        $shift_info = shifts::findOrFail($id);
        return view('settings.shifts.view_shift', compact('shift_info'));
    }


    public function destroy($id)
    {
        shifts::destroy($id);
        return redirect()->route('shift_list')->with('message','Deleted successfully!');
    }
}
