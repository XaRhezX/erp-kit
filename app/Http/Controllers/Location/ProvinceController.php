<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\LocationProvince;
use Illuminate\Http\Request;
use App\Http\Requests\Location\Province\StoreRequest;
use App\Http\Requests\Location\Province\UpdateRequest;

class ProvinceController extends Controller
{
    protected $is_public = false;
    protected $need_permission = true;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = LocationProvince::query();
        $data = $this->search($model, $request);
        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\Location\Province\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $created = LocationProvince::create($request->validated());
        return $this->success($created);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LocationProvince  $locationProvince
     * @return \Illuminate\Http\Response
     */
    public function show(LocationProvince $locationProvince)
    {
        //$locationProvince->load();
        return $this->success($locationProvince);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\Location\Province\UpdateRequest  $request
     * @param  \App\Models\LocationProvince  $locationProvince
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, LocationProvince $locationProvince)
    {
        $locationProvince->update($request->validated());
        return $this->success($locationProvince);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationProvince  $locationProvince
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationProvince $locationProvince)
    {
        $locationProvince->delete();
        return $this->success($locationProvince);
    }
}
