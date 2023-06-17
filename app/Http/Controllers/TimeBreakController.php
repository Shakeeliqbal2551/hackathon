<?php

namespace App\Http\Controllers;

use App\Models\TimeBreak;
use App\Http\Requests\StoreTimeBreakRequest;
use App\Http\Requests\UpdateTimeBreakRequest;

class TimeBreakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreTimeBreakRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeBreakRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeBreak  $timeBreak
     * @return \Illuminate\Http\Response
     */
    public function show(TimeBreak $timeBreak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeBreak  $timeBreak
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeBreak $timeBreak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTimeBreakRequest  $request
     * @param  \App\Models\TimeBreak  $timeBreak
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimeBreakRequest $request, TimeBreak $timeBreak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeBreak  $timeBreak
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeBreak $timeBreak)
    {
        //
    }
}
