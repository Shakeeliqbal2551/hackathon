<?php

namespace App\Http\Controllers;

use App\Models\OpeningHour;
use App\Http\Requests\StoreOpeningHourRequest;
use App\Http\Requests\UpdateOpeningHourRequest;

class OpeningHourController extends Controller
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
     * @param  \App\Http\Requests\StoreOpeningHourRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOpeningHourRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpeningHour  $openingHour
     * @return \Illuminate\Http\Response
     */
    public function show(OpeningHour $openingHour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpeningHour  $openingHour
     * @return \Illuminate\Http\Response
     */
    public function edit(OpeningHour $openingHour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOpeningHourRequest  $request
     * @param  \App\Models\OpeningHour  $openingHour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOpeningHourRequest $request, OpeningHour $openingHour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpeningHour  $openingHour
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpeningHour $openingHour)
    {
        //
    }
}
