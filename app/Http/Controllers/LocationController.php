<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\Location\StoreRequest;
use App\Http\Requests\Location\UpdateRequest;
use App\Actions\Location\Store;
use App\Actions\Location\Update;
use App\Actions\Location\Delete;


class LocationController extends Controller
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
        $model = Location::query();
        $data = $this->search($model, $request);
        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\Location\StoreRequest  $request
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
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //$location->load();
        return $this->success($location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\Location\UpdateRequest  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Location $location)
    {
        $update = Update::run($location, $request->validated());
        return $this->success($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $delete = Delete::run($location);
        return $this->success($delete);
    }
}