<?php

namespace App\Http\Controllers\Hotels;

use App\Enter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('enter.import-port');

        /*if(auth()->check() && auth()->user()->hasAnyRole('개발','super-admin')){
            return view('enter.import-port');
        }else{
            return view('enter.index');
        }*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function managerCreate()
    {
        return view('enter.manager-create');
    }

    public function managerCreateCompleted()
    {
        return view('enter.manager-create-completed');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enter  $enter
     * @return \Illuminate\Http\Response
     */
    public function show(Enter $enter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enter  $enter
     * @return \Illuminate\Http\Response
     */
    public function edit(Enter $enter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enter  $enter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enter $enter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enter  $enter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enter $enter)
    {
        //
    }
}
