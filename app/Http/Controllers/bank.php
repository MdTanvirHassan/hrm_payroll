<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banks;
use DB;

class Bank extends Controller
{
    public function index()
    {
        $bank = banks::get();
        return view('settings.banks.bank_list', compact('bank'));
    }

    public function add_bank()
    {
        return view('settings.banks.add_bank');
    }

    public function store(Request $request)
    {
        $data = array();
        $data['name'] = $request['name'];
        $data['branch_name'] = $request['branch_name'];
        $data['bank_type'] = $request['bank_type'];
        $data['company_account'] = $request['company_account'];
        $data['company_id'] = $request['company_id'];
        $data['routing_number'] = $request['routing_number'];
        banks::insert($data);
        return redirect()->route('bank_list')->with('message','Added successfully!');
        //return back();
    }

    public function edit_bank(Request $request, $id)
    {
        $bank_info = banks::findOrFail($id);
        return view('settings.banks.edit_bank', compact('bank_info'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $bank = banks::findOrFail($id);
        // print_r($bank);
        // exit;

        $bank->name = $request->name;
        $bank->branch_name = $request->branch_name;
        $bank->bank_type = $request->bank_type;
        $bank->company_account = $request->company_account;
        $bank->company_id = $request->company_id;
        $bank->routing_number = $request->routing_number;
       

        $bank->save();
        return redirect()->route('bank_list')->with('message','Updated successfully!');
    }


    public function view_bank(Request $request, $id)
    {
        $bank_info = banks::findOrFail($id);
        return view('settings.banks.view_bank', compact('bank_info'));
    }


    public function destroy($id)
    {
        banks::destroy($id);
        return redirect()->route('bank_list')->with('message','Deleted successfully!');
    }
}
