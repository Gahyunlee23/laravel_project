<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Settlement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function index(){
        $settlements=Settlement::withTrashed()
            ->orderBy('id', 'desc')->get();

        return view('admin.settlements.index')
            ->with('settlements',$settlements);
    }

    public function show(Settlement $settlement){
        ddd($settlement);
    }
    public function update(Request $request, Settlement $settlement): RedirectResponse
    {
        $settlement->calculate_yn = $request->status;
        if($request->status === 'Y'){
            $settlement->calculate_dt = now();
        }else{
            $settlement->calculate_dt = null;
        }
        $settlement->save();

        return redirect()->back();
    }
    public function settlementRestore($settlement): RedirectResponse
    {
        Settlement::withTrashed()->find($settlement)->restore();
        return redirect()->back();
    }
    public function destroy(Settlement $settlement): RedirectResponse
    {
        $settlement->delete();
        return redirect()->back();
    }
}
