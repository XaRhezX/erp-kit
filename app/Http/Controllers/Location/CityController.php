<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationCity;
use Illuminate\Http\Request;
use App\Http\Requests\Location\City\StoreRequest;
use App\Http\Requests\Location\City\UpdateRequest;
use App\Actions\Location\City\Store;
use App\Actions\Location\City\Update;
use App\Actions\Location\City\Delete;


class CityController extends Controller
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
        $model = LocationCity::query();
        $data = $this->search($model, $request);
        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\Location\City\StoreRequest  $request
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
     * @param  \App\Models\LocationCity  $locationCity
     * @return \Illuminate\Http\Response
     */
    public function show(LocationCity $locationCity)
    {
        //$locationCity->load();
        return $this->success($locationCity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\Location\City\UpdateRequest  $request
     * @param  \App\Models\LocationCity  $locationCity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, LocationCity $locationCity)
    {
        $update = Update::run($locationCity,$request->validated());
        return $this->success($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationCity  $locationCity
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationCity $locationCity)
    {
        $delete = Delete::run($locationCity);
        return $this->success($delete);
    }
}
