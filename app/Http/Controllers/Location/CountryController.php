<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationCountry;
use Illuminate\Http\Request;
use App\Http\Requests\Location\Country\StoreRequest;
use App\Http\Requests\Location\Country\UpdateRequest;
use App\Actions\Location\Country\Store;
use App\Actions\Location\Country\Update;
use App\Actions\Location\Country\Delete;


class CountryController extends Controller
{
    protected $is_public = true;
    protected $need_permission = true;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = LocationCountry::query();
        $data = $this->search($model, $request);
        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\Location\Country\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $store = Store::run($request->validated());
        return $this->success($store);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LocationCountry  $locationCountry
     * @return \Illuminate\Http\Response
     */
    public function show(LocationCountry $locationCountry)
    {
        //$locationCountry->load();
        return $this->success($locationCountry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\Location\Country\UpdateRequest  $request
     * @param  \App\Models\LocationCountry  $locationCountry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, LocationCountry $locationCountry)
    {
        $update = Update::run($locationCountry, $request->validated());
        return $this->success($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationCountry  $locationCountry
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationCountry $locationCountry)
    {
        $delete = Delete::run($locationCountry);
        return $this->success($delete);
    }
}