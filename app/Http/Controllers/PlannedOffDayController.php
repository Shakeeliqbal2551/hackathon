<?php

namespace App\Http\Controllers;

use App\Models\PlannedOffDay;
use App\Http\Requests\StorePlannedOffDayRequest;
use App\Http\Requests\UpdatePlannedOffDayRequest;

class PlannedOffDayController extends Controller
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
     * @param  \App\Http\Requests\StorePlannedOffDayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlannedOffDayRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlannedOffDay  $plannedOffDay
     * @return \Illuminate\Http\Response
     */
    public function show(PlannedOffDay $plannedOffDay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlannedOffDay  $plannedOffDay
     * @return \Illuminate\Http\Response
     */
    public function edit(PlannedOffDay $plannedOffDay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlannedOffDayRequest  $request
     * @param  \App\Models\PlannedOffDay  $plannedOffDay
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlannedOffDayRequest $request, PlannedOffDay $plannedOffDay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlannedOffDay  $plannedOffDay
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlannedOffDay $plannedOffDay)
    {
        //
    }
}
